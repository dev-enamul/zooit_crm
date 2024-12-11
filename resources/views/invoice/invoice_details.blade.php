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

        @media print { 
            @page {
                margin: 0.50in;
            } 
            body {
                margin: 0;
                padding: 0;
            }

            .main-content {
                padding: 0.50in;
            } 
        } 
    </style>
 @endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
 
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">
                                <button class="btn btn-secondary" id="printButton">
                                    <i class="fas fa-print"></i> Print
                                </button>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-dark" height="40px">
                                        <div class="company_info">
                                            <p>24/ A1-, A-2, Bosila Rd, Mohammadpur, Dhaka</p>
                                            <p>1711432284</p>
                                            <p>info@thezoomit.com</p>
                                        </div> 
                                        <div class="bill_to">
                                            <h6 class="text-primary">BILL TO </h6>
                                            <h6>{{@$invoice->user->name}}</h6>
                                            <p>{{@$invoice->user->userAddress->address}}</p> 
                                        </div>  
                                    </div> 

                                    <div class="col-md-4 text-center">
                                        @if ($invoice->status==0)
                                            <img src="https://t3.ftcdn.net/jpg/04/87/13/44/360_F_487134492_svhGzEgDXKyQuuPXQrs7prKoBYWCEJdw.jpg" alt="" width="100px">
                                        @else 
                                        <img src="https://png.pngtree.com/png-vector/20230208/ourmid/pngtree-paid-stamp-vector-illustration-png-image_6585127.png" alt="" width="100px">
                                        @endif
                                        
                                    </div> 

                                    <div class="col-md-4">
                                        <h1 class="text-primary">INVOICE</h1>
                                        <div class="invoice_info">
                                            <h6 class="text-primary m-0 p-0">INVOICE# {{$invoice->id}} </h6> 
                                            <p><b>Issue Date</b> {{get_date($invoice->invoice_date)}}</p>
                                            <p><b>Due Date</b> {{get_date($invoice->due_date)}}</p>
                                        </div>

                                        <div class="invoice_reason">
                                            <h6 class="text-primary">FOR </h6> 
                                            <h6>{{@$invoice->title}} </h6> 
                                        </div>
                                    </div>
                                </div>  

                                <table id="datatable" class="table  dt-responsive nowrap fs-14" >
                                    <thead>
                                        <tr>
                                            <th><h6 class="text-primary">Description</h6></th>
                                            <th><h6 class="text-primary">Amount</h6></th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$invoice->description}} </td>
                                            <td>{{get_price($invoice->amount)}}</td>
                                        </tr>
                                        <tr>
                                            <td><h6>TOTAL</h6></td>
                                            <td><h6>{{get_price($invoice->amount)}}</h6></td>
                                        </tr>

                                        <tr>
                                            <td>  
                                                @if ($invoice->tax_amount>0)
                                                    <p class="mb-2">Vat & Tax</p>
                                                @endif  
                                                @if ($invoice->discount_amount>0)
                                                    <p>Discount</p>
                                                @endif  
                                            </td>
                                            <td>
                                                @if ($invoice->tax_amount>0)
                                                    <p class="mb-2">{{get_price(@$invoice->tax_amount)}}</p> 
                                                @endif 
                                                @if ($invoice->discount_amount>0)
                                                    <p>-{{get_price(@$invoice->discount_amount)}}</p> 
                                                @endif 
                                            </td>
                                        </tr> 

                                        <tr>
                                            <td><h6>GRAND TOTAL</h6></td>
                                            <td><h6>{{get_price($invoice->total_amount)}}</h6></td>
                                        </tr>
                                    </tbody>
                                </table>

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
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
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
@endsection