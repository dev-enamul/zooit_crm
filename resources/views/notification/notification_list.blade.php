@extends('layouts.dashboard')
@section('title','Negotiation Analysis')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Notification</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Notification</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="card overflow-hidden"> 
                <div class="card-body pt-0"> 
                    <div class="box shadow-sm rounded mb-3">
                        <div class="box-title border-bottom p-3">
                            <h6 class="m-0">Notification</h6>
                        </div>
                        <div class="box-body p-0"> 
                            @foreach ($notifications as $notification)
                                <div class="p-3 d-flex align-items-center justify-content-between {{$notification->read_at==null?'bg-light':''}}">
                                    <div class="d-flex">
                                        <div class="dropdown-list-image me-3">
                                            <img class="rounded-circle" src="{{@$notification->notification->creator->image()}}" alt="" />
                                        </div>
                                        <div class="font-weight-bold mr-3">
                                            <div class="">
                                                <b>{{@$notification->notification->title}}</b>
                                                {{Str::limit(@$notification->notification->content,200)}}
                                            </div>
                                            <div class="text-right text-secondary">
                                                {{@$notification->created_at->diffForHumans();}}
                                            </div>
                                            <a href="{{route('notification.read',$notification->id)}}" type="button" class="btn btn-outline-primary btn-sm">View Details</a> 
                                        </div>
                                    </div>  
                                </div>  
                            @endforeach 

                            {{$notifications->links()}}
                        </div>
                    </div>
                </div>   
            </div> 
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content --> 
    @include('includes.footer')
</div>
@endsection 

 