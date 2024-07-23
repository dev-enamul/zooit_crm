@extends('layouts.dashboard')
@section('title',"Profile")
@section('content')
<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('customer.includes.customer_sidebar')
                </div> 
                <div class="col-md-9">   
                    @include('customer.includes.customer_menu')
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-icon text-muted"><i class="fa fa-bell"></i></div>
                                <h3 class="card-title">Contacts Persons</h3>
                                <div class="card-addon">
                                     <a class="btn btn-secondary" href="">Add New</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="rich-list rich-list-bordered rich-list-action">
                                    @foreach ($contact_persons as $person)
                                    <div class="rich-list-item">
                                        <div class="rich-list-prepend">
                                            <div class="avatar avatar-xs avatar-label-info">
                                                <div class="">
                                                    <img class="rounded avatar-2xs p-0" src="{{$person->user->image()}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rich-list-content">
                                            <h4 class="rich-list-title mb-1">{{$person->name}}</h4>
                                            <p class="rich-list-subtitle mb-0">{{$person->email}}</p>
                                        </div>
                                        <div class="rich-list-append">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-label-secondary btn-icon" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h fs-12"></i></button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated" style="">
                                                    <a class="dropdown-item" href="#">
                                                        <div class="dropdown-icon"><i class="fa fa-check"></i></div>
                                                        <span class="dropdown-content">Edit</span>
                                                    </a>
                                                    <a class="dropdown-item" href="#">
                                                        <div class="dropdown-icon"><i class="fa fa-trash-alt"></i></div>
                                                        <span class="dropdown-content">Delete</span>
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">
                                                        <div class="dropdown-icon"><i class="fa fa-cog"></i></div>
                                                        <span class="dropdown-content">Show</span>
                                                    </a>
                                                </div>
                                            </div>
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
    </div> 

    
</div>
@endsection 
 