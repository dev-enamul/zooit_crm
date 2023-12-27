@extends('layouts.dashboard')
@section('title',"Profile");
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="card overflow-hidden">
                <div class="bg-primary-subtle">
                    <img src="https://i.pinimg.com/originals/f6/42/cd/f642cdffdac25be276ed241ac0218f89.jpg" alt="" width="100%">
                </div>
                <div class="card-body pt-0">
                    <div class="row align-items-end">
                        <div class="col-sm-4 mt-n4">
                            <div class="avatar-md mb-3 profile_picture">
                                <img src="../assets/images/users/avatar-6.png" alt="" class="img-fluid avatar-circle bg-light p-2 border-2 border-primary">
                            </div>
                            <h5 class="fs-16 mb-1 text-truncate">Charlie Stone</h5>
                            <p class="text-muted mb-0 text-truncate">UI/UX Designer</p>
                        </div>

                        <div class="col-sm-8">
                          <div class="row">
                                <div class="col-sm-4">
                                    <h5 class="fs-15 mb-1"><i class="mdi mdi-human-queue"></i>150</h5>
                                    <p class="text-muted mb-0">Freelancer</p>
                                </div>

                                <div class="col-sm-4">
                                    <h5 class="fs-15 mb-1"><i class="mdi mdi-human-capacity-decrease"></i>572</h5>
                                    <p class="text-muted mb-0">Customer</p>
                                </div>

                                <div class="col-sm-4">
                                    <h5 class="fs-15 mb-1">$1245</h5>
                                    <p class="text-muted mb-0">Revenue</p>
                                </div> 
                          </div>

                        </div>
                    </div>
                </div>

                <div class="card-body border-top">
                    <div class="d-flex justify-content-between mb-4">
                        <h4 class="card-title">About</h4>
                        <div>
                            <div class="btn btn-secondary cursor-pointer" title="Change Password"  data-bs-toggle="modal" data-bs-target="#change_password_modal">
                                <i class="mdi mdi-key-change"></i> Change password 
                            </div>  
                            <a href="edit_profile.html" class="btn btn-primary cursor-pointer"> 
                                <i class="mdi mdi-account-edit"></i> Edit Profile
                            </a>  
                        </div>
                       
                    </div> 
                    <p class="text-muted mb-4">Hi I'm Charlie Stone,has been the industry's standard dummy text To an English person, it will seem like simplified English, as a skeptical Cambridge.</p>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-account align-middle text-primary me-2"></i> Full Name :</th>
                                    <td>Charlie Stone</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-cellphone align-middle text-primary me-2"></i> Mobile :</th>
                                    <td>(123) 123 1234</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-email text-primary me-2"></i> E-mail :</th>
                                    <td>cynthiaskote@gmail.com</td>
                                </tr>
                                <tr>
                                    <th scope="row"><i class="mdi mdi-google-maps text-primary me-2"></i> Location :</th>
                                    <td>California, United States</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>

            <div class="row border-top">
                <div class="col-md-6">
                    <div class="card"> 
                        <div class="card-body">
                            <h4>Target Achive</h4>
                            <div id="abc"
                                data-colors='["--bs-primary", "--bs-success"]'
                                class="apex-charts"
                                data-series='[{"name": "Target", "data": [90, 60, 70, 80, 90]}]'
                                data-xaxis-categories='["Last 7 Days", "This Month", "Last Month", "Last 1 Year", "Full Life"]'
                                data-height="300">
                            </div>
                        </div> 
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="card"> 
                        <div class="card-body">
                            <h4>Task Complete</h4>
                            <div id="aaa"
                                data-colors='["--bs-primary", "--bs-success"]'
                                class="apex-charts"
                                data-series='[{"name": "Target", "data": [50, 95, 70, 80, 90]}]'
                                data-xaxis-categories='["Last 7 Days", "This Month", "Last Month", "Last 1 Year", "Full Life"]'
                                data-height="300">
                            </div>
                        </div> 
                    </div>
                </div>  
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

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