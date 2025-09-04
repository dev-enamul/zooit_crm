@extends('layouts.dashboard')
@section('title',"Deposit Create")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Invoice Payment</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Invoice Payment </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form class="needs-validation" method="post" action="{{route('deposit.store')}}" novalidate>
                                @csrf  
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="invoice_id" class="form-label">Invoice <span class="text-danger">*</span></label>
                                            <select class="form-select select2" search name="invoice_id" id="invoice_id" required @if ($selected_invoice) readonly @endif>
                                                @foreach ($invoices as $invoice)
                                                    <option {{@$selected_invoice->id==$invoice->id?"selected":""}} value="{{@$invoice->id}}"> INVOICE# {{@$invoice->id}} </option> 
                                                @endforeach
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div>  
                
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="amount" id="amount" class="form-control" min=".1" step=".1" required> 
                                        </div>
                                    </div>    

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Deposit Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" value="{{date('Y-m-d');}}" class="form-control" id="date" required> 
                                        </div>
                                    </div> 
                                </div>  

                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank_id" class="form-label">Bank <span class="text-danger">*</span></label>
                                            <select class="select2" name="bank_id" id="bank_id" required>
                                                <option value="">Select Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                @endforeach 
                                            </select> 

                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tnx_id" class="form-label">Tnx ID</label>
                                            <input type="text" name="tnx_id" class="form-control" id="tnx_id" > 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Remark</label>
                                            <textarea name="remark" class="form-control" id="" cols="30" rows="5"></textarea>
                                        </div>
                                    </div> 
                                    <div class="text-end ">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
                <!-- end col --> 
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

  @include('includes.footer')

</div>
@endsection 

@section('script')
    <script>
        var due = 0;
        $(document).ready(function(){ 
            getDue();
            $("#invoice_id").on('change',function(){
                getDue();
            });   
        }); 

        function getDue(){ 
            var formData = {
                invoice_id: $("#invoice_id").val(), 
            }; 
            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: "{{ route('get.invoice.due') }}", 
                success: function(data) { 
                    $("#amount").val(data.due); 
                    $("#amount").attr('max',data.due); 
                }, 
            });
        }
    </script>
@endsection