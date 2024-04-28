<?php

use App\Http\Controllers\ApproveFreelancerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankDayController;
use App\Http\Controllers\ColdCallingController;
use App\Http\Controllers\ComissionReportController;
use App\Http\Controllers\CommissionControler;
use App\Http\Controllers\CommissionDeductedController;
use App\Http\Controllers\CommissionReportController;
use App\Http\Controllers\Common\AreaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositCategoryController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DepositTargetController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DtaReportController;
use App\Http\Controllers\DueReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeEditController;
use App\Http\Controllers\EmployeePermissionController;
use App\Http\Controllers\EmployeeTreeController;
use App\Http\Controllers\FieldTargetController;
use App\Http\Controllers\FollowupAnalysisController;
use App\Http\Controllers\FollowupController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\FreelancerEditController;
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
use App\Http\Controllers\SearchController;
use App\Http\Controllers\settings\ApproveSettingController;
use App\Http\Controllers\SpecialComissionController; 
use App\Http\Controllers\SpecialOfferController; 
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TrainingCategoryController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\ZoneAreaController;
use App\Http\Controllers\ZoneController; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Events\Message;
use App\Events\UserCreatedEvent;
use App\Http\Controllers\CommonController; 
use App\Http\Controllers\EmployeeImportController;
use App\Http\Controllers\ExistingSalseController; 
use App\Http\Controllers\SalseApproveController;
use App\Http\Controllers\settings\LastSubmitTimeSettingController;
use App\Http\Controllers\UpazilaController;
use App\Models\Customer;
use App\Models\Prospecting;
use App\Models\ReportingUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        Route::get('bypass/{id}', [DashboardController::class, 'bypass'])->name('bypass');
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/id', [DashboardController::class, 'id']);
        Route::get('/search',[SearchController::class,'search'])->name('search');

        Route::post('update/password',[DashboardController::class,'change_password'])->name('update.password');
 
        //Area
        Route::get('division-get-district', [AreaController::class, 'divisionGetDistrict'])->name('division-get-district');
        Route::get('district-get-upazila', [AreaController::class, 'districtGetUpazila'])->name('district-get-upazila');
        Route::get('upazila-get-union', [AreaController::class, 'upazilaGetUnion'])->name('upazila-get-union');
        Route::get('union-get-village', [AreaController::class, 'unionGetVillage'])->name('union-get-village');



        // Profile 
        Route::get('profile/{id}', [ProfileController::class, 'profile'])->name('profile');
        Route::get('profile/hierarchy/{id}', [ProfileController::class, 'hierarchy'])->name('profile.hierarchy'); 
        Route::get('freelancer/join/process/{id}', [ProfileController::class, 'freelancer_join_process'])->name('freelancer.join.process');
        Route::get('profile-target-achive/{id}', [ProfileController::class, 'target_achive'])->name('profile.target.achive');
        Route::get('profile-wallet/{id}', [ProfileController::class, 'wallet'])->name('profile.wallet');

        // Employee 
        Route::resource('employee', EmployeeController::class);
        Route::get('select2-employee', [EmployeeController::class, 'select2_employee'])->name('select2.employee');
        Route::get('select2-employee-freelancer', [EmployeeController::class, 'select2_employee_freelancer'])->name('select2.employee.freelancer');
        Route::get('select2-employee-encode', [EmployeeController::class, 'select2_employee_encode'])->name('select2-employee-encode');
        Route::get('all-employee', [CommonController::class, 'all_employee'])->name('all.employee');
        Route::get('import', [EmployeeImportController::class, 'index'])->name('import');
        Route::post('employee-import', [EmployeeImportController::class, 'import'])->name('employee.import');
        Route::post('employee-save', [EmployeeController::class, 'save'])->name('employee.save'); 
        Route::get('refresh-password/{id}',[ResetPasswordController::class,'fresh'])->name('refresh.password');
         
        Route::get('reporting/user/edit/{id}', [EmployeeEditController::class, 'reporting_edit'])->name('reporting.user.edit');
        Route::post('reporting/user/update/{id}', [EmployeeEditController::class, 'reporting_update'])->name('reporting.user.update');
        Route::get('select2-reporting-user', [EmployeeEditController::class, 'select2_reporting_user'])->name('select2.reporting.user');
        
        Route::get('area/user/edit/{id}', [EmployeeEditController::class, 'area_edit'])->name('user.area.edit');
        Route::post('area/user/update/{id}', [EmployeeEditController::class, 'area_update'])->name('user.area.update');

        Route::get('designation/user/edit/{id}', [EmployeeEditController::class, 'designation_edit'])->name('designation.user.edit');
        Route::post('designation/user/update/{id}', [EmployeeEditController::class, 'designation_update'])->name('designation.user.update');
        Route::any('deactive/user/{id}', [EmployeeEditController::class, 'deactive_user'])->name('deactive.user');
        Route::get('user-details/{id}', [EmployeeController::class, "userDetails"])->name('user.details');

        #Employee Permission 
        Route::get('user-permission/{id}', [EmployeePermissionController::class, 'employee_permission'])->name('employee.permission');
        Route::post('user-permission-update', [EmployeePermissionController::class, 'user_permission_update'])->name('user.permission.update');
        
        #Employee Tree
        Route::get('employees/tree', [EmployeeTreeController::class, 'tree'])->name('employees.tree');
        Route::get('employees-hierarchy', [EmployeeTreeController::class, 'hierarchy'])->name('employees.hierarchy');
        Route::get('employees-hierarchy-2', [EmployeeTreeController::class, 'hierarchy2'])->name('employees.hierarchy2');

        #Product  
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
        Route::get('complete-training/{id}', [ApproveFreelancerController::class, 'complete_training'])->name('complete.training');
        Route::post('freelancer-save/{id?}', [FreelancerController::class, 'save'])->name('freelancer.save'); 
         
 
        Route::get('designation/freelancer/edit/{id}', [FreelancerEditController::class, 'designation_edit'])->name('designation.freelancer.edit');
        Route::post('designation/freelancer/update/{id}', [FreelancerEditController::class, 'designation_update'])->name('designation.freelancer.update');
        Route::any('deactive/freelancer/{id}', [FreelancerEditController::class, 'deactive_user'])->name('deactive.freelancer');

 
        //Route::any('/freelacer-delete/{id}', [FreelancerController::class, "freelancerDelete"])->name('freelancer.delete');

        Route::get('freelancer-profile', [FreelancerProfileController::class, 'freelancer_profile'])->name('freelancer.profile');
        Route::get('freelancer-hierarchy', [FreelancerProfileController::class, 'freelancer_hierarchy'])->name('freelancer.hierarchy');
        Route::get('freelancer-book-reading', [FreelancerProfileController::class, 'freelancer_book_reading'])->name('freelancer.book');
        Route::get('freelancer-field-work', [FreelancerProfileController::class, 'freelancer_field_work'])->name('freelancer.field.work');
        Route::get('freelancer-wallet', [FreelancerProfileController::class, 'freelancer_wallet'])->name('freelancer.wallet');
        Route::get('freelancer-salse', [FreelancerProfileController::class, 'freelancer_sales'])->name('freelancer.salse');



        // Customer 
        Route::resource('customer', CustomerController::class);
        
        Route::post('customer-save/{id?}', [CustomerController::class, 'save'])->name('customer.save'); 
        Route::get('customer-approve', [CustomerController::class, 'customer_approve'])->name('customer.approve');
        Route::post('customer-approve-save', [CustomerController::class, 'customer_approve_save'])->name('customer.approve.save');
       
        Route::get('customer-profile/{id}', [CustomerProfileController::class, 'index'])->name('customer.profile');
        Route::any('customer-delete/{id}', [CustomerController::class, "customerDelete"])->name('customer.delete');
        Route::get('customer-details/{id}', [CustomerController::class, "customerDetails"])->name('customer.details');

        // Prospecting a
        Route::resource('prospecting', ProspectingController::class);
        Route::get('select2-prospecting-customer', [ProspectingController::class, 'select2_customer'])->name('select2.prospecting.customer');
        Route::post('prospecting-save/{id?}', [ProspectingController::class, 'save'])->name('prospecting.save');
        Route::any('prospecting-delete/{id}', [ProspectingController::class, "prospectingDelete"])->name('prospecting.delete');
        Route::get('prospecting-approve', [ProspectingController::class, 'prospecting_approve'])->name('prospecting.approve');
        Route::post('product-approve-save', [ProspectingController::class, 'prospectingApprove'])->name('prospecting.approve.save');

        // Cold Calling 
        Route::resource('cold-calling', ColdCallingController::class); 
        Route::get('select2-cold-calling-customer', [ColdCallingController::class, 'select2_customer'])->name('select2.cold_calling.customer');
        Route::post('cold-calling-save/{id?}', [ColdCallingController::class, 'save'])->name('cold_calling.save');
        Route::any('cold-calling-delete/{id}', [ColdCallingController::class, "colCallingDelete"])->name('cold_calling.delete');
        Route::get('cold-calling-approve', [ColdCallingController::class, 'coldCallingApprove'])->name('cold-calling.approve');
        Route::post('cold-calling-approve-save', [ColdCallingController::class, 'coldCallingApproveSave'])->name('cold-calling.approve.save');

        // Lead 
        Route::resource('lead', LeadController::class);
        Route::get('select2-lead-customer', [LeadController::class, 'select2_customer'])->name('select2.lead.customer');
        Route::post('lead-save/{id?}', [LeadController::class, 'save'])->name('lead.save');
        Route::get('get-cold-calling-data', [LeadController::class, 'customer_data'])->name('get.cold.calling.data');
        Route::any('lead-delete/{id}', [LeadController::class, "leadDelete"])->name('lead.delete');
        Route::get('lead-approve', [LeadController::class, 'leadApprove'])->name('lead.approve');
        Route::post('lead-approve-save', [LeadController::class, 'leadApproveSave'])->name('lead.approve.save');

        // Lead Analysis
        Route::resource('lead-analysis', LeadAnalysisController::class);
        Route::get('select2-lead-analysis-customer', [LeadAnalysisController::class, 'select2_customer'])->name('select2.lead_analysis.customer');
        Route::get('get-lead-data', [LeadAnalysisController::class, 'customer_data'])->name('get.lead.data');
        Route::post('lead-analysis-save/{id?}', [LeadAnalysisController::class, 'save'])->name('lead_analysis.save');
        Route::any('lead-analysis-delete/{id}', [LeadAnalysisController::class, "leadAnalysisDelete"])->name('lead_analysis.delete');
        Route::get('lead-analysis-approve', [LeadAnalysisController::class, 'leadAnalysisApprove'])->name('lead-analysis.approve');
        Route::post('lead-analysis-approve-save', [LeadAnalysisController::class, 'leadAnalysisApproveSave'])->name('lead-analysis.approve.save');
        Route::get('lead-analysis-details/{id}', [LeadAnalysisController::class, 'lead_analysis_details'])->name('lead.analysis.details');

        // Presentation
        Route::resource('presentation', PresentationController::class);
        Route::get('select2-presentation-customer', [PresentationController::class, 'select2_customer'])->name('select2.presentation.customer');
        Route::get('get-lead-analysis-data', [PresentationController::class, 'customer_data'])->name('get.lead.analysis.data');
        Route::post('presentation-save/{id?}', [PresentationController::class, 'save'])->name('presentation.save');
        Route::any('presentation-delete/{id}', [PresentationController::class, "presentationDelete"])->name('presentation.delete');
        Route::get('presentation-approve', [PresentationController::class, 'presentationApprove'])->name('presentation.approve');
        Route::post('presentation-approve-save', [PresentationController::class, 'presentationApproveSave'])->name('presentation.approve.save');

        // Presentation Analysis
        Route::resource('presentation_analysis', PresentationAnalysisController::class);
        Route::get('select2-presentation-analysis-customer', [PresentationAnalysisController::class, 'select2_customer'])->name('select2.presentation_analysis.customer');
        Route::get('select2-visitor', [PresentationAnalysisController::class, 'get_visitor'])->name('select2.visitor');
        Route::post('visit-save/{id?}', [PresentationAnalysisController::class, 'save'])->name('visit.save');
        Route::any('visit-delete/{id}', [PresentationAnalysisController::class, "presentationDelete"])->name('visit.delete');
        Route::get('presentation-analysis-approve', [PresentationAnalysisController::class, 'presentationAnalysisApprove'])->name('presentation-analysis.approve');
        Route::post('presentation-analysis-approve-save', [PresentationAnalysisController::class, 'presentationAnalysisApproveSave'])->name('presentation-analysis.approve.save');
        Route::get('presentation-analysis-details/{id}', [PresentationAnalysisController::class, 'presentation_analysis_details'])->name('presentation.analysis.details');

        // Follow Up
        Route::resource('followup', FollowupController::class);
        Route::get('select2-followup-customer', [FollowupController::class, 'select2_customer'])->name('select2.followup.customer');
        Route::get('get-presentaion-data', [FollowupController::class, 'customer_data'])->name('get.presentation.data');
        Route::get('get-project-duration-type-name', [FollowupController::class, 'projectDurationTypeName'])->name('get-project-duration-type-name');
        Route::post('follow-up-save/{id?}', [FollowupController::class, 'save'])->name('follow-up.save');
        Route::any('follow-up-delete/{id}', [FollowupController::class, "followUpDelete"])->name('followUp.delete');
        Route::get('follow-up-approve', [FollowupController::class, 'followUpApprove'])->name('followUp.approve');
        Route::post('follow-up-approve-save', [FollowupController::class, 'followUpApproveSave'])->name('followUp.approve.save');
        

        // Follow Up Analysis
        Route::resource('followup-analysis', FollowupAnalysisController::class);
        Route::get('select2-followup-analysis-customer', [FollowupController::class, 'select2_customer'])->name('select2.followup_analysis.customer');
        Route::get('get-follow-up-data', [FollowupAnalysisController::class, 'customer_data'])->name('get.follow.up.data');
        Route::post('follow-up-analysis-save/{id?}', [FollowupAnalysisController::class, 'save'])->name('follow-up-analysis.save');
        Route::any('follow-up-analysis-delete/{id}', [FollowupAnalysisController::class, "followUpDelete"])->name('followUp-analysis.delete');
        Route::get('follow-up-analysis-approve', [FollowupAnalysisController::class, 'followUpApprove'])->name('followUp-analysis.approve');
        Route::post('follow-up-analysis-approve-save', [FollowupAnalysisController::class, 'followUpsApproveSave'])->name('followUp-analysis.approve.save');
        Route::get('follow-up-analysis-details/{id}', [FollowupAnalysisController::class, 'follow_analysis_up_details'])->name('followup.analysis.details');
        
        // Negotation
        Route::resource('negotiation', NegotiationController::class);
        Route::get('select2-negotiation-customer', [NegotiationController::class, 'select2_customer'])->name('select2.negotiation.customer');
        Route::get('get-follow-up-analysis-data', [NegotiationController::class, 'customer_data'])->name('get.follow.up.analysis.data');
        Route::post('negotiation-save/{id?}', [NegotiationController::class, 'save'])->name('negotiation.save');
        Route::any('negotiation-delete/{id}', [NegotiationController::class, "negotiationDelete"])->name('negotiation.delete');
        Route::get('negotiation-approve', [NegotiationController::class, 'negotiationApprove'])->name('negotiation.approve');
        Route::post('negotiation-approve-save', [NegotiationController::class, 'negotiationApproveSave'])->name('negotiation-approve.save');

        // Negotation Analysis
        Route::resource('negotiation-analysis', NegotiationAnalysisController::class);
        Route::get('select2-negotiation_analysis-customer', [NegotiationAnalysisController::class, 'select2_customer'])->name('select2.negotiation_analysis.customer');
        Route::get('get-negotiation-data', [NegotiationAnalysisController::class, 'customer_data'])->name('get.negotiation.data');
        Route::post('negotiation-analysis-save/{id?}', [NegotiationAnalysisController::class, 'save'])->name('negotiation-analysis.save');
        Route::any('negotiation-analysis-delete/{id}', [NegotiationAnalysisController::class, "negotiationAnalysisDelete"])->name('negotiation-analysis.delete');
        Route::get('negotiation-analysis-approve', [NegotiationAnalysisController::class, 'negotiationAnalysisApprove'])->name('negotiation-analysis.approve');
        Route::any('negotiation-analysis-approve-save', [NegotiationAnalysisController::class, 'negotiationAnalysisApproveSave'])->name('negotiation-analysis-approve.save');
        Route::post('update-negotiation-waiting-day',[NegotiationAnalysisController::class,'update_waiting_day'])->name('update.negotiation.waiting.day');
        Route::get('negotiation-analysis-details/{id}', [NegotiationAnalysisController::class, 'negotiation_analysis_details'])->name('negotiation.analysis.details');


        // Salse
        Route::resource('salse', SalseController::class);
        Route::get('select2-salse-customer', [SalseController::class, 'select2_customer'])->name('select2.salse.customer');
        Route::get('salse-approve', [SalseApproveController::class, 'salse_approve'])->name('salse.approve');
        Route::get('salse-approve-save/{id}', [SalseApproveController::class, 'salse_approve_save'])->name('salse.approve.save');
        Route::get('get-negotiation-analysis-data', [SalseController::class, 'customer_data'])->name('get.negotiation.analysis.data');
        Route::get('salse-details/{id}', [SalseController::class, 'salse_details'])->name('salse.details');
        Route::get('get-salse-info', [SalseController::class, 'get_salse_info'])->name('get.salse.info');
        Route::get('existing-salse', [ExistingSalseController::class, 'create'])->name('existing.salse');

        // Deposit
        Route::resource('deposit', DepositController::class);
        Route::get('get-customer-form-deposit-type', [DepositController::class, 'getCustomerFormDepositType'])->name('get.customer.form.deposit.category');
        Route::get('get-customer-due',[DepositController::class,'get_customer_due'])->name('get.customer.due');

        // Rejection
        Route::resource('rejection', RejectionController::class);
        Route::post('rejection-save/{id?}', [RejectionController::class, 'save'])->name('rejection.save');
        Route::any('rejection-delete/{id}', [RejectionController::class, "rejectionDelete"])->name('rejection.delete');
        Route::get('rejection-approve', [RejectionController::class, 'rejectionApprove'])->name('rejection.approve');
        Route::post('rejection-save', [RejectionController::class, 'rejectionApproveSave'])->name('rejection.approve.save');
        
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
        Route::resource('upazila', UpazilaController::class);
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

        //Approve Setting 
        Route::get('approve-setting', [ApproveSettingController::class, 'index'])->name('approve.setting');
        Route::post('approve-setting-save', [ApproveSettingController::class, 'save'])->name('approve.setting.save');
        Route::get('submit/time/setting',[LastSubmitTimeSettingController::class,'index'])->name('submit.time.setting');
        Route::post('submit/time/setting/update',[LastSubmitTimeSettingController::class,'update'])->name('submit.time.setting.update');
 
        //Reports 
        Route::get('monthly-target-achive', [CommissionReportController::class, 'monthly_target_achive'])->name('monthly.target.achive');
        Route::get('mst-commission', [CommissionReportController::class, 'mst_commission'])->name('mst.commission');
        Route::get('mst-commission-details/{id}/{month}', [CommissionReportController::class, 'mst_commission_details'])->name('mst.commission.details');
        Route::get('rsa-co-ordinator', [CommissionReportController::class, 'rsa_co_ordinator'])->name('rsa.co.ordinator');
        Route::get('cc-report', [CommissionReportController::class, 'cc_report'])->name('cc.report');
        Route::get('pending-report',[PendingReportController::class,'pending_report'])->name('pending.report');


        Route::get('monthly-dt-achivement', [DtaReportController::class, 'monthly_dt_achivement'])->name('monthly.dt.achivement');
        Route::get('dt-achivement', [DtaReportController::class, 'dt_achivement'])->name('dt.achivement');
        Route::get('daily-deposit', [DtaReportController::class, 'daily_deposit'])->name('daily.deposit'); 
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
        Route::get('my-deposit-target', [DepositTargetController::class, 'my_target'])->name('my.deposit.target');
        Route::get('deposit-target-asign/{id}', [DepositTargetController::class, 'target_asign'])->name('deposit.target.asign');
        Route::get('deposit-target-asign-list', [DepositTargetController::class, 'target_asign_list'])->name('deposit.target.asign.list');
        Route::get('project-deposit-target', [DepositTargetController::class, 'project_deposit_target'])->name('project.deposit.target');
        Route::get('direct-deposit-target', [DepositTargetController::class, 'direct_deposit_target'])->name('direct.deposit.target');
        Route::post('deposit-target-save', [DepositTargetController::class, 'deposit_target_save'])->name('deposit.target.save');

        // Training
        Route::resource('training-category', TrainingCategoryController::class);
        Route::post('training-category-update', [TrainingCategoryController::class, 'update'])->name('training.category.update');
        Route::resource('training', TrainingController::class);
        // Route::get('training-create', [TrainingController::class, 'training_create'])->name('training.create');
        Route::get('training-schedule', [TrainingController::class, 'training_schedule'])->name('training.schedule');
        Route::get('training-history', [TrainingController::class, 'training_history'])->name('training.history');

        // Meeting  
        Route::resource('meeting', MeetingController::class);

        // Header Route 
        Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');
});
        Route::get('/migrate-refresh', [DashboardController::class, 'migrate_fresh']);

