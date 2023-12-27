@extends('layouts.dashboard')
@section('title','Prospecting Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lead Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Lead Entry</li>
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

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="select2" search id="freelancer" name="freelancer" required>
                                                <option value="">Select Customer</option> 
                                                <option value="">Md Enamul Haque 01796351081</option> 
                                                <option value="">Jamil Hosain 01796351081</option> 
                                                <option value="">Md Mehedi Hasan 01796351081</option> 
                                                <option value="">Suvo Hasan 01796351081</option>  
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="purchase_capacity" class="form-label">Purchase Capacity <span class="text-danger">*</span></label>
                                            <select class="select2" name="purchase_capacity" id="purchase_capacity" required>
                                                <option value="">Select Priority</option>
                                                <option value="1">Regular</option>
                                                <option value="meet-up">High</option> 
                                                <option value="meet-up">Low</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="project" class="form-label">Preferrer Project Name <span class="text-danger">*</span></label>
                                            <select class="select2" name="project" id="project" required>
                                                <option value="">Select Project</option>
                                                <option value="1">Regular</option>
                                                <option value="meet-up">High</option> 
                                                <option value="meet-up">Low</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession" class="form-label">Preferrer Unit Name <span class="text-danger">*</span></label>
                                            <select class="select2" name="profession" id="profession" required>
                                                <option value="">Select Priority</option>
                                                <option value="1">Regular</option>
                                                <option value="meet-up">High</option> 
                                                <option value="meet-up">Low</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Possible Purchase Date</label>
                                            <input type="date" class="datepicker w-100" name="" id="">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark"></textarea>
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