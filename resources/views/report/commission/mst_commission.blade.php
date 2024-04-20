@extends('layouts.dashboard')
@section('title',"Summary of Sales Commision")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Summary of Sales Commission Employee</h4> 
                        <p class="d-none">{{get_date($selected, 'M - Y')}}</p>
                        {{-- <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">  --}}
                        <input type="hidden" id="pageSize" value="legal">
                        <input type="hidden" id="fontSize" value="8">

                        <div class="page-title-right">
                            <form action="" method="get" action="">
                                <div class="input-group">  
                                    <input class="form-control" name="month" value="{{$selected}}"  type="month" value="" /> 
                                    <button class="btn btn-secondary" type="submit">
                                        <span><i class="fas fa-filter"></i> Filter</span>
                                    </button> 
                                </div>
                            </form> 
                        </div>

                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                                <a href="{{route('mst.commission.details',[encrypt($employee->id),$selected])}}">{{$employee->name}} [{{$employee->user_id}}]</a>
                                            </td>
                                            <td>Manager</td> 
                                            
                                            @foreach ($projects as $project)  
                                                @php 
                                                    // $new_commission = clone $commission;
                                                    $project_commission =  $commission->where('project_id',$project->id)->where('user_id',$employee->id)->sum('amount');
                                                @endphp
                                                <td>{{get_price($project_commission)}}</td> 
                                            @endforeach  

                                            <td>{{get_price($employee->total_commission)}}</td>
                                            <td>{{get_price($employee->applicable_commission)}}</td> 
                                            
                                            @php 
                                                $applicable_commission = $employee->applicable_commission;
                                                $gtbi_rc = $gtbi_deduction->where('start_amount','<=',$applicable_commission)
                                                ->where('end_amount','>=',$applicable_commission)->first(); 
                                                $deducted_percent = $gtbi_rc->deducted??0; 
                                            @endphp
                                            <td>{{$deducted_percent}}%</td>
                                            <td>{{$applicable_commission-$employee->payble_commission}}</td>
                                            <td>{{get_price(0)}}</td>
                                            <td>{{get_price($employee->payble_commission)}}</td>
                                            <td>{{get_price($employee?->assignTo?->deposit_achive($selected)??0)}}</td> 
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
 
@endsection

@section('script') 
    @include('includes.data_table')
@endsection