@extends('layouts.dashboard')
@section('title',"Deposit Report for ASM and DSM")
@section('content') 
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center">
                        <h4 class="mb-sm-0">Way Housing Pvt. Ltd</h4> 
                        <p class="m-0">Project Unit and Sales Executive Wise Deposit Report</p>
                        <p><strong>Period: </strong>1st, December-2023 to 30th, December-2023</p>
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
                           <div class="table-box" style="overflow-x: scroll;">
                            <table class="table table-hover align-middle text-center table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle"> 
                                        <th>SL.</th>
                                        <th>CUS ID</th>
                                        <th>Customer Name</th>
                                        <th>Booking Date</th>
                                        <th>Project Name</th>
                                        <th>Unit Name</th>
                                        <th>Unit Qty</th>
                                        <th>Deposit Type</th>
                                        @foreach ($designations as $designation)
                                            <th>{{$designation->title}}</th>
                                        @endforeach 
                                    
                                        <th>Declaration Price</th>
                                        <th>Discount Amount</th>
                                        <th>Sales Value </th>
                                        <th>Deposit Amount</th>
                                        <th>Total Deposit Amount</th>
                                        <th>Total Due Amount</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                        <tr class=""> 
                                            <td>{{$key +1}}</td>
                                            <td>{{@$data->customer->customer_id}}</td>
                                            <td>{{@$data->customer->name}}</td>
                                            <td>{{get_date(@$data->salse->created_at)}}</td>
                                            <td>{{$data->salse->project->name??'-'}}</td>
                                            <td>{{$data->salse->unit->title??'-'}}</td>
                                            <td>
                                                @if (isset($data->salse) && isset($data->salse->project_units) && count($data->salse->project_units) > 0)
                                                    {{ count($data->salse->project_units) }}
                                                @endif
                                            </td> 
                                            <td>{{$data->depositCategory->name??'Regular'}}</td>
                                            @foreach ($designations as $designation)   
                                                @php 
                                                    $employee = $data->commissions->where('designation_id', $designation->id);
                                                    if ($employee->isNotEmpty()) { 
                                                        $employee = $employee->first()->user->name;
                                                    } else {
                                                        $employee = '-';
                                                    }
                                                @endphp
                                                <th>{{$employee}}</th>
                                            @endforeach  
                                            <td>{{get_price(@$data->salse->regular_amount)}}</td>
                                            <td>{{get_price(@$data->salse->regular_amount-@$data->salse->sold_value)}}</td>
                                            <td>{{get_price(@$data->salse->sold_value)}}</td>
                                            <td>{{get_price($data->amount)}}</td>
                                            <td>{{get_price(@$data->salse->total_deposit)}}</td>
                                            <td>{{get_price(@$data->salse->sold_value-@$data->salse->total_deposit)}}</td>  
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
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row">   
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration </label>
                    <input class="form-control" id="duration" name="duration" default="This Month" type="text" value="" />   
                </div>
            </div> 

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="zone" class="form-label">Zone </label>
                    <select class="select2" name="zone" id="zone" >
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
                    <label for="area" class="form-label">Area </label>
                    <select class="select2" name="area" id="area" >
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
                    <label for="project" class="form-label">Project </label>
                    <select class="select2" name="project" id="project" >
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
                    <label for="unit" class="form-label">Unit </label>
                    <select class="select2" name="unit" id="unit" >
                        <option value="">All</option>
                        <option value="1">Shop</option>
                        <option value="2">Flat</option> 
                    </select>  
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="employee_hierachy" class="form-label">Employee Hierachy</label>
                    <select class="select2" name="employee_hierachy" id="employee_hierachy" > 
                        <option value="1">Marketing Executive</option>
                        <option value="2">Salse Executive</option>
                        <option value="3">ASM</option>
                        <option value="4">DSM</option> 
                    </select>  
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
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div>
@endsection

 

@section('script')
    <script>
        getDateRange('duration')
    </script>
@endsection