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
                    {{-- @include('includes.freelancer_profile_data') --}}
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon text-muted"><i class="fa fa-chalkboard fs14"></i></div>
                            <h3 class="card-title">Field Work</h3>
                            <div class="card-addon">
                                 <input type="month" name="" id="" class="form-control">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2">Server Load</p>
                                        <h4 class="fs-16 mb-2">489</h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: 49.4%"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">49.4% <span>Avg</span></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2">Members online</p>
                                        <h4 class="fs-16 mb-2">3,450</h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-danger" style="width: 34.6%"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">34.6% <span>Avg</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2">Today's revenue</p>
                                        <h4 class="fs-16 mb-2">$18,390</h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-warning" style="width: 20%"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">$37,578 <span>Avg</span></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2">Expected profit</p>
                                        <h4 class="fs-16 mb-2">$23,461</h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-info" style="width: 60%"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">$23,461 <span>Avg</span></p>
                                    </div>
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

 
<div class="modal fade" id="change_password">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Change Password</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="{{route('update.password')}}" method="post"> 
                    @csrf  
                    <div class="form-group mb-2">
                        <label class="mb-1" for="old_password">Old Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password" required>
                    </div> 
                    <div class="form-group mb-2">
                        <label class="mb-1 mt-2" for="password">New Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Old Password" required>
                    </div> 

                    <div class="form-group mb-2">
                        <label class="mb-1 mt-2" for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Old Password" required>
                    </div> 

                    <div class="modal-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        </div> 
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>

@endsection 
 
@section('script')
  
@endsection