Route::get('function_test', function () {  
       
         dd("nothing");
  
        // $users = User::whereIn('user_type',[1])->latest()->get();
        // foreach($users as $user){
        //         $my_all_employee = my_all_employee((int)$user->id);
        //         $user_reporting = user_reporting((int)$user->id); 
        //         User::where('id', $user->id)
        //             ->update(['user_reporting' => $user_reporting, 'user_employee' => $my_all_employee]);
        // }
        
       

        // foreach($employees as $employee){
        //         if($employee->id != 1 || $employee->id != 3){  
        //                 $permissions = UserPermission::where('user_id',3)->get();
        //                 UserPermission::where('user_id',$employee->id)->delete();
        //                 foreach($permissions as $permission){
        //                         $userPermission = new UserPermission();
        //                         $userPermission->user_id = $employee->id;
        //                         $userPermission->permission_id = $permission->permission_id;
        //                         $userPermission->save();
        //                 } 
        //         }
        // } 
        // $data = UserPermission::all();
     
        
        // $organogram = getOrganogram($topUser);
        // dd($organogram);
 
        // return view('organogram', ['organogram' => $organogram]);
});

// test
Route::get('/messae', function () {
        return view('message');
    });  

    Route::post('send-message',function (Request $request){
        event(new Message($request->username, $request->message));
        return ['success' => true];
    });