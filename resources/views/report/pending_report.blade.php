@extends('layouts.dashboard')
@section('title',"Due Report")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-sm-0">Daily Work Pending or Done Report</h4> 
                            <p class="d-none">{{get_date($startDate)}} - {{get_date($endDate)}}</p>
                        </div>

                        <div class="">   
                            <form action="" method="get" action="">
                                <div class="input-group">  
                                    <input class="form-control" id="date" name="date" default="This Month" type="text" value="" /> 
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
                            <table id="datatable" class="table table-hover align-middle table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle">  
                                        <th>Employee</th>
                                        <th>Designation</th>
                                        <th>Pending FL</th>
                                        <th>Done FL</th>
                                        <th>Pending Cus.</th>
                                        <th>Done Cus.</th>
                                        <th>Pending Prospecting</th>
                                        <th>Done Prospecting</th>
                                        <th>Pending Cold Calling </th> 
                                        <th>Done Cold Calling</th>
                                        <th>Pending Lead</th>
                                        <th>Done Lead</th>
                                        <th>Pending Lead Analysis</th>
                                        <th>Done Lead Analysis</th>

                                        <th>Pending Visit & Presentation</th> 
                                        <th>Done Visit & Presentation</th> 
                                        <th>Pending Visit Analysis</th> 
                                        <th>Done Visit Analysis</th>

                                        <th>Pending Folow Up</th>
                                        <th>Done Follow Up</th>
                                        
                                        <th>Pending Folow Up Analysis</th>
                                        <th>Done Follow Up Analysis</th>

                                        <th>Pending Negotiation</th>
                                        <th>Done Negotiation</th> 

                                        <th>Pending Negotiation Analysis</th>
                                        <th>Done Negotiation Analysis</th>

                                        <th>Pending Rejection</th>
                                        <th>Done Rejection</th>
                                        <th>New Salse Unit</th>
                                        <th>Existing Deposit</th>
                                        <th>New Deposit</th>
                                    </tr>
                                </thead>
                             <tbody>
                                @foreach ($employees as $key => $employee)
                                    <tr> 
                                        <td>{{$employee->name}}</td>
                                        <td>{{@$employee->employee->designation->title}}</td> 
                                        @php   
                                        $my_all_employee_ids = my_all_employee($employee->id);
                                          $freelancer = App\Models\Freelancer::whereIn('ref_id', $my_all_employee_ids) 
                                            ->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp 
                                        <td>{{$freelancer->where('status', 0)->count()}}</td>
                                        <td>{{$freelancer->where('status', 1)->count()}}</td> 
                                        
                                        @php
                                        $customer = App\Models\Customer::whereIn('ref_id', $my_all_employee_ids) 
                                            ->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$customer->where('status', 0)->count()}}</td>
                                        <td>{{$customer->where('status', 1)->count()}}</td> 

                                        @php
                                        $prospecting = App\Models\Prospecting::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$prospecting->where('status',0)->count()}}</td>
                                        <td>{{$prospecting->where('status',1)->count()}}</td> 

                                        @php
                                        $cold_calling = App\Models\ColdCalling::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$cold_calling->where('status',0)->count()}}</td>
                                        <td>{{$cold_calling->where('status',1)->count()}}</td>  

                                        @php
                                        $lead = App\Models\Lead::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]); 

                                        @endphp
                                        <td>{{$lead->where('status',0)->count()}}</td>
                                        <td>{{$lead->where('status',1)->count()}}</td>  
                                        @php 

                                        $lead_analysis = App\Models\LeadAnalysis::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$lead_analysis->where('status',0)->count()}}</td>
                                        <td>{{$lead_analysis->where('status',1)->count()}}</td>

                                        @php
                                        $visit_presentation = App\Models\Presentation::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$visit_presentation->where('status',0)->count()}}</td>
                                        <td>{{$visit_presentation->where('status',1)->count()}}</td>

                                        @php
                                        $visit_analysis = App\Models\VisitAnalysis::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$visit_analysis->where('status',0)->count()}}</td>
                                        <td>{{$visit_analysis->where('status',1)->count()}}</td>
                                        
                                        @php
                                        $follow_up = App\Models\FollowUp::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$follow_up->where('status',0)->count()}}</td>
                                        <td>{{$follow_up->where('status',1)->count()}}</td>

                                        @php
                                        $follow_up_analysis = App\Models\FollowUpAnalysis::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$follow_up_analysis->where('status',0)->count()}}</td>
                                        <td>{{$follow_up_analysis->where('status',1)->count()}}</td>

                                        @php
                                        $negotiation = App\Models\Negotiation::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$negotiation->where('status',0)->count()}}</td>
                                        <td>{{$negotiation->where('status',1)->count()}}</td>

                                        @php
                                        $negotiation_analysis = App\Models\NegotiationAnalysis::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$negotiation_analysis->where('status',0)->count()}}</td>
                                        <td>{{$negotiation_analysis->where('status',1)->count()}}</td>

                                        @php
                                        $rejection = App\Models\Rejection::whereHas('customer', function($query) use($my_all_employee_ids){
                                            $query->whereIn('ref_id', $my_all_employee_ids);
                                        })->whereBetween('created_at', [$startDate, $endDate]);
                                        @endphp
                                        <td>{{$rejection->where('status',0)->count()}}</td>
                                        <td>{{$rejection->where('status',1)->count()}}</td> 

                                         <td>0</td>
                                         <td>0</td>
                                         <td>0</td>
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
<script>
    var title = $('.page-title-box').find('h4').text();
    var Period = $('.page-title-box').find('p').text();
    getDateRange('date');
</script>
    @include('includes.data_table')
    
@endsection