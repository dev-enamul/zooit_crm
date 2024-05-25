@extends('layouts.dashboard')
@section('title','Meeting Details')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box text-center">
                        <h4 class="mb-sm-0 pb-1">{{$data->title}}</h4> 
                        <h5>{{@$data->createdBy->name}} [{{@$data->createdBy->user_id}}]</h5>
                        <p class="m-0">{{get_date($data->date_time)}} <span class="badge badge-label-primary"> {{get_date($data->date_time,'h:i A')}} </span></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card"> 
                        @if (!$is_time_end) 
                        <div class="card-header card-header-bordered bg-primary">
                            <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                            <h3 class="card-title text-white w-100">Invitation Member <span class="badge badge-secondary float-end">{{$absent->count()}}</span></h3>
                        </div>
                        <div class="card-body">
                            <div class="rich-list rich-list-flush">
                                @foreach ($absent as $user_id)
                                    @php
                                        $user = $user_id->user;
                                    @endphp 
                                    <div class="flex-column align-items-stretch">
                                        <div class="rich-list-item">
                                            <div class="rich-list-prepend">
                                                <div class="avatar avatar-xs">
                                                    <div class=""><img src="{{@$user->image()}}" class="avatar-2xs"></div>
                                                </div>
                                            </div>
                                            <div class="rich-list-content">
                                                <h4 class="rich-list-title mb-1">{{@$user->name}}</h4>
                                                <p class="rich-list-subtitle mb-0">
                                                    {{ $user->employee->designation->title ?? $user->freelancer->designation->title ?? 'No Designation' }} [{{ $user->user_id }}]
                                                </p>
                                            </div>
                                            @if ($user->user_type==1 || $user->user_type==2)
                                                <div class="rich-list-append">
                                                    <a href="{{route('profile',encrypt($user->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                </div> 
                                            @else  
                                                <div class="rich-list-append">
                                                    <a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a><a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                </div>
                                            @endif 
                                        </div>
                                    </div> 
                                @endforeach
                            </div>
                        </div>
                        @else 
                            <div class="card-header card-header-bordered bg-primary">
                                <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                                <h3 class="card-title text-white w-100">Present <span class="badge badge-secondary float-end">{{$present->count()}}</span></h3>
                            </div>
                            <div class="card-body">
                                <div class="rich-list rich-list-flush">
                                    @foreach ($present as $present_user)
                                    @php
                                        $user = $present_user->user;
                                    @endphp
                                        <div class="flex-column align-items-stretch">
                                            <div class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-xs">
                                                        <div class=""><img src="{{@$user->image()}}" class="avatar-2xs"></div>
                                                    </div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title mb-1">{{@$user->name}}</h4>
                                                    <p class="rich-list-subtitle mb-0">
                                                        {{ $user->employee->designation->title ?? $user->freelancer->designation->title ?? 'No Designation' }} [{{ $user->user_id }}]
                                                    </p>
                                                </div>
                                                @if ($user->user_type==1 || $user->user_type==2)
                                                    <div class="rich-list-append">
                                                        <a href="{{route('meeting.attendance.status',encrypt($present_user->id))}}" class="btn btn-sm btn-label-danger me-1">Absent</a>
                                                        <a href="{{route('profile',encrypt($user->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div> 
                                                @else  
                                                    <div class="rich-list-append">
                                                        <a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div>
                                                @endif 
                                            </div>
                                        </div> 
                                    @endforeach
                                </div>
                            </div> 


                            <div class="card-header card-header-bordered bg-primary">
                                <div class="card-icon text-white"><i class="fa fa-user-tag fs14"></i></div>
                                <h3 class="card-title text-white w-100">Absent <span class="badge badge-secondary float-end">{{$absent->count()}}</span></h3>
                            </div>
                            <div class="card-body">
                                <div class="rich-list rich-list-flush">
                                    @foreach ($absent as $present_user)
                                    @php
                                        $user = $present_user->user;
                                    @endphp
                                        <div class="flex-column align-items-stretch">
                                            <div class="rich-list-item">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-xs">
                                                        <div class=""><img src="{{$user->image()}}" class="avatar-2xs"></div>
                                                    </div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title mb-1">{{$user->name}}</h4>
                                                    <p class="rich-list-subtitle mb-0">
                                                        {{ $user->employee->designation->title ?? $user->freelancer->designation->title ?? 'No Designation' }} [{{ $user->user_id }}]
                                                    </p>
                                                </div>
                                                @if ($user->user_type==1 || $user->user_type==2)
                                                    <div class="rich-list-append">
                                                        <a href="{{route('meeting.attendance.status',encrypt($present_user->id))}}" class="btn btn-sm btn-label-success me-1">Present</a>
                                                        <a href="{{route('profile',encrypt($user->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div> 
                                                @else  
                                                    <div class="rich-list-append">
                                                        <a href="{{route('customer.profile',encrypt(@$user->customer[0]->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                                    </div>
                                                @endif 
                                            </div>
                                        </div> 
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <div class="card-icon text-white"><i class="mdi mdi-view-agenda fs14"></i></div>
                            <h3 class="card-title text-white"> Agenda</h3>
                        </div>
                        <div class="card-body"> 
                            {{$data->agenda}}
                             
                        </div>
                    </div> 
                </div>
            </div> 
        </div>  
    </div>

 @include('includes.footer')

</div>
@endsection 
 