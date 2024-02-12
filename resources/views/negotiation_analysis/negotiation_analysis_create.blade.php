@extends('layouts.dashboard')
@section('title','Negotiation Analysis Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Negotiation Analysis Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Negotiation Analysis Entry</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                                <div class="row">  
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select id="customer" class="select2" search name="customer">
                                                <option value="">Select Customer</option> 
                                                <option value="">Md Enamul Haque 01796351081</option> 
                                                <option value="">Jamil Hosain 01796351081</option> 
                                                <option value="">Md Mehedi Hasan 01796351081</option> 
                                                <option value="">Suvo Hasan 01796351081</option>  
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="priority" class="form-label">Priority  <span class="text-danger">*</span></label>
                                            <select class="select2" name="priority" id="priority" req>
                                                <option value="">Select Priority</option>
                                                <option value="1" selected>Regular</option>
                                                <option value="meet-up">High</option> 
                                                <option value="meet-up">Low</option>
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="project" class="form-label">Project  <span class="text-danger">*</span></label>
                                            <select class="select2" name="project" id="project" required>
                                                <option value="">Select project</option>
                                                <option value="1" selected>Regular</option>
                                                <option value="meet-up">High</option> 
                                                <option value="meet-up">Low</option>
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit" class="form-label">Unit Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="unit" id="unit" required>
                                                <option value="">Select Unit</option>
                                                <option value="1">Shop</option>
                                                <option value="meet-up">Garage</option> 
                                                <option value="meet-up">Apartment</option>
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="payment_duration" class="form-label">Payment Duration <span class="text-danger">*</span></label>
                                            <select class="select2" name="payment_duration" id="payment_duration" required>
                                                <option value="1">6 Month</option>
                                                <option value="2">12 Month</option> 
                                                <option value="3">18 Month</option>
                                                <option value="4">24 Month</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="select_type" class="form-label">Select Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="select_type" id="select_type" required>
                                                <option value="">Select Type</option>
                                                <option value="1">On Choice</option>
                                                <option value="2">Lottery</option> 
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="project_unit" class="form-label">Project Unit Name<span class="text-danger">*</span></label>
                                            <select class="select2" multiple name="project_unit" id="project_unit" required>
                                                <option value="">Select Project Unit</option>
                                                <option value="1">A-2 [$8676767]</option>
                                                <option value="meet-up">A-2 [$8676767]</option> 
                                                <option value="meet-up">A-4 [$8676767]</option>
                                            </select>  
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_amount" class="form-label"> Regular Amount</label>
                                             <input value="453545457" type="number"  class="form-control" name="regular_amount" id="regular_amount" disabled> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="negotiation_amount" class="form-label"> Negotiation Amount</label>
                                             <input type="number" placeholder="Negotiation Amount" class="form-control" name="negotiation_amount" id="negotiation_amount"> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_emotion" class="form-label"> Customer Emotion's</label>
                                             <input type="text" placeholder="Customer Emotion's" class="form-control" name="customer_emotion" id="customer_emotion"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_preferance" class="form-label"> Customer Preference</label>
                                             <input type="text" placeholder="Customer Preference" class="form-control" name="customer_preferance" id="customer_preferance"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="plan_b" class="form-label"> Have a Plan "B"</label>
                                             <input type="text" placeholder="Customer Plan B" class="form-control" name="plan_b" id="plan_b"> 
                                        </div>
                                    </div>

                                </div>
                                  
                                <div class="text-end ">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                                </div> 
                            </form>
                        </div>
                    </div> 
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 
    @include('includes.footer') 
</div>
@endsection