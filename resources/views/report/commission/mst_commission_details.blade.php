@extends('layouts.dashboard')
@section('title',"Summary of Sales Commision")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-12"> 
                    <div class="text-center page-title-box">
                        <h4 class="mb-sm-0"> Hierarchy Wise Money Receipt</h4>  
                        <p class=""> <b>Employee Name: </b> {{$user->name}} [{{$user->user_id}}] <br> 
                            <b>Month : </b> {{get_date($month, 'M - Y')}} </p>
                        {{-- <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">  --}}
                        <input type="hidden" id="pageSize" value="a3">
                        <input type="hidden" id="fontSize" value="8">
                    </div>  
                </div>
            </div>   
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">
                            
                           <div class="table-box" style="overflow-x: scroll;">

                            {{-- <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Name : MD Enamul Haque</th> 
                                        <th>EMP-254</th>
                                        <th>Region: </th>
                                        <th>Zone: Noakhali</th>
                                        <th>Reporting Name & ID : MR Kamruzzaman & 153</th>
                                    </tr>
                                </thead> 
                            </table> --}}

                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class=""> 
                                        <th>SN</th>
                                        <th>CUS ID</th>
                                        <th>Customer Name</th>
                                        <th>Booking Date</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Project</th> 
                                        <th>Sales Value</th>
                                        <th>Deposit Amount</th> 
                                        <th>Resale/Adjustment Amount</th>
                                        <th>Cash Amount</th>
                                        <th>Commission Rate (%)</th>
                                        <th>Commission</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($commissions as $key => $data)
                                        <tr class="">
                                            <td>{{++$key}}</td>
                                            <td> {{@$data->deposit->customer->customer_id}}</td>
                                            <td>{{@$data->deposit->customer->name}}</td>
                                            <td>{{get_date($data->salse->created_at)}}</td>
                                            <td>{{$data->salse->unit->title??"-"}}</td>
                                            <td>{{@$data->salse->unit_qty}}</td>
                                            <td>{{@$data->salse->project->name}}</td>
                                            <td>{{get_price($data->salse->sold_value)}}</td>
                                            <td>{{get_price($data->salse->total_deposit)}}</td> 
                                            <td>{{get_price(0)}}</td>
                                            <td>{{get_price($data->deposit->amount)}}</td>
                                            <td>{{$data->commission_percent}}</td>
                                            <td>{{get_price($data->amount)}}</td>
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
    @include('includes.data_table')
@endsection