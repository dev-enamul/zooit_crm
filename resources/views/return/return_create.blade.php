@extends('layouts.dashboard')
@section('title','Project Return Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Project Return Entry</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Project Return Entry</li>
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
                                <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Old Customer Information</h6>
                                <hr>
                                <div class="row">  
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select id="customer_id" class="select2" search name="customer_id"> 
                                                @isset($customers)
                                                    <option value="">Select a Customer</option>
                                                    @foreach ($customers as $cstm)
                                                        <option value="{{ $cstm->customer_id }}" {{ isset($selected_data['customer']) || isset($lead->customer_id) == $cstm->id ? 'selected' : '' }}>
                                                            {{ @$cstm->customer->name }} ({{ $cstm->customer->customer_id}})
                                                        </option>
                                                    @endforeach
                                                @endisset   
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="mobile_no" class="form-label">Mobile No</label>
                                            <input class="form-control" type="text" value="" id="mobile_no" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="bokking_date" class="form-label">Booking Date</label>
                                            <input class="datepicker form-control w-100" type="text"  id="bokking_date" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="project_name" class="form-label">Project Name</label>
                                            <input class="form-control" type="text" name="project_name" id="project_name" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="declaration_value" class="form-label">Declaration Value</label>
                                            <input class="form-control" type="number" name="declaration_value"  id="declaration_value" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="sold_value" class="form-label">Sold Value</label>
                                            <input class="form-control" type="number"  id="sold_value" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="discount" class="form-label">Discount Amount</label>
                                            <input class="form-control" type="number" id="discount" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="total_deposit" class="form-label">Total Deposit Amount</label>
                                            <input class="form-control" type="number" id="total_deposit" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="due" class="form-label">Total DUE Amount</label>
                                            <input class="form-control" type="number" id="due" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit" class="form-label">Unit Name</label>
                                            <input class="form-control" type="text" id="unit" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_facility" class="form-label">Unit Facility</label>
                                            <input class="form-control" type="text"  id="unit_facility" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="floor" class="form-label">ON CHOICE Floor No</label>
                                            <input class="form-control" type="text"  id="floor" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_no" class="form-label">ON CHOICE Unit No</label>
                                            <input class="form-control" type="text" name="unit_no" value="" id="unit_no" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_category" class="form-label">Unit Type</label>
                                            <input class="form-control" type="text" id="unit_category" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="lottery" class="form-label">Lottery</label>
                                            <input class="form-control" type="text"  id="lottery" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="installment" class="form-label">Total Installment</label>
                                            <input class="form-control" type="text" name="installment" id="installment" disabled>
                                        </div>
                                    </div>
 
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="negotiation_person" class="form-label">Deduction Type </label>
                                            <select id="negotiation_person" class="select2" search name="negotiation_person">
                                                <option value="">Same Project</option> 
                                                <option value="">Another Project</option> 
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="deduction_amount" class="form-label">Deduction Amount</label>
                                            <input class="form-control" type="number" name="deduction_amount" value="3564" id="deduction_amount" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="transfer_fee" class="form-label">Sales Return Amount</label>
                                            <input class="form-control" type="number" name="transfer_fee" value="3564" id="transfer_fee" disabled>
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
        $('#customer_id').on('change', function() {
            getSalseInfo();
        });
    });

        function getSalseInfo(){ 
            var customer_id = $('#customer_id').val();
            if(customer_id != ''){
                $.ajax({
                    url: "{{route('get.salse.info')}}",
                    type: "GET",
                    data: {customer_id:customer_id},
                    success: function(response){
                        console.log(response.customer.user.phone);
                        $('#mobile_no').val(response.customer.user.phone);
                        $('#bokking_date').val(new Date(response.created_at).toLocaleDateString() );
                        $('#project_name').val(response.project.name);
                        $('#declaration_value').val(response.regular_amount);
                        $('#sold_value').val(response.sold_value);
                        $('#discount').val(response.regular_amount-response.sold_value);
                        $('#total_deposit').val(response.total_deposit);
                        $('#due').val(response.sold_value-response.total_deposit);
                        $('#unit').val(response.unit.title);
                        if(response.facility == 1){
                            $('#unit_facility').val("WithFinishing");
                        }else{
                            $('#unit_facility').val("WithoutFinishing");
                        } 
                        $('#floor').val(response.floor);
                        $('#unit_no').val(response.unit_category.title);

                        if(response.select_type==1){
                            $('#lottery').val("No");
                        }else{
                            $('#lottery').val("Yes"); 
                        } 
                        $('#installment').val(response.total_installment);
                        

                    }
                });
            }
        }
    </script>
@endsection