@extends('layouts.dashboard')
@section('title','Commission')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Commission</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Commission</li>
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
                                </div> 
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_profession">
                                            <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Commision</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Commission Title</th>
                                        <th>Hold Position</th> 
                                        <th>Commision</th> 
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
                                                    <a class="dropdown-item" href="profession_permission.html">Update Permission</a> 
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td>Franchise Partner</td> 
                                        <th>Franchise Partner</th>
                                        <th>3%</th> 
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
                                        <td>1</td>
                                        <td>Co-Ordinator Applicant</td> 
                                        <th>Co-Ordinator Applicant</th>
                                        <th>0%</th> 
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
                                        <td>1</td>
                                        <td>Co Ordinator</td> 
                                        <th>Co Ordinator</th>
                                        <th>1%</th> 
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
                                        <td>1</td>
                                        <td>Ex.Co-Ordinator</td> 
                                        <th>Ex.Co-Ordinator</th>
                                        <th>0.25%</th> 
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
                                        <td>1</td>
                                        <td>Excutive Marketing</td> 
                                        <th>Excutive Marketing</th>
                                        <th>0.4%</th> 
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
                                        <td>1</td>
                                        <td>Junior Executive</td> 
                                        <th>Junior Executive</th>
                                        <th>0%</th> 
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
                                        <td>1</td>
                                        <td>Sales Team</td> 
                                        <th>Sales Executive, Sr. Executive, A.S.M, D.S.M</th>
                                        <th>1.1%</th> 
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

<div class="modal fade" id="create_profession">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create Commission</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="">
                    <div class="form-group mb-2">
                        <label for="commission_title">Commission Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="commission_title" name="commission_title" required>
                    </div> 

                    <div class="form-group mb-2">
                        <label for="hole_possition">Hold Employee<span class="text-danger">*</span></label>
                        <select id="hole_possition" class="select2" multiple name="hole_possition" required> 
                            <option value="">Zonal Manager</option> 
                            <option value="">Area Manager</option>  
                            <option value="">Salse Executive</option>  
                            <option value="">Sr. Executive</option>  
                            <option value="">ASM</option>
                            <option value="">DSM</option>
                        </select> 
                    </div>  
                </form>
            </div>

            <div class="modal-footer">
                <div class="text-end">
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                </div> 
            </div>

            <!-- <div class="modal-footer"><button class="btn btn-primary">Submit</button> <button class="btn btn-outline-danger">Reset</button></div> -->
        </div>
    </div>
</div>
@endsection