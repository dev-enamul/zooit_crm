@extends('layouts.dashboard')
@section('title','Lead Source')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Team member for <span class="text-primary">{{$project->customer_name}}</span></h4>  
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_service">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Team Member</span>
                                </button>
                            </ol>
                        </div>  
                    </div>
                </div>
            </div>
         
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">  
                            <table id="datatable-buttons" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>    
                                        <th>S/N</th>
                                        <th>Employee</th>
                                        <th>Role</th>
                                        <th>Is Leader</th>
                                        <th>Remark</th>  
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead> 
                                <tbody> 
                                    @foreach($datas as $key => $data)
                                        <tr>   
                                            <td>{{$key+1}}</td>
                                            <td>{{$data['name']}}</td> 
                                            <td>{{$data['role']}}</td>
                                            <td>{{$data['is_leader'] ? 'Yes' : 'No'}}</td>
                                            <td>{{$data['remark']}}</td> 

                                            <td><a class="btn btn-danger"  onclick="deleteItem('{{ route('project-team.destroy',$data['id']) }}')">Delete</a> </td>
                                        </tr>   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div> 
        </div>
    </div>
    @include('includes.footer')
</div>

{{-- Create Modal   --}}
<div class="modal fade" id="create_service">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Add new employee</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('project-team.store')}}" method="POST">
                @csrf
                <div class="modal-body"> 
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group mb-2"> 
                        <label for="user" class="form-label">Employee <span class="text-danger">*</span></label>
                        <select class="select2" id="user" name="user_id" required>
                            @foreach ($employees as $employee)
                                <option value = "{{$employee->id}}">{{$employee->name}} </option>
                            @endforeach 
                        </select> 
                    </div>  

                    <div class="form-group mb-2">
                        <label for="role">Role <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="role" name="role" required>
                    </div>

                    <div class="form-group mb-2 mt-3">
                        <label for="role">Is Leader</label>
                        <input type="checkbox" class="form-check-input" id="is_leader" name="is_leader" value="1">
                    </div>  
                    <div class="form-group mb-2">
                        <label for="role">Remark</label> 
                        <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                    </div>
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 
            </form> 
        </div>
    </div>
</div>  

@endsection 

 