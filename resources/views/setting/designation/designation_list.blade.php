@extends('layouts.dashboard')
@section('title','Designation')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Designation</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Designation</li>
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
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_profession">
                                            <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Designation</span>
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
                                        <th>Commision</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a> 
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('designation.destroy',$data->id) }}')">Delete</a>
                                                    <a class="dropdown-item" href="{{route('designation.permission',$data->id)}}">Update Permission</a> 
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->title}}</td>  
                                        <th>{{@$data->commission->commission}}%</th> 
                                    </tr> 
                                    @endforeach 
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
                <h5 class="modal-title">Create New Designation</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('designation.store')}}" method="POST">
                @csrf
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="title">Position Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div> 

                    <div class="form-group mb-2">
                        <label for="commission_id">Commission <span class="text-danger">*</span></label>
                        <select id="commission_id" class="select2" name="commission_id" required>
                            @foreach ($commissions as $item)
                                <option value="{{$item->id}}">{{$item->title}} - {{$item->commission}}%</option>
                            @endforeach
                                
                        </select> 
                    </div> 

                    <div class="form-group mb-2">
                        <label for="working_place">Working Space <span class="text-danger">*</span></label>
                        <select id="working_place" class="select2" name="working_place" required> 
                            <option value="1">Zone</option> 
                            <option value="2">Area</option>  
                        </select> 
                    </div>  
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 

            </form> 
        </div>
    </div>
</div>
@endsection 

 