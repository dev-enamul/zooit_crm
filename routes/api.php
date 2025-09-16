<?php

use App\Http\Controllers\Api\ApiDashboardController;
use App\Http\Controllers\Api\ApiEmployeeController;
use App\Http\Controllers\Api\ApiEmployeeWorktingTimeController;
use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ApiProjectController;
use App\Http\Controllers\Api\ApiTaskController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\LeadStoreController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeWorktingTimeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Twilio\TwiML\Video\Room;

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
    Route::get('projects',[ApiProjectController::class,'projects']);
    Route::get('project/{id}',[ApiProjectController::class,'projectDetails']);
    Route::get('project/team/{id}',[ApiProjectController::class,'projectTeamDetails']);
    Route::get('project/task/{id}',[ApiProjectController::class,'projectTaskDetails']);

    // Task 
    Route::resource('tasks',ApiTaskController::class);
    Route::post('completed-task', [ApiTaskController::class, 'completedTask']);
    Route::post('assign-task',[ApiTaskController::class,'assignTask']);
    Route::post('start-work',[ApiEmployeeWorktingTimeController::class,'startWork']);
    Route::post('end-work',[ApiEmployeeWorktingTimeController::class,'endWork']);
    Route::post('work-screenshort-upload',[ApiEmployeeWorktingTimeController::class,'UploadScreenshort']);

    // Employee 
    Route::get('employees',[ApiEmployeeController::class,'employees']);

    // Dashboard 
    Route::get('today-activity',[ApiDashboardController::class,'todayActivity']);
    Route::get('urgent-tasks',[ApiDashboardController::class,'urgentTasks']);
    Route::get('card-data',[ApiDashboardController::class,'cardData']);
    Route::get('work-summary',[ApiDashboardController::class,'workSummary']);

    Route::post('change-password', [ApiLoginController::class, 'changePassword']);
});
 
