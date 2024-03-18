@extends('layouts.dashboard')
@section('title',"Approve Setting")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('approve.setting.save')}}" method="POST">
                            @csrf    
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="mb-sm-0" id="#swal-11">Approve Setting</h4>  
                                <div class="">
                                    <div class="btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_profession">
                                            <span><i class="fas fa-save"></i> Update</span>
                                        </button> 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body"> 
                                <div class="row">
                                    @foreach ($datas as $data)
                                        <div class="col-md-4 mb-4"> 
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  name="{{$data->name}}" id="{{$data->name}}" {{$data->status==1?"checked":""}}>
                                                <label class="form-check-label text-capitalize" for="{{$data->name}}">{{$data->name}}</label>
                                            </div> 
                                        </div> 
                                    @endforeach 
                                </div> 
                            </div>
                        </form> 
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    @include('includes.footer')
</div> 
@endsection

 
 