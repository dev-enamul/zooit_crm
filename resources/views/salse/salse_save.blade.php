@extends('layouts.dashboard')
@section('title','Salse Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Salse Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Salse Entry</li>
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
                                            <select class="select2" search name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($customers)
                                                    @foreach ($customers as $cstm)
                                                    <option value="{{ $cstm->customer_id }}" {{ isset($selected_data['customer']) || isset($sales->customer_id) == $cstm->customer_id ? 'selected' : '' }}>
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
                                                        <option value="{{ $employee->id }}" {{ old('employee', isset($sales) ? $sales->employee_id : null) == $employee->id || (isset($selected_data['employee']) && $selected_data['employee'] == $employee->id) ? 'selected' : '' }}>
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
                                        <label for="project" class="form-label">Project<span class="text-danger">*</span></label>
                                        <select class="form-select reset-data" name="project" id="project" required>
                                            <option data-display="Select a project *" value="">
                                                Select a Project
                                            </option>
                                            @isset($projects)
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" 
                                                        {{ (old('project', isset($sales) ? $sales->project_id : null) == $project->id || (isset($selected_data['project']) && $selected_data['project'] == $project->id)) ? 'selected' : '' }}>
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
                                                    <option value="{{ $unit->id }}" {{ old('unit', isset($sales) ? $sales->unit_id : null) == $unit->id || (isset($selected_data['unit']) && $selected_data['unit'] == $unit->id) ? 'selected' : '' }}>
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
                                                @isset($unit_prices)
                                                    @foreach ($unit_prices as $unit_p)
                                                        <option value="{{ $unit_p->id }}" {{ old('payment_duration', isset($sales) ? $sales->payment_duration : null) == $unit_p->id || (isset($selected_data['payment_duration']) && $selected_data['payment_duration']->id == $unit_p->id) ? 'selected' : '' }}>
                                                            {{ $unit_p->payment_duration }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>  
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="select_type" class="form-label">Select Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="select_type" id="select_type" required>
                                                <option value="">Select Type</option>
                                                <option value="1" {{ isset($selected_data['select_type']) && $selected_data['select_type'] == 1 ? 'selected' : '' }}>On Choice</option>
                                                <option value="2" {{ isset($selected_data['select_type']) && $selected_data['select_type'] == 2 ? 'selected' : '' }}>Lottery</option> 
                                            </select>
                                            
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="project_unit" class="form-label">Project Unit Name<span class="text-danger">*</span></label>
                                            <select class="select2" name="project_units[]" id="project_units" multiple required>
                                                <option value="">Select Project Units</option>
                                                @foreach ($projectUnits as $project_unit)
                                                    <option value="{{ $project_unit->id }}" {{ in_array($project_unit->id, $selected_data['project_units']) ? 'selected' : '' }}>
                                                        {{ $project_unit->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="booking" class="form-label">Booking</label>
                                            <input type="number" class="form-control" name="booking" id="booking" value="{{ isset($selected_data['booking']) ? $selected_data['booking'] : (isset($sales) ? $sales->booking : old('booking')) }}">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_amount" class="form-label"> Regular Amount</label>
                                            <input type="number"  class="form-control" name="regular_amount" id="regular_amount" value="{{isset($sales) ? $sales->regular_amount : old('regular_amount')}}"> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Sold Value</label>
                                            <input type="number" class="form-control" name="sold_value" id="sold_value" value="{{ isset($sales) ? $sales->sold_value : old('sold_value') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Discount</label>
                                            <input type="number" value="{{isset($sales) ? $sales->discount : old('discount')}}" class="form-control" name="discount" id="discount" disabled> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Down Payment</label>
                                            <input type="number"  class="form-control" name="down_payment" id="down_payment" value="{{ isset($selected_data['down_payment']) ? $selected_data['down_payment'] : (isset($sales) ? $sales->down_payment : old('down_payment')) }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Down Payment Pay</label>
                                            <input type="number" class="form-control" name="down_payment_pay" id="down_payment_pay" value="{{isset($sales) ? $sales->down_payment_pay : old('down_payment_pay')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Down Payment Due</label>
                                            <input type="number"  class="form-control" name="down_payment_due" id="down_payment_due" value="{{isset($sales) ? $sales->down_payment_due : old('down_payment_due')}}" readonly> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">Rest Down Payment Date</label>
                                            <input type="text" name="rest_down_payment" class="form-control datepicker w-100 p-1" id="rest_down_payment" placeholder="Rest Down Payment" required  value="{{isset($sales) ? $sales->rest_down_payment: old('rest_down_payment')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="installment_type" class="form-label">Installment Type<span class="text-danger">*</span></label>
                                            <select class="select2" name="installment_type" id="installment_type" required>
                                                <option value="">Select Installment Type</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="bi-weekly">Bi-Weekly</option> 
                                                <option value="monthly">Monthly</option>
                                                <option value="quarterly">Quarterly</option>
                                                <option value="semi-annually">Semi-Annually</option>
                                                <option value="annually">Annually</option> 
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="installment_value" class="form-label">Installment Amount <span class="text-danger">*</span>.</label>
                                            <input type="number" value="{{ isset($sales) ? $sales->installment_value : old('installment_value') }}" class="form-control" name="installment_value" id="installment_value" readonly> 
                                        </div>
                                    </div> 

                                   <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facility" class="form-label">Unit Facility <span class="text-danger">*</span></label>
                                            <select class="select2" name="facility" id="facility" required>
                                                @isset($facilities)
                                                    @foreach ($facilities as $id => $fac)
                                                        <option value="{{ $id }}" {{ old('facility', isset($sales) ? $sales->facility : null) == $id ? 'selected' : '' }}>
                                                            {{ $fac }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>  
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
            $('#regular_amount, #sold_value').on('input', function() {
                var regularAmount = parseFloat($('#regular_amount').val()) || 0;
                var soldValue = parseFloat($('#sold_value').val()) || 0;
                var discount = regularAmount - soldValue;
                $('#discount').val(discount.toFixed(2));
            });
            $('#down_payment, #down_payment_pay').on('input', function() {
                var down_payment = parseFloat($('#down_payment').val()) || 0;
                var down_payment_pay = parseFloat($('#down_payment_pay').val()) || 0;
                var discount1 = down_payment - down_payment_pay;
                $('#down_payment_due').val(discount1.toFixed(2));
            });

            $('#installment_type, #sold_value').on('input change', function() {
            var soldValue = parseFloat($('#sold_value').val()) || 0;
            var installmentType = $('#installment_type').val();
            var installmentValue = 0;

            if (soldValue > 0 && installmentType) {
                switch(installmentType) {
                    case 'weekly':
                        installmentValue = soldValue / 7;
                        break;
                    case 'bi-weekly':
                        installmentValue = soldValue / 15;
                        break;
                    case 'monthly':
                        installmentValue = soldValue / 30;
                        break;
                    case 'quarterly':
                        installmentValue = soldValue / 90;
                        break;
                    case 'semi-annually':
                        installmentValue = soldValue / 182;
                        break;
                    case 'annually':
                        installmentValue = soldValue / 365;
                        break;
                    default:
                        installmentValue = 0;
                        break;
                }
            }

            $('#installment_value').val(installmentValue.toFixed(2));
        });

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