@extends('layouts.dashboard')
@section('title',"Search")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="card">
                <div class="card-header card-header-bordered">
                    <div class="card-icon text-muted"><i class="fa fa-user-tag fs14"></i></div>
                    <h3 class="card-title">#{{$key}}</h3>
                </div>
                
                <div class="card-body">
                    <div class="rich-list rich-list-flush">
                        @foreach ($datas as $data)
                            <div class="flex-column align-items-stretch">
                                <div class="rich-list-item">
                                    <div class="rich-list-prepend">
                                        <div class="avatar avatar-xs">
                                            <div class=""><img src="{{$data->image()}}" alt="Avatar image" class="avatar-2xs" /></div>
                                        </div>
                                    </div> 
                                    <div class="rich-list-content">
                                        <h4 class="rich-list-title mb-1">
                                            @if ($data->user_type==1 || $data->user_type==2)
                                                <a href="{{route('profile',encrypt($data->id))}}">{{$data->name}}</a>
                                            @else 
                                                <a href="{{route('customer.profile',encrypt($data?->customer[0]?->id))}}">{{$data->name}}</a>
                                            @endif 
                                        </h4>
                                     
                                        @if ($data->user_type==1 || $data->user_type==2)
                                            <p class="rich-list-subtitle mb-0"> #{{$data->user_id}}</p> 
                                        @else
                                            <p class="rich-list-subtitle mb-0">
                                                @foreach ($data->customer as $customer)
                                                    #{{$customer->customer_id}}
                                                @endforeach 
                                            </p> 
                                        @endif  
                                    </div>
                                    
                                    @if ($data->user_type==1 || $data->user_type==2)
                                        <div class="rich-list-append">
                                            <a href="{{route('profile',encrypt($data->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                        </div> 
                                    @else  
                                        <div class="rich-list-append">
                                            <a href="{{route('customer.profile',encrypt($data?->customer[0]?->id))}}" class="btn btn-sm btn-label-primary">Profile</a>
                                        </div>
                                    @endif 
                                </div>
                            </div> 
                        @endforeach 
                    </div>
                </div>
            </div>
    </div>

    @include('includes.footer')

</div>
@endsection 

@section('script')
   <script>
        $('input[name="key"]').val('{{$key}}');
   </script>
@endsection