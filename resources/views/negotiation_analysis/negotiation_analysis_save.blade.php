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
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="select2" search name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($customers)
                                                    @foreach ($customers as $cstm)
                                                        <option value="{{ $cstm->customer_id }}" {{ isset($selected_data['customer']) || isset($follow->customer_id) == $cstm->customer_id ? 'selected' : '' }}>
                                                            {{ @$cstm->customer->name }} ({{ $cstm->customer->customer_id}})
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
                                        
                                        @if ($errors->has('project'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('project') }}
                                            </span>
                                        @endif
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

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="project_unit" class="form-label">Project Unit Name<span class="text-danger">*</span></label>
                                            <select class="select2" multiple name="project_unit[]" id="project_unit_data" required>
                                                
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

                                    <div class="col-md-12">
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
        $("#unit").on("change", function() {
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
                    $("#project_unit_data").empty(); 

                    if (data.project_unit.length) {
                        $.each(data.project_unit, function(i, project_unit) {
                            $("#project_unit_data").append(
                                $("<option>", {
                                    value: project_unit.id,
                                    text: project_unit.name+" #Floor:"+project_unit.floor+" #Type:"+project_unit.unit_category.title+" ("+project_unit.highest_price+"Tk)",
                                    price: project_unit.highest_price,
                                })
                            );
                        });
                    } 
                    $('#project_unit_data').trigger('change');
                },
                error: function(data) {
                    console.log('Error:', data);
                },
            });
        });
    });

    var totalSelectedPrice = 0;

    $('#project_unit_data').on('change', function() {
        totalSelectedPrice = 0;   
        $(this).find('option:selected').each(function() {
            totalSelectedPrice += parseFloat($(this).attr('price') || 0); 
        });
        $('#regular_amount').val(totalSelectedPrice);
    }); 

    </script>
@endsection