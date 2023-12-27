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
                        <h4 class="mb-sm-0">Follow Up Analyses Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Follow Up Analyses Entry</li>
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
                                            <label for="amount" class="form-label">Unit Value</label>
                                            <input type="number" placeholder="Negotiation Amount" class="form-control" name="amount" id="amount"> 
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label"> Unit Qty.</label>
                                            <input type="text" placeholder="Product Qty." class="form-control" name="qty" id="qty"> 
                                        </div>
                                    </div>

                                   <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="facility" class="form-label">Unit Facility <span class="text-danger">*</span></label>
                                            <select class="select2" name="facility" id="facility" required>
                                                <option value="">Select Facility</option>
                                                <option value="1">With Finishing</option>
                                                <option value="meet-up">Without Finishing</option> 
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="flat_no" class="form-label"> Flat No <span class="text-danger">*</span>.</label>
                                            <input type="text" placeholder="Flat No" class="form-control" name="flat_no" id="flat_no" required> 
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="unit_no" class="form-label"> Unit No. <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Unit No" class="form-control" name="unit_no" id="unit_no" required> 
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="booking_money" class="form-label"> Booking Money</label>
                                             <input type="number" placeholder="Customer Expectation" class="form-control" name="booking_money" id="booking_money"> 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="booking_money" class="form-label"> Duration</label>
                                            <input type="text" class="datepicker form-control w-100" placeholder="Select date" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="type" id="type" required>
                                                <option value="">Select Type</option>
                                                <option value="1">A</option>
                                                <option value="meet-up">B</option> 
                                                <option value="1">C</option>
                                                <option value="meet-up">D</option> 
                                                <option value="1">E</option> 
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="select_type" class="form-label">Flat Select Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="select_type" id="select_type" required>
                                                <option value="">Select Type</option>
                                                <option value="">On Choice</option>
                                                <option value="1">Lottery</option> 
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