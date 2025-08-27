@extends('layouts.dashboard')
@section('title','Salse Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        {{-- <h4 class="mb-sm-0">
                            <a href="{{route('install.payment.edit',encrypt($customer->id))}}" class="btn btn-primary">Edit</a>
                        </h4> --}}

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Installment Payment</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" action="{{route('install.payment.store')}}" novalidate method="post">
                                @csrf 
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <div class="row">    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">
                                                <span id="customer_label">Customer</span><span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="customer" class="form-control" id="customer" value="{{@$customer->user->name}}  [{{$customer->customer_id}}]" disabled>
                                        </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">
                                                <span id="price_label">Price</span><span class="text-danger">*</span>
                                            </label>
                                            <input type="hidden" name="total_price" id="total_price" value="{{@$customer->project->price}}">
                                            <input type="number" name="price" class="form-control" id="price" value="{{@$customer->project->price}}" disabled>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>   
                                </div> 
                                
                                <!-- Section to repeat -->
                                <div id="installment_container"> 
                                    @if (isset($installments) && count($installments)>0)
                                        @foreach ($installments as $installment)
                                            <div class="row installment_section"> 
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="installment_amount" class="form-label">
                                                            <span id="installment_amount_label">Install Amount</span><span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" min="0" name="installment_amount[]" value="{{$installment->amount}}" class="form-control" disabled>
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="installment_date" class="form-label">
                                                            <span id="installment_date_label">Install Date</span><span class="text-danger">*</span>
                                                        </label>
                                                        <input type="date" name="installment_date[]" value="{{$installment->payment_date}}" class="form-control" id="installment_date" disabled>
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        @endforeach  
                                    @endif 
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
 
 
