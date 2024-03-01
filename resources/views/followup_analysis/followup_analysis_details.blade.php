@extends('layouts.dashboard')
@section('title','Follow-up Analysis')
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
                        <h4 class="mb-sm-0">Follow-up Analysis</h4>  
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
                            <h4 class="card-title">Follow-up Analysis</h4> 
                        </div>

                        <div class="card-body"> 
                            <table class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tbody> 
                                    <tr> 
                                        <td class="p-1"><strong>Name & ID : </strong> {{$employee->name}} [{{$employee->user_id}}]</td>
                                        <td class="p-1"><strong>Mobile : </strong>{{$employee->phone}}</td> 
                                    </tr> 
            
                                    <tr> 
                                        <td class="p-1"><strong>Reporting Name & ID : </strong> {{@$employee->my_reporting()->name??""}} [{{@$employee->my_reporting()->user_id??""}}]</td>
                                        <td class="p-1"><strong>Area : </strong>{{@$employee->userAddress->area->name??"-"}}</td> 
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
                                        <td>{{$customer->name}}</td>
                                        <td>Customer Address</td>
                                        <td>{{@$user->userAddress->address}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Presentation Date</td>
                                        <td>{{get_date($presentation_date->created_at)}}</td>
                                        <td>Mobile Number</td>
                                        <td>{{$user->phone}}</td> 
                                    </tr>  
                                    <tr> 
                                        <td>Products</td>
                                        <td>{{$data->unit->title}}</td>
                                        <td>Email/Facebook</td>
                                        <td>{{@$user->userContact->facebook_id}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Project</td>
                                        <td>{{$data->project->name}}</td>
                                        <td>Refferal</td>
                                        <td>{{$customer->reference->name}} [{{$customer->reference->user_id}}]</td> 
                                    </tr>

                                    <tr> 
                                        <td>Negotiation Price</td>
                                        <td>{{get_price($data->negotiation_amount)}}</td>
                                        <td>Customer's Product</td>
                                        <td>-</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Product Qty</td>
                                        <td>{{$data->unit_qty??"-"}}</td>
                                        <td>Need</td>
                                        <td>{{$data->need}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Customer's Expectation</td>
                                        <td>{{$data->customer_expectation}}</td>
                                        <td>Ability</td>
                                        <td>{{$data->ability}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Follow Up 1 Date</td>
                                        <td>{{get_date($followUps->first()->created_at??"")}}</td>
                                        <td>Influncer Opinion</td>
                                        <td>{{$data->influencer_opinion}}</td> 
                                    </tr> 
                                    <tr> 
                                        <td>Follow Up 2 Date</td>
                                        <td>{{get_date($followUps->slice(1, 1)->first()->created_at??"")}}</td>
                                        <td>Decision Maker & His Opinion</td>
                                        <td>{{$data->decision_maker}} / {{$data->decision_maker_opinion}}</td> 
                                    </tr>
                                    <tr> 
                                        <td>Follow Up 3 Date</td>
                                        <td>{{get_date($followUps->slice(2, 1)->first()->created_at??"")}}</td>
                                        <td>Last Follow Up Customer Comments</td>
                                        <td>{{get_date($followUps->last()->created_at??"")}}</td> 
                                    </tr>

                                    <tr> 
                                        <td>Total Follow Up</td>
                                        <td>{{$followUps->count()}}</td>
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
 