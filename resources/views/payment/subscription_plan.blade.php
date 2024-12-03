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
                                    <!-- Reason Field -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                                            <input 
                                                type="text" 
                                                name="reason" 
                                                class="form-control" 
                                                id="reason" 
                                                placeholder="What for this payment" 
                                                value="{{ old('reason', isset($payment) ? $payment->reason : '') }}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
                            
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
                            
                                    <!-- Amount Field -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                            <input 
                                                type="number" 
                                                name="amount" 
                                                class="form-control" 
                                                id="amount" 
                                                placeholder="Enter the amount" 
                                                value="{{ old('amount', isset($payment) ? $payment->amount : '') }}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
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
                            
                                    <!-- Remark Field -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea 
                                                class="form-control" 
                                                id="remark" 
                                                rows="3" 
                                                name="remark" 
                                                placeholder="Enter Remark">{{ old('remark', isset($payment) ? $payment->remark : '') }}</textarea>
                                        </div>
                                    </div>
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
<script>
    $(document).ready(function () { 
        $('#add_installment').on('click', function () { 
            const $installmentSection = $('.installment_section').first(); 
            const $newSection = $installmentSection.clone(); 
            $newSection.find('input').val('');  

            $('#installment_container').append($newSection); 
            $newSection.find('.remove_installment').on('click', function () {
                $(this).closest('.installment_section').remove();
            });
        }); 
        $(document).on('click', '.remove_installment', function () {
            $(this).closest('.installment_section').remove();
        });
    });  
 
</script> 


@endsection
 
