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
                                                <h6>{{@$invoice->user->name}}</h6>
                                                <p>{{@$invoice->user->userAddress->address}}</p> 
                                            </div>  
                                        </td>
                                        <td style="padding:0px 50px">
                                            @if ($invoice->status==0)
                                            <img src="https://t3.ftcdn.net/jpg/04/87/13/44/360_F_487134492_svhGzEgDXKyQuuPXQrs7prKoBYWCEJdw.jpg" alt="" width="100px">
                                            {{-- <br><a href="" class="btn btn-lg btn-secondary">Pay Now</a> --}}
                                            @else 
                                            <img src="https://png.pngtree.com/png-vector/20230208/ourmid/pngtree-paid-stamp-vector-illustration-png-image_6585127.png" alt="" width="100px">
                                        @endif
                                        </td>
                                        <td>
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
                                        </td>
                                    </tr>
                                </table>
                            

                                <table id="datatable" class="table  dt-responsive nowrap fs-14" >
                                    <thead>
                                        <tr>
                                            <th><h6 class="text-primary">Description</h6></th>
                                            <th><h6 class="text-primary">Amount</h6></th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($invoice->description!=null)
                                            <tr>
                                                <td>{{$invoice->description}} </td>
                                                <td>{{get_price($invoice->amount)}}</td>
                                            </tr> 
                                        @else 
                                            @php
                                                $details = $invoice->details;
                                            @endphp
                                            @if (isset($details) && count($details)>0)
                                                @foreach ($details as $detail)
                                                    <tr>
                                                        <td>{{$detail->reason}} </td>
                                                        <td>{{get_price($detail->amount)}}</td>
                                                    </tr> 
                                                @endforeach
                                            @endif
                                        @endif
                                        

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

                                <table>
                                    <tr>
                                        <td>
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
                                        </td>
                                        
                                    </tr>
                                   
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
    </div> 

      <div class="modal fade" id="edit_modal">
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
                        {{-- <a id="whatsAppButton" href="" target="blank" class="btn btn-primary"><i class="fab fa-whatsapp"></i> Send WhatsApp</a> --}}
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
        // var whatsappLink = "https://api.whatsapp.com/send/?phone=+88"+phone+"&text="+link;
        // $("#whatsAppButton").attr('href',whatsappLink);
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
