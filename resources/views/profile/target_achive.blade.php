@extends('layouts.dashboard')
@section('title',"Profile")
 

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9">  
                    {{-- <div class="card">
                        <div class="card-header">
                            <div class="card-icon text-muted"><i class="fa fa-boxes"></i></div>
                            <h3 class="card-title">Average Achivement</h3> 
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <h2 class="rich-list-title mb-0">{{ date('M-Y', $date->timestamp) }}</h2>
                                    <p class="rich-list-subtitle mb-0">{{$total_per}}%</p>
                                </div>
                                <div class="progress progress-sm" style="height:8px;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: {{$total_per}}%"></div>
                                </div>
                            </div> 
                        </div>
                    </div> --}}

                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon text-muted"><i class="fa fa-chalkboard fs14"></i></div>
                            <h3 class="card-title">Field Work 
                                <a href="{{route('my.field.target',['month'=>urldecode(date('Y-m', $date->timestamp)),'employee'=>encrypt($user->id)])}}" class="btn btn-secondary" type="submit">
                                    <span><i class="fas fa-print"></i> Export</span>
                                </a>  
                            </h3>
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
                            <div class="row g-3">
                                <div class="col-4">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2 bold"><a href="{{route('freelancer.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>FL Recruitment</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['freelancer']}}</span> / 
                                            <span title="target">{{$target->freelancer??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['freelancer']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['freelancer']}} <span>Avg</span></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('customer.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Customer Data</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['customer']}}</span> / 
                                            <span title="target">{{$target->customer??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['customer']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['customer']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('prospecting.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Prospectings</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['prospecting']}}</span> / 
                                            <span title="target">{{$target->prospecting??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['prospecting']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['prospecting']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('cold-calling.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Cold Calling</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['cold_calling']}}</span> / 
                                            <span title="target">{{$target->cold_calling??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['cold_calling']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['cold_calling']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('lead.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Lead</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['lead']}}</span> / 
                                            <span title="target">{{$target->lead??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['lead']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['lead']}} <span>Avg</span></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2"></p>
                                        <p class="text-muted mb-2 bold"><a href="{{route('lead-analysis.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Lead Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['lead_analysis']}}</span> / 
                                            <span title="target">{{$target->lead_analysis??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['lead_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['lead_analysis']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('presentation.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Presentation</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['presentation']}}</span> / 
                                            <span title="target">{{$target->project_visit??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['presentation']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['presentation']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('presentation_analysis.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Visit Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['visit_analysis']}}</span> / 
                                            <span title="target">{{$target->project_visit_analysis??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['visit_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['visit_analysis']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('followup.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Follow Up</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['followup']}}</span> / 
                                            <span title="target">{{$target->follow_up??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['followup']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['followup']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2">
                                        <p class="text-muted mb-2 bold"><a href="{{route('followup-analysis.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Follow Up Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['followup_analysis']}}</span> / 
                                            <span title="target">{{$target->follow_up_analysis??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['followup_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['followup_analysis']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('negotiation.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Negotiation</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['negotiation']}}</span> / 
                                            <span title="target">{{$target->negotiation??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['negotiation']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['negotiation']}} <span>Avg</span></p>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="border rounded p-2"> 
                                        <p class="text-muted mb-2 bold"><a href="{{route('negotiation-analysis.index',['employee'=>$user->id,'date'=>$date_range])}}"><b>Negotiation Analysis</b></a></p>
                                        <h4 class="fs-16 mb-2">
                                            <span title="Achivement">{{$achive['negotiation_analysis']}}</span> / 
                                            <span title="target">{{$target->negotiation_analysis??0}}</span></h4>
                                        <div class="progress progress-sm" style="height:4px;">
                                            <div class="progress-bar bg-success" style="width: {{$per['negotiation_analysis']}}"></div>
                                        </div>
                                        <p class="text-muted mb-0 mt-1">{{$per['negotiation_analysis']}} <span>Avg</span></p>
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