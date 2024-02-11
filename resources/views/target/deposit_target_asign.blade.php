@extends('layouts.dashboard')
@section('title',"Deposit Target Assign")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Deposit Target Assign</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposit Target Assign</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header text-primary">
                            <div class="card-icon">
                                <i class="fas fa-building fs-14"></i>
                            </div>
                            <h4 class="card-title mb-0">{{@$target_project->project->name}}</h4> 
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div class="">
                                            <p class="text-primary text-truncate mb-2"> New Unit</p>
                                            <h5 class="mb-0">{{$target_project->new_unit}}</h5>
                                        </div> 
                                        <div class="text-primary float-end">
                                            {{-- <i class="fas fa-check"></i> --}}
                                            <i class="mdi mdi-menu-up"> </i>{{$target_project->new_unit}}
                                        </div>

                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Existing Unit</p>
                                            <h5 class="mb-0">{{$target_project->existing_unit}}</h5>
                                        </div>
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i>{{$target_project->existing_unit}}
                                        </div>
                                    </div>
                                </div> 

                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">New Deposit</p>
                                            <h5 class="mb-0">{{get_price($target_project->new_total_deposit)}}</h5>
                                        </div> 
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i>{{get_price($target_project->new_total_deposit)}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="d-flex justify-content-between align-content-end shadow-lg p-3">
                                        <div>
                                            <p class="text-muted text-truncate mb-2">Existing Deposit</p>
                                            <h5 class="mb-0">{{get_price($target_project->existing_deposit)}}</h5>
                                        </div>
                                        <div class="text-success float-end">
                                            <i class="mdi mdi-menu-up"> </i>{{get_price($target_project->existing_deposit)}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    <form class="needs-validation" novalidate>
                        @foreach ($employees as $data)
                            <div class="card"> 
                                <div class="card-body"> 
                                        <div class="row">
                                            <div class="rich-list-item pt-0">
                                                <div class="rich-list-prepend">
                                                    <div class="avatar avatar-xs">
                                                        <div class=""><img src="assets/images/users/avatar-1.png" alt="Avatar image" class="avatar-2xs"></div>
                                                    </div>
                                                </div>
                                                <div class="rich-list-content">
                                                    <h4 class="rich-list-title mb-1">{{$data->name}}</h4>
                                                    <p class="rich-list-subtitle mb-0">#4243</p>
                                                </div>
                                                <div class="rich-list-append"><button class="btn btn-sm btn-label-primary">Profile</button></div>
                                            </div>
                                            <hr>   
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="new_unit" class="form-label">New Unit</label>
                                                    <input type="number" name="new_unit" id="new_unit" min="0" class="form-control" placeholder="0"> 
                                                </div>
                                            </div> 
        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="new_deposit" class="form-label">New Deposit</label>
                                                    <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" placeholder="0"> 
                                                </div>
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="new_deposit" class="form-label">Existing Unit</label>
                                                    <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" placeholder="0"> 
                                                </div>
                                            </div>
        
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="new_deposit" class="form-label">Existing Deposit</label>
                                                    <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" placeholder="0"> 
                                                </div>
                                            </div> 
                                        </div>  
                                </div> 
                            </div>  
                        @endforeach 
                </form>
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

  @include('includes.footer')

</div>
@endsection