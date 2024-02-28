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
                                        <select class="select2" search name="project" id="project" required>
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
                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div>
                                    </div> 
                                    <div class="col-md-6 mb-3">
                                        <label for="unit" class="form-label">Unit Type <span class="text-danger">*</span></label>
                                        <select class="select2" name="unit" id="unit" required>
                                            <option data-display="Select a unit *" value="">
                                                Select a unit
                                            </option>
                                            @isset($units)
                                                @foreach ($units as $unit)
                                                    <option booking="{{$unit->booking}}" down_payment="{{$unit->down_payment}}" value="{{ $unit->id }}" {{ old('unit', isset($sales) ? $sales->unit_id : null) == $unit->id || (isset($selected_data['unit']) && $selected_data['unit'] == $unit->id) ? 'selected' : '' }}>
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
                                            <label for="select_type" class="form-label">Select Type <span class="text-danger">*</span></label>
                                            <select class="select2" name="select_type" id="select_type" required>
                                                <option value="1" {{ isset($selected_data['select_type']) && $selected_data['select_type'] == 1 ? 'selected' : '' }}>On Choice</option>
                                                <option value="2" {{ isset($selected_data['select_type']) && $selected_data['select_type'] == 2 ? 'selected' : '' }}>Lottery</option> 
                                            </select> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_qty" class="form-label">Unit Qty <span class="text-danger">*</span></label>
                                             <input class="form-control" min="1" type="number" name="unit_qty" id="unit_qty" value="1" required> 
                                        </div>
                                    </div>   

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_price" class="form-label">Unit Price <span class="text-danger">*</span></label>
                                            <input type="number"  class="form-control" name="unit_price" id="unit_price" value="{{isset($sales) ? $sales->regular_amount : old('regular_amount')}}" readonly> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_amount" class="form-label"> Total Regular Price <span class="text-danger">*</span></label>
                                            <input type="number"  class="form-control" name="regular_amount" id="regular_amount" value="{{isset($sales) ? $sales->regular_amount : old('regular_amount')}}" readonly> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="payment_duration" class="form-label">Payment Duration [month] <span class="text-danger">*</span></label>
                                             <input class="form-control" type="number" name="payment_duration" id="payment_duration" value="12" required> 
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Sold Price</label>
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
                                            <label for="booking" class="form-label">Booking <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="booking" id="booking" value="" required readonly>
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
                                            <label for="total_installment" class="form-label">Total Installment <span class="text-danger">*</span>.</label>
                                            <input type="number" value="" class="form-control" name="total_installment" id="total_installment" readonly> 
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
        });  

        $(document).ready(function() {
            getUnitPrice();
            getBookingAndDownPayment();
            calculateInstallmentAmount();
        }); 

        $('#unit').on('change', function() {
            getUnitPrice();
            getBookingAndDownPayment();
        }); 
        $('#project').on('change', function() {
            getUnitPrice();
        });

        $('#unit_qty').on('input', function() {
             getTotalRegularAmount();
        });

        $('#unit_price').on('change', function() {
            getTotalRegularAmount();
        });

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
                        $('#unit_price').val(data.most_highest_price);
                        $('#project_unit_data').trigger('change');
                        getTotalRegularAmount();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
        }

     
    $('#installment_type').on('change', function() {
        calculateInstallmentAmount();
    });

    function calculateInstallmentAmount() {  
        var soldValue = parseFloat($('#sold_value').val()) || 0;
        var downPayment = parseFloat($('#down_payment').val()) || 0;
        var booking = parseFloat($('#booking').val()) || 0; 
        var totalAmount = soldValue - (downPayment + booking);
        var duration = $('#payment_duration').val()|| 0;
        var installmentType = $('#installment_type').val(); 
        var installment = 0

        if(duration > 0 && totalAmount > 0 && installmentType) {
            switch(installmentType) {
                case 'weekly': 
                    installment = duration * 4;
                    break;
                case 'bi-weekly':  
                    installment = duration * 2;
                    break;
                case 'monthly': 
                    installment = duration;
                    break;
                case 'quarterly': 
                    installment = duration/3;
                    break;
                case 'semi-annually': 
                    installment = duration/6;
                    break;
                case 'annually': 
                    installment = duration/12;
                    break;
            } 
        } 
        var installmentAmount = totalAmount/installment;
        $('#installment_value').val(installmentAmount.toFixed(2));
        $('#total_installment').val(installment);
    }

        function getBookingAndDownPayment(){
            var down_payment = $("#unit option:selected").attr('down_payment');
            var booking = $("#unit option:selected").attr('booking');
            $('#down_payment').val(down_payment);
            $('#booking').val(booking);
        }

        function getTotalRegularAmount(){
            var unit_qty = $("#unit_qty").val();
            var unit_price = $("#unit_price").val();
            var regular_amount = unit_qty * unit_price;
            $('#regular_amount').val(regular_amount);
        }

    </script>
@endsection