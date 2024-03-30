@extends('layouts.dashboard')
@section('title',"Summary of Sales Commision")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-sm-0">Summary of Sales Commission (For Executive, ASM, AL, ZM, RM, HOS & ED)</h4> 
                            <p class="d-none">{{get_date($selected, 'M - Y')}}</p>
                        </div>

                        <div class="page-title-right">
                            <div class="btn-group flex-wrap mb-2">     
                                <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                    <span><i class="fas fa-filter"></i> Filter</span>
                                </button> 
                            </div>
                        </div>

                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable-buttons" class="table table-hover table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class=""> 
                                        <th>Name of Staffs</th>
                                        <th>Des.</th>
                                        @foreach ($projects as $project)
                                            <th>{{$project->name}}</th>
                                        @endforeach  
                                        <th>Total Achived Comission</th>
                                        <th>Applicable Commission </th>
                                        <th>GTBI RC Deduction 
                                            <a href="{{route('commission-deducted-setting.index')}}"> <i class="fas fa-cog"></i> Update</a>
                                        </th>
                                        <th>GTBIRC Deducation</th>
                                        <th>Instant Paid Commision</th>
                                        <th>Payble Commision</th>
                                        <th>Achivement</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($employees as $employee)
                                        <tr class="">
                                            <td style="white-space: nowrap;">
                                                <a href="{{route('mst.commission.details',1)}}">{{$employee->name}} [{{$employee->user_id}}]</a>
                                            </td>
                                            <td>Manager</td> 
                                            
                                            @foreach ($projects as $project)  
                                                @php
                                                    $cloneCommission = clone $commission;
                                                    $project_commission =  $commission->where('project_id',$project->id)->where('user_id',$employee->id)->sum('amount');
                                                @endphp
                                                <td>{{get_price($project_commission)}}</td> 
                                            @endforeach 

                                            @php
                                                $cloneCommission = clone $commission;
                                                $total_commission =  $cloneCommission->where('user_id',$employee->id)->sum('amount');
                                            @endphp
                                            <td>{{get_price($total_commission)}}</td>
                                            <td>৳54321</td>
                                            <td>8%</td>
                                            <td>৳432</td>
                                            <td>৳100</td>
                                            <td>৳332</td>
                                            <td>75%</td> 
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
        <h5 class="offcanvas-title">Filter Report</h5>
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
  
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="profession" class="form-label">Position</label>
                    <select class="select2" multiple name="profession" id="profession"> 
                        <option value="">Freelancer</option>
                        <option value="">Co Ordinator</option> 
                        <option value="">Ordinator</option>
                        <option value="">Salse Executive</option>
                        <option value="">Marketing Executive</option>
                    </select>  
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
 
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        var title = $('.page-title-box').find('h4').text();
        var Period = $('.page-title-box').find('p').text();;
    </script>
    @include('includes.data_table')

    <script>
        getDateRange('duration')
    </script>
@endsection