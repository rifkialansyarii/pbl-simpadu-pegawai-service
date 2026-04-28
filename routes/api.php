<?php

use App\Http\Controllers\ChangeRequestController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/employee/{employee}', [EmployeeController::class, 'show']);
Route::post('/employee', [EmployeeController::class, 'store']);
Route::put('/employee/{employee}', [EmployeeController::class, 'update']);
Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy']);

Route::middleware(['auth:auth-jwt'])->group(function () {
    Route::get('/change-request', [ChangeRequestController::class, 'index']);
    Route::get('/change-request/{changeRequest}', [ChangeRequestController::class, 'show']);
    Route::put('/change-request/{changeRequest}', [ChangeRequestController::class, 'update'])->middleware('can:update,changeRequest');
});