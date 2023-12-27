@extends('layouts.dashboard')
@section('title','Dashboard')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fs-16 fw-semibold mb-1 mb-md-2">Good Morning, <span class="text-primary">Md Enamul Haque!</span></h4>
                            <!-- <p class="text-muted mb-0">Here's what's happening with your store today.</p> -->
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Zoom IT</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--    end row -->

            <div class="row">
                <div class="col-xxl-9">
                 
                    <h3 class="card-title">Today target achivement</h3>
                    <div class="row">  
                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Freelancer Join</p>
                                           <small> <span class="text-primary" id="countdown">4: 3: 12 </span></small>
                                            <h4 class="mb-0">10/20</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Customer Join</p>
                                            <small> <span class="text-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">24/24</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Prospecting</p>
                                            <small> <span class="text-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">10/34</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Cold Calling</p>
                                            <small> <span class="badge badge-label-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">10/23</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Lead</p>
                                            <small> <span class="badge badge-label-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">33/43</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Lead Analyses</p>
                                            <small> <span class="badge badge-label-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">21/45</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                    </div> 

                    <h3 class="card-title">This month achivement</h3>
                    <div class="row">  
                     

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Freelancer Join</p>
                                           <small> <span class="text-primary" id="countdown">4: 3: 12 </span></small>
                                            <h4 class="mb-0">10/20</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Customer Join</p>
                                            <small> <span class="text-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">24/24</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Prospecting</p>
                                            <small> <span class="text-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">10/34</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Cold Calling</p>
                                            <small> <span class="text-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">10/23</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Lead</p>
                                            <small> <span class="text-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">33/43</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div> 

                        <div class="col-xl-2">
                            <div class="card bg-primary-subtle" style="background: url('../assets/images/dashboard/dashboard-shape-3.png'); background-repeat: no-repeat; background-position: bottom center; ">
                                <div class="card-body">
                                    <div class="d-flex"> 
                                        <div class="ms-3">
                                            <p class="text-primary mb-0">Lead Analyses</p>
                                            <small> <span class="badge badge-label-primary" id="countdown">4: 3: 12</span></small>
                                            <h4 class="mb-0">21/45</h4>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>  
                    </div> 

                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Today Target</h3>
                            <div class="card">
                                <div id="today_target"
                                    data-colors='["--bs-primary", "--bs-success"]'
                                    class="apex-charts"
                                    data-series='[{"name": "Target", "data": [90, 60, 70, 80]},{"name": "Achivement", "data": [80, 60, 50, 40]}]'
                                    data-xaxis-categories='["Presentation", "Follow Up", "Negotiation", "Salse"]'
                                    data-height="400">
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-12">
                            <h3 class="card-title">Today Task</h3>
                            <div class="card"> 
                                <div class="card-body"> 
                                    <div class="timeline timeline-timed">
                                        <div class="timeline-item">
                                            <span class="timeline-time">10:00</span>
                                            <div class="timeline-pin"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked"></div>
                                            <div class="timeline-content">
                                                <div>
                                                    <span>Meeting with Enamul, Jamil in Dhaka</span> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="timeline-time">12:45</span>
                                            <div class="timeline-pin"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked"></div>
                                            <div class="timeline-content">
                                                <p class="mb-0">Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="timeline-time">14:00</span>
                                            <div class="timeline-pin"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"></div>
                                            <div class="timeline-content">
                                                <p class="mb-0">Received a new feedback on <a href="#">GoFinance</a> App product.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="timeline-time">15:20</span>
                                            <div class="timeline-pin"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"></div>
                                            <div class="timeline-content">
                                                <p class="mb-0">Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna.</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <span class="timeline-time">17:00</span>
                                            <div class="timeline-pin"><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"></div>
                                            <div class="timeline-content">
                                                <p class="mb-0">Make Deposit <a href="#">USD 700</a> o ESL.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div> 
                    </div>
                    
                </div> 
        </div>
        <!-- end container-fluid -->
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

@section('script')
     <script>
        barChart("today_target"); 
    </script>
@endsection