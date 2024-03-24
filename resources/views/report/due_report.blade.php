@extends('layouts.dashboard')
@section('title',"Due Report")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Due Over Due Report</h4> 
                        <p class="d-none">Employee: {{auth()->user()->name}}</p> 
                        <input type="hidden" id="hideExport" value=""> 
                        <input type="hidden" id="pageSize" value="a3">
                        <input type="hidden" id="fontSize" value="8">
                        <div class="page-title-right">
                             
                        </div> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable" class="table table-hover align-middle text-center table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="align-middle"> 
                                        <th>SL.</th>
                                        <th>CUS ID</th>
                                        <th>Customer Name</th>
                                        <th>Project Name</th>
                                        <th>Unit Name</th>
                                        <th>Unit Qty.</th>
                                        <th>Booking Date</th>
                                        <th>Declaration Price</th>
                                        <th>Sold Price</th>
                                        <th>Discount Amount</th> 
                                        <th>Total Installment Qty</th>
                                        <th>Booking Deposit</th>
                                        <th>Downpayment Deposit</th>
                                        <th>Total Installment Deposit</th> 
                                        <th>Total Deposit</th>
                                        <th>DUE Downpayment Amount</th>
                                        <th>Total DUE Amount</th>
                                        <th>Total Due Installment Qty</th>
                                        <th>Due (Current Installment) Amount</th>
                                        <th>Total Over Due Installment Qty.</th>
                                        <th>Over Due Installment Amount</th>
                                        <th>Franchise Partner Name & ID</th>
                                        <th>Reporting Person Name & ID</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @php
                                        $total_regular_price = 0;
                                        $total_sold_price = 0;
                                        $total_discount_amount = 0;
                                        $total_total_installment = 0; 
                                        $total_booking = 0;
                                        $total_down_payment = 0;
                                        $total_installment_deposit = 0;
                                        $total_total_deposit = 0;
                                        $total_due_downpayment = 0;
                                        $total_due_amount = 0;
                                        $total_due_installment = 0;
                                        $total_due_installment_amount = 0;
                                        $total_over_due_installment = 0;
                                        $total_over_due_installment_amount = 0; 
                                    @endphp
                                    @foreach ($customers as $key => $data)
                                    {{-- calculate total  --}}
                                    @php
                                        $total_regular_price        = $total_regular_price+@$data->salse->regular_amount;
                                        $total_sold_price           = $total_sold_price+@$data->salse->sold_value;
                                        $total_discount_amount      = $total_discount_amount+(@$data->salse->regular_amount-@$data->salse->sold_value);
                                        $total_total_installment    = $total_total_installment+@$data->salse->total_installment;
                                        $total_booking              = $total_booking+(@$data->salse->booking-@$data->salse->booking_due);
                                        $total_down_payment         = $total_down_payment+(@$data->salse->down_payment-@$data->salse->down_payment_due);
                                        $total_installment_deposit  = $total_installment_deposit+(@$data->salse->total_deposit-(@$data->salse->booking-@$data->salse->booking_due+@$data->salse->down_payment-@$data->salse->down_payment_due));
                                        $total_total_deposit        = $total_total_deposit+@$data->salse->total_deposit;
                                        $total_due_downpayment      = $total_due_downpayment+@$data->salse->down_payment_due;
                                        $total_due_amount           = $total_due_amount+(@$data->salse->sold_value-@$data->salse->total_deposit);
                                        $total_due_installment      = $total_due_installment+$data->dueInstallment();
                                        $total_due_installment_amount = $total_due_installment_amount+($data->dueInstallment()*@$data->salse->installment_value);
                                        $total_over_due_installment = $total_over_due_installment+$data->overDueInstallment();
                                        $total_over_due_installment_amount = $total_over_due_installment_amount+($data->overDueInstallment()*@$data->salse->installment_value);
 
                                    @endphp
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data->customer_id}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{@$data->salse->project->name}}</td>
                                        <td>{{@$data->salse->unit->title}}</td>
                                        <td>{{@$data->salse->unit_qty}}</td>
                                        <td>{{get_date(@$data->salse->created_at)}}</td>
                                        <td>{{get_price(@$data->salse->regular_amount)}}</td>
                                        <td>{{get_price(@$data->salse->sold_value)}}</td>
                                        <td>{{get_price(@$data->salse->regular_amount-@$data->salse->sold_value)}}</td> 
                                        <td>{{@$data->salse->total_installment}}</td>
                                        @php
                                            $booking = @$data->salse->booking-@$data->salse->booking_due;
                                            $down_payment = @$data->salse->down_payment-@$data->salse->down_payment_due;
                                        @endphp
                                        <td>{{get_price(@$booking)}}</td>
                                        <td>{{get_price(@$down_payment)}}</td>
                                        <td>{{get_price(@$data->salse->total_deposit-($booking+$down_payment))}}</td> 
                                        <td>{{get_price(@$data->salse->total_deposit)}}</td>
                                        <td>{{get_price(@$data->salse->down_payment_due)}}</td>
                                        <td>{{get_price(@$data->salse->sold_value-@$data->salse->total_deposit)}}</td>
                                        <td>{{$data->dueInstallment()}}</td>
                                        <td>{{get_price($data->dueInstallment()*@$data->salse->installment_value)}}</td>
                                        <td>{{$data->overDueInstallment()}}</td>
                                        <td>{{get_price($data->overDueInstallment()*@$data->salse->installment_value)}}</td>
                                        <td>{{@$data->reference->name}} [{{@$data->reference->user_id}}]</td>
                                        @php
                                            $user_reporting = user_reporting($data->ref_id);
                                            if(count($user_reporting)>1){
                                                $user_reporting = $user_reporting[1];
                                            }else{
                                                $user_reporting = $user_reporting[0];
                                            }
                                        @endphp
                                        <td>{{user_info($user_reporting)->name}} [{{user_info($user_reporting)->user_id}}]</td>
                                    </tr> 
                                    @endforeach  

                                    <tr class="align-middle"> 
                                        <th><strong>Total</strong></th>
                                        <th><strong>-</strong></th>
                                        <th><strong>-</strong></th>
                                        <th><strong>-</strong></th>
                                        <th><strong>-</strong></th>
                                        <th><strong>-</strong></th>
                                        <th><strong>-</strong></th>
                                        <th><strong>{{get_price($total_regular_price)}}</strong></th>
                                        <th><strong>{{get_price($total_sold_price)}}</strong></th>
                                        <th><strong>{{get_price($total_discount_amount)}}</strong></th> 
                                        <th><strong>{{$total_total_installment}}</strong></th>
                                        <th><strong>{{get_price($total_booking)}}</strong></th>
                                        <th><strong>{{get_price($total_down_payment)}}</strong></th>
                                        <th><strong>{{get_price($total_installment_deposit)}}</strong></th> 
                                        <th><strong>{{get_price($total_total_deposit)}}</strong></th>
                                        <th><strong>{{get_price($total_due_downpayment)}}</strong></th>
                                        <th><strong>{{get_price($total_due_amount)}}</strong></th>
                                        <th><strong>{{$total_due_installment}}</strong></th>
                                        <th><strong>{{get_price($total_due_installment_amount)}}</strong></th>
                                        <th><strong>{{$total_over_due_installment}}</strong></th>
                                        <th><strong>{{get_price($total_over_due_installment_amount)}}</strong></th>
                                        <th>-</th>
                                        <th>-</th>
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
 
@endsection

@section('script')
@include('includes.data_table')
    <script>
        getDateRange('duration')
    </script>
@endsection