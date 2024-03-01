@extends('layouts.dashboard')
@section('title','Prospecting Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Leads</h4> 
                        <p class="d-none">Employee: {{auth()->user()->name}}</p> 
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="a3">
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
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Profession</th>
                                        <th>Upazilla/Thana</th>
                                        <th>Union</th>
                                        <th>Village</th>
                                        <th>Maritial</th>
                                        <th>CC Call</th>
                                        <th>Project</th>
                                        <th>Unit</th>
                                        <th>Capacity</th>
                                        <th>PP Date</th>
                                        <th>Mobile</th>
                                        <th>Freelancer</th> 
                                    </tr>
                                </thead>
                               
                                <tbody> 
                                    @foreach ($leads as  $lead)
                                    <tr class="{{$lead->approve_by==null?"table-warning":""}}">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="{{@$lead->customer->user->image()}}">
                                                </a> 
                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    @if ($lead->approve_by==null)
                                                        @can('lead-manage')
                                                            <a class="dropdown-item" href="{{route('lead.edit',$lead->id)}}">Edit</a>
                                                        @endcan 
                                                    @endif 

                                                    @can('lead-delete')
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('lead.delete',$lead->id) }}')">Delete</a>  
                                                    @endcan
                                                    
                                                    @if ($lead->approve_by!=null)
                                                        @can('lead-analysis')
                                                            <a class="dropdown-item" href="{{route('lead-analysis.create',['customer'=> $lead->customer->id])}}">Lead Analysis Form</a>
                                                        @endcan 
                                                    @endif  
                                                    <a class="dropdown-item" href="{{route('customer.details', encrypt($lead->customer_id))}}">Print Customer</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td class="">{{ $loop->iteration }}</td>
                                        <td class="">{{ get_date($lead->created_at) }}</td>
                                        <td class="">{{ @$lead->customer->name }} {{ @$lead->customer->customer_id }}</td>
                                        <td class="">{{ @$lead->customer->profession->name }}</td>
                                        <td class="">{{ @$lead->customer->user->userAddress->upazila->name }}</td>
                                        <td class="">{{ @$lead->customer->user->userAddress->union->name }}</td>
                                        <td class="">{{ @$lead->customer->user->userAddress->village->name }}</td>
                                        <td class="">{{ @$lead->customer->user->marital_status }}</td>

                                        @php
                                            $cold_calling = \App\Models\ColdCalling::where('customer_id',$lead->customer_id)->first(); 
                                            $last_cold_calling = $cold_calling->updated_at?? $cold_calling->created_at;
                                        @endphp

                                        <td class="">{{ get_date($last_cold_calling) }}</td>
                                        <td class="">{{ @$lead->project->name }}</td>
                                        <td class="">{{ @$lead->unit->title }}</td>
                                        <td class="text-primary">
                                           @if ($lead->purchase_capacity ==1)
                                               High
                                           @elseif($lead->purchase_capacity ==2)
                                               Regular
                                            @else
                                                Low
                                           @endif
                                        </td>
                                        <td class="">{{ @$lead->possible_purchase_date }}</td>
                                        <td class="">{{ @$lead->customer->user->phone }}</td>
                                        <td class="">{{ @$lead->customer->reference->name ?? '-' }} [{{ @$lead->customer->reference->user_id }}]</td>
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

<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter Leads</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row"> 
 
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="freelancer" class="form-label">Freelancer</label>
                    <select id="freelancer" class="select2" name="freelancer" search>
                        <option value="">All Freelancer</option> 
                        <option value="">Md Enamul Haque </option> 
                        <option value="">Jamil Hosain #FL1545 01796351081</option> 
                        <option value="">Md Mehedi Hasan #FL1545 01796351081</option> 
                        <option value="">Suvo Hasan #FL1545 01796351081</option>  
                    </select>
                    
                </div>
            </div> 
 

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="join_date" class="form-label">Join Date </label>
                    <input class="form-control" id="join_date" name="join_date" default="All" type="text" value="" />   
                </div>
            </div>  

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="last_cold_calling" class="form-label">Last Cold Calling </label>
                    <input class="form-control" name="last_cold_calling" id="last_cold_calling" type="text" value="" />   
                </div>
            </div> 

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="possible_purchase_date" class="form-label">Possible Purchase Date</label>
                    <input class="form-control daterangepicker-4" name="possible_purchase_date" id="possible_purchase_date" type="text" value="" />   
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

            <div class="col-md-12">
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
@endsection 

@section('script') 
@include('includes.data_table')
    <script>
        getDateRange('join_date');
        getDateRange('last_cold_calling');
        getDateRange('possible_purchase_date');
        getDateRange('last_lead_date');
        getDateRange('presentation_date')
    </script>
@endsection