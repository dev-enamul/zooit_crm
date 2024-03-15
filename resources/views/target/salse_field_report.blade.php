@extends('layouts.dashboard')
@section('title',"Marketing Target vs Achievemen")
@section('style')
    <style>
        .select2{
            min-width: 230px;
        }
    </style>
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Marketing Target vs Achievement</h4>
                        <p class="d-none">Name : {{$employee->name}}, </p>
                        <p class="d-none">ID : {{$employee->user_id}}, </p>
                        <p class="d-none">Area: {{@$employee->userAddress->area->name}},</p>
                        <p class="d-none">Zone: {{@$employee->userAddress->zone->name}},</p>  
                        <input type="hidden" id="hideExport" value=""> 
                        <input type="hidden" id="pageSize" value="a3">
                        <input type="hidden" id="fontSize" value="8">

                        <div class="page-title-right">
                            <a class="btn btn-secondary me-1" href="{{route(Route::currentRouteName())}}"><i class="mdi mdi-refresh"></i> </a> 
                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                <span><i class="fas fa-filter"></i> Filter</span>
                            </button> 
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title --> 
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">  
                            <div class="table-box" style="overflow-x: scroll;">
                                <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr class=""> 
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">Freelancer Name & ID</th>
                                            <th>FL Recruitment [T-A-%]</th>  
                                            <th>Customer [T-A-%]</th> 
                                            <th>Prospecting [T-A-%]</th> 
                                            <th>Cold calling [T-A-%]</th> 
                                            <th>LEAD [T-A-%]</th> 
                                            <th>LEAD Analysis [T-A-%]</th>   
                                            <th>Presentation [T-A-%]</th>
                                            <th>Visit Analysis [T-A-%]</th>
                                            <th>Follow Up [T-A-%]</th>
                                            <th>Follow Up Analysis [T-A-%]</th>
                                            <th>Negotiation [T-A-%]</th>
                                            <th>Negotiation Analysis [T-A-%]</th>
                                        </tr> 
                                    </thead>
                                    <tbody> 
                                        @php
                                            $total_freelancer = 0;
                                            $total_customer = 0;
                                            $total_prospecting = 0;
                                            $total_cold_calling = 0;
                                            $total_lead = 0;
                                            $total_lead_analysis = 0;
                                            $total_presentation = 0;
                                            $total_visit_analysis = 0;
                                            $total_followup = 0;
                                            $total_followup_analysis = 0;
                                            $total_negotiation = 0;
                                            $total_negotiation_analysis = 0;

                                            $total_freelancer_target = 0;
                                            $total_customer_target = 0;
                                            $total_prospecting_target = 0;
                                            $total_cold_calling_target = 0;
                                            $total_lead_target = 0;
                                            $total_lead_analysis_target = 0;
                                            $total_presentation_target = 0;
                                            $total_visit_analysis_target = 0;
                                            $total_followup_target = 0;
                                            $total_followup_analysis_target = 0;
                                            $total_negotiation_target = 0;
                                            $total_negotiation_analysis_target = 0; 
                                        @endphp
                                        @foreach ($datas as $key => $data)
                                        @php
                                            $target = App\Models\FieldTarget::where('assign_to',$data->id)
                                                ->whereMonth('month',$date)
                                                ->whereYear('month',$date)
                                                ->first(); 
                                                $freelancer = $data->freelanecr_achive($date);
                                                $customer = $data->customer_achive($date);
                                                $prospecting = $data->prospecting_achive($date);
                                                $cold_calling = $data->cold_calling_achive($date);
                                                $lead = $data->lead_achive($date);
                                                $lead_analysis = $data->lead_analysis_achive($date);
                                                $presentation = $data->presentation_achive($date);
                                                $visit_analysis = $data->visit_analysis_achive($date);
                                                $followup = $data->followup_achive($date);
                                                $followup_analysis = $data->followup_analysis_achive($date);
                                                $negotiation = $data->negotiation_achive($date);
                                                $negotiation_analysis = $data->negotiation_analysis_achive($date); 

                                                $total_freelancer += $freelancer;
                                                $total_customer += $customer;
                                                $total_prospecting += $prospecting;
                                                $total_cold_calling += $cold_calling;
                                                $total_lead += $lead;
                                                $total_lead_analysis += $lead_analysis;
                                                $total_presentation += $presentation;
                                                $total_visit_analysis += $visit_analysis;
                                                $total_followup += $followup;
                                                $total_followup_analysis += $followup_analysis;
                                                $total_negotiation += $negotiation;
                                                $total_negotiation_analysis += $negotiation_analysis; 

                                                $total_freelancer_target += $target->freelancer??0;
                                                $total_customer_target += $target->customer??0;
                                                $total_prospecting_target += $target->prospecting??0;
                                                $total_cold_calling_target += $target->cold_calling??0;
                                                $total_lead_target += $target->lead??0;
                                                $total_lead_analysis_target += $target->lead_analysis??0;
                                                $total_presentation_target += $target->presentation??0;
                                                $total_visit_analysis_target += $target->visit_analysis??0;
                                                $total_followup_target += $target->follow_up??0;
                                                $total_followup_analysis_target += $target->follow_up_analysis??0;
                                                $total_negotiation_target += $target->negotiation??0;
                                                $total_negotiation_analysis_target += $target->negotiation_analysis??0;

                                            @endphp 

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    {{$data->name}} [{{$data->user_id}}]
                                                </td>
                                                <td>
                                                    {{$target->freelancer??0}} - {{$freelancer}} - {{get_percent($freelancer,$target->freelancer??0)}}
                                                </td>
                                                <td>
                                                    {{$target->customer??0}} - {{$customer}} - {{get_percent($customer,$target->customer??0)}}
                                                </td>
                                                <td>
                                                    {{$target->prospecting??0}} - {{$prospecting}} -  {{get_percent($prospecting,$target->prospecting??0)}}
                                                </td>
                                                <td>
                                                    {{$target->cold_calling??0}} - {{$cold_calling}} - {{get_percent($cold_calling,$target->cold_calling??0)}}
                                                </td>
                                                <td>
                                                    {{$target->lead??0}} - {{$lead}} - {{get_percent($lead,$target->lead??0)}}
                                                </td>
                                                <td>
                                                    {{$target->lead_analysis??0}} - {{$lead_analysis}} - {{get_percent($lead_analysis,$target->lead_analysis??0)}}
                                                </td> 
                                                <td>
                                                    {{$target->presentation??0}} - {{$presentation}} - {{get_percent($presentation,$target->presentation??0)}}
                                                </td>
                                                <td>
                                                    {{$target->visit_analysis??0}} - {{$visit_analysis}} - {{get_percent($visit_analysis,$target->visit_analysis??0)}}
                                                </td>
                                                <td>
                                                    {{$target->follow_up??0}} - {{$followup}} - {{get_percent($followup,$target->follow_up??0)}}
                                                </td>
                                                <td>
                                                    {{$target->follow_up_analysis??0}} - {{$followup_analysis}} - {{get_percent($followup_analysis,$target->follow_up_analysis??0)}}
                                                </td>
                                                <td>
                                                    {{$target->negotiation??0}} - {{$negotiation}} - {{get_percent($negotiation,$target->negotiation??0)}}
                                                </td>
                                                <td>
                                                    {{$target->negotiation_analysis??0}} - {{$negotiation_analysis}} -  {{get_percent($negotiation_analysis,$target->negotiation_analysis??0)}}
                                                </td>
                                            </tr> 
                                        @endforeach 
                                        <tr>
                                            <td><b>Total</b></td>
                                            <td><b>-</b></td>
                                            <td>
                                                <b>{{$total_freelancer_target}} - {{$total_freelancer}} - {{get_percent($total_freelancer,$total_freelancer_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_customer_target}} - {{$total_customer}} - {{get_percent($total_customer,$total_customer_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_prospecting_target}} - {{$total_prospecting}} -  {{get_percent($total_prospecting,$total_prospecting_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_cold_calling_target}} - {{$total_cold_calling}} - {{get_percent($total_cold_calling,$total_cold_calling_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_lead_target}} - {{$total_lead}} - {{get_percent($total_lead,$total_lead_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_lead_analysis_target}} - {{$total_lead_analysis}} - {{get_percent($total_lead_analysis,$total_lead_analysis_target)}}</b>
                                            </td> 
                                            <td>
                                                <b>{{$total_presentation_target}} - {{$total_presentation}} - {{get_percent($total_presentation,$total_presentation_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_visit_analysis_target}} - {{$total_visit_analysis}} - {{get_percent($total_visit_analysis,$total_visit_analysis_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_followup_target}} - {{$total_followup}} - {{get_percent($total_followup,$total_followup_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_followup_analysis_target}} - {{$total_followup_analysis}} - {{get_percent($total_followup_analysis,$total_followup_analysis_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_negotiation_target}} - {{$total_negotiation}} - {{get_percent($total_negotiation,$total_negotiation_target)}}</b>
                                            </td>
                                            <td>
                                                <b>{{$total_negotiation_analysis_target}} - {{$total_negotiation_analysis}} -  {{get_percent($total_negotiation_analysis,$total_negotiation_analysis_target)}}</b>
                                            </td>
                                        </tr>
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
        <h5 class="offcanvas-title">Filter Leads</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="" method="get">
            <div class="row">  
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Marketing Executive</label>
                        <select id="employee" class="select2" name="employee" search>
                            @foreach ($employees as $data)
                                <option {{$employee->id==$data->id?"selected":""}} value="{{encrypt($data->id)}}">{{$data->name}} [{{$data->user_id}}]</option> 
                            @endforeach 
                        </select> 
                    </div>
                </div>  
    
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <input type="month" class="form-control" name="month" value="{{ date('Y-m', $date->timestamp) }}">
                    </div>
                </div> 
     
                <div class="text-end ">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button type="button" class="btn btn-outline-danger btn_refresh"><i class="mdi mdi-refresh"></i> Reset</button>
                </div>  
            </div>
        </form>
    </div>
</div>

@endsection 

@section('script')
@include('includes.data_table')
    <script>
        getDateRange('daterangepicker');
    </script>
@endsection