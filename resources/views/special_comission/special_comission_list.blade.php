@extends('layouts.dashboard')
@section('title','Special Comission List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Special Comission </h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Special Comission</li>
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
                                        <a class="btn btn-secondary" href="{{route('special-comission.create')}}">
                                            <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Comission</span>
                                        </a> 
                                    </div>
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Comission Name</th> 
                                        <th>Total Comission</th>
                                        <th>Total Salse</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('special-comission.show','12')}}">View Details</a>  
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>  
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td><a href="{{route('special-comission.show','23')}}">Bijoy Offer</a></td>   
                                        <td>10%</td>   
                                        <td>0</td>
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
                                        <td>Bijoy Offer</td>   
                                        <td>10%</td>   
                                        <td>0</td>
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
                                        <td>Bijoy Offer</td>   
                                        <td>10%</td>   
                                        <td>0</td>
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
                <h5 class="modal-title">Create new Training</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="">
                    <div class="form-group mb-2">
                        <label for="profession_name">Training Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="profession_name" name="profession_name" required>
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
@endsection