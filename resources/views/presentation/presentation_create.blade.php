@extends('layouts.dashboard')
@section('title','Presentation Entry')

@section('content') 
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Presentation Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Presentation Entry</li>
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
                                            <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                                            <select class="select2" name="priority" id="priority">
                                                <option value="">Select Priority</option>
                                                <option value="1">Regular</option>
                                                <option value="meet-up">High</option> 
                                                <option value="meet-up">Low</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="project" class="form-label">Interested Project Name <span class="text-danger">*</span></label>
                                            <select class="select2" name="project" id="project" required>
                                                <option value="">Select Project</option>
                                                <option value="1">Mosafir Vobon</option>
                                                <option value="meet-up">Din Tower</option> 
                                                <option value="meet-up">Enam Vila</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit" class="form-label">Interested Unit Name <span class="text-danger">*</span></label>
                                            <select class="select2" name="unit" id="unit" required>
                                                <option value="">Select Unit</option>
                                                <option value="1">A-1</option>
                                                <option value="meet-up">B-2</option> 
                                                <option value="meet-up">C-2</option>
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3" name="remark"></textarea>
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