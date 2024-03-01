@extends('layouts.dashboard')
@section('title','Negotiation Analysis')
@section('style')
    <style>
        @media print {
            @page {
                size: A4;
            }
            .page-break {
                page-break-before: always;
            }  
        } 
        hr{
            margin: 0;
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
                        <h4 class="mb-sm-0">Negotiation Analysis</h4>  
                        <div class="page-title-right">
                            <button class="btn btn-primary" onclick="printPage()">Print</button>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="align-items-center mt-3 pb-2 d-flex flex-column page_head"> 
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" width="50px">
                            <h4 class="card-title">Negotiation Analysis</h4> 
                        </div>

                        <div class="card-body"> 
                            <table class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tbody> 
                                    <tr> 
                                        <td class="p-1"><strong>Name & ID : </strong> {{@$data->employee->name}} [{{@$data->employee->user_id}}]</td>
                                        <td class="p-1"><strong>Mobile : </strong>{{@$data->employee->phone}}</td> 
                                    </tr> 
            
                                    <tr> 
                                        <td class="p-1"><strong>Reporting Name & ID : </strong> {{@$data->employee->my_reporting()->name??""}} [{{@$data->employee->my_reporting()->user_id??""}}]</td>
                                        <td class="p-1"><strong>Area : </strong>{{@$data->employee->userAddress->area->name??"-"}}</td> 
                                    </tr> 
                                </tbody>
                            </table>
                            <table class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>Particulars</th>
                                        <th>Details</th>
                                        <th>Particulars</th>
                                        <th>Details</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr> 
                                        <td>Customer Name</td>
                                        <td>{{$data->customer->name}}</td>
                                        <td>Customer Preferences</td>
                                        <td>{{$data->customer_preference}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Mobile No</td>
                                        <td>{{@$data->customer->user->phone}}</td>
                                        <td>Last Verified LEAD date</td>
                                        <td>{{get_date($last_lead->created_at)}}</td> 
                                    </tr>  
                                    <tr> 
                                        <td>Project Name</td>
                                        <td>{{$data->project->name}}</td>
                                        <td>Last Presentation Date</td>
                                        <td>{{get_date($last_presentation_date->created_at??"")}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Product Name & Qty</td>
                                        <td>{{$data->unit->title}} ({{$data->unit_qty??"-"}})</td>
                                        <td>Last Follow Up Date</td>
                                        <td>{{get_date($last_follow_up->created_at)}}</td> 
                                    </tr>

                                    <tr> 
                                        <td>Follow Up After Price</td>
                                        <td>{{get_price($last_follow_up->negotiation_amount)}}</td>
                                        <td>Have a Plan "B"</td>
                                        <td>{{$data->plan_b}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Customer Emotion's</td>
                                        <td>{{$data->customer_emotion}}</td>
                                        <td>Approve By</td> 
                                        <td>{{$data->approver->name??"-"}} <hr>{{@$data->approver->employee->designation->title}}</td> 
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
    
        </div> <!-- container-fluid -->
    </div>
 
    @include('includes.footer')
</div> 
@endsection  
 
@section('script')
    <script>
        function printPage() {
            window.print();
        }
    </script> 
@endsection
 