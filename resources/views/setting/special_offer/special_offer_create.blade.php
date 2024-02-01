@extends('layouts.dashboard')
@section('title',"Special Offer Create")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Special Offer Create</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Special Offer Create</li>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Offer Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Offer Name" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                            <input type="text" name="start_date" class="form-control datepicker w-100 p-1" id="start_date" placeholder="Select Start Date" required> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                            <input type="text" name="end_date" class="form-control datepicker w-100 p-1" id="end_date" placeholder="Select End Date" required> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="designation" class="form-label">Designation</label>
                                            <select class="form-select select2" multiple name="marital_status" id="marital_status">
                                                <option value="">Select Designations</option>
                                                <option value="" selected>All</option>
                                                @foreach($designations as $designation)
                                                    <option value="">{{$designation->title}}</option> 
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="deposit_type" class="form-label">Deposit Type</label>
                                            <select class="form-select select2" multiple name="deposit_type" id="deposit_type">
                                                <option value="" selected>All</option>
                                                @foreach($deposit_types as $deposit_type)
                                                    <option value="">{{$deposit_type->name}} </option> 
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Customer</label>
                                            <select class="form-select select2" multiple name="customer" id="customer">
                                                <option value="" selected>All</option>
                                                @foreach($customers as $customer)
                                                    <option value="">{{$customer->name}} [{{$customer->user_id}}]</option> 
                                                @endforeach
                                            </select>   
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="project" class="form-label">Project Name</label>
                                            <select class="form-select select2" multiple name="project" id="project">
                                                <option value="" selected>All</option>
                                                @foreach($projects as $project)
                                                    <option value="">{{$project->name}}</option> 
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit" class="form-label">Unit Name</label>
                                            <select class="form-select select2" multiple name="unit" id="unit">
                                                <option value="" selected>All</option>
                                                @foreach($units as $unit)
                                                    <option value="">{{$unit->title}}</option> 
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_qty" class="form-label">Unit Qty</label>
                                            <input type="number" name="unit_qty" class="form-control" id="unit_qty" placeholder="Unit Qty"> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="deposit" class="form-label">Deposit Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="deposit" class="form-control" id="deposit" placeholder="Deposit Amount" required> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="follow_up" class="form-label">Follow Up</label>
                                            <input type="number" name="follow_up" class="form-control" id="follow_up" value="0"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="negotiation" class="form-label">Negotiation</label>
                                            <input type="number" name="negotiation" class="form-control" id="negotiation" value="0"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="incentive_name" class="form-label">Incentive Name <span class="text-danger">*</span></label>
                                            <input type="text" name="incentive_name" class="form-control" id="incentive_name" placeholder="Incentive Name" required>  
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="incentive_amount" class="form-label">Incentive Amount <span class="text-danger">*</span></label>
                                            <input type="text" name="incentive_amount" class="form-control" id="incentive_amount" placeholder="Incentive Amount" required>  
                                        </div>
                                    </div>
                                </div>
                                  
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection