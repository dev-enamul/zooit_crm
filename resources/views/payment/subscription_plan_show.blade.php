@extends('layouts.dashboard')
@section('title','Subscription Plan')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <a href="{{route('service.payment.edit',encrypt($payment->id))}}" class="btn btn-primary">Edit</a>
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
                            <form class="needs-validation"novalidate method="post"> 
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <div class="row"> 

                                     <!-- Payment Type Field -->
                                     <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="package_type" class="form-label">Payment Type</label>
                                            <select disabled class="form-select select2" name="package_type" id="package_type">
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
                                                disabled
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
                                    <!-- Reason Field -->
                                    @php
                                        $details = $payment->details;
                                    @endphp 
                                    @if (isset($details) && count($details)>0) 
                                        @foreach ($details as $detail)
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="reason" class="form-label">Reason <span class="text-danger">*</span></label>
                                                    <input 
                                                        disabled
                                                        type="text" 
                                                        name="reason" 
                                                        class="form-control" 
                                                        id="reason" 
                                                        placeholder="What for this payment" 
                                                        value="{{ $detail->reason}}"> 
                                                </div>
                                            </div> 
                                    
                                            <!-- Amount Field -->
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                                    <input 
                                                        disabled
                                                        type="number" 
                                                        name="amount" 
                                                        class="form-control" 
                                                        id="amount" 
                                                        placeholder="Enter the amount" 
                                                        value="{{ $detail->amount}}">
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach 
                                    @endif  
                                    <!-- Remark Field -->
                                    {{-- <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea 
                                                disabled
                                                class="form-control" 
                                                id="remark" 
                                                rows="3" 
                                                name="remark" 
                                                placeholder="Enter Remark">{{ old('remark', isset($payment) ? $payment->remark : '') }}</textarea>
                                        </div>
                                    </div> --}}
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
 
 
