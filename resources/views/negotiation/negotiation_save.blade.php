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
                                    <div class="col-md-12">
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
                                            <label for="employee" class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select class="select2" search name="employee" id="employee" required>
                                                <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }} ({{ auth()->user()->user_id }})</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="priority" class="form-label">Priority<span class="text-danger">*</span></label>
                                            <select class="select2" name="priority" id="priority" required>
                                                @isset($priorities)
                                                    @foreach ($priorities as $id => $name)
                                                        <option value="{{ $id }}" {{ old('priority', isset($negotiation) ? $negotiation->priority : null) == $id || (isset($selected_data['priority']) && $selected_data['priority'] == $id) ? 'selected' : '' }}>
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
                                        <label for="project" class="form-label">Project<span class="text-danger">*</span></label>
                                        <select class="select2" name="project" id="project" required>
                                            <option data-display="Select a project *" value="">
                                                Select a Project
                                            </option>
                                            @isset($projects)
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ old('project', isset($negotiation) ? $negotiation->project_id : null) == $project->id ? 'selected' : '' }}>
                                                        {{ $project->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select> 
                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div>
                                    </div> 

                                    <div class="col-md-6 mb-3">
                                        <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                                        <select class="select2 reset-data" name="unit" id="unit" required>
                                            <option data-display="Select a unit *" value="">
                                                Select a unit
                                            </option>
                                            @isset($units)
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}" {{ old('unit', isset($lead) ? $lead->unit_id : null) == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->title }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select> 

                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_price" class="form-label"> Unit Price</label>
                                             <input type="number"  class="form-control" name="unit_price" id="unit_price" value="" readonly> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_qty" class="form-label"> Unit Qty <span class="text-danger">*</span></label>
                                             <input type="number"  class="form-control" name="unit_qty" id="unit_qty" value="1" min="1" required> 
                                        </div>
                                    </div>   

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_amount" class="form-label"> Regular Amount</label>
                                             <input type="number"  class="form-control" name="regular_amount" id="regular_amount" value="{{isset($negotiation) ? $negotiation->regular_amount : old('regular_amount')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="negotiation_amount" class="form-label"> Negotiation Amount <span class="text-danger">*</span></label>
                                             <input type="number" placeholder="Negotiation Amount" class="form-control" name="negotiation_amount" id="negotiation_amount" value="{{isset($negotiation) ? $negotiation->negotiation_amount : old('negotiation_amount')}}" required> 
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

<script>
    $(document).ready(function() { 
        $('#unit_price, #unit').on('change', function() {
            getUnitPrice(); 
        });

        $('#unit_qty, #unit_price').on('change', function() {
            getRegularPrice(); 
        });
    });

    var totalSelectedPrice = 0;

    function getUnitPrice(){
            var formData = {
                    project_id: $("#project").val(),
                    unit_id: $("#unit").val(), 
                };  
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('get-project-duration-type-name') }}", 
                    success: function(data) {
                        $('#unit_price').val(data.most_highest_price);  
                        getRegularPrice();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
        }

        function getRegularPrice(){
            $unit_qty = $('#unit_qty').val();
            $unit_price = $('#unit_price').val();
            $('#regular_amount').val($unit_qty * $unit_price);
    }
</script> 

 {{-- get old data  --}} 
 <script>   
    $(document).ready(function(){
        get_customer_data();
        $('#customer').on('change', function() {
            get_customer_data();
        });
    })
  function get_customer_data(){
        var formData = {
                customer_id: $("#customer").val()
            };  
            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: "{{ route('get.follow.up.analysis.data') }}", 
                success: function(data) {   
                    $('#priority').val(data.priority).select2();
                    $('#project').val(data.project_id).select2();
                    $('#unit').val(data.unit_id).select2();
                    $('#unit_qty').val(data.unit_qty);
                    $("#negotiation_amount").val(data.negotiation_amount);
                    getUnitPrice();
                },
                error: function(data) {
                    console.log('Error:', data);
                },
            });
    }
</script>

@endsection