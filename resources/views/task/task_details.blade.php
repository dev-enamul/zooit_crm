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
                        <h4 class="mb-sm-0">Task Details</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Task Details</li>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>
     
            <div class="row"> 
                <div class="col-12">
 
                    <div class="card"> 
                        <div class="card-body">
                            <h3 class="card-title">Task Details <span class='text-primary'>[{{get_date($task->date)}}]</span></h3>
                            <div class="timeline timeline-timed"> 
                                @if (isset($task->taskList) && $task->taskList->count()>0)
                                    @foreach ($task->taskList as $data)
                                        <div class="timeline-item">
                                            <span class="timeline-time">{{get_date($data->time,'H:i')}}</span>
                                            @php 
                                                if($data->status == 0){
                                                    $color = 'text-danger';
                                                    $icon = 'fa-calendar-times';
                                                } else if($data->status == 1){
                                                    $color = 'text-primary';
                                                    $icon = 'fa-calendar-check';
                                                } else {
                                                    $color = 'text-secondary';
                                                    $icon = 'fa-calendar-times';
                                                }
                                            @endphp
                                            <div class="timeline-pin"><i class="fas {{$icon}} fs-16 {{$color}}"></i></div>
                                            <div class="timeline-content">
                                                <p class="mb-0">{{$data->task}}</p>
                                            </div>
                                        </div>
                                    @endforeach 
                                @endif 
                            </div>
                        </div> 
                    </div>
                </div> 
            </div> 
        </div>  
    </div> 
    @include('includes.footer')
</div>
@endsection