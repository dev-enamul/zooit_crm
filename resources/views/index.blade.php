@extends('layouts.dashboard')
@section('title','Dashboard')
@section('content')  
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fs-16 fw-semibold mb-1 mb-md-2">{{$greeting}}, <span class="text-primary">{{auth()->user()->name}}!</span></h4>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name', 'ZOOM IT') }}</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">  
                <div class="col-xxl-9">  
                    @if ($designations>=15) 
                    <div class="mb-3"> 
                        <div class="accordion" id="accordionExample-general"> 
                            <div class="accordion-item"> 
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-general" aria-expanded="false" aria-controls="collapseOne-general">
                                        <b>Today target achivement</b>
                                    </button>
                                </h2>
                                <div id="collapseOne-general" class="accordion-collapse collapse" data-bs-parent="#accordionExample-general" style="">
                                    <div class="accordion-body">
                                        <div class="row">  
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Freelancer Join</p> 
                                                                <h4 class="mb-0">{{$today_achive['freelancer']}}/{{$today_target['freelancer']}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Customer Join</p> 
                                                                <h4 class="mb-0">{{$today_achive['customer']}}/{{$today_target['customer']}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Prospecting</p> 
                                                                <h4 class="mb-0">{{$today_achive['prospecting']}}/{{$today_target['prospecting']}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Cold Calling</p> 
                                                                <h4 class="mb-0">{{$today_achive['cold_calling']}}/{{$today_target['cold_calling']}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Lead</p> 
                                                                <h4 class="mb-0">{{$today_achive['lead']}}/{{$today_target['lead']}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                     
                                        </div> 
                                    </div>
                                    <div class="col-md-12"> 
                                        <div class="card">
                                            <div id="today_target"
                                                data-colors='["--bs-primary", "--bs-success"]'
                                                class="apex-charts"
                                                data-series='[{"name": "Achivement", "data": [{{$today_achive['freelancer']}}, {{$today_achive['customer']}}, {{$today_achive['prospecting']}}, {{$today_achive['cold_calling']}},{{$today_achive['lead']}}]},
                                                        {"name": "Target", "data": [{{$today_target['freelancer']}}, {{$today_target['customer']}}, {{$today_target['prospecting']}}, {{$today_target['cold_calling']}}, {{$today_target['lead']}}]}]'
                                                data-xaxis-categories='["Freelancer", "Customer", "Prospecting", "Cold Calling","Lead"]'
                                                data-height="400">
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo-general" aria-expanded="false" aria-controls="collapseTwo-general">
                                        <b>This month achivement</b>
                                    </button>
                                </h2>
                                <div id="collapseTwo-general" class="accordion-collapse collapse" data-bs-parent="#accordionExample-general" style="">
                                    <div class="accordion-body">
                                        <div class="row">   
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Freelancer Join</p> 
                                                                <h4 class="mb-0">{{$monthly_achive['freelancer']}}/{{$field_target->freelancer??0}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Customer Join</p> 
                                                                <h4 class="mb-0">{{$monthly_achive['customer']}}/{{$field_target->customer??0}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Prospecting</p> 
                                                                <h4 class="mb-0">{{$monthly_achive['prospecting']}}/{{$field_target->prospecting??0}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Cold Calling</p> 
                                                                <h4 class="mb-0">{{$monthly_achive['cold_calling']}}/{{$field_target->cold_calling??0}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                            <div class="col-xl-2">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="text-secondary mb-0">Lead</p> 
                                                                <h4 class="mb-0">{{$monthly_achive['lead']}}/{{$field_target->lead??0}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div> 
                    
                                             
                                        </div>
                                    </div>
                                    <div class="col-md-12"> 
                                        <div class="card">
                                            <div id="this_month_target"
                                                data-colors='["--bs-primary", "--bs-success"]'
                                                class="apex-charts"
                                                data-series='[{"name": "Achivement", "data": [{{$monthly_achive['freelancer']}}, {{$monthly_achive['customer']}}, {{$monthly_achive['prospecting']}}, {{$monthly_achive['cold_calling']}},{{$monthly_achive['lead']}}]},
                                                    {"name": "Target", "data": [{{$field_target->freelancer??0}}, {{$field_target->customer??0}}, {{$field_target->prospecting??0}}, {{$field_target->cold_calling??0}}, {{$field_target->lead??0}}]}]'
                                                data-xaxis-categories='["Freelancer", "Customer", "Prospecting", "Cold Calling","Lead"]'
                                                data-height="400">
                                            </div>
                                        </div> 
                                    </div>

                                </div>
                            </div>
                        
                        </div>
                    </div> 
                    @else  
                    <div class="mb-3"> 
                        <div class="accordion" id="accordionExample-general"> 
                            <div class="accordion-item"> 
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-general" aria-expanded="false" aria-controls="collapseOne-general">
                                        <b>Today target achivement</b>
                                    </button>
                                </h2>
                                <div id="collapseOne-general" class="accordion-collapse collapse" data-bs-parent="#accordionExample-general" style="">
                                    <div class="accordion-body">
                                        <div class="row"> 
                                            <div class="col-md-3">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="fw-semibold mb-0">Deposit </p> 
                                                                <h4 class="mb-0">{{$today_achive['deposit']}}/{{$today_target['deposit']}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-md-12"> 
                                        <div class="card">
                                            <div id="today_target"
                                                data-colors='["--bs-primary", "--bs-success"]'
                                                class="apex-charts"
                                                data-series='[{"name": "Achivement", "data": [{{$today_achive['deposit']}}]},
                                                        {"name": "Target", "data": [    {{$today_target['deposit']}}]}]'
                                                data-xaxis-categories='["Today Deposit TA"]'
                                                data-height="400">
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo-general" aria-expanded="false" aria-controls="collapseTwo-general">
                                        <b>This month achivement</b>
                                    </button>
                                </h2>
                                <div id="collapseTwo-general" class="accordion-collapse collapse" data-bs-parent="#accordionExample-general" style="">
                                    <div class="accordion-body">
                                        <div class="row">  
                                              
                                            <div class="col-md-3">
                                                <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                                    <div class="card-body">
                                                        <div class="d-flex"> 
                                                            <div class="ms-3">
                                                                <p class="fw-semibold mb-0">TDeposit</p> 
                                                                <h4 class="mb-0">{{$monthly_achive['deposit']}}/{{$deposit_target}}</h4>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-md-12"> 
                                        <div class="card">
                                            <div id="this_month_target"
                                                data-colors='["--bs-primary", "--bs-success"]'
                                                class="apex-charts"
                                                data-series='[{"name": "Achivement", "data": [   {{$monthly_achive['deposit']}}]},
                                                {"name": "Target", "data": [  {{$deposit_target}}]}]'
                                                data-xaxis-categories='[ "Deposit"]'
                                                data-height="400">
                                            </div>
                                        </div> 
                                    </div>

                                </div>
                            </div> 
                        </div>
                    </div> 
                    @endif 

                   
  
                    <div class="row">
                         
                        <div class="col-12">   
                            <div class="card"> 
                                <div class="card-body"> 
                                    <h5>Pending Task</h5>
                                    
                                    <div class="table-box">
                                        <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    @can('village-manage')
                                                    <th>Action</th>
                                                    @endcan
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
                                                    <td>{{get_date($data->created_at)}} <span class="badge badge-primary">{{get_date($data->time,'g:i A')}}</span></td>  
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
                    </div>
                    
                </div> 
        </div> 
    </div>  

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer> 
</div> 
@endsection 

@section('script')
     <script>
        barChart("today_target"); 
        barChart("this_month_target");
    </script>
@endsection