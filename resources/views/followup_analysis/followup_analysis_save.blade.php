@extends('layouts.dashboard')
@section('title','Follow Up Analysis Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Follow Up Analysis Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Follow Up Analysis Entry</li>
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
                            @if(isset($followUp))
                                <form action="{{route('follow-up-analysis.save',$followUp->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input type="hidden" name="id" value="{{$followUp->id}}">
                            @else
                                <form action="{{route('follow-up-analysis.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @endif
                            @csrf
                                <div class="row">
                                    @if (isset($selected_data['customer']) && $selected_data['customer'] != null)
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Reference</label>
                                                <input type="text" value="{{ $selected_data['customer']->reference->name??'' }}" disabled class="form-control"  >
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-{{ (isset($selected_data['customer']) && $selected_data['customer'] != null) ? '6' : '12' }}">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="select2" search name="customer" id="customer" required>

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
                                                        <option value="{{ $id }}" {{ old('priority', isset($follow) ? $follow->priority : null) == $id || (isset($selected_data['priority']) && $selected_data['priority'] == $id) ? 'selected' : '' }}>
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
                                        <select class="form-select reset-data" name="project" id="project" required>
                                            <option data-display="Select a project *" value="">
                                                Select a Project
                                            </option>
                                            @isset($projects)
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ old('project', isset($cold_calling) ? $cold_calling->project_id : null) == $project->id ? 'selected' : '' }}>
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
                                        <select class="form-select reset-data" name="unit" id="unit" required>
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
                                             <input type="number"  class="form-control" name="unit_qty" id="unit_qty" value="{{old('unit_price',$followUp->unit_price??'1')}}" min="1" required>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_amount" class="form-label"> Regular Amount</label>
                                             <input type="number"  class="form-control" name="regular_amount" id="regular_amount" value="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="negotiation_amount" class="form-label"> Negotiation Amount <span class="text-danger">*</span></label>
                                             <input type="number" placeholder="Negotiation Amount" class="form-control" name="negotiation_amount" id="negotiation_amount" value="{{old('negotiation_amount',$followUp->negotiation_amount??0)}}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_expectation" class="form-label"> Customer's Expectation</label>
                                             <input type="text" placeholder="Customer Expectation" class="form-control" name="customer_expectation" id="customer_expectation" value="{{old('customer_expectation',$followUp->customer_expectation??'')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_need" class="form-label"> Need</label>
                                             <input type="text" placeholder="Customer Need" class="form-control" name="customer_need" id="customer_need" value="{{old('need',$followUp->need??'')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_ability" class="form-label"> Ability</label>
                                             <input type="text" placeholder="Customer Ability" class="form-control" name="customer_ability" id="customer_ability"  value="{{old('ability',$followUp->ability??'')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="influencer_opinion" class="form-label"> Influencer Opinion</label>
                                             <input type="text" placeholder="Influncer Opinion" class="form-control" name="influencer_opinion" id="influencer_opinion" value="{{old('influencer_opinion',$followUp->influencer_opinion??'')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="descision_maker" class="form-label"> Decision Maker</label>
                                             <input type="text" placeholder="Enter Decision Maker" class="form-control" name="descision_maker" id="descision_maker" value="{{old('decision_maker',$followUp->decision_maker??'')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="decision_maker_opinion" class="form-label"> Decision Maker Opinion</label>
                                             <input type="text" placeholder="Decision Maker Opinion" class="form-control" name="decision_maker_opinion" id="decision_maker_opinion" value="{{old('decision_maker_opinion',$followUp->decision_maker_opinion??'')}}">
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
                    url: '{{ route('select2.followup_analysis.customer') }}',
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
                    url: "{{ route('get.follow.up.data') }}",
                    success: function(data) {
                        $('#priority').val(data.priority);
                        $('#project').val(data.project_id);
                        $('#unit').val(data.unit_id);
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
