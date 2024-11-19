@extends('layouts.dashboard')
@section('title',"Profile")
@section('content')
<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('customer.includes.customer_sidebar')
                </div> 
                <div class="col-md-9">   
                    @include('customer.includes.customer_menu')
                    <div class="card overflow-hidden"> 
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">{{$customer->customer_id}}</h4>
                                <div>
                                    <button class="btn btn-primary  mx-1 btn-md">
                                        <a href="{{route('rejection.create', ['customer' => $customer->id])}}" class="text-white" type="submit">
                                            Sales
                                        </a> 
                                    </button>
                                    <button class="btn btn-danger  mx-1 btn-md">
                                        <a href="{{route('rejection.create', ['customer' => $customer->id])}}" class="text-white" type="submit">
                                            Reject
                                        </a> 
                                    </button> 
                                </div>
                            </div>  
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
                                                <p class="m-0 fs-10">Created At: {{get_date($customer->created_at,'j M, Y g:i A')}}</p> 
                                                
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
                                            {{$communication['cold_calling']->remark??""}}
                                            <span class="badge badge-secondary mb-1">#project:  </span>
                                            <span class="badge badge-secondary mb-1">#unit: </span>
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
                                                <p class="m-0 fs-10">Created At: {{get_date(@$communication['lead']->created_at,'j M, Y g:i A')}}</p> 
                                                <p class="m-0 fs-10">Approved At:
                                                    @if (@$communication['lead']->approve_by != null)
                                                        {{get_date(@$communication['lead']->updated_at,'j M, Y g:i A')}} 
                                                    @else
                                                        <span class="badge badge-warning">Not approved yet</span>
                                                    @endif  
                                                </p> 

                                                {{$communication['lead']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['lead']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['lead']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Possible Purchase Date: {{get_date($communication['lead']->possible_purchase_date)??date('y-m-d')}}</span>
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
                                                <p class="m-0 fs-10">Created At: {{get_date(@$communication['presentation']->created_at,'j M, Y g:i A')}}</p> 
                                                <p class="m-0 fs-10">Approved At:
                                                    @if (@$communication['presentation']->approve_by != null)
                                                        {{get_date(@$communication['presentation']->updated_at,'j M, Y g:i A')}} 
                                                    @else
                                                        <span class="badge badge-warning">Not approved yet</span>
                                                    @endif  
                                                </p>

                                                {{$communication['presentation']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['presentation']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['presentation']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Possible Purchase Date: {{get_date($communication['presentation']->possible_purchase_date)??date('y-m-d')}}</span>
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
                                                <p class="m-0 fs-10">Created At: {{get_date(@$communication['follow_up']->created_at,'j M, Y g:i A')}}</p> 
                                                <p class="m-0 fs-10">Approved At:
                                                    @if (@$communication['follow_up']->approve_by != null)
                                                        {{get_date(@$communication['follow_up']->updated_at,'j M, Y g:i A')}} 
                                                    @else
                                                        <span class="badge badge-warning">Not approved yet</span>
                                                    @endif  
                                                </p>

                                                {{$communication['follow_up']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['follow_up']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['follow_up']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['follow_up']->regular_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Negotiation Amount: {{get_price( $communication['follow_up']->negotiation_amount??0)}}</span>
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
                                                <p class="m-0 fs-10">Created At: {{get_date(@$communication['negotiation']->created_at,'j M, Y g:i A')}}</p> 
                                                <p class="m-0 fs-10">Approved At:
                                                    @if (@$communication['negotiation']->approve_by != null)
                                                        {{get_date(@$communication['negotiation']->updated_at,'j M, Y g:i A')}} 
                                                    @else
                                                        <span class="badge badge-warning">Not approved yet</span>
                                                    @endif  
                                                </p>

                                                {{$communication['negotiation']->remark}}
                                                <span class="badge badge-secondary mb-1">#project: {{$communication['negotiation']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['negotiation']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['negotiation']->regular_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Negotiation Amount: {{get_price( $communication['negotiation']->negotiation_amount??0)}}</span>
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
 