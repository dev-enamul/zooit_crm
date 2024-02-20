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
                        @can('designation-manage') 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_profession">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Designation</span>
                                </button> 
                            </ol>
                        </div> 
                        @endcan
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">
 
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        @can('designation-manage')
                                        <th>Action</th>
                                        @endcan
                                        <th>S/N</th>
                                        <th>Profession Name</th> 
                                        <th>Designation Type</th> 
                                        <th>Commission</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                    <tr>
                                        @can('designation-manage')
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($data)}})">Edit</a> 
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('designation.destroy',$data->id) }}')">Delete</a>
                                                    <a class="dropdown-item" href="{{route('designation.permission',$data->id)}}">Update Permission</a> 
                                                </div>
                                            </div> 
                                        </td> 
                                        @endcan
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->title}}</td>
                                        <td>{{$data->designation_type==1?"Employee":"Freelancer"}}</td>  
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
                            <option value="3">Head Office</option>
                        </select> 
                    </div>  

                    <div class="form-group mb-2">
                        <label for="designation_type">Designation Type <span class="text-danger">*</span></label>
                        <select id="designation_type" class="select2" name="designation_type" required> 
                            <option value="1">Employee</option> 
                            <option value="2">Freelancer</option>   
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


<div class="modal fade" id="update_profession">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create New Designation</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('designation.update')}}" method="POST">
                @csrf 
                <input type="hidden" name="id">
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="title">Position Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div> 

                    <div class="form-group mb-2">
                        <label for="new_commission_id">Commission <span class="text-danger">*</span></label>
                        <select id="new_commission_id" class="select2" name="commission_id" required>
                            @foreach ($commissions as $item)
                                <option value="{{$item->id}}">{{$item->title}} - {{$item->commission}}%</option>
                            @endforeach 
                        </select> 
                    </div> 

                    <div class="form-group mb-2">
                        <label for="new_working_place">Working Space <span class="text-danger">*</span></label>
                        <select id="new_working_place" class="select2" name="working_place" required> 
                            <option value="1">Zone</option> 
                            <option value="2">Area</option>  
                            <option value="3">Head Office</option>
                        </select> 
                    </div>  

                    <div class="form-group mb-2">
                        <label for="designation_type">Designation Type <span class="text-danger">*</span></label>
                        <select id="designation_type" class="select2" name="designation_type" required> 
                            <option value="1">Employee</option> 
                            <option value="2">Freelancer</option>   
                        </select> 
                    </div>
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button> <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 

            </form> 
        </div>
    </div>
</div>
@endsection  

@section('script')
    <script>  
        function editItem(data){
            $('#update_profession input[name=id]').val(data.id);
            $('#update_profession input[name=title]').val(data.title);
            $('#update_profession select[name=commission_id]').val(data.commission_id);
            $('#update_profession select[name=working_place]').val(data.working_place);
            $('#update_profession select[name=designation_type]').val(data.designation_type);
            $('.select2').select2();
            $('#update_profession').modal('show');
        }
    </script>
@endsection


 