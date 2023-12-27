@extends('layouts.dashboard')
@section('title',"Freelancer Create")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Freelancer List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Freelancer List</li>
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
                           <div class="text-center">
                            <h5 class="m-0">{{ config('app.name', 'ZOOM IT') }}</h5>
                            <p class="mb-1" ><b>Real Estate Agent- Data Collection Form</b> </p>
                           </div>
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Name : MD Enamul Haque</th> 
                                        <th>EMP-254</th>
                                        <th>Region: </th>
                                        <th>Zone: Noakhali</th>
                                        <th>Reporting Name & ID : MR Kamruzzaman & 153</th>
                                    </tr>
                                </thead> 
                            </table>
                           
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>Full Name</th>
                                        <th>Profession</th>
                                        <th>Upazilla/Thana</th>
                                        <th>Union</th>
                                        <th>Village</th>
                                        <th>Mobile No</th>
                                        <th>F/L ID</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="freelancer_profile.html">View Profile</a>
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospecting.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td>3 Dec, 2023</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>FL-154</td> 
                                    </tr>

                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="freelancer_profile.html">View Profile</a>
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospectings_create.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>2</td>
                                        <td>12 Nov, 2023</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>FL-154</td> 
                                    </tr>

                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="freelancer_profile.html">View Profile</a>
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospectings_create.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>3</td>
                                        <td>7 Sep, 2023</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>FL-154</td> 
                                    </tr>

                                    <tr>
                                        <td class="text-center"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="d-block" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="freelancer_profile.html">View Profile</a>
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                    <a class="dropdown-item" href="prospectings_create.html">Prospecting</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>4</td>
                                        <td>9 Aug, 2023</td>
                                        <td>Md Enamul Haque</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>FL-154</td> 
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

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="status" class="form-label">Status </label>
                    <select class="select2" name="status" id="status"> 
                        <option value="">Running </option> 
                        <option value="">Complete </option> 
                    </select>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="employee" class="form-label">Employee </label>
                    <select class="select2" search name="employee" id="employee">
                        <option value="">All</option>
                        <option value="1">John Doe #231</option>
                        <option value="2">Jane Smith #232</option>
                        <option value="3">Michael Johnson #233</option>
                        <option value="4">Emily Davis #234</option>
                        <option value="5">David Brown #235</option>
                        <option value="6">Sophia Wilson #236</option>
                        <option value="7">Christopher Lee #237</option>
                        <option value="8">Olivia Martin #238</option>
                        <option value="9">Matthew Taylor #239</option>
                        <option value="10">Emma Anderson #240</option>
                        
                    </select>  
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="profession" class="form-label">Join Date </label>
                    <input class="form-control" type="text" id="daterangepicker" />   
                </div>
            </div> 
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="division" class="form-label">Division </label>
                    <select class="select2" name="division" id="division" >
                        <option value="">All</option>
                        <option value="1">Dhaka</option>
                        <option value="2">Chittagong</option>
                        <option value="3">Khulna</option>
                        <option value="4">Rajshahi</option>
                        <option value="5">Barisal</option>
                        <option value="6">Sylhet</option>
                        <option value="7">Rangpur</option>
                        <option value="8">Mymensingh</option>
                        <option value="9">Jessore</option>
                        <option value="10">Comilla</option> 
                    </select>  
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="district" class="form-label">District </label>
                    <select class="select2" name="district" id="district" >
                        <option value="">All</option>
                        <option value="1">Dhaka</option>
                        <option value="2">Chittagong</option>
                        <option value="3">Khulna</option>
                        <option value="4">Rajshahi</option>
                        <option value="5">Barisal</option>
                        <option value="6">Sylhet</option>
                        <option value="7">Rangpur</option>
                        <option value="8">Mymensingh</option>
                        <option value="9">Jessore</option>
                        <option value="10">Comilla</option> 
                    </select>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="upazila" class="form-label">Thana/Upazila </label>
                    <select class="select2" name="upazila" id="upazila">
                        <option value="">All</option>
                        <option value="">Dhaka </option>
                        <option value="">Chittagong </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Khulna </option> 
                        <option value="">Barishal </option> 
                        <option value="">Sylhet</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Mymensingh</option>  
                    </select>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="union" class="form-label">Union </label>
                    <select class="select2" name="union" id="union">
                        <option value="">All</option>
                        <option value="">Dhaka </option>
                        <option value="">Chittagong </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Khulna </option> 
                        <option value="">Barishal </option> 
                        <option value="">Sylhet</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Mymensingh</option>  
                    </select>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="village" class="form-label">Village</label>
                    <select class="select2" name="village" id="village">
                        <option value="">Select Village</option>
                        <option value="">Dhaka </option>
                        <option value="">Chittagong </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Khulna </option> 
                        <option value="">Barishal </option> 
                        <option value="">Sylhet</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Mymensingh</option>  
                    </select>  
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="profession" class="form-label">Profession </label>
                    <select class="select2" name="profession" id="profession">
                        <option value="">Select Profession</option>
                        <option value="">Doctors</option>
                        <option value="">Lawyers</option> 
                        <option value="">Banker</option>
                        <option value="">Teacher</option>
                        <option value="">Engineer</option>
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

@section('script')
    <script>
        getDateRange('daterangepicker');
    </script>
@endsection