@extends('layouts.dashboard')
@section('title','Installment Plan')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Invoice for <span class="text-primary">{{@$customer->user->name}} {{$customer->customer_id}}</span></h4>

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
                            <form class="needs-validation" action="{{route('instant.invoice.store')}}" novalidate method="post">
                                @csrf 
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <input type="hidden" name="project_id" value="{{$customer->project->id}}">
                                <div class="row">    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">
                                                <span id="title_label">Title</span><span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Invoice Title" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="due_date" class="form-label">
                                                <span id="due_date_label">Due Date</span><span class="text-danger">*</span>
                                            </label>
                                             <input type="date" name="due_date" value="{{ now()->addDays(10)->format('Y-m-d') }}" class="form-control" id="due_date" required>
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
                                                        <label for="reason" class="form-label">
                                                            <span id="reason_label">Reason</span><span class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" min="0" name="reason[]" value="{{$installment->amount}}" class="form-control" required>
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="amount" class="form-label">
                                                            <span id="amount_label">Install Date</span><span class="text-danger">*</span>
                                                        </label>
                                                        <input type="date" name="amount[]" value="{{$installment->payment_date}}" class="form-control" id="amount" required>
                                                        <div class="invalid-feedback">
                                                            This field is required.
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Remove button for only the first section -->
                                                <div class="col-12 text-end first-remove">
                                                    <button type="button" class="btn btn-danger btn-sm remove_installment">Remove</button>
                                                </div>
                                            </div> 
                                        @endforeach 
                                    @else   
                                        <div class="row installment_section"> 
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="reason" class="form-label">
                                                        <span id="reason_label">Reason</span><span class="text-danger" >*</span>
                                                    </label>
                                                    <input type="text" name="reason[]" class="form-control" placeholder="Enter reason" required>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">
                                                        <span id="amount_label">Amount</span><span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="amount[]" class="form-control" id="amount" placeholder="Enter amount" required>
                                                    <div class="invalid-feedback">
                                                        This field is required.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Remove button for only the first section -->
                                            <div class="col-12 text-end first-remove">
                                                <button type="button" class="btn btn-danger btn-sm remove_installment">Remove</button>
                                            </div>
                                        </div>
                                    @endif 
                                </div>
                                
                                <!-- Add Installment Button -->
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary" id="add_installment">+ Add Installment</button>
                                </div>

                                <div class="text-end ">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
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