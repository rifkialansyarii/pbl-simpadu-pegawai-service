<?php

namespace App\Http\Controllers;

use App\Http\Requests\BulkDeleteFileUploadRequest;
use App\Http\Requests\StoreFileUploadRequest;
use App\Http\Resources\FileUploadCollection;
use App\Models\FileUpload;
use App\Services\FileUploadService;
use Exception;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Header;
use Knuckles\Scribe\Attributes\ResponseFromFile;

/**
 * 
 * @group File Upload
 * Endpoint terkait operasi CRUD untuk file upload, termasuk pengambilan data file yang telah diupload, unggah file / upload, mengunduh file dan penghapusan.
 */
class FileUploadController extends Controller
{
    public function __construct(private FileUploadService $service)
    {
    }

    /**
     * Ambil Semua File yang Di-Upload
     * 
     * Endpoint bertujuan untuk **mengambil seluruh data file yang telah di-upload**.
     * 
     * Jika usernya adalah **dosen** maka hanya akan menampilkan semua **data sesi kelas milik dosen**.
     * 
     * Jika usernya adalah **mahasiswa** maka hanya akan menampilkan semua **data sesi kelas milik mahasiswa**.
     *  
     */
    #[ResponseFromFile(file: 'responses/file_upload/success_get.json', status: 200, description: 'Sukses mendapatkan data file upload')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function index(Request $request)
    {
        $fileUploadCollection = new FileUploadCollection($this->service->showAllFileUpload($request->user()));
        return $fileUploadCollection->additional([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'code' => 200,
        ]);
    }

    /**
     * Unggah / Upload File
     * 
     * Endpoint bertujuan untuk **mengunggah / upload file**.
     * 
     * Juga **bisa mengupload beberapa file sekaligus** (*maksimum 5 file* dan **ukuran per file maksimal 10 MB**).
     * 
     * Hanya **dosen** dan **mahasiswa** yang dapat mengupload file.
     * 
     * **Noted**: Gunakan Content-Type: multipart/form-data, bukan application/json 
     *  
     */
    #[Header("Content-Type", "application/json")]
    #[ResponseFromFile(file: 'responses/file_upload/success_upload.json', status: 200, description: 'Sukses mengunggah file')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function store(StoreFileUploadRequest $request)
    {
        try {
            $fileUploadCollection = new FileUploadCollection($this->service->uploadFile($request->validated(), $request->user()->id));
            return $fileUploadCollection->additional([
                'success' => true,
                'message' => 'File uploaded successfully',
                'code' => 201,
            ]);
        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    /**
     * Unduh / Download File
     * 
     * Endpoint bertujuan untuk **mengunduh / download file**.
     *  
     * Hanya **dosen** dan **mahasiswa** yang dapat mengupload file.
     * 
     * **User hanya bisa mengunduh file miliknya sendiri**
     *  
     */
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function download(FileUpload $fileUpload)
    {
        try {
            $path = $this->service->getDownloadPath($fileUpload);
            if (!file_exists($path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'resource not found',
                    'code' => 404,
                ], 404);
            }

            return response()->download($path, $fileUpload->original_file_name);

        } catch (Exception $e) {
            $isDebug = config('app.debug');

            $response = [
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errors' => $e->getMessage()
            ];

            if ($isDebug) {
                $response['errors'] = $e->getMessage();
                $response['trace'] = $e->getTrace();
            }

            return response()->json($response, 500);
        }
    }

    /**
     * Hapus File
     * 
     * Endpoint bertujuan untuk **menghapus file** yang sudah di-upload.
     *  
     * Hanya **dosen** dan **mahasiswa** yang dapat menghapus file.
     * 
     * **User hanya bisa menghapus file miliknya sendiri**
     *  
     */
    #[ResponseFromFile(file: 'responses/file_upload/success_delete.json', status: 200, description: 'Sukses menghapus file')]
    #[ResponseFromFile(file: 'responses/unauthenticated.json', status: 401, description: 'Tidak terotentikasi')]
    #[ResponseFromFile(file: 'responses/expired_token.json', status: 401, description: 'Token expired')]
    #[ResponseFromFile(file: 'responses/unauthorized.json', status: 403, description: 'Tidak memiliki izin')]
    public function destroy(BulkDeleteFileUploadRequest $request)
    {
        try {
            $attributes = $request->validated()['uuids'];

            $files = $this->service->checkFileOwnership($attributes, $request->user()->id);

            $validFileIds = $files->pluck('id')->toArray();

            $this->service->deleteFile($validFileIds);
            return response()->json([
                'success' => true,
                'message' => 'Data deleted successfully',
                'code' => 200,
                'deleted_count' => count($validFileIds),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'an error occurred while processing',
                'code' => 500,
                'errors' => $e->getMessage()
            ], 500);
        }
    }
}
