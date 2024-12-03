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
                                
                                

                                @if (isset($communication['follow_up']) && count($communication['follow_up'])>0)
                                    @foreach ($communication['follow_up'] as $follwoup)
                                        <div class="timeline-item">
                                            <div class="timeline-pin">
                                                <i class="marker marker-circle text-info"></i>
                                            </div>
                                            <div class="timeline-content"> 
                                                <p class="m-0 bold-lg">Follow Up by {{$follwoup->employee->name??"-"}}</p>
                                                    <p class="m-0 fs-10">Created At: {{get_date(@$follwoup->created_at,'j M, Y g:i A')}}</p>  
                                                    {{$follwoup->remark}}  <br>
                                                    <span class="badge badge-secondary mb-1">#Possibility: {{$follwoup->purchase_possibility??0}}%</span>
                                                    <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $follwoup->negotiation_amount??0)}}</span> 
                                                    <span class="badge badge-secondary mb-1">#Next Followup: {{get_date( $follwoup->next_followup_date??now())}}%</span>
                                                    
                                            </div>
                                        </div>
                                    @endforeach 
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
 