@extends('layouts.dashboard')
@section('title','Project Return Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Project Return Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Project Return Entry</li>
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
                                <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Old Customer Information</h6>
                                <hr>
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

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="priority" class="form-label">Mobile No</label>
                                            <input class="form-control" type="text" value="01796351081" name="mobile" id="" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="bokking_date" class="form-label">Booking Date</label>
                                            <input class="datepicker form-control w-100" type="text" placeholder="Select Date" name="bokking_date" id="bokking_date">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="project_name" class="form-label">Project Name</label>
                                            <input class="form-control" type="text" name="project_name" value="Musafir Tower" id="project_name" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="declaration_value" class="form-label">Declaration Value</label>
                                            <input class="form-control" type="number" name="declaration_value" value="675000" id="declaration_value" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="sold_value" class="form-label">Sold Value</label>
                                            <input class="form-control" type="number" name="sold_value" value="675000" id="sold_value" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="discount_value" class="form-label">Discount Amount</label>
                                            <input class="form-control" type="number" name="discount_value" value="12000" id="discount_value" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="total_deposit" class="form-label">Total Deposit Amount</label>
                                            <input class="form-control" type="number" name="total_deposit" value="12000" id="total_deposit" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="due" class="form-label">Total DUE Amount</label>
                                            <input class="form-control" type="number" name="due" value="12000" id="due" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit" class="form-label">Unit Name</label>
                                            <input class="form-control" type="text" name="Unit-A" value="12000" id="unit" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_facility" class="form-label">Unit Facility</label>
                                            <input class="form-control" type="text" name="unit_facility" value="WIth Washroom" id="unit_facility" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="floor_no" class="form-label">ON CHOICE Floor No</label>
                                            <input class="form-control" type="text" name="floor_no" value="" id="floor_no" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_no" class="form-label">ON CHOICE Unit No</label>
                                            <input class="form-control" type="text" name="unit_no" value="" id="unit_no" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_type" class="form-label">Unit Type</label>
                                            <input class="form-control" type="text" name="unit_type" value="Shop" id="unit_type" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="lottery" class="form-label">Lottery</label>
                                            <input class="form-control" type="text" name="lottery" value="Yes" id="lottery" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="installment" class="form-label">Total Installment</label>
                                            <input class="form-control" type="text" name="installment" value="Yes" id="installment" disabled>
                                        </div>
                                    </div>
 
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="negotiation_person" class="form-label">Deduction Type </label>
                                            <select id="negotiation_person" class="select2" search name="negotiation_person">
                                                <option value="">Same Project</option> 
                                                <option value="">Another Project</option> 
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="deduction_amount" class="form-label">Deduction Amount</label>
                                            <input class="form-control" type="number" name="deduction_amount" value="3564" id="deduction_amount" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="transfer_fee" class="form-label">Sales Return Amount</label>
                                            <input class="form-control" type="number" name="transfer_fee" value="3564" id="transfer_fee" disabled>
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