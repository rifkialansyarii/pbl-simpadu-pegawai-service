<?php

use App\Http\Controllers\ChangeRequestController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:auth-jwt'])->group(function () {

    Route::get('/employee', [EmployeeController::class, 'index'])->middleware('can:viewAny, App\Models\Employee');
    Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->middleware('can:view,employee');
    Route::post('/employee', [EmployeeController::class, 'store'])->middleware('can:create, App\Models\Employee');
    Route::put('/employee/{employee}', [EmployeeController::class, 'update'])->middleware('can:update,employee');
    Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->middleware('can:delete,employee');

    Route::get('/change-request', [ChangeRequestController::class, 'index'])->middleware('can:viewAny, App\Models\ChangeRequest');
    Route::post('/change-request', [ChangeRequestController::class, 'store'])->middleware('can:create,App\Models\ChangeRequest');
    Route::put('/change-request/{changeRequest}', [ChangeRequestController::class, 'update'])->middleware('can:update,changeRequest');

});