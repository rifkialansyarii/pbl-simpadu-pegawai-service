<?php

use App\Http\Controllers\ChangeRequestController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\VillageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:auth-jwt'])->group(function () {

    Route::get('/employees', [EmployeeController::class, 'index'])->middleware('can:viewAny, App\Models\Employee');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->middleware('can:view,employee');
    Route::get('/employees/info/count', [EmployeeController::class, 'showTotal'])->middleware('can:viewAny, App\Models\Employee');
    Route::post('/employees', [EmployeeController::class, 'store'])->middleware('can:create, App\Models\Employee');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->middleware('can:update,employee');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->middleware('can:delete,employee');

    Route::get('/change-requests', [ChangeRequestController::class, 'index'])->middleware('can:viewAny, App\Models\ChangeRequest');
    Route::get('/change-requests/info/newly', [ChangeRequestController::class, 'showNewly'])->middleware('can:viewNewly, App\Models\ChangeRequest');
    Route::get('/change-requests/info/pending', [ChangeRequestController::class, 'showTotalPendingStatus'])->middleware('can:viewTotalPendingStatus, App\Models\ChangeRequest');
    Route::put('/change-requests/{changeRequest}', [ChangeRequestController::class, 'update'])->middleware('can:update,changeRequest');
});

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/provinces', [ProvinceController::class, 'index']);

Route::get('/cities', [CityController::class, 'index']);
Route::get('/cities/{provinceCode}', [CityController::class, 'showByProvince']);

Route::get('/districts', [DistrictController::class, 'index']);
Route::get('/districts/{cityCode}', [DistrictController::class, 'showByCity']);

Route::get('/villages', [VillageController::class, 'index']);
Route::get('/villages/{districtCode}', [VillageController::class, 'showByDistrict']);