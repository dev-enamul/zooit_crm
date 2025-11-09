@extends('layouts.dashboard')
@section('title',"Invoice Details") 
 
 @section('style')
    <style>
        .company_info{
            margin-top: 20px;
        }
        .company_info p{
            margin: 0px;
            padding: 0px;
        }
        .bill_to{
            margin-top: 20px;
        }

        .invoice_info{
            margin-top: 30px;
        }

        .invoice_info p{
            margin: 0px;
            padding: 0px;
        }

        .invoice_reason{
            margin-top: 30px;
        } 
        .invoice_footer{
            margin-top: 50px;
        } 

        .invoice_footer p{
            margin: 0px;
            padding: 0px;
        }

        .bank_info{
            margin-top: 20px
        }
        .bank_info p{
            margin: 0px;
            padding: 0px;
        }
        .table{
            margin-top: 20px;
        }

        /* Enhanced Table Styles */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .invoice-table thead {
            background-color: #f8f9fa;
        }
        
        .invoice-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        
        .invoice-table td {
            padding: 5px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .invoice-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .invoice-table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .amount-column {
            text-align: right !important;
            font-weight: 500;
        }
        
        .total-row {
            background-color: #f8f9fa;
            font-weight: 600;
            text-align: right
        }
        
        .grand-total-row {
            background-color: #e9ecef;
            font-weight: 700;
            font-size: 16px;
        }
        
        .payment-history-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
            font-size: 14px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .payment-history-table thead {
            background-color: #f8f9fa;
        }
        
        .payment-history-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }
        
        .payment-history-table td {
            padding: 5px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .payment-history-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .payment-history-table .due-row {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        @media print {
            .col-print-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .d-print-block {
                display: block !important;
            }
            .d-print-none {
                display: none !important;
            }
            @page {
                size: A4;
                margin: 0.5in; /* Margin for the printer */
            }
            body {
                margin: 0;
                padding: 0;
                font-size: 10pt;
            }
            .card {
                border: none !important;
                box-shadow: none !important;
            }
            .main-content, .page-content, .container-fluid, .row, .col-12 {
                padding: 0 !important;
                margin: 0 !important;
            }
            h1, h2, h3, h4, h5, h6 {
                font-size: 12pt !important;
            }
            .invoice-table th, .invoice-table td,
            .payment-history-table th, .payment-history-table td {
                padding: 5px !important;
            }
            .company_info, .bill_to, .invoice_info, .invoice_reason, .invoice_footer, .bank_info {
                margin-top: 15px !important;
            }
            .invoice_footer {
                margin-top: 30px !important;
            }
            .table {
                margin-top: 15px !important;
            }
        } 
    </style>
 @endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
 
                <div class="row d-print-none">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between d-print-none">
                            <h4 class="mb-sm-0">
                                <button class="btn btn-secondary" id="printButton">
                                    <i class="fas fa-print"></i> Print
                                </button>
                                <a href="javascript:void(0)"   class="btn btn-dark"  onclick="shareLink('{{ customEncrypt($invoice->id) }}')">Share</a>
                                @if ($invoice->status==0 || $invoice->status==2)
                                    <a href="{{ route('invoice.edit', encrypt($invoice->id)) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a> 
                                @endif   
                            </h4>  
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table style="width: 100%">
                                    <tr>
                                        <td>
                                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-dark" height="40px">
                                            <div class="company_info">
                                                <p>24/ A1-, A-2, Bosila Rd, Mohammadpur, Dhaka</p>
                                                <p>1711432284</p>
                                                <p>info@thezoomit.com</p>
                                            </div> 
                                            <div class="bill_to">
                                                <h6 class="text-primary">BILL TO </h6>
                                                <h6>{{@$invoice->customer->user->name}}</h6>
                                                <p>{{@$invoice->user->userAddress->address}}</p> 
                                            </div>  
                                        </td>
                                        <td>
                                            <h1 class="text-primary">INVOICE #S{{$invoice->id}}</h1>
                                            <div class="invoice_info"> 
                                                <p><b>Issue Date</b> {{get_date($invoice->invoice_date)}}</p>
                                                <p><b>Due Date</b> {{get_date($invoice->due_date)}}</p>
                                            </div>
    
                                            <div class="invoice_reason">
                                                <h6 class="text-primary">FOR </h6> 
                                                <h6>{{@$invoice->title}} </h6> 
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            
                                <!-- Enhanced Invoice Items Table -->
                                <table class="invoice-table">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th class="amount-column">Amount</th>  
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @if ($invoice->description!=null)
                                            <tr>
                                                <td>{{$invoice->description}} </td>
                                                <td class="amount-column">{{get_price($invoice->amount,$invoice->project->currency)}}</td>
                                            </tr> 
                                        @else 
                                            @php
                                                $details = $invoice->details;
                                            @endphp
                                            @if (isset($details) && count($details)>0)
                                                @foreach ($details as $detail)
                                                    <tr>
                                                        <td>{{$detail->reason}} </td>
                                                        <td class="amount-column">{{get_price($detail->amount,$invoice->project->currency)}}</td>
                                                    </tr> 
                                                @endforeach
                                            @endif
                                        @endif 

                                        <tr class="total-row">
                                            <td><strong>Total</strong></td>
                                            <td class="amount-column"><strong>{{get_price($invoice->amount,$invoice->project->currency)}}</strong></td>
                                        </tr> 

                                        @if ($invoice->tax_amount>0 || $invoice->discount_amount>0)
                                        <tr class="total-row">
                                            <td>  
                                                @if ($invoice->tax_amount>0)
                                                    <p class="mb-2">Vat & Tax</p>
                                                @endif  
                                                @if ($invoice->discount_amount>0)
                                                    <p>Discount</p>
                                                @endif  
                                            </td>
                                            <td class="amount-column">
                                                @if ($invoice->tax_amount>0)
                                                    <p class="mb-2">{{get_price(@$invoice->tax_amount,$invoice->project->currency)}}</p> 
                                                @endif 
                                                @if ($invoice->discount_amount>0)
                                                    <p>-{{get_price(@$invoice->discount_amount,$invoice->project->currency)}}</p> 
                                                @endif 
                                            </td>
                                        </tr>  
                                        @endif 
                                        
                                        <tr class="total-row">
                                            <td><strong>Grand Total</strong></td>
                                            @php 
                                                $currency = @$invoice->project->currency ?? 'bdt'; 
                                                if($currency == 'usd'){
                                                    $price = get_price($invoice->total_amount_usd, $currency) 
                                                            . ' = (' . $invoice->total_amount_usd 
                                                            . ' x ' . $invoice->usd_rate 
                                                            . ') ' . get_price($invoice->total_amount);
                                                } else {
                                                    $price = get_price($invoice->total_amount);
                                                }  
                                            @endphp
                                            <td class="amount-column"><strong>{{ $price }}</strong></td>
                                        </tr>
                                        <tr class="total-row">
                                            <td><strong>Paid</strong></td>
                                            <td class="amount-column"><strong>{{get_price(($invoice->total_amount-$invoice->due_amount),'bdt')}}</strong></td>
                                        </tr> 
                                        <tr class="total-row">
                                            <td><strong>Payble</strong></td>
                                            <td class="amount-column"><strong>{{get_price($invoice->due_amount,'bdt')}}</strong></td>
                                        </tr> 
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-8">
                                        <div class="invoice_footer">
                                            <p><b>Please paid the bill before Due Date</b></p>
                                            <p>Grand Total is excluded from vat & tax</p>
                                            <p>If you have any questions concerning this invoice, <b>Shiblee Mozumder | +8801711432284 |</b></p>
                                            <a href="mailto:thezoomit@gmail.com">thezoomit@gmail.com</a>
                                        </div>
            
                                        <div class="bank_info">
                                            <h5 class="m-0">Bank Details</h5>
                                            <img src="https://tds-images.thedailystar.net/sites/default/files/styles/big_202/public/feature/images/united_commercial_bank.jpg" alt="" width="70px">
                                            <p><b>Ac Name </b>ZOOM IT</p>
                                            <p><b>AC NO </b>1782112000003115</p>
                                            <p><b>UCB bank Ati Bazar Branch</b></p>

                                            <img src="https://logos-world.net/wp-content/uploads/2024/10/Bkash-Logo.jpg" alt="" width="70px"> 
                                            <p><b>AC NO </b>+880 1711-432284 (Personal)</p>
                                        </div>
                                    </div>
                                     @php
                                        $transactions = $invoice->transactions;
                                        $due = $invoice->total_amount;
                                    @endphp
                                    @if (isset($transactions) && count($transactions) > 0)
                                    <div class="col-4">
                                        <div class="payment_history">
                                            <h5 class="text-primary">Payment History</h5>
                                            <table class="payment-history-table">
                                                <thead>
                                                    <tr>
                                                        <th>Payment Date</th> 
                                                        <th class="amount-column">Paid Amount</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                                        @foreach ($transactions as $transaction)
                                                            <tr>
                                                                <td>{{ get_date($transaction->created_at) }}</td> 
                                                                <td class="amount-column">{{ get_price($transaction->amount, $invoice->project->currency) }}</td>
                                                            </tr> 
                                                        @endforeach 
                                                </tbody>
                                            </table>
                                        </div> 
                                    </div>
                                    @endif 
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
    </div> 

      <div class="modal fade d-print-none" id="edit_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h5 class="modal-title">Share Invoice </h5>
                    <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                </div>
    
                <div class="modal-body">
                    <form action="{{route('village.update')}}" method="post"> 
                        @csrf  
                        <label for="word_no">Invoice Link <span class="text-danger">Copy and share with your customer.</span></label>
                        <input id="invoice-link" class="form-control" type="text" value="" readonly> 
                    </form>
                </div>  
    
                <div class="modal-footer">
                    <div class="text-end">
                        <a  id="prevButton"  href="" target="blank" class="btn btn-primary"><i class="fas fa-eye"></i> Preview</a>
                        <button class="btn btn-primary" id="copyLinkButton"><i class="fas fa-link"></i> Copy Link</button>
                    </div>                     
                </div>
            </div>
        </div>
    </div>

 
@endsection
@section('script') 
<script>
    $(document).ready(function () {
        $('#printButton').click(function () {
            window.print();
        });
    });
</script> 

<script>
    function shareLink(id){
        var link = "{{ route('invoice.share', ':id') }}".replace(':id', id); 
        $('#invoice-link').val(link);
        $('#prevButton').attr('href',link);
        $('#edit_modal').modal('show');
    }
    $(document).ready(function() { 
        $('#copyLinkButton').click(function() {
            var copyText = $('#invoice-link');
            copyText.select();
            copyText[0].setSelectionRange(0, 99999);  
            document.execCommand('copy'); 
            Toast.fire({ icon: "success", title: 'Invoice link copied to clipboard!' });  
        });
    });
</script>

@endsection