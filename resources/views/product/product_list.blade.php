@extends('layouts.dashboard')
@section('title','Product Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product List</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product List</li>
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
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
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
                                        <th>Name & ID</th>
                                        <th>Address</th>
                                        <th>Flat</th>
                                        <th>Shop</th>
                                        <th>Garage</th> 
                                        <th>Deiuxe/Studio</th> 
                                        <th>Sea/Hall</th> 
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
                                        <td>MN Tower</td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
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
                                        <td>1</td>
                                        <td>MN Tower</td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
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
                                        <td>1</td>
                                        <td>MN Tower</td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
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
                                        <td>1</td>
                                        <td>MN Tower</td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
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
                                        <td>1</td>
                                        <td>MN Tower</td>
                                        <td>Mohammadpur, Dhaka</td>
                                        <td>3/12</td>
                                        <td>4/12</td>
                                        <td>6/12</td>
                                        <td>4/65</td> 
                                        <td>5/12</td>
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
@endsection