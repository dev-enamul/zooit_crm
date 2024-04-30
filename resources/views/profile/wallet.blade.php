@extends('layouts.dashboard')
@section('title',"Wallet")  
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9">  
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <p class="m-0 float-center w-100 f-15"> <b>{{get_date($user_commission->updated_at)}}</b> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"> 
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                                <span class="avatar-title">
                                                    <i class="mdi mdi-chart-line fs-24"></i> 
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted fw-medium mb-2">Regular Commission</p>
                                            <h4 class="mb-0">{{get_price($user_commission->total_regular_commission)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                                <span class="avatar-title">
                                                    <i class="mdi mdi-chart-line fs-24"></i> 
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted fw-medium mb-2">Special Commission</p>
                                            <h4 class="mb-0">{{get_price($user_commission->total_special_commission)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"> 
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                                                <span class="avatar-title">
                                                    <i class="mdi mdi-chart-line fs-24"></i> 
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted fw-medium mb-2">Total Commission</p>
                                            <h4 class="mb-0">{{get_price($user_commission->total_commission)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded bg-warning-subtle text-warning d-flex align-items-center justify-content-center">
                                                <span class="avatar-title">
                                                    <i class="mdi mdi-check-circle-outline fs-24"></i> 
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted fw-medium mb-2">Withdraw Commission</p>
                                            <h4 class="mb-0">{{get_price($user_commission->paid_commission)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded bg-danger-subtle text-danger d-flex align-items-center justify-content-center">
                                                <span class="">
                                                    <i class="mdi mdi-timer-sand fs-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-muted fw-medium mb-2">Due Commission</p>
                                            <h4 class="mb-0">{{get_price($user_commission->pending_commission)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="card-icon text-muted"><i class="fa fa-chalkboard fs14"></i></div>
                            <h3 class="card-title">Commission</h3>
                            <div class="card-addon">
                                <form action="" method="get">
                                    <div class="input-group">   
                                        <input type="month" class="form-control" name="month" value="{{ date('Y-m', $date->timestamp) }}">
                                        <button class="btn btn-secondary" type="submit">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button>  
                                    </div>
                                </form>
                            </div> 
                        </div>
                        <div class="card-body">
                            <div class="table-box">
                                <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr> 
                                            <th>S/N</th>
                                            <th>Date</th> 
                                            <th>Project</th>
                                            <th>Deposit</th>
                                            <th>Commission [%]</th>
                                            <th>Commission [Tk]</th>
                                            <th>Applicable Commission</th>
                                            <th>Payble Commission</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($commissions as  $commission)
                                        <tr class="{{$commission->approve_by==null?"table-warning":""}}"> 
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="">{{get_date($commission->created_at)}}</td>
                                            <td class="">{{@$commission->project->name}}</td>
                                            <td class="">{{ get_price(@$commission->deposit->amount) }}</td>
                                            <td class="">{{ get_price(@$commission->commission_percent) }}%</td>
                                            <td class="">{{ get_price(@$commission->amount) }}</td> 
                                            <td class="">{{ get_price(@$commission->applicable_commission) }}</td> 
                                            <td class="">{{ get_price(@$commission->payble_commission) }}</td>
                                        </tr>
                                        @endforeach  
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right">Total</td>
                                            <td class="">{{ get_price($commissions->sum('deposit->amount')) }}</td>
                                            <td class=""></td>
                                            <td class="">{{ get_price($commissions->sum('amount')) }}</td>
                                            <td class="">{{ get_price($commissions->sum('applicable_commission')) }}</td>
                                            <td class="">{{ get_price($commissions->sum('payble_commission')) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div> 
        </div> 
    </div>  

    @include('includes.footer')
</div> 
@endsection 
 
@section('script')
    
@endsection