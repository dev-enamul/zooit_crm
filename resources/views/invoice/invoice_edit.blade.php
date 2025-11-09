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
                            <h4 class="mb-sm-0"> Invoice Details</h4>  
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                               <form action="{{ route('invoice.update', $invoice->id) }}" method="post">
                                @csrf
                                @method('PUT')
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
                                         
                                    </div> 

                                    <div class="col-md-4">
                                        <h1 class="text-primary">INVOICE</h1>
                                        <div class="invoice_info">
                                            <h6 class="text-primary m-0 p-0">INVOICE# {{$invoice->id}} </h6> 
                                            <p><b>Issue Date</b>
                                                <input type="date" name="invoice_date" id="" value="{{ date('Y-m-d', strtotime($invoice->invoice_date)) }}">
                                            </p> 
                                            <p><b>Due Date</b> <input type="date" name="due_date" id="" value="{{ date('Y-m-d', strtotime($invoice->due_date)) }}"></p>
                                        </div>

                                        <div class="invoice_reason">
                                            <h6 class="text-primary">FOR </h6> 
                                            <h6><input type="text" name="title" id="title" value="{{@$invoice->title}}"> </h6> 
                                        </div>
                                    </div>
                                </div>  

                                                                <table id="datatable" class="table dt-responsive nowrap fs-14">

                                                                    <thead>

                                                                        <tr>

                                                                            <th><h6 class="text-primary">Description</h6></th>

                                                                            <th><h6 class="text-primary">Amount</h6></th>

                                                                            <th><h6 class="text-primary">Action</h6></th>

                                                                        </tr>

                                                                    </thead>

                                                                    <tbody id="invoice-items">

                                                                        @if ($invoice->description != null)

                                                                            <tr>

                                                                                <td><input type="text" name="reason[]" class="form-control" value="{{ $invoice->description }}"></td>

                                                                                <td><input type="number" name="amount[]" class="form-control amount" value="{{ $invoice->amount }}"></td>

                                                                                <td><button type="button" class="btn btn-danger btn-sm remove-item">Remove</button></td>

                                                                            </tr>

                                                                        @else

                                                                            @php

                                                                                $details = $invoice->details;

                                                                            @endphp

                                                                            @if (isset($details) && count($details) > 0)

                                                                                @foreach ($details as $detail)

                                                                                    <tr>

                                                                                        <td><input type="text" name="reason[]" class="form-control" value="{{ $detail->reason }}"></td>

                                                                                        <td><input type="number" name="amount[]" class="form-control amount" value="{{ $detail->amount }}"></td>

                                                                                        <td><button type="button" class="btn btn-danger btn-sm remove-item">Remove</button></td>

                                                                                    </tr>

                                                                                @endforeach

                                                                            @endif

                                                                        @endif

                                                                    </tbody>

                                                                </table>

                                                                <button type="button" id="add-item" class="btn btn-primary btn-sm">Add New Item</button>

                                

                                                                <div class="row mt-4">

                                                                    <div class="col-md-6">

                                                                        <p class="mb-2">Vat & Tax</p>

                                                                        <p>Discount</p>

                                                                    </div>

                                                                    <div class="col-md-6 text-end">

                                                                        <input class="mb-2 form-control" type="number" min="0" name="tax_amount" id="tax_amount" value="{{ @$invoice->tax_amount }}">

                                                                        <input type="number" min="0" name="discount_amount" id="discount_amount" class="form-control" value="{{ @$invoice->discount_amount }}">

                                                                    </div>

                                                                </div>

                                

                                                                <div class="row mt-4">

                                                                    <div class="col-md-6"><h6>TOTAL</h6></div>

                                                                    <div class="col-md-6 text-end"><h6 id="total_amount">{{ get_price($invoice->amount) }}</h6></div>

                                                                </div>

                                

                                                                <div class="row mt-2">

                                                                    <div class="col-md-6"><h6>GRAND TOTAL</h6></div>

                                                                    <div class="col-md-6 text-end"><h6 id="grand_total">{{ get_price($invoice->total_amount) }}</h6></div>

                                                                </div>

                                

                                                                <button class="btn btn-primary mt-3">Update</button>

                                                               </form>

                                

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

                                        function calculateTotal() {

                                            let totalAmount = 0;

                                            $('.amount').each(function () {

                                                totalAmount += parseFloat($(this).val()) || 0;

                                            });

                                            $('#total_amount').text(`৳${totalAmount.toFixed(2)}`);

                                

                                            let taxAmount = parseFloat($("#tax_amount").val()) || 0;

                                            let discountAmount = parseFloat($("#discount_amount").val()) || 0;

                                            

                                            let grandTotal = totalAmount + taxAmount - discountAmount;

                                            $('#grand_total').text(`৳${grandTotal.toFixed(2)}`);

                                        }

                                

                                        $('#add-item').on('click', function () {

                                            $('#invoice-items').append(`

                                                <tr>

                                                    <td><input type="text" name="reason[]" class="form-control" placeholder="Enter Description"></td>

                                                    <td><input type="number" name="amount[]" class="form-control amount" placeholder="Enter Amount"></td>

                                                    <td><button type="button" class="btn btn-danger btn-sm remove-item">Remove</button></td>

                                                </tr>

                                            `);

                                            calculateTotal();

                                        });

                                

                                        $(document).on('click', '.remove-item', function () {

                                            $(this).closest('tr').remove();

                                            calculateTotal();

                                        });

                                

                                        $(document).on('keyup change', '.amount, #tax_amount, #discount_amount', function() {

                                            calculateTotal();

                                        });

                                

                                        calculateTotal();

                                    });

                                </script>

                                @endsection
