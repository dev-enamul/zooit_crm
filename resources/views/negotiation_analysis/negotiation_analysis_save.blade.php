@extends('layouts.dashboard')
@section('title','Negotiation Analysis Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Negotiation Analysis Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Negotiation Analysis Entry</li>
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
                                <form action="{{route('negotiation-analysis.save',$negotiation->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                <input type="hidden" name="id" value="{{$negotiation->id}}">
                            @else 
                                <form action="{{route('negotiation-analysis.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                            @endif 
                                @csrf
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer</label>
                                            <select class="form-select" name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($customers)
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}" {{ old('customer', isset($negotiation) ? $negotiation->customer_id : null) == $customer->id ? 'selected' : '' }}>
                                                            {{ @$customer->customer->user->name }} ({{ $customer->customer->user->user_id}})
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
                                            <label for="employee" class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select class="select2" search name="employee" id="employee" required>
                                                <option data-display="Select a employee *" value="">
                                                    Select a employee
                                                </option>
                                                @isset($employees)
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}" {{ old('employee', isset($negotiation) ? $negotiation->employee_id : null) == $employee->id || (isset($selected_data['employee']) && $selected_data['employee'] == $employee->id) ? 'selected' : '' }}>
                                                            {{ $employee->name }} ({{ $employee->user_id}})
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
                                        <select class="form-select reset-data" name="project" id="project" required>
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
                                        
                                        @if ($errors->has('project'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('project') }}
                                            </span>
                                        @endif
                                    </div> 

                                    <div class="col-md-6 mb-3">
                                        <label for="unit" class="form-label">Unit Type <span class="text-danger">*</span></label>
                                        <select class="form-select reset-data" name="unit" id="unit" required>
                                            <option data-display="Select a unit *" value="">
                                                Select a unit
                                            </option>
                                            @isset($units)
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}" {{ old('unit', isset($negotiation) ? $negotiation->unit_id : null) == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->title }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('unit'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('unit') }}
                                            </span>
                                        @endif
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="payment_duration" class="form-label">Payment Duration <span class="text-danger">*</span></label>
                                            <select class="select2" name="payment_duration" id="payment_duration" required>
                                                
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="select_type" class="form-label">Select Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="select_type" id="select_type" required>
                                               
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="project_unit" class="form-label">Project Unit Name<span class="text-danger">*</span></label>
                                            <select class="select2" multiple name="project_unit" id="project_unit_data" required>
                                                <option data-display="Select a project unit *" value="">
                                                    Select a  Project unit
                                                </option>
                                                @isset($projectUnits)
                                                    @foreach ($projectUnits as $projectUnit)
                                                        <option value="{{ $projectUnit->id }}" {{ old('project_unit', isset($negotiation) ? $negotiation->unit_id : null) == $projectUnit->id ? 'selected' : '' }}>
                                                            {{ $projectUnit->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>  
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
                                            <label for="negotiation_amount" class="form-label"> Negotiation Amount</label>
                                             <input type="number" placeholder="Negotiation Amount" class="form-control" name="negotiation_amount" id="negotiation_amount" value="{{isset($negotiation) ? $negotiation->negotiation_amount : old('negotiation_amount')}}"> 
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_emotion" class="form-label"> Customer Emotion's</label>
                                             <input type="text" placeholder="Customer Emotion's" class="form-control" name="customer_emotion" id="customer_emotion"  value="{{isset($negotiation) ? $negotiation->customer_emotion : old('customer_emotion')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_preferance" class="form-label"> Customer Preference</label>
                                             <input type="text" placeholder="Customer Preference" class="form-control" name="customer_preferance" id="customer_preferance"  value="{{isset($negotiation) ? $negotiation->customer_preferance : old('customer_preferance')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="plan_b" class="form-label"> Have a Plan "B"</label>
                                             <input type="text" placeholder="Customer Plan B" class="form-control" name="plan_b" id="plan_b"  value="{{isset($negotiation) ? $negotiation->plan_b : old('plan_b')}}"> 
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
    @include('includes.footer') 
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#project").on("change", function() {
                var formData = {
                    id: $(this).val(),
                };

                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('get-project-duration-type-name') }}",

                    success: function(data) {
                        $("#unit").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select a unit *',
                            })
                        );
                        $("#payment_duration").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select a payment duration *',
                            })
                        );
                        $("#select_type").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select a type *',
                            })
                        );

                        if (data.unit_type.length) {
                            $.each(data.unit_type, function(i, unit) {
                                $("#unit").append(
                                    $("<option>", {
                                        value: unit.id,
                                        text: unit.title,
                                    })
                                );
                            });
                        }
                        if (data.payment_duration.length) {
                            $.each(data.payment_duration, function(i, payment_duration) {
                                $("#payment_duration").append(
                                    $("<option>", {
                                        value: payment_duration.id,
                                        text: payment_duration.payment_duration + ' months',
                                    })
                                );
                            });
                        }
                        if (data.payment_duration.length) {
                            $.each(data.payment_duration, function(i, payment_duration) {
                                var optionText = payment_duration.payment_duration + ' months - On Choice Price: ' + payment_duration.on_choice_price + ' - Lottery Price: ' + payment_duration.lottery_price;
                                $("#select_type").append(
                                    $("<option>", {
                                        value: payment_duration.id,
                                        text: optionText,
                                    })
                                );
                            });
                        }
                        if (data.project_unit.length) {
                            $.each(data.project_unit, function(i, project_unit) {
                                $("#project_unit_data").append(
                                    $("<option>", {
                                        value: project_unit.id,
                                        text: project_unit.name,
                                    })
                                );
                            });
                        }

                        $('#unit').trigger('change');
                        $('#payment_duration').trigger('change');
                        $('#select_type').trigger('change');
                        $('#project_unit_data').trigger('change');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });
        });

    </script>
@endsection