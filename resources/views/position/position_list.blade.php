@extends('layouts.dashboard')
@section('title','Employee Position List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Cold-Calling List</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Cold-Calling List</li>
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
                                            <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Profession</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Profession Name</th>
                                        <th>Total Employee</th> 
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
                                        <td>Managing Derector</td> 
                                        <th>23</th>
                                        <th>2%</th> 
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
                                        <td>Sr. Marketing Executive</td> 
                                        <th>10</th>
                                        <th>4%</th> 
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
                                        <td>Area In Charge</td> 
                                        <th>44</th>
                                        <th>1%</th> 
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
                <h5 class="modal-title">Create new profession</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="">
                    <div class="form-group mb-2">
                        <label for="profession_name">Profession Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="profession_name" name="profession_name" required>
                    </div>


                    <div class="form-group mb-3">
                        <label for="commision">Commision [%]</label>
                        <input type="number" class="form-control" id="commision" value="0" name="commision" >
                    </div> 

                    <div class="form-group mb-2">
                        <label for="permission">Permission <span class="text-danger">*</span></label>
                        <select id="permission" class="select2" multiple search name="permission" required> 
                            <option value="">Follow Up</option> 
                            <option value="">Freelancer Join</option> 
                            <option value="">Customer Join</option> 
                            <option value="">Cold Calling</option>  
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