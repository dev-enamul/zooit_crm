
@extends('layouts.dashboard')
@section('title','Commission Setting')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Commission Setting</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Commission Setting</li>
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
                                            <span><i class="fas fa-file-pdf"></i> PDF</span>
                                        </button>  
                                    </div>  
                                </div>

                                <div class="">
                                    <div class="d-flex">   
                                        <div class="input-group">   
                                            <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                                <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Bank</span>
                                            </button> 
                                        </div>
                                    </div>  
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/L</th>
                                        <th>Start Amount</th>
                                        <th>End Amount</th>
                                        <th>Deducation</th>
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
                                        <th>2</th>
                                        <th>0</th>
                                        <th>1000</th>
                                        <th>5%</th>
                                    </tr> 
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
                                        <td>2</td>
                                        <td>1001</td>
                                        <td>5000</td>
                                        <td>7%</td>
                                    </tr>  
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
                                        <td>3</td>
                                        <td>5001</td>
                                        <td>Unlimited</td>
                                        <td>10%</td>
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
                <h5 class="modal-title">Create new Bank</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="">  
                    <div class="form-group mb-2">
                        <label for="start_amount">Start Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="start_amount" name="start_amount" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="end_amount">End Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="end_amount" name="end_amount" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="deducated">Deducation %<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="deducated" name="deducated" required>
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