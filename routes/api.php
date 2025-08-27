<?php

use App\Http\Controllers\Api\ApiEmployeeWorktingTimeController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiTaskController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\LeadStoreController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeWorktingTimeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('services',[LeadStoreController::class,'services']);
Route::post('lead-save',[LeadStoreController::class,'saveLead']);
Route::post('login',[ApiLoginController::class,"login"]);



Route::middleware('auth:sanctum')->group(function () { 
    Route::post('/logout', [ApiLoginController::class, 'logout']);

    Route::get('users', [ApiUserController::class, 'users']); 
    Route::post('users-find', [ApiUserController::class, 'findUser']); 
    Route::post('save-user', [ApiUserController::class, 'save']); 
    Route::post('followup', [ApiUserController::class, 'followupSave']); 
    Route::get('followup', [ApiUserController::class, 'followup']); 

    // Projects 
    Route::get('projects',[ApiTaskController::class,'projects']);
    Route::resource('tasks',ApiTaskController::class); 
    Route::get('start-work',[ApiEmployeeWorktingTimeController::class,'startWork']);
    Route::get('end-work',[ApiEmployeeWorktingTimeController::class,'endWork']);
    Route::post('work-screenshort-upload',[ApiEmployeeWorktingTimeController::class,'UploadScreenshort']);

});
 
