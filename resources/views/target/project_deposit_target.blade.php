@extends('layouts.dashboard')
@section('title',"Deposit Target Asign")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Deposit Target Asign </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposit Target Asign</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12"> 
                    <form class="needs-validation" novalidate>
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
                                            <h4 class="rich-list-title mb-1">Project Name</h4>
                                            <p class="rich-list-subtitle mb-0">Project Location</p>
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
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="10"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="new_deposit" class="form-label">Existing Deposit</label>
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="400000"> 
                                        </div>
                                    </div> 
                                </div>  
                        </div> 
                    </div>  

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
                                            <h4 class="rich-list-title mb-1">Project Name</h4>
                                            <p class="rich-list-subtitle mb-0">Project Location</p>
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
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="10"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="new_deposit" class="form-label">Existing Deposit</label>
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="400000"> 
                                        </div>
                                    </div> 
                                </div>  
                        </div> 
                    </div>  

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
                                            <h4 class="rich-list-title mb-1">Project Name</h4>
                                            <p class="rich-list-subtitle mb-0">Project Location</p>
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
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="10"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="new_deposit" class="form-label">Existing Deposit</label>
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="400000"> 
                                        </div>
                                    </div> 
                                </div>  
                        </div> 
                    </div>  

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
                                            <h4 class="rich-list-title mb-1">Project Name</h4>
                                            <p class="rich-list-subtitle mb-0">Project Location</p>
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
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="10"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="new_deposit" class="form-label">Existing Deposit</label>
                                            <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" value="400000"> 
                                        </div>
                                    </div> 
                                </div>  
                        </div> 
                    </div>  
                   
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