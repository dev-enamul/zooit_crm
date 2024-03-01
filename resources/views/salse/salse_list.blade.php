@extends('layouts.dashboard')
@section('title','Sales List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sales</h4> 
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
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>CUS ID</th>
                                        <th>Cus. Name</th>
                                        <th>Cus. Mobile Number</th> 
                                        <th>Project Name</th>
                                        <th>Unit Name</th> 
                                        <th>Unit Qty</th> 
                                        <th>Unit Facility</th> 
                                        <th>Type No</th> 
                                        <th>Floor No</th> 
                                        <th>Unit No</th> 
                                        <th>Lottery</th>
                                        <th>Regular Price</th>
                                        <th>Sold Price</th>
                                        <th>Discount Amount</th>
                                        <th>Installment Qty.</th>
                                        <th>Collection Amount</th>
                                        <th>DUE Amount</th>
                                        <th>FL Name & ID</th> 
                                        <th>Deed Status</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                        <tr class="{{$data->approve_by==null?"table-warning":""}}">
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img class="rounded avatar-2xs p-0" src="{{@$data->customer->user->image()}}">
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="customer_profile.html">Customer Profile</a>
                                                        <a class="dropdown-item" href="{{route('salse.details',encrypt($data->id))}}">Salse Details</a>  
                                                    </div>
                                                </div> 
                                            </td>
                                            <td>{{$key+1}}</td>
                                            <td>{{get_date($data->created_at)}}</td>
                                            <td>{{@$data->customer->customer_id}}</td>
                                            <td>{{@$data->customer->name}}</td>
                                            <td>{{@$data->customer->user->phone}}</td>
                                            <td>{{$data->project->name}}</td>
                                            <td>{{$data->unit->title}}</td>
                                            <td>{{$data->unit_qty}}</td>
                                            <td>{{$facilityText = App\Enums\UnitFacility::values()[$data->facility] ?? 'Unknown';}}</td>
                                            @php
                                                if($data->select_type==1){ 
                                                    $project_unti = json_decode($data->project_units);
                                                    $unit_type = "";
                                                    $floor_no = "";
                                                    $unit_no = "";
                                                    foreach ($project_unti as $key => $value) {
                                                        $unit = App\Models\ProjectUnit::find($value); 
                                                        if(isset($unit) && $unit!=null){
                                                            if($key!=0){
                                                                $unit_type .= ', ';
                                                                $floor_no .= ', ';
                                                                $unit_no .= ', ';  
                                                            }
                                                            $unit_type .= $unit->unitCategory->title;
                                                            $floor_no .= $unit->floor;
                                                            $unit_no .= $unit->name;
                                                        }
                                                    }
                                                }else{
                                                    $unit_type = "-";
                                                    $floor_no = "-";
                                                    $unit_no = "-";
                                                }
                                            @endphp 
                                            <td>{{$unit_type}}</td>
                                            <td>{{$floor_no}}</td>
                                            <td>{{$unit_no}}</td>
                                            <td>{{$data->select_type==1?"onChoice":"Lottery"}}</td>
                                            <td>{{get_price($data->regular_amount)}}</td>
                                            <td>{{get_price($data->sold_value)}}</td>
                                            <td>{{get_price($data->regular_amount-$data->sold_value)}}</td>
                                            <td>{{$data->total_installment}}</td>
                                            <td>{{$data->total_installment}}</td>
                                            <td>{{get_price($data->total_deposit)}}</td>
                                            <td>{{$data->customer->reference->name}} [{{$data->customer->reference->user_id}}]</td>
                                            <td>{{$data->approve_by!=null?"Complete":"Pending"}}</td>
                                        </tr>
                                    @endforeach 
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

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="project" class="form-label">Project</label>
                    <select class="select2" name="project" id="project">
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
@endsection