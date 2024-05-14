@extends('layouts.dashboard')
@section('title',"Profile") 
@section('style')
    <style>
        .card-title{
            font-size: 12px !important;
        }
    </style>
@endsection
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9">  
                    <div class="card">
                        <div class="card-header d-flex justify-content-between"> 
                            <h6 class="card-title">Field Work & Deposit Work Summery <br>  </h6>
                            {{-- <a href="{{route('my.field.target',['month'=>urldecode(date('Y-m', $date->timestamp)),'employee'=>encrypt($user->id)])}}" class="btn btn-secondary" type="submit">
                                <span><i class="fas fa-print"></i> Export</span>
                            </a>   --}}
                        </div>
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="mb-4">
                                    <div class="row">
                                      <div class="col-md-3">
                                          <label for="start_date" class="form-label">Start Date</label>
                                          <input type="number" class="form-control" name="start_date" id="start_date" value="{{get_date($start_date,'d')}}">
                                      </div>
                                      <div class="col-md-3">
                                          <label for="end_date" class="form-label">End Date</label>
                                          <input type="number" class="form-control" name="end_date" id="end_date" value="{{get_date($end_date,'d')}}">
                                      </div>
                                      <div class="col-md-6">
                                          <label for="month" class="form-label">Month</label>
                                          <div class="input-group">  
                                              <input type="month" id="month" class="form-control" name="month" value="{{ $month }}">
                                              <button class="btn btn-secondary btn-sm" type="submit">
                                                  <span><i class="fas fa-filter"></i> Filter</span>
                                              </button>  
                                          </div>
                                      </div>
                                    </div>
                              </div>
                            </form> 
                        </div>
                    </div> 
                    <div class="card">
                        <div class="card-header d-flex justify-content-between"> 
                            <h6 class="card-title"> {{get_date($start_date)}} to {{get_date($end_date)}} </h6>

                            <a href="{{route('my.field.target',['start_date'=>get_date($start_date,'d'),'end_date'=>get_date($end_date,'d'),'month'=>$month,'employee'=>encrypt($user->id)])}}" class="btn btn-secondary" type="submit">
                                <span><i class="fas fa-print"></i> Export</span>
                            </a>  
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-4">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2 bold"><a href="{{route('freelancer.index',['employee'=>$user->id,'date'=>$date])}}"><b>FL Recruitment</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['freelancer']}}</span> / 
                                            <span title="target">T-{{target_cal($target->freelancer??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['freelancer']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['freelancer']}} <span>Avg</span></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('customer.index',['employee'=>$user->id,'date'=>$date])}}"><b>Customer Data</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['customer']}}</span> / 
                                            <span title="target">T-{{target_cal($target->customer??0,$total_days,$diff)}} </span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['customer']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['customer']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('prospecting.index',['employee'=>$user->id,'date'=>$date])}}"><b>Prospectings</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['prospecting']}}</span> / 
                                            <span title="target">T-{{target_cal($target->prospecting??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['prospecting']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['prospecting']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('cold-calling.index',['employee'=>$user->id,'date'=>$date])}}"><b>Cold Calling</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['cold_calling']}}</span> / 
                                            <span title="target">T-{{target_cal($target->cold_calling??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['cold_calling']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['cold_calling']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('lead.index',['employee'=>$user->id,'date'=>$date])}}"><b>Lead</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['lead']}}</span> / 
                                            <span title="target">T-{{target_cal($target->lead??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['lead']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['lead']}} <span>Avg</span></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2"></p>
                                        <p class="text-muted mb-2 bold"><a href="{{route('lead-analysis.index',['employee'=>$user->id,'date'=>$date])}}"><b>Lead Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['lead_analysis']}}</span> / 
                                            <span title="target">T-{{target_cal($target->lead_analysis??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['lead_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['lead_analysis']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('presentation.index',['employee'=>$user->id,'date'=>$date])}}"><b>Presentation</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['presentation']}}</span> / 
                                            <span title="target">T-{{target_cal($target->project_visit??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['presentation']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['presentation']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('presentation_analysis.index',['employee'=>$user->id,'date'=>$date])}}"><b>Visit Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['visit_analysis']}}</span> / 
                                            <span title="target">T-{{target_cal($target->project_visit_analysis??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['visit_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['visit_analysis']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('followup.index',['employee'=>$user->id,'date'=>$date])}}"><b>Follow Up</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['followup']}}</span> / 
                                            <span title="target">T-{{target_cal($target->follow_up??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['followup']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['followup']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2 bold"><a href="{{route('followup-analysis.index',['employee'=>$user->id,'date'=>$date])}}"><b>Follow Up Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['followup_analysis']}}</span> / 
                                            <span title="target">T-{{target_cal($target->follow_up_analysis??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['followup_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['followup_analysis']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('negotiation.index',['employee'=>$user->id,'date'=>$date])}}"><b>Negotiation</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['negotiation']}}</span> / 
                                            <span title="target">T-{{target_cal($target->negotiation??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['negotiation']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['negotiation']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('negotiation-analysis.index',['employee'=>$user->id,'date'=>$date])}}"><b>Negotiation Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['negotiation_analysis']}}</span> / 
                                            <span title="target">T-{{target_cal($target->negotiation_analysis??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['negotiation_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['negotiation_analysis']}} <span>Avg</span></p>
                                    </div>
                                </div> 

 
                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href=""><b>Rejection</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['rejection']}}</span>  
                                    </div>
                                </div> 

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href=""><b>Sales Return</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['return']}}</span>
                                           
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href=""><b>Sales Transfer</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">0</span> 
                                    </div>
                                </div>


                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href=""><b>Unit</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['sales']}}</span> / 
                                            <span title="target">T-{{target_cal($deposit_target->total_unit??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['sales']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['sales']}} <span>Avg</span></p>
                                    </div>
                                </div> 

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href=""><b>Deposit</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">A-{{$achive['deposit']}}</span> / 
                                            <span title="target">T-{{target_cal($deposit_target->total_deposit??0,$total_days,$diff)}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['deposit']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['deposit']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                

                            </div> 
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>  

    @include('includes.footer')
</div>

 

@endsection 
 
@section('script')
  
@endsection