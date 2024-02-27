@extends('layouts.dashboard')
@section('title',"Employee List")

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Employee List</h4>
                        {{-- <p class="d-none">Last Update: {{get_date($lastUpdateDate)}}</p>  --}}
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="A3">
                        <input type="hidden" id="fontSize" value="10">
                    </div>
                </div>
            </div>
            <!-- end page title -->

         

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Name & ID</th>
                                        <th>Mobile No</th> 
                                        <th>Email</th> 
                                        <th>Designation</th> 
                                        <th>Area</th>
                                        <th>Reporting Name & ID</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="{{$data->image()}}">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated">   
                                                    @can('employee-manage')
                                                        <a class="dropdown-item" href="{{route('employee.edit', encrypt($data->id))}}">Edit</a>
                                                        <a class="dropdown-item" href="{{route('designation.user.edit', encrypt($data->id))}}">Change Designation</a>
                                                        @can('employee-delete')
                                                            <a class="dropdown-item"  href="javascript:void(0)" onclick="deleteItem('{{ route('deactive.user', encrypt($data->id)) }}')">Resign Employee</a>
                                                        @endcan 
                                                        <a class="dropdown-item" href="{{route('user.area.edit', encrypt($data->id))}}">Change Area</a>
                                                        <a class="dropdown-item" href="{{route('reporting.user.edit', encrypt($data->id))}}">Change Reporting User</a>
                                                        @can('employee-permission')
                                                            <a class="dropdown-item" href="{{route('employee.permission', encrypt($data->id))}}">Change Permissin</a>
                                                        @endcan 
                                                    @endcan
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->name}} [ {{$data->user_id}} ]</td>
                                        <td>{{$data->phone}}</td> 
                                        <td>{{$data->userContact->personal_email??$data->userContact->office_email??'-'}}</td> 
                                        <td>{{$data->employee->designation->title??'-'}}</td> 
                                        <td>{{$data->userAddress->area->name??'-'}}</td>
                                            @php
                                                $reporting_user_id = @user_reporting($data->id)[1];
                                                if(isset($reporting_user_id) && $reporting_user_id != null){
                                                    $reporting_user = user_info($reporting_user_id)->name;
                                                }else{
                                                    $reporting_user = '-';
                                                }
                                            @endphp
                                        <td>{{$reporting_user}}</td> 
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
@endsection 

@section('script') 
    <script>
    
    </script> 
    @include('includes.data_table')
    
@endsection