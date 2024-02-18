@extends('layouts.dashboard')
@section('title','Follow Up Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Follow Up Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Follow Up Entry</li>
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
                            <form class="needs-validation" novalidate>
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
                                                        <option value="{{ $customer->id }}" {{ old('customer', isset($cold_calling) ? $cold_calling->customer_id : null) == $customer->id ? 'selected' : '' }}>
                                                            {{ @$customer->user->name }} ({{ $customer->user->user_id}})
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
                                                        <option value="{{ $id }}" {{ old('media', isset($cold_calling) ? $cold_calling->priority : null) == $id ? 'selected' : '' }}>
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
                                                    <option value="{{ $unit->id }}" {{ old('unit', isset($cold_calling) ? $cold_calling->unit_id : null) == $unit->id ? 'selected' : '' }}>
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
                                                {{-- <option value="">Select Type</option>
                                                <option value="">On Choice</option>
                                                <option value="1">Lottery</option>  --}}
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="project_unit" class="form-label">Project Unit Name<span class="text-danger">*</span></label>
                                            <select class="select2" multiple name="project_unit" id="project_unit" required>
                                                <option data-display="Select a project unit *" value="">
                                                    Select a  Project unit
                                                </option>
                                                @isset($projectUnits)
                                                    @foreach ($projectUnits as $projectUnit)
                                                        <option value="{{ $projectUnit->id }}" {{ old('project_unit', isset($cold_calling) ? $cold_calling->unit_id : null) == $projectUnit->id ? 'selected' : '' }}>
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
                                             <input value="453545457" type="number"  class="form-control" name="regular_amount" id="regular_amount" disabled> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="negotiation_amount" class="form-label"> Negotiation Amount</label>
                                             <input type="number" placeholder="Negotiation Amount" class="form-control" name="negotiation_amount" id="negotiation_amount"> 
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3" name="remark" placeholder="Enter Remark"></textarea>
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
        // $(document).ready(function() {
        //     $("#project").on("change", function() {
        //         var url = $("#url").val();
        //         var formData = {
        //             id: $(this).val(),
        //         };
        //         // get district
        //         $.ajax({
        //             type: "GET",
        //             data: formData,
        //             dataType: "json",
        //             url: "{{ route('get-project-duration-type-name') }}",

        //             success: function(data) {
        //                 $("#unit").empty().append(
        //                     $("<option>", {
        //                         value: '',
        //                         text: 'Select option',
        //                     })
        //                 );

        //                 if (data.length) {
        //                     $.each(data, function(i, unit) {
        //                         $("#unit").append(
        //                             $("<option>", {
        //                                 value: unit.id,
        //                                 text: unit,
        //                             })
        //                         );
        //                         // $("#payment_duration").append(
        //                         //     $("<option>", {
        //                         //         value: duration.id,
        //                         //         text: duration.payment_duration,
        //                         //     })
        //                         // );
        //                         // $("#select_type").append(
        //                         //     $("<option>", {
        //                         //         value: type.id,
        //                         //         text: type,
        //                         //     })
        //                         // );
        //                         // $("#project_unit").append(
        //                         //     $("<option>", {
        //                         //         value: projectunitname.id,
        //                         //         text: projectunitname.name,
        //                         //     })
        //                         // );
        //                     });
        //                 }

        //                 $('#project').trigger('change');

                        
        //             },
        //             error: function(data) {
        //                 console.log('Error:', data);
        //             },
        //         });
        //     });

          
        // });

        $(document).ready(function() {
            $("#project").on("change", function() {
                var formData = {
                    id: $(this).val(),
                };

                // get district
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
                        $("#project_unit").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select a Project Unit *',
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
                                $("#project_unit").append(
                                    $("<option>", {
                                        value: project_unit.id,
                                        text: project_unit.name,
                                    })
                                );
                            });
                        }


                        // Trigger change event after populating options
                        $('#unit').trigger('change');
                        $('#payment_duration').trigger('change');
                        $('#select_type').trigger('change');
                        $('#project_unit').trigger('change');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });
        });

    </script>

    
@endsection