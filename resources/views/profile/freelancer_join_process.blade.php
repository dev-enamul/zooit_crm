@extends('layouts.dashboard')
@section('title',"Profile")
  
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9"> 
                    @include('includes.freelancer_profile_data') 
                    <div class="card"> 
                        <div class="card-body">
                            <h4 class="card-title">Approve Process</h4>
                            <hr>
                            <div class="timeline timeline-zigzag"> 
                                <div class="timeline-item">
                                    <div class="timeline-pin">
                                        <i class="marker marker-circle text-danger"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <p class="mb-0"></p>
                                            <p class="m-0 bold-lg">Recruitment By {{@$user->freelancer->reference->name}} [{{@$user->freelancer->reference->user_id}}]</p>
                                        @if ($user->ref_id!=$user->created_by)
                                            <p class="m-0 bold-lg">Created By {{@$user->createdBy->name}} [{{@$user->createdBy->user_id}}]</p>   
                                        @endif
                                        <p class="m-0 fs-10">{{get_date(@$user->freelancer->created_at)}}</p> 
                                        <p></p>
                                    </div>
                                </div> 

                               @foreach ($approve_process as $approve)
                                <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <p class="mb-0">
                                                </p><p class="m-0 bold-lg">Approve By {{@$approve->approver->name}}</p>
                                                <p class="m-0 fs-10">{{get_date(@$approve->created_at)}}</p>
                                                <p>{{@$approve->remarks}}</p>
                                                @if ($approve->id_making==1)
                                                    Congratulations on receiving your ID. Now, you are required to complete the training.
                                                    <span class="badge badge-secondary mb-1">ID: {{$approve->freelancer->user_id}} </span>
                                                @endif
                                                @if ($approve->counselling==1)
                                                    <span class="badge badge-secondary mb-1">#Counselling </span>
                                                @endif

                                                @if ($approve->interview==1)
                                                    <span class="badge badge-secondary mb-1">#Interview </span> 
                                                @endif 

                                                @if ($approve->meeting_date!=null)
                                                    <span class="badge badge-secondary mb-1">#Meeting Date: {{get_date($approve->meeting_date)}} </span>
                                                    
                                                @endif 

                                                @if ($approve->training_category_id!=null)
                                                    <span class="badge badge-secondary mb-1">#Training Category: {{@$approve->trainingCategory->title}} </span>
                                                @endif 

                                                @if ($approve->complete_training==1)  
                                                    <span class="badge badge-secondary mb-1">#Complete Training </span> 
                                                @endif
                                               
                                                
                                            <p></p>
                                        </div>
                                    </div> 
                               @endforeach 
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
        barChart("abc");
        barChart("aaa");
    </script>
@endsection