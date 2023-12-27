<?php

use App\Http\Controllers\ColdCallingController;
use App\Http\Controllers\ComissionReportController;
use App\Http\Controllers\CommissionReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmpPositionController;
use App\Http\Controllers\FollowupAnalysisController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\LeadAnalysisController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NegotiationAnalysisController;
use App\Http\Controllers\NegotiationController;
use App\Http\Controllers\PresentationAnalysisController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProspectingController;
use App\Http\Controllers\RejectionController;
use App\Http\Controllers\SalseController;
use App\Http\Controllers\SpecialComissionController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TargetReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 

Route::get('/',[DashboardController::class,'index'])->name('index'); 

// Profile 
Route::get('profile',[ProfileController::class,'index'])->name('profile');

// Employee 
Route::resource('employee', EmployeeController::class); 
Route::get('employees/tree',[EmployeeController::class,'tree'])->name('employees.tree');

// Product 
Route::resource('product', ProductController::class);  

// Freelancer 
Route::resource('freelancer', FreelancerController::class); 

// Customer 
Route::resource('customer', CustomerController::class); 

// Prospecting 
Route::resource('prospecting', ProspectingController::class); 

// Prospecting 
Route::resource('cold-calling', ColdCallingController::class); 

// Lead 
Route::resource('lead', LeadController::class); 

// Lead Analysis
Route::resource('lead-analysis', LeadAnalysisController::class); 

// Presentation
Route::resource('presentation', PresentationController::class); 

// Presentation Analysis
Route::resource('presentation_analysis', PresentationAnalysisController::class); 

// Follow Up
Route::resource('followup', FollowupController::class); 

// Follow Up Analysis
Route::resource('followup-analysis', FollowupAnalysisController::class); 

// Negotation
Route::resource('negotiation', NegotiationController::class); 

// Negotation Analysis
Route::resource('negotiation-analysis', NegotiationAnalysisController::class); 

// Salse
Route::resource('salse', SalseController::class); 

// Rejection
Route::resource('rejection', RejectionController::class);

// Profession
Route::resource('profession', ProfessionController::class);

// Location
Route::resource('union', UnionController::class);
Route::resource('village', VillageController::class);

 
// Emp Position
Route::resource('employee-position', EmpPositionController::class);

// Special Commision
Route::resource('special-comission', SpecialComissionController::class);


//Reports 
Route::get('salse-commission-summary',[CommissionReportController::class,'salse_comission_summary'])->name('salse.commission.summery');
Route::get('target-report',[TargetReportController::class,'target_sheet'])->name('target.sheet');
Route::get('deposit-report-salse-executive',[DepositReportController::class,'salse_executive'])->name('deposit.report.salse.executive');
Route::get('deposit-report-asm-dsm',[DepositReportController::class,'asm_dsm'])->name('deposit.report.asm.dsm');
Route::get('deposit-report-area-incharge',[DepositReportController::class,'area_incharge'])->name('deposit.report.area.incharge');


// target
Route::get('target-achive',[TargetController::class,'target_achive'])->name('target.achive');
Route::get('today-target',[TargetController::class,'today_target'])->name('today.target'); 

// task 
Route::get('task-complete',[TaskController::class,'task_complete'])->name('task.complete'); 

// Training
Route::resource('training', TrainingController::class);
Route::get('training-schedule',[TrainingController::class,'training_schedule'])->name('training.schedule');
Route::get('training-attendance',[TrainingController::class,'training_attendance'])->name('training.attendance');
Route::get('training-history',[TrainingController::class,'training_history'])->name('training.history');
Route::get('training-details',[TrainingController::class,'training_details'])->name('training.details');

// Meeting  
Route::resource('meeting',MeetingController::class);


 

 

