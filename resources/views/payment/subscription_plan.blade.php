@extends('layouts.dashboard')
@section('title','Subscription Plan')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Subscription Payment</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Subscription Payment</li>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" action="{{ route('service.payment.store') }}" novalidate method="post">
                                @csrf  
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <div class="row"> 
                            
                                    <!-- Payment Type Field -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="package_type" class="form-label">Payment Type</label>
                                            <select class="form-select select2" name="package_type" id="package_type">
                                                <option value="1" {{ old('package_type', isset($payment) && $payment->package_type == 1 ? 'selected' : '') }}>Yearly</option>
                                                <option value="2" {{ old('package_type', isset($payment) && $payment->package_type == 2 ? 'selected' : '') }}>Monthly</option>
                                            </select>
                                        </div>
                                    </div> 
                            
                                    <!-- Start From Field -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="start_from" class="form-label">Start From <span class="text-danger">*</span></label>
                                            <input 
                                                type="date" 
                                                name="start_from" 
                                                class="form-control" 
                                                id="start_from" 
                                                value="{{ old('start_from', isset($payment) ? $payment->next_payment_date : '') }}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
                            
                                    @php
                                        $details = @$payment->details;
                                    @endphp 
                                    @if (isset($details) && count($details)>0)
                                        @foreach ($details as $detail) 
                                            <div id="payment-fields">
                                                <!-- Reason and Amount Input Template -->
                                                <div class="row payment-field-row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                                                            <input 
                                                                value="{{$detail->reason}}"
                                                                type="text" 
                                                                name="reason[]" 
                                                                class="form-control" 
                                                                placeholder="What for this payment">
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                                            <input 
                                                                value="{{$detail->amount}}"
                                                                type="number" 
                                                                name="amount[]" 
                                                                class="form-control" 
                                                                placeholder="Enter the amount">
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-12 text-end">
                                                        <button type="button" class="btn btn-danger remove-payment-field">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>  

                                            <div class="col-md-12 mb-3 text-center">
                                                <button type="button" class="btn btn-primary" id="add-payment-field">
                                                    <i class="fas fa-plus"></i> Add Another Payment
                                                </button>
                                            </div>
                                        @endforeach
                                    @else 
                                        <div id="payment-fields">
                                            <!-- Reason and Amount Input Template -->
                                            <div class="row payment-field-row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                                                        <input 
                                                            type="text" 
                                                            name="reason[]" 
                                                            class="form-control" 
                                                            placeholder="What for this payment">
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                                        <input 
                                                            type="number" 
                                                            name="amount[]" 
                                                            class="form-control" 
                                                            placeholder="Enter the amount">
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-12 text-end">
                                                    <button type="button" class="btn btn-danger remove-payment-field">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                 
                                        <div class="col-md-12 mb-3 text-center">
                                            <button type="button" class="btn btn-primary" id="add-payment-field">
                                                <i class="fas fa-plus"></i> Add Another Payment
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            
                                <!-- Submit Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> {{ isset($payment) ? 'Update' : 'Submit' }}
                                    </button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Add a new set of reason and amount fields
        $('#add-payment-field').on('click', function () {
            var newFields = `
                <div class="row payment-field-row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="reason[]" 
                                class="form-control" 
                                placeholder="What for this payment">
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input 
                                type="number" 
                                name="amount[]" 
                                class="form-control" 
                                placeholder="Enter the amount">
                            <div class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>
                    </div> 
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-danger remove-payment-field">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                </div>
            `;
            $('#payment-fields').append(newFields);
        });

        // Remove a payment field row
        $(document).on('click', '.remove-payment-field', function () {
            $(this).closest('.payment-field-row').remove();
        });
    });
</script>
@endsection
