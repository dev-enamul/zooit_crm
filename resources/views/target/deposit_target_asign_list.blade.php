@extends('layouts.dashboard')
@section('title','Deposit Target') 
@section('content') 

{{-- Date by Filter  --}}
@php
    if(isset($selected) && $selected != ''){ 
        $month = date('m',strtotime($selected));
        $year = date('Y',strtotime($selected)); 
    }else{
        $month = date('m');
        $year = date('Y');
    } 
    
@endphp
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Deposit Target</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposit Target</li>
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
                                    {{-- <div class="dt-buttons btn-group flex-wrap mb-2">     
                                        <button class="btn btn-primary ms-1" data-bs-toggle="modal" data-bs-target="#modal6"> <i class="mdi mdi-chart-box-outline"></i> View Chart</button> 
                                    </div> --}}
                                </div>
                                <div class="">   
                                    <form action="" method="get" action="">
                                        <div class="input-group">  
                                            <input class="form-control" type="month" name="month" value="{{$selected != ''?$selected:now()->format('Y-m') }}"/>   
                                            <button class="btn btn-secondary" type="submit">
                                                <span><i class="fas fa-filter"></i> Filter</span>
                                            </button> 
                                        </div>
                                    </form>
                                </div>
                           </div>

                            <table class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle">  
                                        <th rowspan="2">S/N</th>
                                        <th rowspan="2">Project</th> 
                                        <th rowspan="2">Unit & Amount</th>
                                        @foreach ($employees as $employee) 
                                            <th colspan="2">{{$employee->name}} ({{$employee->user_id}})</th>
                                        @endforeach 
                                        <th colspan="2">Total</th> 
                                    </tr> 
                                    
                                    <tr> 
                                        @foreach ($employees as $employee) 
                                            <th>Unit</th>
                                            <th>Deposit</th>
                                        @endforeach
                                        <th>Unit</th>
                                        <th>Deposit</th> 
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($projects) && $projects->isNotEmpty())  
                                        @foreach ($projects as $project) 
                                            <tr> 
                                                 
                                                <td  rowspan="2">1</td>
                                                <td  rowspan="2">{{$project->name}}</td>
                                                <td class="align-middle">Existing</td>

                                                @php
                                                    $total_existing_unit = 0;
                                                    $total_existing_deposit = 0;
                                                @endphp  
                                                    @foreach ($employees as $employee)
                                                    @php  
                                                        $deposit_target = App\Models\DepositTarget::where('assign_to',$employee->id)
                                                            ->where('assign_by',auth()->user()->id)
                                                            ->whereMonth('created_at',$month)
                                                            ->whereYear('created_at',$year)
                                                            ->where('is_project_wise',1)
                                                            ->first();

                                                        if($deposit_target) {
                                                            $target_project = App\Models\DepositTargetProject::where('project_id',$project->id)
                                                                ->where('deposit_target_id',$deposit_target->id)
                                                                ->first();   
                                                            if($target_project) {
                                                                $total_existing_unit += $target_project->existing_unit; 
                                                                $total_existing_deposit += $target_project->existing_deposit; 
                                                                echo '<td class="align-middle">'.$target_project->existing_unit.'</td>'; 
                                                                echo '<td class="align-middle">'.get_price($target_project->existing_deposit).'</td>';
                                                            } else { 
                                                                echo '<td class="align-middle">-</td>';
                                                                echo '<td class="align-middle">-</td>';
                                                            }
                                                        } else { 
                                                            echo '<td class="align-middle">-</td>';
                                                            echo '<td class="align-middle">-</td>';
                                                        }
                                                    @endphp 
                                                    @endforeach 

                                                <td class="align-middle">{{$total_existing_unit}}</td> 
                                                <td class="align-middle">{{get_price($total_existing_deposit)}}</td>  
                                            </tr>  
                                            <tr>   
                                                <td class="align-middle">New Sales</td> 
                                                
                                                @php
                                                    $total_new_unit = 0;
                                                    $total_new_deposit = 0;
                                                @endphp 

                                                @foreach ($employees as $employee)
                                                @php
                                                    $deposit_target = App\Models\DepositTarget::where('assign_to', $employee->id)
                                                        ->where('assign_by', auth()->user()->id)
                                                        ->whereMonth('created_at', $month)
                                                        ->whereYear('created_at', $year)
                                                        ->where('is_project_wise', 1)
                                                        ->first();

                                                    $target_project = null;
                                                    $new_unit = 0;
                                                    $new_deposit = 0;

                                                    if ($deposit_target) {
                                                        $target_project = App\Models\DepositTargetProject::where('project_id', $project->id)
                                                            ->where('deposit_target_id', $deposit_target->id)
                                                            ->first();

                                                        if ($target_project) {
                                                            $new_unit = $target_project->new_unit;
                                                            $new_deposit = $target_project->new_deposit;
                                                            $total_new_unit += $new_unit;
                                                            $total_new_deposit += $new_deposit;
                                                        }
                                                    }
                                                @endphp 

                                                <td class="align-middle">{{ $target_project ? $new_unit : '-' }}</td> 
                                                <td class="align-middle">{{ $target_project ? get_price($new_deposit) : '-' }}</td>
                                                @endforeach  
                                                <td class="align-middle">{{$total_new_unit}}</td> 
                                                <td class="align-middle">{{get_price($total_new_deposit)}}</td>  
 
                                            </tr> 
                                        @endforeach  
                                        <tr>
                                            <td colspan="3" class="text-end">Total</td> 
                                            @php 
                                                $total_unit = 0;
                                                $total_deposit = 0;
                                            @endphp 
                                            @foreach ($employees as $employee) 
                                                @php 
                                                    $employee_total_unit = 0;
                                                    $employee_total_deposit = 0;
                                                    $deposit_target = App\Models\DepositTarget::where('assign_to',$employee->id)
                                                    ->where('assign_by',auth()->user()->id)
                                                    ->whereMonth('created_at',$month)
                                                    ->whereYear('created_at',$year) 
                                                    ->first();
                                                    if (isset($deposit_target)) {
                                                        if($deposit_target->is_project_wise==1){  
                                                            if(isset($deposit_target->depositTargetProjects) && $deposit_target->depositTargetProjects->isNotEmpty()){
                                                                $deposit_target = $deposit_target->depositTargetProjects;
                                                                $employee_total_unit = $deposit_target->sum('new_unit') + $deposit_target->sum('existing_unit');
                                                                $employee_total_deposit = $deposit_target->sum('new_deposit') + $deposit_target->sum('existing_deposit');
                                                                $total_unit += $employee_total_unit;
                                                                $total_deposit += $employee_total_deposit;
                                                            }
                                                        }else{  
                                                            $employee_total_unit = $deposit_target->new_total_unit + $deposit_target->existing_total_unit;
                                                            $employee_total_deposit = $deposit_target->new_total_deposit + $deposit_target->existing_total_deposit;
                                                            $total_unit += $employee_total_unit;
                                                            $total_deposit += $employee_total_deposit;
                                                        }
                                                    } 
                                                @endphp  
                                                
                                                <td class="align-middle">{{$employee_total_unit}}</td> 
                                                <td class="align-middle">{{get_price($employee_total_deposit)}}</td>
                                            @endforeach
                                            <td class="align-middle">{{$total_unit}}</td> 
                                            <td class="align-middle">{{get_price($total_deposit)}}</td>
                                        </tr> 
                                    @else   
                                        <tr>
                                            <td colspan="9" class="text-center">Project not found</td>
                                        </tr>
                                    @endif
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

<div class="modal fade" id="modal6">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Achivement <span class="text-info">[1 May-2023 - 30 May, 2023]</span></h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>
            <div class="modal-body">
                <div id="abc"
                    data-colors='["--bs-primary", "--bs-success"]'
                    class="apex-charts"
                    data-series='[{"name": "Target", "data": [90, 60, 70, 80, 90]},{"name": "Achivement", "data": [80, 60, 50, 40, 10]}]'
                    data-xaxis-categories='["Freelancer Join", "Customer Join", "Prospecting", "Cold Calling", "Lead"]'
                    data-height="400">
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection 
 