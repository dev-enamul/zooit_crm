<?php

use App\Http\Controllers\ApproveFreelancerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankDayController;
use App\Http\Controllers\ColdCallingController;
use App\Http\Controllers\ComissionReportController;
use App\Http\Controllers\CommissionControler;
use App\Http\Controllers\CommissionDeductedController;
use App\Http\Controllers\CommissionReportController;
use App\Http\Controllers\Common\AreaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositCategoryController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DepositTargetController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DtaReportController;
use App\Http\Controllers\DueReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FieldTargetController;
use App\Http\Controllers\FollowupAnalysisController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\FreelancerProfileController;
use App\Http\Controllers\LeadAnalysisController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NegotiationAnalysisController;
use App\Http\Controllers\NegotiationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PendingReportController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PresentationAnalysisController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReportController;
use App\Http\Controllers\ProductUnitController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectSettingController;
use App\Http\Controllers\ProspectingController;
use App\Http\Controllers\RejectionController;
use App\Http\Controllers\SalseController;
use App\Http\Controllers\SalseReturnController;
use App\Http\Controllers\SalseTransferController;
use App\Http\Controllers\SpecialComissionController;
use App\Http\Controllers\SpecialOffer;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\SpecialOfferReportController;
use App\Http\Controllers\TargetController;
use App\Http\Controllers\TargetReportController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TrainingCategoryController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\ZoneAreaController;
use App\Http\Controllers\ZoneController;
use App\Models\DepositCategory;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        # Common
        //Area
        Route::get('division-get-district', [AreaController::class, 'divisionGetDistrict'])->name('division-get-district');
        Route::get('district-get-upazila', [AreaController::class, 'districtGetUpazila'])->name('district-get-upazila');
        Route::get('upazila-get-union', [AreaController::class, 'upazilaGetUnion'])->name('upazila-get-union');
        Route::get('union-get-village', [AreaController::class, 'unionGetVillage'])->name('union-get-village');



        // Profile 
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');

        // Employee 
        Route::resource('employee', EmployeeController::class);
        Route::get('employee-permission/{id}', [EmployeeController::class, 'employee_permission'])->name('employee.permission');
        Route::post('user-permission-update', [EmployeeController::class, 'user_permission_update'])->name('user.permission.update');
        Route::get('employees/tree', [EmployeeController::class, 'tree'])->name('employees.tree');

        // Product 

        Route::resource('product', ProductController::class);
        Route::post('product-save/{id?}', [ProductController::class, 'save'])->name('product.save');
        Route::get('sold-unsold/{id}', [ProductController::class, 'sold_unsold'])->name('sold.unsold');
        Route::post('product-save/{id?}', [ProductController::class, 'save'])->name('product.save');
        Route::get('/product-approve', [ProductController::class, 'product_approve'])->name('product.approve');
        Route::post('/product-approve', [ProductController::class, 'productApprove'])->name('product.approve.save');
        Route::post('/product-search', [ProductController::class, 'productSearch'])->name('product.search');
        Route::any('product-delete/{id}', [ProductController::class, "productDelete"])->name('product.delete');

        Route::resource('unit', ProductUnitController::class);
        Route::post('unit-save/{id?}', [ProductUnitController::class, 'save'])->name('unit.save');
        Route::any('product-unit-delete/{id}', [ProductUnitController::class, "productUnitDelete"])->name('project.unit.delete');
        Route::post('/product-unit-search', [ProductUnitController::class, 'productUnitSearch'])->name('project.unit.search');

        // Freelancer 
        Route::resource('freelancer', FreelancerController::class);
        Route::resource('approve-freelancer', ApproveFreelancerController::class);
        Route::post('freelancer-save/{id?}', [FreelancerController::class, 'save'])->name('freelancer.save');
        Route::post('/freelancer-search', [FreelancerController::class, 'freelancerSearch'])->name('freelancer.search');
        Route::any('freelacer-delete/{id}', [FreelancerController::class, "freelancerDelete"])->name('freelancer.delete');
        Route::get('freelacer-print/{id}', [FreelancerController::class, "freelancerPrint"])->name('freelancer.print');

        Route::get('freelancer-profile', [FreelancerProfileController::class, 'freelancer_profile'])->name('freelancer.profile');
        Route::get('freelancer-hierarchy', [FreelancerProfileController::class, 'freelancer_hierarchy'])->name('freelancer.hierarchy');
        Route::get('freelancer-book-reading', [FreelancerProfileController::class, 'freelancer_book_reading'])->name('freelancer.book');
        Route::get('freelancer-field-work', [FreelancerProfileController::class, 'freelancer_field_work'])->name('freelancer.field.work');
        Route::get('freelancer-wallet', [FreelancerProfileController::class, 'freelancer_wallet'])->name('freelancer.wallet');
        Route::get('freelancer-salse', [FreelancerProfileController::class, 'freelancer_sales'])->name('freelancer.salse');



        // Customer 
        Route::resource('customer', CustomerController::class);
        Route::post('customer-save/{id?}', [CustomerController::class, 'save'])->name('customer.save');
        Route::post('/customer-search', [CustomerController::class, 'customerSearch'])->name('customer.search');
        Route::get('customer-profile', [CustomerController::class, 'customer_profile'])->name('customer.profile');
        Route::any('customer-delete/{id}', [CustomerController::class, "customerDelete"])->name('customer.delete');
        Route::get('customer-print/{id}', [CustomerController::class, "customerPrint"])->name('customer.print');

        // Prospecting 
        Route::resource('prospecting', ProspectingController::class);
        Route::post('prospecting-save/{id?}', [ProspectingController::class, 'save'])->name('prospecting.save');
        Route::any('prospecting-delete/{id}', [ProspectingController::class, "prospectingDelete"])->name('prospecting.delete');


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

        // Salse
        Route::resource('deposit', DepositController::class);

        // Rejection
        Route::resource('rejection', RejectionController::class);

        // Return
        Route::resource('return', SalseReturnController::class);

        // Transfer
        Route::resource('transfer', SalseTransferController::class);

        // Settings ============================= 
        // Profession
        Route::resource('profession', ProfessionController::class);
        Route::post('profession-update', [ProfessionController::class, 'update'])->name('profession.update');
        // Location
        Route::resource('union', UnionController::class);
        Route::resource('village', VillageController::class);
        Route::get('village-update', [VillageController::class, 'update'])->name('village.update');
        Route::resource('zone', ZoneController::class);
        Route::post('zone-update', [ZoneController::class, 'update'])->name('zone.update');
        Route::resource('area', ZoneAreaController::class);
        Route::post('area-update', [ZoneAreaController::class, 'update'])->name('area.update');

        // Emp Position & Permission 
        Route::resource('designation', DesignationController::class);
        Route::post('designation-update', [DesignationController::class, 'update'])->name('designation.update');
        Route::get('designation-permission/{id}', [DesignationController::class, 'designation_permission'])->name('designation.permission');
        Route::post('designation-permission-update', [DesignationController::class, 'designation_permission_update'])->name('designation.permission.update');
        Route::resource('permission', PermissionController::class);
        // Special 
        Route::resource('commission', CommissionControler::class);
        Route::post('commission-update', [CommissionControler::class, 'update'])->name('commission.update');
        Route::resource('special-commission', SpecialComissionController::class);
        Route::resource('commission-deducted-setting', CommissionDeductedController::class);
        // Bank
        Route::resource('bank', BankController::class);
        Route::resource('bank-day', BankDayController::class);
        // Project 
        Route::get('unit-type', [ProjectSettingController::class, 'unit_type'])->name('unit.type');
        Route::post('unit-type-store', [ProjectSettingController::class, "unit_type_store"])->name('unit.type.store');
        Route::post('unit-type-update', [ProjectSettingController::class, "unit_type_update"])->name('unit.type.update');
        Route::any('unit-type-delete/{id}', [ProjectSettingController::class, "unit_type_delete"])->name('unit.type.delete');
        Route::get('unit-category', [ProjectSettingController::class, 'unit_category'])->name('unit.category');
        Route::post('unit-category-store', [ProjectSettingController::class, "unit_category_store"])->name('unit.category.store');
        Route::post('unit-category-update', [ProjectSettingController::class, "unit_category_update"])->name('unit.category.update');
        Route::any('unit-category-delete/{id}', [ProjectSettingController::class, "unit_category_delete"])->name('unit.category.delete');

        // Deposit Category 
        Route::resource('deposit-category', DepositCategoryController::class);
        Route::resource('special-offer', SpecialOfferController::class);
        Route::get('special-offer-achiver',[SpecialOfferController::class,'achiver'])->name('special.offer.achiver');


        //Reports 
        Route::get('monthly-target-achive', [CommissionReportController::class, 'monthly_target_achive'])->name('monthly.target.achive');
        Route::get('mst-commission', [CommissionReportController::class, 'mst_commission'])->name('mst.commission');
        Route::get('mst-commission-details/{id}', [CommissionReportController::class, 'mst_commission_details'])->name('mst.commission.details');
        Route::get('rsa-co-ordinator', [CommissionReportController::class, 'rsa_co_ordinator'])->name('rsa.co.ordinator');
        Route::get('cc-report', [CommissionReportController::class, 'cc_report'])->name('cc.report');
        Route::get('pending-report',[PendingReportController::class,'pending_report'])->name('pending.report');


        Route::get('dt-achivement', [DtaReportController::class, 'dt_achivement'])->name('dt.achivement');
        Route::get('daily-deposit', [DtaReportController::class, 'daily_deposit'])->name('daily.deposit');
        Route::get('deposit-report', [DtaReportController::class, 'deposit_report'])->name('deposit.report');
        Route::get('due-report', [DueReportController::class, 'due_report'])->name('due.report');
        Route::get('floor-wise-sold-unsold-report', [ProductReportController::class, 'floor_wise_sold'])->name('floor.wise.sold.report');

        // Route::get('project-wise-sold-unsold-report',[ProductReportController::class,'project_wise_sold'])->name('project.wise.sold.report');



        // field target
        Route::get('assign-field-target', [FieldTargetController::class, 'assign_target'])->name('assign.field.target');
        Route::post('field-target-save', [FieldTargetController::class, 'field_target_save'])->name('field.target.save');
        Route::get('my-field-target', [FieldTargetController::class, 'my_field_target'])->name('my.field.target');
        Route::get('assign-field-target-list', [FieldTargetController::class, 'assign_target_list'])->name('assign.field.target.list'); 
        Route::get('marketing-field-report', [FieldTargetController::class, 'marketing_field_report'])->name('marketing.field.report');
        Route::get('salse-field-report', [FieldTargetController::class, 'salse_field_report'])->name('salse.field.report');
        // task 
        Route::get('task-complete', [TaskController::class, 'task_complete'])->name('task.complete');
        Route::get('my-task', [TaskController::class, 'my_task'])->name('my.task');
        Route::get('submit-task/{id}', [TaskController::class, 'submit_task'])->name('submit.task');
        Route::get('reject-task/{id}', [TaskController::class, 'reject_task'])->name('reject.task');
        Route::get('assign-task-list',[TaskController::class,'assign_task_list'])->name('assign.task.list');
        Route::get('task-details/{id}',[TaskController::class,'task_details'])->name('task.details');
        Route::get('assign-task',[TaskController::class,'assign_task'])->name('assign.task');
        Route::post('task-save',[TaskController::class,'task_save'])->name('task.save');

        // deposit target 
        Route::get('deposit-target', [DepositTargetController::class, 'target'])->name('deposit.target');
        Route::get('deposit-target-asign', [DepositTargetController::class, 'target_asign'])->name('deposit.target.asign');
        Route::get('deposit-target-asign-list', [DepositTargetController::class, 'target_asign_list'])->name('deposit.target.asign.list');
        Route::get('project-deposit-target', [DepositTargetController::class, 'project_deposit_target'])->name('project.deposit.target');
        Route::get('direct-deposit-target', [DepositTargetController::class, 'direct_deposit_target'])->name('direct.deposit.target');
        Route::post('deposit-target-save', [DepositTargetController::class, 'deposit_target_save'])->name('deposit.target.save');

        // Training
        Route::resource('training-category', TrainingCategoryController::class);
        Route::post('training-category-update', [TrainingCategoryController::class, 'update'])->name('training.category.update');
        Route::get('training-schedule-create', [TrainingController::class, 'training_schedule_create'])->name('training.schedule.create');
        Route::get('training-schedule', [TrainingController::class, 'training_schedule'])->name('training.schedule');
        Route::get('training-attendance', [TrainingController::class, 'training_attendance'])->name('training.attendance');
        Route::get('training-history', [TrainingController::class, 'training_history'])->name('training.history');
        Route::get('training-details', [TrainingController::class, 'training_details'])->name('training.details');

        // Meeting  
        Route::resource('meeting', MeetingController::class);

        // Header Route 
        Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
});
Route::get('/migrate-refresh', [DashboardController::class, 'migrate_fresh']);

Route::get('function_test', function () {
        $topUser = \App\Models\ReportingUser::where('user_id', 1)
                ->select(['id', 'user_id'])
                ->first();

        $organogram = getOrganogram($topUser); 

        return view('organogram', ['organogram' => $organogram]);
});