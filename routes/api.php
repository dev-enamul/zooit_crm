<?php

use App\Http\Controllers\Api\LeadStoreController;
use App\Http\Controllers\CustomerController; 
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
