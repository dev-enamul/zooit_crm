@extends('layouts.dashboard')
@section('title','Union List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Unions</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Union List</li>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">

                            <div class="d-flex justify-content-between"> 
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>

                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
                                        </button>  
                                    </div> 
                                    <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                        <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Union</span>
                                    </button> 
                                </div>

                                <div class="">
                                    <div class="d-flex">   
                                        <div class="input-group">   
                                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#filter_offcanvas">
                                                <span><i class="fas fa-filter"></i> Filter</span>
                                            </button> 
                                        </div>
                                    </div> 

                                  
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th> 
                                        <th>Union Name</th>
                                        <th>Status</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>  
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td>Dhaka</td>  
                                        <th><span class="badge badge-label-success">Active</span></th> 
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    @include('includes.footer')
</div>

<div class="modal fade" id="create_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create new Upazila</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="">

                    <div class="form-group mb-2">
                        <label for="division">Division <span class="text-danger">*</span></label>
                        <select id="division" class="select2" search name="division" required> 
                            <option value="">Select Division</option> 
                            <option value="">Dhaka</option> 
                            <option value="">Rangpur</option> 
                            <option value="">Rajshahi</option>
                            <option value="">Borisal</option>  
                        </select> 
                    </div>

                    <div class="form-group mb-2">
                        <label for="district">Districe <span class="text-danger">*</span></label>
                        <select id="district" class="select2" search name="district" required> 
                            <option value="">Select Districe</option> 
                            <option value="">Dhaka</option> 
                            <option value="">Rangpur</option> 
                            <option value="">Rajshahi</option>
                            <option value="">Borisal</option>  
                        </select> 
                    </div>

                    <div class="form-group mb-2">
                        <label for="thana">Thana / Upazila <span class="text-danger">*</span></label>
                        <select id="thana" class="select2" search name="thana" required> 
                            <option value="">Select Thana/Upazila</option> 
                            <option value="">Dhaka</option> 
                            <option value="">Rangpur</option> 
                            <option value="">Rajshahi</option>
                            <option value="">Borisal</option>  
                        </select> 
                    </div>

                    <div class="form-group mb-2">
                        <label for="union">Union Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="union" name="union" placeholder="Enter Union" required>
                    </div>


                    <div class="form-group mb-2">
                        <label for="permission">Status <span class="text-danger">*</span></label>
                        <select id="permission" class="select2" name="permission" required> 
                            <option value="" selected>Active</option> 
                            <option value="">Inactive</option> 
                        </select> 
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <div class="text-end">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                </div> 
            </div> 
        </div>
    </div>
</div> 

<div class="offcanvas offcanvas-end" id="filter_offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter Union</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row"> 
 
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="division_filter" class="form-label">Division</label>
                    <select id="division_filter" class="select2" name="division_filter" search>
                        <option value="">All Division</option> 
                        <option value="">Dhaka </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Borisal</option>
                        <option value="">Sylet</option>  
                    </select> 
                </div>
            </div> 

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="district_filter" class="form-label">Districe</label>
                    <select id="district_filter" class="select2" name="district_filter" search>
                        <option value="">All Districe</option> 
                        <option value="">Naogaon </option> 
                        <option value="">Joypurhat</option> 
                        <option value="">Bogura</option> 
                        <option value="">Pabna</option>
                        <option value="">Rajshahi</option>  
                    </select> 
                </div>
            </div> 

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="thana_filter" class="form-label">Thana / Upazila</label>
                    <select id="thana_filter" class="select2" name="thana_filter" search>
                        <option value="">All Thana / Upazila</option> 
                        <option value="">Badulgachi </option> 
                        <option value="">Sapahar</option> 
                        <option value="">Mohadebpur</option> 
                        <option value="">Porsha</option>
                        <option value="">Attrai</option>  
                    </select> 
                </div>
            </div>  
 
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div> 

@endsection