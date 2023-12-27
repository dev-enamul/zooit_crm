@extends('layouts.dashboard')
@section('title',"Employee List")

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customer List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer List</li>
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
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Profession</th>
                                        <th>Upazilla/Thana</th>
                                        <th>Union</th>
                                        <th>Village</th>
                                        <th>Mobile No</th>
                                        <th>Freelancer</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospecting.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>Md Jamil [FL154]</td>
                                        <td>He is Good</td>
                                    </tr>

                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospectings_create.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>2</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>Md Jamil [FL154]</td>
                                        <td>He is Good</td>
                                    </tr>

                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospectings_create.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>3</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>Md Jamil [FL154]</td>
                                        <td>He is Good</td>
                                    </tr>

                                    <tr>
                                        <td class="text-center"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="d-block" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospectings_create.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>4</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>Md Jamil [FL154]</td>
                                        <td>He is Good</td>
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