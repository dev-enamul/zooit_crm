@extends('layouts.dashboard')
@section('title','Salse Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Salse Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Salse Entry</li>
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
                                            <label for="freelancer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select id="freelancer" class="select2" search name="freelancer">
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
                                            <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                                            <select class="select2" name="unit" id="unit" required>
                                                <option value="">Select Unit</option>
                                                <option value="1">Flat</option>
                                                <option value="meet-up">Shop</option> 
                                                <option value="meet-up">Garage</option>
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
                                                <option value="">On Choice</option>
                                                <option value="1">Lottery</option> 
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="project_unit" class="form-label">Project Unit Name<span class="text-danger">*</span></label>
                                            <select class="select2" multiple name="project_unit" id="project_unit" required>
                                                <option value="">Select Project Unit</option>
                                                <option value="1">Floor: 2, Flat: 1</option> 
                                                <option value="1">Floor: 2, Flat: 3</option> 
                                                <option value="1">Floor: 2, Flat: 4</option> 
                                            </select>  
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_amount" class="form-label"> Regular Amount</label>
                                             <input value="453545457" type="number"  class="form-control" name="amount" id="amount" disabled> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Sold Value</label>
                                            <input type="number" value="675656400" class="form-control" name="amount" id="amount"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Discount</label>
                                            <input type="number" value="45300" class="form-control" name="amount" id="amount" disabled> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Down Payment</label>
                                            <input type="number" value="50000" class="form-control" name="down_payment" id="qty"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Down Payment Pay</label>
                                            <input type="number" value="20000" class="form-control" name="down_payment" id="qty"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Down Payment Due</label>
                                            <input type="number" value="30000" class="form-control" name="down_payment" id="qty" readonly> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Rest Down Payment Date</label>
                                            <input type="text" name="dob" class="form-control datepicker w-100 p-1" id="dob" placeholder="Select date of birth" required> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="installment_type" class="form-label">Installment Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="installment_type" id="installment_type" required>
                                                <option value="">Select Installment</option>
                                                <option value="1">Weekly</option>
                                                <option value="2">Monthly</option>
                                                <option value="3">Bi-Weekly (Every 2 Weeks)</option>
                                                <option value="4">Bi-Monthly (Every 2 Months)</option>
                                                <option value="5">Quarterly (Every 3 Months)</option>
                                                <option value="6">Semi-Annually (Every 6 Months)</option>
                                                <option value="7">Annually (Yearly)</option>
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="installment_type" class="form-label">Installment Type<span class="text-danger">*</span></label>
                                            <select class="select2" name="installment_type" id="installment_type" required>
                                                <option value="">Select Installment Type</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="bi-weekly">Bi-Weekly</option> 
                                                <option value="monthly">Monthly</option>
                                                <option value="quarterly">Quarterly</option>
                                                <option value="semi-annually">Semi-Annually</option>
                                                <option value="annually">Annually</option> 
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="installment_value" class="form-label">Installment Amount <span class="text-danger">*</span>.</label>
                                            <input type="number"value="12500" class="form-control" name="installment_value" id="installment_value" disabled> 
                                        </div>
                                    </div>

                                   <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="facility" class="form-label">Unit Facility <span class="text-danger">*</span></label>
                                            <select class="select2" name="facility" id="facility" required>
                                                <option value="">Select Facility</option>
                                                <option value="1">With Finishing</option>
                                                <option value="meet-up">Without Finishing</option> 
                                            </select>  
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