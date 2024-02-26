@extends('layouts.dashboard')
@section('title','Presentation Analysis')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Visit Analysis</h4> 
                        <p class="d-none">Employee: {{auth()->user()->name}}</p> 
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="a4">
                        <input type="hidden" id="fontSize" value="8">
                        <div class="page-title-right">
                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                <span><i class="fas fa-filter"></i> Filter</span>
                            </button> 
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>Project Name</th>
                                        <th>Negotiation Person</th>
                                        <th>Phone</th>
                                        <th>Total Visitor</th> 
                                    </tr>
                                </thead>
                                <tbody>                                     
                                    @foreach ($visits as  $visit)
                                    <tr class="{{$visit->approve_by==null?"table-warning":""}}">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="{{@$visit->customer->user->image()}}">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('customer.profile',encrypt($visit->customer_id))}}">Customer Profile</a> 
                                                    <a class="dropdown-item cursor-pointer" data-bs-toggle="modal" data-bs-target="#view_visitor">View Details</a>
                                                   
                                                    @if ($visit->approve_by==null)
                                                        @can('visit-analysis-manage')
                                                                <a class="dropdown-item" href="{{route('presentation_analysis.edit',$visit->id)}}">Edit</a>
                                                            @endcan
                                                    @endif 
                                                    
                                                    @can('visit-analysis-delete')
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('visit.delete',$visit->id) }}')">Delete</a> 
                                                    @endcan
                                                    
                                                    @if ($visit->approve_by!=null)
                                                        @can('follow-up-manage')
                                                            <a class="dropdown-item" href="{{route('followup.create',['customer' => $visit->customer_id])}}">Follow Up</a>
                                                        @endcan 
                                                    @endif 
                                                </div>
                                            </div> 
                                        </td> 
                                        <td class="">{{ $loop->iteration}}</td>
                                        <td class="">{{ get_date($visit->created_at) }}</td>
                                        <td class="">
                                            @php
                                                $projects = json_decode($visit->projects);
                                            @endphp
                                            @foreach($projects as $key => $project)
                                            @if ($key!=0)
                                                ,
                                            @endif
                                            {{ $project }}
                                            @endforeach
                                        </td>
                                        <td class="">{{ @$visit->customer->user->name }}</td>
                                        <td class=""> {{ @$visit->customer->user->phone }}</td>
                                        <td class=""><span class="badge badge-label-success"> 
                                            @php
                                                $visitors = json_decode($visit->visitors);
                                                $totalVisitors = count($visitors);
                                            @endphp
                                           {{ $totalVisitors }}    
                                        
                                        </span></td> 
                                    </tr>
                                    
                                    @endforeach
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
                    <label for="join_date" class="form-label">Join Date </label>
                    <input class="form-control" id="join_date" name="join_date" default="All" type="text" value="" />   
                </div>
            </div>  


            <div class="col-md-6">
                <div class="mb-3">
                    <label for="last_cold_calling" class="form-label">Visit Date </label>
                    <input class="form-control" name="last_cold_calling" id="last_cold_calling" type="text" value="" />   
                </div>
            </div> 
 
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


@section('script')
    @include('includes.data_table')
@endsection
 