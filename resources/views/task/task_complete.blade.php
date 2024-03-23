@extends('layouts.dashboard') 
@section('title','Task Complete')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Task Complete History </h4>
                        <p class="d-none">{{$user->name}} [{{$user->user_id}}]</p> 
                        <input type="hidden" id="hideExport" value=":nth-child(1)"> 
                        <input type="hidden" id="pageSize" value="A4">
                        <input type="hidden" id="fontSize" value="10">

                        <div class="page-title-right">
                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                <span><i class="fas fa-filter"></i> Filter</span>
                            </button> 
                        </div>

                    </div>
                </div>
            </div> 
            <div class="row"> 
                <div class="col-12"> 
                    <div class="card"> 
                        <div class="card-body"> 
                            <div class="table-box">
                                <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr> 
                                            <th>Action</th> 
                                            <th>S/N</th> 
                                            <th>Date</th> 
                                            <th>Assign Task</th>
                                            <th>Complete Task</th>
                                            <th>Progress</th>   
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($datas as $key => $data)
                                        <tr> 
                                            <td class="text-center"><a href="{{route('task.details',$data->id)}}" class="btn btn-sm btn-primary"><i class="mdi mdi-eye"></i> View</a></td>
                                            <td>{{$key+1}}</td>
                                            <td>{{get_date($data->date)}}</td>
                                            @php
                                                if(isset($data->taskList) && $data->taskList->count() > 0){
                                                    $total_task = count($data->taskList);
                                                    $complete_task = count($data->taskList->where('status',1));
    
                                                    $completionPercentage = $total_task > 0 ? round(($complete_task / $total_task) * 100) : 0;
                                                    
                                                }else{
                                                    $total_task = 0;
                                                    $complete_task = 0;
                                                    $completionPercentage = 0;
                                                }  
     
                                            @endphp 
    
                                            <td>{{$total_task}}</td>
                                            <td>{{$complete_task}}</td> 
                                            <td class="align-middle">
                                                <div class="">
                                                    <div class="d-flex justify-content-between">
                                                        <h6>{{$completionPercentage}}%</h6>  
                                                    </div>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-primary" style="width: {{$completionPercentage}}%"></div>
                                                    </div>
                                                </div>
                                            </td>   
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
    </div>

  @include('includes.footer') 
</div> 
 
<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row"> 
           <form action="" method="get">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="freelancer" class="form-label">Date</label>
                        <input class="form-control" type="text" name="date" id="daterangepicker" /> 
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Employee</label>
                        <select class="form-select select2" name="employee" id="employee"> 
                            <option value="{{auth()->user()->id}}" selected>My Task</option> 
                            @foreach ($employeies as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option> 
                            @endforeach 
                        </select>  
                    </div>
                </div>  
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
                </div>
           </form> 
        </div>
    </div>
</div>
@endsection 

@section('script')
    @include('includes.data_table')
    <script>
        getDateRange('daterangepicker')
    </script>
@endsection