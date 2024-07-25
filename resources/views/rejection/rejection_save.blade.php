@extends('layouts.dashboard')
@section('title','Rejection Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Rejection Reason Entry</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Rejection Reason Entry</li>
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
                            @if(isset($rejection))
                                <form action="{{route('rejection.save',$rejection->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                <input type="hidden" name="id" value="{{$rejection->id}}">
                            @else 
                                <form action="{{route('rejection.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                            @endif 
                                @csrf
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="select2" search name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">  Select a customer </option> 
                                                @if (isset($selected_data['customer']))
                                                    <option selected value="{{ $selected_data['customer']->id }}" > {{$selected_data['customer']->name}} [ {{$selected_data['customer']->customer_id}} ]</option>
                                                @endif 
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="rejection_reason" class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                            <select class="select2" search name="rejection_reason" id="rejection_reason" required>
                                                @foreach ($reject_reasons as $reason)
                                                    <option data-display="Select a reason *" value="{{$reason->id}}"> {{$reason->name}} </option> 
                                                @endforeach                                                
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 additional_info" id="price_capability_section">
                                        <div class="mb-3">
                                            <label for="customer_price_capability" class="form-label">Price Capability</label>
                                             <input type="number" class="form-control" name="customer_price_capability" id="customer_price_capability" min="0">
                                        </div>
                                    </div>

                                    <div class="col-md-6 additional_info" id="purchase_date_section">
                                        <div class="mb-3">
                                            <label for="possible_purchase_date" class="form-label">Possible Purchase Date </label>
                                             <input type="date" class="form-control" name="possible_purchase_date" id="possible_purchase_date">
                                        </div>
                                    </div>

                                    <div class="col-md-6 additional_info" id="competitor_information_section">
                                        <div class="mb-3">
                                            <label for="competitor_information" class="form-label">Competitor Information</label>
                                             <input type="text" class="form-control" name="competitor_information" id="competitor_information">
                                        </div>
                                    </div> 
                                   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark" placeholder="Enter Remark">{{isset($rejection) ? $rejection->remark : old('remark')}}</textarea>
                                        </div>
                                    </div> 
                                </div>
                                  
                                <div class="text-end ">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
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

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer> 
</div>
@endsection 

@section('script') 
<script>
    $(document).ready(function() {
        $('#customer').select2({
            placeholder: "Select Customer",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.rejection.customer') }}',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        term: params.term
                    }
                    return query;
                }
            }
        });

        $('.additional_info').hide();
        $('#rejection_reason').on('change',function(){
            var id = $(this).val();
            if(id==1 || id==2){
                $('#price_capability_section'.show());
            }
        });
    });
</script> 
@endsection