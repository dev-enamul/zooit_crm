@extends('layouts.dashboard')
@section('title','Unit List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Unit List</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Unit List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

         

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">
                           <div class="d-flex justify-content-between"> 
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>

                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-pdf"></i> pdf</span>
                                        </button> 
                                    </div> 
                                </div>
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>
                           
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Action</th>
                                        <th>S/N</th> 
                                        <th>Unit Name</th>
                                        <th>Project Name</th>
                                        <th>Unit Type</th>
                                        <th>Category</th>
                                        <th>Price</th> 
                                        <th>Status</th>   
                                    </tr>
                                </thead>
                                <tbody> 
                                   <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="../assets/images/users/avatar-6.png" alt="Header Avatar">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="{{route('sold.unsold')}}">Sold & Unsold</a>
                                                    <a class="dropdown-item" href="{{route('salse.index')}}">Salse History</a>  
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td>Unit 101</td>
                                        <td>City Plaza</td>
                                        <td>Residential</td>
                                        <td>2 Bedroom</td>
                                        <td>৳5,000,000</td>
                                        <td>Available</td>
                                    </tr> 

                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="../assets/images/users/avatar-6.png" alt="Header Avatar">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <!-- <a class="dropdown-item" href="freelancer_profile.html">View Profile</a> -->
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="{{route('sold.unsold')}}">Sold & Unsold</a> 
                                                    <!-- <a class="dropdown-item" href="profession_permission.html">Update Permission</a> -->
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>2</td>
                                        <td>Unit 202</td>
                                        <td>Green Valley</td>
                                        <td>Commercial</td>
                                        <td>Office Space</td>
                                        <td>৳10,000,000</td>
                                        <td>Booked</td>
                                    </tr> 

                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="../assets/images/users/avatar-6.png" alt="Header Avatar">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <!-- <a class="dropdown-item" href="freelancer_profile.html">View Profile</a> -->
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <!-- <a class="dropdown-item" href="profession_permission.html">Update Permission</a> -->
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>3</td>
                                        <td>Unit 303</td>
                                        <td>Ocean View</td>
                                        <td>Residential</td>
                                        <td>3 Bedroom</td>
                                        <td>৳7,500,000</td>
                                        <td>Sold</td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
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

<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row">  

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="status" class="form-label">Status </label>
                    <select class="select2" name="status" id="status"> 
                        <option value="">Sold </option> 
                        <option value="">Blocked </option> 
                        <option value="">Available </option>
                    </select>  
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="project" class="form-label">Project </label>
                    <select class="select2" search name="project" id="project">
                        <option value="">All</option>
                        <option value="1">City Plaza</option>
                        <option value="2">Green Valley</option>
                        <option value="3">Ocean View</option>  
                    </select>  
                </div>
            </div> 
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div>
@endsection