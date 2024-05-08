@extends('layouts.dashboard')
@section('title','Today Target')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daily Task</h4>

                        {{-- <div class="page-title-right">
                            <form action="" method="get" action="">
                                <div class="input-group">  
                                    <input type="date" class="form-control" value="{{$selected_date}}" name="date" id="date">
                                    <button class="btn btn-secondary" type="submit">
                                        <span><i class="fas fa-filter"></i> Filter</span>
                                    </button> 
                                </div>
                            </form> 
                        </div> --}}

                    </div>
                </div>
            </div>
            <!-- end page title -->

         
          
            <div class="row"> 
                <div class="col-12">  
                    @if (isset($old_tasks) && count($old_tasks) > 0) 
                    <div class="card"> 
                        <div class="card-body">
                            <h3 class="card-title">Old Task</h3>
                            <div class="timeline timeline-timed">
                               
                                    @foreach($old_tasks as $data)
                                    <div class="timeline-item">
                                        <span class="timeline-time">{{get_date($data->time,'H:i')}}</span>
                                        <div class="timeline-pin"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" {{$data->status==1?"checked":""}}></div>
                                        <div class="timeline-content">
                                            <div>
                                                <small>{{get_date($data->time)}}</small> <br>
                                                <span>{{$data->task}}</span>  <br>
                                                <a href="{{route('submit.task',$data->id)}}" class="btn btn-primary">Completed</a>
                                                {{-- <a href="{{route('reject.task',$data->id)}}" class="btn btn-danger">Skip Task</a> --}}
                                            </div>
                                        </div>
                                    </div> 
                                    @endforeach 
                            </div>
                        </div> 
                    </div>

                    @endif

                    
                    <div class="card"> 
                        <div class="card-body"> 
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>Action</th> 
                                        <th>S/N</th> 
                                        <th>Date & Time</th>
                                        <th>Assign By</th> 
                                        <th>Particulars</th> 
                                        <th>Status</th>       
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($today_tasks as $key => $data)
                                    <tr> 
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            @if ($data->status==0)
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="{{route('submit.task',$data->id)}}" >Completed</a>
                                                        {{-- <a class="dropdown-item" href="{{route('reject.task',$data->id)}}" >Reject</a> --}}
                                                    </div>
                                                </div> 
                                            @endif
                                           
                                        </td>  
                                        <td>{{$key+1}}</td>
                                        <td>{{get_date($data->time)}} <span class="badge badge-primary">{{get_date($data->time,'g:i A')}}</span></td>  
                                        <td>{{@$data->taskModel->assigner->name}} [{{@$data->taskModel->assigner->user_id}}]</td>
                                        <td>{{$data->task}}</td>
                                        <td>
                                            @if($data->status==0)
                                                <span class="badge badge-warning">Pending</span>
                                            @else  
                                                <span  class="badge badge-success">Completed</span>
                                            @endif
                                        </td>
                                        {{-- <td></td>
                                        <td></td>  --}}
                                    </tr>   
                                    @endforeach  
                                </tbody>  
                            </table> 
                        </div> 
                    </div> 
                </div> 
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 
    @include('includes.footer')
</div>
@endsection