<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;
use App\Models\Employee;
use App\Services\ChangeRequestService;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\ResponseFromFile;
use Knuckles\Scribe\Attributes\UrlParam;

/**
 * 
 * @group Pegawai
 * Endpoint terkait operasi CRUD untuk data pegawai, termasuk penambahan, pembaruan, penghapusan, dan pengambilan data pegawai.
 */
class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeService $service,
        private ChangeRequestService $changeRequestService
    ) {
    }

    /**
     * Ambil data pegawai
     * 
     * Endpoint bertujuan untuk **mengambil semua data pegawai**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     */
    #[QueryParam("page", "int", "Nomor Halaman, required: false, Default: 1")]
    #[QueryParam("search", "string", "Kata kunci pencarian, required: false, Pencarian berdasarkan nama pegawai, NIP, atau NIK")]
    #[ResponseFromFile(file: 'responses/employee/get_employees.json', status: 200, description: 'Sukses mendapatkan data pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search'),
        ];
        $employeCollection = new EmployeeCollection($this->service->getAllEmployees($filters));
        return $employeCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
        ;
    }

    /**
     * Detail pegawai
     * 
     * Endpoint bertujuan untuk **melihat detail pegawai**.
     * 
     * **dosen** atau **pegawai** hanya dapat melihat detail **MILIKNYA SENDIRI**.
     * 
     * admin-pegawai dan super-admin dapat melihat detail pegawai manapun.
     */    
    #[ResponseFromFile(file: 'responses/employee/detail_employee.json', status: 200, description: 'Sukses mendapatkan detail pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/not_found.json', status: 404, description: 'Data tidak ditemukan')]
    #[UrlParam("employee_id", "string", "UUID Pegawai", example: "123e4567-e89b-12d3-a456-426614174000")]
    public function show(Employee $employee)
    {
        $employeeResource = new EmployeeResource($this->service->getEmployeeById($employee));
        $employeeResource->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
        return $employeeResource;
    }

    /**
     * Menambahkan data pegawai
     * 
     * Endpoint bertujuan untuk **menambahkan data pegawai**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     */
    #[ResponseFromFile(file: 'responses/employee/detail_employee.json', status: 201, description: 'Sukses menambahkan data pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function store(StoreEmployeeRequest $request)
    {
        $employeeResource = new EmployeeResource($this->service->createEmployee($request->validated()));
        $employeeResource->additional([
            'success' => true,
            'message' => 'Data created successfully',
            'code' => 201,
        ]);
        return $employeeResource;
    }

    /**
     * Update data pegawai
     * 
     * Endpoint bertujuan untuk **mengupdate data pegawai**.
     * 
     * **dosen** atau **pegawai** hanya dapat mengupdate data **MILIKNYA SENDIRI**.
     * 
     * admin-pegawai dan super-admin dapat mengupdate data pegawai manapun.
     * 
     * **NOTE**: Ketika dosen atau pegawai mengubah data **NIK**, **NIP** dan **NAMA** miliknya, maka perubahan ini **OTOMATIS DIKIRIMKAN KE ADMIN** dan harus **MENUNGGU ADMIN MENYETUJUI**.
     */
    #[ResponseFromFile(file: 'responses/employee/detail_employee.json', status: 200, description: 'Sukses mengubah data pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/not_found.json', status: 404, description: 'Data tidak ditemukan')]
    #[UrlParam("employee_id", "string", "UUID Pegawai", example: "123e4567-e89b-12d3-a456-426614174000")]
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employeeResource = new EmployeeResource($this->service->updateEmployee($request, $employee));
        $employeeResource->additional([
            'success' => true,
            'message' => 'Data updated successfully',
            'code' => 200,
        ]);
        return $employeeResource;
    }

    /**
     * Hapus data pegawai
     * 
     * Endpoint bertujuan untuk **menghapus data pegawai**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     * 
     */
    #[ResponseFromFile(file: 'responses/success_delete.json', status: 200, description: 'Sukses menghapus data pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    #[ResponseFromFile(file: 'responses/not_found.json', status: 404, description: 'Data tidak ditemukan')]
    #[UrlParam("employee", "string", "UUID Pegawai", example: "123e4567-e89b-12d3-a456-426614174000")]
    public function destroy(Employee $employee)
    {
        $this->service->deleteEmployee($employee);
        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully',
            'code' => 200,
        ]);
    }

    /**
     * Ambil total data pegawai
     * 
     * Endpoint bertujuan untuk **mengambil total data pegawai**.
     * 
     * Fitur ini **hanya bisa dijalankan** oleh user **admin-pegawai** dan **super-admin**.
     * 
     */
    #[ResponseFromFile(file: 'responses/employee/total_employee.json', status: 200, description: 'Sukses mendapatkan total data pegawai')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function showTotal()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
            'data' => [
                'total_employee' => $this->service->getTotalEmployee()
            ]
        ]);
    }
}