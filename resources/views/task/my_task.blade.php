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

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Daily Task</li>
                            </ol>
                        </div>

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
                                                <a href="{{route('submit.task',$data->id)}}" class="btn btn-primary">Submit Task</a> <a href="{{route('reject.task',$data->id)}}" class="btn btn-danger">Skip Task</a>
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
                            <h3 class="card-title">Today Task</h3>
                            <div class="timeline timeline-timed">
                                @if ($today_tasks?->taskList && $today_tasks->taskList->count() > 0)
                                    @foreach($today_tasks->taskList as $data)
                                    <div class="timeline-item">
                                        <span class="timeline-time">{{get_date($data->time,'H:i')}}</span>
                                        <div class="timeline-pin"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" {{$data->status==1?"checked":""}}></div>
                                        <div class="timeline-content">
                                            <div>
                                                <span>{{$data->task}}</span> <br>
                                                <a href="{{route('submit.task',$data->id)}}" class="btn btn-primary">Submit Task</a> <a href="{{route('reject.task',$data->id)}}" class="btn btn-danger">Skip Task</a>
                                            </div>
                                        </div>
                                    </div> 
                                    @endforeach
                                @else 
                                     <p class="mt-3">No task asign today</p>
                                @endif
                            </div>
                        </div> 
                    </div>


                    {{-- <div class="card"> 
                        <div class="card-body">
                            <h3 class="card-title">Tomorrow Task</h3>
                            <div class="timeline timeline-timed"> 
                                <div class="timeline-item">
                                    <span class="timeline-time">14:00</span>
                                    <div class="timeline-pin"><i class=" fas fa-dot-circle"></i></div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Received a new feedback on <a href="#">GoFinance</a> App product.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-time">15:20</span>
                                    <div class="timeline-pin"><i class=" fas fa-dot-circle"></i></div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna.</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <span class="timeline-time">17:00</span>
                                    <div class="timeline-pin"><i class=" fas fa-dot-circle"></i></div>
                                    <div class="timeline-content">
                                        <p class="mb-0">Make Deposit <a href="#">USD 700</a> o ESL.</p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> --}}
                </div> 
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 
    @include('includes.footer')
</div>
@endsection