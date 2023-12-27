@extends('layouts.dashboard')
@section('title','Cold Calling List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Cold-Calling List</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Cold-Calling List</li>
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
                                        <th>Last Prospecting</th>
                                        <th>Project</th>
                                        <th>Unit</th>
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
                                                    <a class="dropdown-item" href="lead_create.html">Lead</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td>Enamul</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <th>11,Dec-2023</th>
                                        <th>Rana Plaza</th>
                                        <th>D-3</th>
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
                                                    <a class="dropdown-item" href="lead_create.html">Lead</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>1</td>
                                        <td>Enamul</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <th>11,Dec-2023</th>
                                        <th>Rana Plaza</th>
                                        <th>D-3</th>
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
                                                    <a class="dropdown-item" href="lead_create.html">Lead</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>2</td>
                                        <td>Enamul</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <th>11,Dec-2023</th>
                                        <th>Rana Plaza</th>
                                        <th>D-3</th>
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
                                                    <a class="dropdown-item" href="lead_create.html">Lead</a>
                                                </div>
                                            </div> 
                                        </td>
                                        <td>3</td>
                                        <td>Enamul</td>
                                        <td>Engineer</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <th>11,Dec-2023</th>
                                        <th>Rana Plaza</th>
                                        <th>D-3</th>
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
    @include('includes.footer')
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
                    <label for="freelancer" class="form-label">Freelancer</label>
                    <select class="select2" search id="freelancer" name="freelancer" required>
                        <option value="">Select Freelancer</option> 
                        <option value="">Enamul #FL1545 01796351081</option> 
                        <option value="">Jamil Hosain #FL1545 01796351081</option> 
                        <option value="">Md Mehedi Hasan #FL1545 01796351081</option> 
                        <option value="">Suvo Hasan #FL1545 01796351081</option>  
                    </select> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer name <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Customer name" >
                </div>
            </div>  
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
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
            <div class="text-center">
                <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
            </div> 
        </div>
    </div>
</div>
@endsection