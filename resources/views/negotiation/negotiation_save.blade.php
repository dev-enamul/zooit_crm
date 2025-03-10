@extends('layouts.dashboard')
@section('title','Follow Up Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Negotiation Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Negotiation Entry</li>
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
                            @if(isset($negotiation))
                                <form action="{{route('negotiation.save',$negotiation->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input type="hidden" name="id" value="{{$negotiation->id}}">
                            @else
                                <form action="{{route('negotiation.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @endif
                                @csrf
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer</label>
                                            <select class="select2" search name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($selected_data['customer'])
                                                    <option value="{{ $selected_data['customer']->id }}" selected>
                                                        {{ $selected_data['customer']->name }} ({{ $selected_data['customer']->customer_id}})
                                                    </option>
                                                @endisset
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="purchase_possibility" class="form-label">Purchase Possibility<span class="text-danger">*</span></label>
                                            <select class="select2" name="purchase_possibility" id="purchase_possibility" required>
                                                @isset($purchase_possibilitys)
                                                    @foreach ($purchase_possibilitys as $id => $name)
                                                        <option value="{{ $id }}" {{ old('purchase_possibility', isset($follow) ? $follow->purchase_possibility : null) == $id || (isset($selected_data['purchase_possibility']) && $selected_data['purchase_possibility'] == $id) ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="negotiation_amount" class="form-label">Negotiation Amount<span class="text-danger">*</span></label>
                                             <input type="number" placeholder="Negotiation Amount" class="form-control" name="negotiation_amount" id="negotiation_amount" value="{{isset($negotiation) ? $negotiation->negotiation_amount : old('negotiation_amount')}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sales_date" class="form-label">Sales Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control datepicker w-100" name="sales_date" id="sales_date" required value="{{old('sales_date', @$negotiation->sales_date)}}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3" name="remark" placeholder="Enter Remark">{{isset($negotiation) ? $negotiation->remark : old('remark')}}</textarea>
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
            </div>
        </div>
    </div>
    @include('includes.footer')
</div>
@endsection

@section('script')
    @can('data-input-for-others')
        <script>
            $(document).ready(function() {
                $('#employee').select2({
                    placeholder: "Select Employee",
                    allowClear: true,
                    ajax: {
                        url: '{{ route('select2.employee') }}',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                term: params.term
                            }
                            return query;
                        }
                    }
                });
            });
        </script>
    @endcan

<script>
    $(document).ready(function() {
        $('#customer').select2({
            placeholder: "Select Customer",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.negotiation.customer') }}',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        term: params.term
                    }
                    return query;
                },
                success: function(data) {
                    get_customer_data();
                }
            }
        });
    });
</script> 

@endsection
