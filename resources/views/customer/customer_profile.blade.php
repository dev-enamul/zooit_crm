@extends('layouts.dashboard')
@section('title',"Profile")
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    <div class="card border mb-0"> 
                        <div class="card-header">
                            <div class="text-center w-100">
                                <img class="w-100 mb-3" src="{{@$customer->user->image()}}" alt="">
                                <h5 class="mb-0">{{@$customer->user->name}}</h5>
                                <p>{{@$customer->profession->name}}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                {{-- <a href="{{route('freelancer.profile')}}" class="list-group-item list-group-item-action {{Route::is('freelancer.profile')?"active":""}} ">About</a> --}}
                                @foreach ($customer->user->customer as $single_customer)
                                <a href="{{route('customer.profile',encrypt($single_customer->id))}}" class="list-group-item list-group-item-action {{$customer->id==$single_customer->id?"active":""}}">{{$single_customer->customer_id}}</a> 
                                @endforeach
                               
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
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
                                    <p class="text-muted fw-medium mb-2">Purchase Amount</p>
                                    <h4 class="mb-0">{{get_price($totalSaleValue)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                    <p class="text-muted fw-medium mb-2">Total Payment</p>
                                    <h4 class="mb-0">{{$totalDeposit}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                    <p class="text-muted fw-medium mb-2">Return/Deduction</p>
                                    <h4 class="mb-0">{{$salesReturnAmount}}+{{$deductionAmount}} = {{$salesReturnAmount+$deductionAmount}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                    <p class="text-muted fw-medium mb-2">Total Due</p>
                                    <h4 class="mb-0">{{get_price(($totalSaleValue+$salesReturnAmount+$deductionAmount)-$totalDeposit)}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 
                <div class="col-md-9">  
                    {{-- <div class="card overflow-hidden"> 
                        <div class="card-body border-top">
                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="card-title">About</h4> 
                            </div>  
                            <div class="table-responsive">
                                <table class="table table-nowrap table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-account align-middle text-primary me-2"></i> Full Name :</th>
                                            <td>{{$customer->user->name??"-"}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-cellphone align-middle text-primary me-2"></i> Mobile :</th>
                                            <td>{{@$customer->user->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-email text-primary me-2"></i> E-mail :</th>
                                            <td>{{$customer->user->userContact->office_email??$customer->user->userContact->personal_email??"-"}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="mdi mdi-google-maps text-primary me-2"></i> Location :</th>
                                            <td>{{$customer->user->userAddress->address??"-"}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                    </div>   --}}

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
                                            <p class="text-muted fw-medium mb-2">Sold Value</p>
                                            <h4 class="mb-0">{{get_price($customer_salse->sold_value??0)}}</h4>
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
                                            <p class="text-muted fw-medium mb-2">Total Deposit</p>
                                            <h4 class="mb-0">{{get_price($customer_salse->total_deposit??0)}}</h4>
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
                                            <p class="text-muted fw-medium mb-2">Total Due</p>
                                            @php
                                                $total_due = ($customer_salse->sold_value??0)-($customer_salse->total_deposit??0);
                                            @endphp
                                            <h4 class="mb-0">{{get_price($total_due)}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 


                    <div class="card overflow-hidden"> 
                        <div class="card-body">
                            <h4 class="card-title">{{$customer->customer_id}}</h4>
                            <hr>
                            <div class="timeline timeline-zigzag">

                                {{-- Customer  --}}
                                 @if (isset($customer) && $customer != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Join by {{@$customer->reference->name}} [{{@$customer->reference->user_id}}]</p>
                                            <p class="m-0 bold-lg">Created by {{@$customer->createdBy->name}} [{{@$customer->createdBy->user_id}}]</p>
                                                <p class="m-0 fs-10">Created At: {{get_date($customer->created_at,'j M, Y g:i A')}}</p> 
                                                <p class="m-0 fs-10">Approved At:
                                                     @if ($customer->approve_by != null)
                                                        {{get_date($customer->updated_at,'j M, Y g:i A')}} 
                                                    @else
                                                        <span class="badge badge-warning">Not approved yet</span>
                                                     @endif  
                                                </p>
                                            <p></p>
                                        </div>
                                    </div>
                                 @endif
                                
                                {{-- Prospecting  --}}
                                 @if (isset($communication['prospecting']) && $communication['prospecting'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Prospecting by {{@$communication['prospecting']->employee->name??"-"}} on {{$communication['prospecting']->media==1?"Phone":"Meet"}}</p>
                                                <p class="m-0 fs-10">Created At: {{get_date(@$communication['prospecting']->created_at,'j M, Y g:i A')}}</p> 
                                                <p class="m-0 fs-10">Approved At:
                                                    @if (@$communication['prospecting']->approve_by != null)
                                                        {{get_date(@$communication['prospecting']->updated_at,'j M, Y g:i A')}} 
                                                    @else
                                                        <span class="badge badge-warning">Not approved yet</span>
                                                    @endif  
                                                </p>

                                                {{$communication['prospecting']->remark}}
                                        </div>
                                    </div>
                                 @endif 

                                 {{-- Cold Calling   --}}
                                 @if (isset($communication['cold_calling']) && $communication['cold_calling'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Cold Calling by {{$communication['cold_calling']->employee->name??"-"}}</p>
                                            <p class="m-0 fs-10">{{get_date($communication['cold_calling']->created_at??date('y-m-d'))}}</p>
                                            <p class="m-0 fs-10">Created At: {{get_date(@$communication['cold_calling']->created_at,'j M, Y g:i A')}}</p> 
                                                <p class="m-0 fs-10">Approved At:
                                                    @if (@$communication['cold_calling']->approve_by != null)
                                                        {{get_date(@$communication['cold_calling']->updated_at,'j M, Y g:i A')}} 
                                                    @else
                                                        <span class="badge badge-warning">Not approved yet</span>
                                                    @endif  
                                                </p>

                                            {{$communication['cold_calling']->remark??""}}
                                            <span class="badge badge-secondary mb-1">#project: {{$communication['cold_calling']->project->name??"-"}} </span>
                                            <span class="badge badge-secondary mb-1">#unit: {{$communication['cold_calling']->unit->title??""}}</span>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($communication['lead']) && $communication['lead'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Lead by {{$communication['lead']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['lead']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['lead']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['lead']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['lead']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Possible Purchase Date: {{get_date($communication['lead']->possible_purchase_date)??date('y-m-d')}}</span>
                                        </div>
                                    </div>
                                @endif 

                                @if (isset($communication['lead_analysis']) && $communication['lead_analysis'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Lead Analysis by {{$communication['lead_analysis']->employee->name??"-"}}</p>
                                            <p class="m-0 fs-10">{{get_date($communication['lead_analysis']->created_at??date('y-m-d'))}}</p>
                                            {{$communication['lead_analysis']->remark??""}}
                                            <span class="badge badge-secondary mb-1">#project: {{$communication['lead_analysis']->project->name??"-"}} </span>
                                            <span class="badge badge-secondary mb-1">#unit: {{$communication['lead_analysis']->unit->title??""}}</span>
                                        </div>
                                    </div>
                                @endif 

                                @if (isset($communication['presentation']) && $communication['presentation'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Presentation by {{$communication['presentation']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['presentation']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['presentation']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['presentation']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['presentation']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Possible Purchase Date: {{get_date($communication['presentation']->possible_purchase_date)??date('y-m-d')}}</span>
                                        </div>
                                    </div>
                                @endif 


                                @if (isset($communication['visit_analysis']) && $communication['visit_analysis'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Project Visit by {{$communication['visit_analysis']->employee->name??"-"}}</p>
                                            <p class="m-0 fs-10">{{get_date($communication['visit_analysis']->created_at??date('y-m-d'))}}</p>
                                            {{$communication['visit_analysis']->remark??""}} 
                     
                                            <span class="badge badge-secondary mb-1">#project: 
                                                @php
                                                    $projects = json_decode($communication['visit_analysis']->projects);
                                                @endphp
                                                @foreach($projects as $key => $project)
                                                    @if ($key!=0)
                                                        ,
                                                    @endif
                                                    {{ $project }}
                                            @endforeach
                                            </span>
                                             
                                        </div>
                                    </div>
                                @endif 

                                @if (isset($communication['follow_up']) && $communication['follow_up'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Follow Up by {{$communication['follow_up']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['follow_up']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['follow_up']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['follow_up']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['follow_up']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['follow_up']->regular_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Negotiation Amount: {{get_price( $communication['follow_up']->negotiation_amount??0)}}</span>
                                        </div>
                                    </div>
                                @endif 


                                @if (isset($communication['follow_up_analysis']) && $communication['follow_up_analysis'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Follow Up Analysis by {{$communication['follow_up_analysis']->employee->name??"-"}}</p>
                                            <p class="m-0 fs-10">{{get_date($communication['follow_up_analysis']->created_at??date('y-m-d'))}}</p>
                                            {{$communication['follow_up_analysis']->remark??""}}  
                                            <span class="badge badge-secondary mb-1">#project: {{$communication['follow_up_analysis']->project->name??"-"}} </span>
                                            <span class="badge badge-secondary m-1">#unit: {{$communication['follow_up_analysis']->unit->title??"-"}}</span>
                                            <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['follow_up_analysis']->regular_amount??0)}}</span>
                                            <span class="badge badge-secondary mb-1">#Negotiation Amount: {{get_price( $communication['follow_up_analysis']->negotiation_amount??0)}}</span>
                                            
                                        </div>
                                    </div>
                                @endif 

                                @if (isset($communication['negotiation']) && $communication['negotiation'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Negotiation by {{$communication['negotiation']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['negotiation']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['negotiation']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['negotiation']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['negotiation']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['negotiation']->regular_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Negotiation Amount: {{get_price( $communication['negotiation']->negotiation_amount??0)}}</span>
                                        </div>
                                    </div>
                                @endif 

                                @if (isset($communication['negotiation_analysis']) && $communication['negotiation_analysis'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Negotiation Analysis by {{$communication['negotiation_analysis']->employee->name??"-"}}</p>
                                            <p class="m-0 fs-10">{{get_date($communication['negotiation_analysis']->created_at??date('y-m-d'))}}</p>
                                            {{$communication['negotiation_analysis']->remark??""}}  
                                            <span class="badge badge-secondary mb-1">#project: {{$communication['negotiation_analysis']->project->name??"-"}} </span>
                                            <span class="badge badge-secondary m-1">#unit: {{$communication['negotiation_analysis']->unit->title??"-"}}</span>
                                            <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['negotiation_analysis']->regular_amount??0)}}</span>
                                            <span class="badge badge-secondary mb-1">#Negotiation Amount: {{get_price( $communication['negotiation_analysis']->negotiation_amount??0)}}</span>
                                        </div>
                                    </div>
                                @endif  

                                @if (isset($communication['rejection']) && $communication['rejection'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Regotiation by {{$communication['rejection']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['rejection']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['rejection']->remark}} 
                                        </div>
                                    </div>
                                @endif  

                                @if (isset($communication['salse']) && $communication['salse'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Salse by {{$communication['salse']->employee->name??"-"}}</p>
                                            <p class="m-0 fs-10">{{get_date($communication['salse']->created_at??date('y-m-d'))}}</p>
                                            {{$communication['salse']->remark??""}}  
                                            <span class="badge badge-secondary mb-1">#project: {{$communication['salse']->project->name??"-"}} </span>
                                            <span class="badge badge-secondary m-1">#unit: {{$communication['salse']->unit->title??"-"}}</span>
                                            <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['salse']->regular_amount??0)}}</span>
                                            <span class="badge badge-secondary mb-1">#Sold Amount: {{get_price( $communication['salse']->sold_value??0)}}</span>
                                        </div>
                                    </div>
                                @endif    

                                @if (isset($communication['salse_return']) && $communication['salse_return'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Salse Return by {{$communication['salse_return']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['salse_return']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['salse_return']->remark}} 

                                                <span class="badge badge-secondary mb-1">#project: {{$communication['salse_return']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['salse_return']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['salse_return']->regular_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Sold Amount: {{get_price( $communication['salse_return']->sold_value??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Total Deposit: {{get_price( $communication['salse_return']->total_deposit??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Deduction: {{get_price( $communication['salse_return']->deduction_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Return: {{get_price( $communication['salse_return']->sales_return_amount??0)}}</span>

                                        </div>
                                    </div>
                                @endif  
                            </div>
                        </div>
                    </div>

                </div>
            </div> 
        </div> 
    </div> 

    
</div>
@endsection 
 