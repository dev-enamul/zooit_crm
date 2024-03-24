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
                            <form class="needs-validation" action="{{route('salse.store')}}" novalidate method="post">
                                @csrf 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="select2" search name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($selected_data['customer'])
                                                    <option value="{{ $selected_data['customer']->id }}" selected>
                                                        {{ $selected_data['customer']->name }} [{{ $selected_data['customer']->customer_id }}]
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
                                                <option data-display="Select a employee *" value="">
                                                    Select a employee
                                                </option>
                                                <option value="{{ auth()->user()->id }}" selected>
                                                    {{ auth()->user()->name }} ({{ auth()->user()->user_id }})
                                                </option>
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
                                            <label for="floor" class="form-label">Floor</label>
                                            <input type="number"  class="form-control"  name="floor" id="floor" placeholder="Enter Floor" >
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="unit_category_id" class="form-label">Unit Type</label>
                                        <select class="select2" name="unit_category_id" id="unit_category_id">
                                            <option data-display="Select a unit *" value="">
                                                Select a unit
                                            </option>
                                            @isset($units)
                                                @foreach ($unit_categories as $unit_category)
                                                    <option value="{{ $unit_category->id }}">
                                                        {{ $unit_category->title }}
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
                                                <option value="2" {{ isset($selected_data['select_type']) && $selected_data['select_type'] == 2 ? 'selected' : '' }}>Lottery</option> 
                                                <option value="1" {{ isset($selected_data['select_type']) && $selected_data['select_type'] == 1 ? 'selected' : '' }}>On Choice</option>
                                            </select> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_qty" class="form-label">Unit Qty <span class="text-danger">*</span></label>
                                            <input class="form-control" min="1"  type="number" name="unit_qty" id="unit_qty"   required> 
                                             
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
                                            <label for="regular_amount" class="form-label">Total Regular Price <span class="text-danger">*</span></label>
                                            <input type="number"  class="form-control" name="regular_amount" id="regular_amount" value="{{isset($sales) ? $sales->regular_amount : old('regular_amount')}}" readonly required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="project_unit" class="form-label">Project Unit Name<span class="text-danger">*</span></label>
                                            <select class="select2" multiple name="project_unit[]" id="project_unit_data" required>
                                                <option data-display="Select a project unit *" value="">
                                                    Select a  Project unit
                                                </option>
                                               
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="payment_duration" class="form-label">Payment Duration [month] <span class="text-danger">*</span></label>
                                             <input class="form-control" type="number" name="payment_duration" id="payment_duration" value="12" required> 
                                             <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Sold Price</label>
                                            <input type="number" class="form-control" name="sold_value" id="sold_value" value="{{ isset($sales) ? $sales->sold_value : old('sold_value') }}" required> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 
 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Discount</label>
                                            <input type="number" value="{{isset($sales) ? $sales->discount : old('discount')}}" class="form-control" name="discount" id="discount" readonly> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="booking" class="form-label">Booking <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="booking" id="booking" value="" required readonly>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="down_payment" class="form-label">Down Payment</label>
                                            <input type="number"  class="form-control" name="down_payment" id="down_payment" value="{{ isset($selected_data['down_payment']) ? $selected_data['down_payment'] : (isset($sales) ? $sales->down_payment : old('down_payment')) }}" readonly > 
                                             
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="first_payment" class="form-label">First Payment</label>
                                            <input type="number"  class="form-control" name="first_payment" id="first_payment" value="" >  
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="first_payment_date" class="form-label">First Payment Date</label>
                                            <input type="date"  class="form-control" name="first_payment_date" id="first_payment_date" value="" >  
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="total_due" class="form-label">Installment Due</label>
                                            <input type="number"  class="form-control" min="0" name="total_due" id="total_due" value="" readonly> 
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="installment_type" class="form-label">Installment Type<span class="text-danger">*</span></label>
                                            <select class="select2" name="installment_type" id="installment_type" required>
                                                <option value="">Select Installment Type</option>
                                                <option value="weekly">Weekly</option>
                                                <option value="bi-weekly">Bi-Weekly</option> 
                                                <option value="monthly" selected>Monthly</option>
                                                <option value="quarterly">Quarterly</option>
                                                <option value="semi-annually">Semi-Annually</option>
                                                <option value="annually">Annually</option> 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="total_installment" class="form-label">Total Installment <span class="text-danger">*</span>.</label>
                                            <input type="number" value="" class="form-control" name="total_installment" id="total_installment" readonly> 
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="installment_value" class="form-label">Installment Amount <span class="text-danger">*</span>.</label>
                                            <input type="number" min="0" value="{{ isset($sales) ? $sales->installment_value : old('installment_value') }}" class="form-control" name="installment_value" id="installment_value" readonly> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facility" class="form-label">Investment Package <span class="text-danger">*</span></label>
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="is_investment_package" id="invest_package" value="1">
                                                    <label class="form-check-label" for="invest_package">Yes</label>
                                                </div> 
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_investment_package" id="not_invest_package" value="0" checked="checked">
                                                    <label class="form-check-label" for="not_invest_package">No</label>
                                                </div>
                                            </div>
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
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div>  
 
                                </div>
                                  
                                <div class="text-end ">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
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
                    url: '{{ route('select2.salse.customer') }}',
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
            getUnitPrice();
            getBookingAndDownPayment();
            calculateInstallmentAmount();
            showHideUnitName();

            $('#unit').on('change', function() {
                getUnitPrice();
                getBookingAndDownPayment();
            });  

            $('#project').on('input change keyup', function() {
                getUnitPrice();
            });

            $('#floor').on('input change keyup', function() {
                getUnitPrice();
            });

            $('#unit_category_id').on('input change keyup', function() {
                getUnitPrice();
            });

            $('#unit_qty').on('input', function() {
                getTotalRegularAmount();
            });

            $('#unit_price').on('change', function() {
                getTotalRegularAmount();
            });

            $('#down_payment_pay').on('input', function() {
                    downPaymentDue();
            }); 

            $('#installment_type, #payment_duration, #sold_value, #select_type, #first_payment').on('change input keyup', function() {
                calculateInstallmentAmount();
            });


            $('#regular_amount, #sold_value').on('keyup', function() {
                var regularAmount = parseFloat($('#regular_amount').val()) || 0;
                var soldValue = parseFloat($('#sold_value').val()) || 0;
                var discount = regularAmount - soldValue;
                $('#discount').val(discount.toFixed(2));
            }); 


            $('#select_type').on('change', function() {
                showHideUnitName();
            });

            $('#project_unit_data').on('change', function() {
                totalSelectedPrice = 0;   
                $(this).find('option:selected').each(function() {
                    totalSelectedPrice += parseFloat($(this).attr('price') || 0); 
                });
                $('#regular_amount').val(totalSelectedPrice);
            }); 

        }); 

       
        function showHideUnitName(){
            var select_type = $('#select_type').val();
                if(select_type == 1){
                    $('#unit_qty').closest('.col-md-6').hide(); 
                    $('#unit_price').closest('.col-md-6').hide(); 
                    $('#project_unit_data').closest('.col-md-12').show();
                    $('#project_unit_data').prop('required', true);
                    $('#unit_qty').prop('required', false);
                }else{
                    $('#unit_qty').closest('.col-md-6').show(); 
                    $('#unit_price').closest('.col-md-6').show(); 
                    $('#project_unit_data').closest('.col-md-12').hide();
                    $('#project_unit_data').prop('required', false);
                    $('#unit_qty').prop('required', true);
                }
        }

        function downPaymentDue(){
                var down_payment = parseFloat($('#down_payment').val()) || 0;
                var down_payment_pay = parseFloat($('#down_payment_pay').val()) || 0;
                var due = down_payment - down_payment_pay;
                $('#down_payment_due').val(due.toFixed(2));
        }

        function getUnitPrice(){
            var formData = {
                    project_id: $("#project").val(),
                    unit_id: $("#unit").val(),
                    floor: $("#floor").val(),
                    unit_category_id: $("#unit_category_id").val(),
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
                                        text: project_unit.name+" #Floor:"+project_unit.floor+" #Type:"+project_unit.unit_category.title,
                                        price: data.most_highest_price,
                                    })
                                );
                            });
                        }   
                        $('#unit_qty').attr('max', data.project_unit.length);
                        $('#unit_price').val(data.most_highest_price);
                        $('#project_unit_data').trigger('change');
                        getTotalRegularAmount();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
        }

      
        function calculateInstallmentAmount() {
            var soldValue = parseFloat($('#sold_value').val()) || 0;
            var downPayment = parseFloat($('#down_payment').val()) || 0;
            var booking = parseFloat($('#booking').val()) || 0; 
            var first_payment = parseFloat($('#first_payment').val()) || 0;
            var totalAmount = soldValue - (downPayment + booking+ first_payment);
            var duration = parseInt($('#payment_duration').val()) || 0; // Ensure duration is an integer
            var installmentType = $('#installment_type').val(); 
            var installment = 0; 

            if(duration > 0 && installmentType) {
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
 
            var installmentAmount = installment !== 0 ? totalAmount / installment : 0; 
            $('#installment_value').val(installmentAmount.toFixed(2));
            $('#total_installment').val(parseInt(installment)); 
            $('#total_due').val(totalAmount.toFixed(2));
        }

        function getBookingAndDownPayment(){
            var down_payment = $("#unit option:selected").attr('down_payment');
            var booking = $("#unit option:selected").attr('booking');
            $('#down_payment').val(down_payment);
            $('#booking').val(booking); 
            downPaymentDue();
        }

        function getTotalRegularAmount(){
            var unit_qty = $("#unit_qty").val();
            var unit_price = $("#unit_price").val();
            var regular_amount = unit_qty * unit_price;
            $('#regular_amount').val(regular_amount);
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
                    url: "{{ route('get.negotiation.analysis.data') }}", 
                    success: function(data) {   
                        $('#priority').val(data.priority).select2();
                        $('#project').val(data.project_id).select2();
                        $('#unit').val(data.unit_id).select2();
                        $('#unit_qty').val(data.unit_qty);
                        $("#sold_value").val(data.negotiation_amount);
                        getUnitPrice();
                        getBookingAndDownPayment();
                        calculateInstallmentAmount();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            }
    </script>

@endsection