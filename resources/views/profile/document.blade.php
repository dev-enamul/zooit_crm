@extends('layouts.dashboard')
@section('title',"Wallet")  
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9">  
                    <div class="card">
                        <div class="card-body">
                            <form class="form" action="{{route('profile.document.store')}}" enctype="multipart/form-data" method="post">
                                @csrf 
                                
                                <div class="row">
                                    <div class="col-md-6 mt-3"> 
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <label for="tin_number" class="form-label">File Title</label>
                                        <input type="text" placeholder="Enter file title" class="form-control" name="title" id="">
                                    </div> 
                                    <div class="col-md-6 mt-3">
                                        <label for="tin_number" class="form-label">File</label>
                                        <input type="file" class="form-control" name="file" id="">
                                    </div> 
                                    <div class="col-md-2 mt-3"> 
                                        <button type="submit" class="btn btn-secondary">Add File</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>  

    @include('includes.footer')
</div> 
@endsection 
 
@section('script')
    
@endsection