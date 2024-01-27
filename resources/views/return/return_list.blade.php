@extends('layouts.dashboard')
@section('title','Project Return List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Project Return List</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Project Return List</li>
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
                                            <span><i class="fas fa-file-pdf"></i> PDF</span>
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

                           <div class="table-box" style="overflow-x: scroll;">
                            <table class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Customer Name</th>
                                        <th>Project Name</th>
                                        <th>Unit Name</th>
                                        <th>Unit Qty</th>
                                        <th>Booking Date</th>
                                        <th>Sold Price</th> 
                                        <th>Total Deposit</th>
                                        <th>Total Due</th>
                                        <th>Return Date</th>
                                        <th>Approve Date</th>
                                        <th>Deduction</th>
                                        <th>Approved Amount</th>
                                        <th>New Customer</th>
                                        <th>Freelancer</th>
                                        <th>Reporting Person</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="customer_profile.html">Customer Profile</a> 
                                                    <a class="dropdown-item cursor-pointer" data-bs-toggle="modal" data-bs-target="#view_visitor">View Details</a>
                                                    <a class="dropdown-item" href="follow_up_create.html">Follow Up</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>Project A</td>
                                        <td>Unit 101</td>
                                        <td>1</td>
                                        <td>2023-04-01</td>
                                        <td>900,000</td>
                                        <td>200,000</td>
                                        <td>150,000</td>
                                        <td>2023-04-15</td>
                                        <td>2023-04-20</td>
                                        <td>5,000</td>
                                        <td>145,000</td>
                                        <td>No</td>
                                        <td>Yes</td>
                                        <td>Reporter 001 - Alice</td>
                                        <td>Good Customer</td>
                                    </tr> 
                                </tbody>
                            </table>
                           </div> 
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
 
    @include('includes.footer')
</div>

{{-- Modal ============= --}}
<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter Leads</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row">  
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="profession" class="form-label">Profession</label>
                    <select class="select2" name="profession" id="profession">
                        <option value="">All Profession</option>
                        <option value="">Doctors</option>
                        <option value="">Lawyers</option> 
                        <option value="">Banker</option>
                        <option value="">Teacher</option>
                        <option value="">Engineer</option>
                    </select> 
                   
                </div>
            </div> 

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="project" class="form-label">Project</label>
                    <select class="select2" search name="project" id="project">
                        <option value="">All Project</option>
                        <option value="">Cidy Plaza</option>
                        <option value="">Metro Housing</option> 
                        <option value="">Rana House</option> 
                    </select>  
                </div>
            </div> 

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="upazila" class="form-label">Thana/Upazila </label>
                    <select class="select2" name="upazila" id="upazila" required>
                        <option value="">All Thana/Upazila</option>
                        <option value="">Dhaka </option>
                        <option value="">Chittagong </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Khulna </option> 
                        <option value="">Barishal </option> 
                        <option value="">Sylhet</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Mymensingh</option>  
                    </select> 
                    <div class="invalid-feedback">
                        This field is required.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="union" class="form-label">Union </label>
                    <select class="select2" name="union" id="union" required>
                        <option value="">All Union</option>
                        <option value="">Dhaka </option>
                        <option value="">Chittagong </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Khulna </option> 
                        <option value="">Barishal </option> 
                        <option value="">Sylhet</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Mymensingh</option>  
                    </select> 
                    <div class="invalid-feedback">
                        This field is required.
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="village" class="form-label">Village</label>
                    <select class="select2" name="village" id="village">
                        <option value="">All Village</option>
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
                    <label for="maritial_status" class="form-label">Marital status</label>
                    <select class="select2" name="maritial_status" id="maritial_status">
                        <option value="">All Marital</option>
                        <option value="">Married</option>
                        <option value="">Unmarried</option> 
                        <option value="">Devorce</option> 
                    </select>  
                </div>
            </div>  
 
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div>


<!-- view details table  -->
<div class="modal fade" id="view_visitor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center flex-column"> 
                <h3>Way Housing Pvt. Ltd</h3>
                <p class="m-0"><small>House 37, Level 02, Khan ABC Tradeplex, Dhanmondi 02, Dhaka- 1205</small></p>
                <p class="m-0"><strong>Attendane Sheet (Project Visit Purpose)</strong></p> 
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <tbody> 
                        <tr> 
                            <td class="p-1"><strong>Name & ID : </strong> Enamul Haque #EM-5242</td>
                            <td class="p-1"><strong>Project Name : </strong>Metro Plaza</td> 
                        </tr> 

                        <tr> 
                            <td class="p-1"><strong> Designation : </strong> Sales Executive</td>
                            <td class="p-1"><strong>Project Visit Date : </strong>4 Dec, 2023</td> 
                        </tr> 
                    </tbody>
                </table>
                <table class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr> 
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>CUS ID</th>
                            <th>FL ID</th>
                            <th>EMP ID</th> 
                            <th>Negotiation Person</th> 
                            <th>Mobile No</th> 
                        </tr>
                    </thead>
                    <tbody> 
                        <tr> 
                            <td>1</td>
                            <td><a>Enamul Haque</a></td>
                            <td>01796351081</td>
                            <td>-</td>
                            <td>#536</td>
                            <td>-</td> 
                            <td>Jahid hasan</td> 
                            <td>01796351081</td>
                        </tr> 

                        <tr> 
                            <td>1</td>
                            <td><a>Enamul Haque</a></td>
                            <td>01796351081</td>
                            <td>-</td>
                            <td>-</td>
                            <td>#536</td> 
                            <td>Jahid hasan</td> 
                            <td>01796351081</td> 
                        </tr> 

                        <tr> 
                            <td>1</td>
                            <td><a>Enamul Haque</a></td>
                            <td>01796351081</td>
                            <td>#536</td>
                            <td>-</td>
                            <td>-</td> 
                            <td>Jahid hasan</td> 
                            <td>01796351081</td>
                        </tr> 

                        <tr> 
                            <td>1</td>
                            <td><a>Enamul Haque</a></td>
                            <td>01796351081</td>
                            <td>-</td>
                            <td>#536</td>
                            <td>-</td> 
                            <td>Jahid hasan</td> 
                            <td>01796351081</td>    
                        </tr> 
                    </tbody>
                </table>
            </div>
            </div>
    </div>
</div>

@endsection 
 