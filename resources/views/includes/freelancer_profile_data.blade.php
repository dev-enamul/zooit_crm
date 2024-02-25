@php
    $commission = App\Models\DepositCommission::where('user_id',$user_id)->sum('amount');
    $withdraws =  App\Models\Withdraw::where('user_id',$user_id)->whereNotNull('approved_by')->sum('amount');
@endphp
<div class="row">
    <div class="col-md-4"> 
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded bg-info-subtle text-info d-flex align-items-center justify-content-center">
                            <span class="avatar-title">
                                <i class="mdi mdi-check-circle-outline fs-24"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted fw-medium mb-2">Total Commission</p>
                        <h4 class="mb-0">{{get_price($commission)}}</h4>
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
                        <div class="avatar-sm rounded bg-warning-subtle text-warning d-flex align-items-center justify-content-center">
                            <span class="avatar-title">
                                <i class="mdi mdi-timer-sand fs-24"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted fw-medium mb-2">Total Withdraw</p>
                        <h4 class="mb-0">{{get_price($withdraws)}}</h4>
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
                        <div class="avatar-sm rounded bg-danger-subtle text-danger d-flex align-items-center justify-content-center">
                            <span class="">
                                <i class="mdi mdi-chart-line fs-24"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <p class="text-muted fw-medium mb-2">Ballance</p>
                        <h4 class="mb-0">{{get_price($commission-$withdraws)}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 