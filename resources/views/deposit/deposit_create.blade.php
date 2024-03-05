@extends('layouts.dashboard')
@section('title',"Deposit Create")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Deposit Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Deposit Entry </li>
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
                            <form class="needs-validation" method="post" action="{{route('deposit.store')}}" novalidate>
                                @csrf
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="deposit_category_id" class="form-label">Deposit Category <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="deposit_category_id" id="deposit_category_id" required>
                                                @foreach($deposit_categories as $data)
                                                    <option {{$data->id==1?"selected":""}} value="{{$data->id}}"> {{$data->name}} </option>
                                                @endforeach 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="form-select select2" search name="customer_id" id="customer_id" required>
                                             
                                            </select>    
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select class="select2" search name="employee_id" id="employee_id" required>
                                                <option data-display="Select a employee *" value="">
                                                    Select a employee
                                                </option>
                                                @isset($employees)
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}" {{ (old('employee_id') == $employee->id) || (auth()->id() == $employee->id) ? 'selected' : '' }}>
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
                                            <label for="customer" class="form-label">Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="amount" id="amount" class="form-control" min="1" placeholder="0" required> 
                                        </div>
                                    </div>   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Deposit Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" class="form-control" id="date" required> 
                                        </div>
                                    </div> 
                                </div>
                                <div class="row" id="down_payment_due_section">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="down_payment_due" class="form-label">Down Payment Due</label>
                                            <input type="number" name="down_payment_due" id="down_payment_due" class="form-control" min="0" placeholder="0" readonly> 
                                        </div>
                                    </div>    

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="rest_down_payment_date" class="form-label">Due Payment Date </label>
                                            <input type="date" name="rest_down_payment_date" class="form-control" id="rest_down_payment_date"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank_id" class="form-label">Bank <span class="text-danger">*</span></label>
                                            <select class="select2" name="bank_id" id="bank_id" required>
                                                <option value="">Select Bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                @endforeach 
                                            </select> 

                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tnx_id" class="form-label">Tnx ID</label>
                                            <input type="text" name="tnx_id" class="form-control" id="tnx_id" > 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Remark</label>
                                            <textarea name="remark" class="form-control" id="" cols="30" rows="5"></textarea>
                                        </div>
                                    </div> 
                                    <div class="text-end ">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                                    </div>
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
        var due = 0;
        $(document).ready(function(){ 
            getCustomer();
            $("#deposit_category_id").on('change',function(){
                getCustomer();
            });

            $("#customer_id").on('change',function(){
                getDue();
            });  
            $("#down_payment_due_section").hide(); 
            $("#amount").on('keyup input change', function(){  
                var amount = parseFloat($(this).val()); 
                var deposit_category_id = $("#deposit_category_id").val(); 
                if(deposit_category_id == 2){  
                    if(!isNaN(amount) && amount < due){ 
                        console.log("Condition met:", deposit_category_id, amount, due);
                        $("#down_payment_due_section").show();
                        $("#down_payment_due").val(due - amount);
                    } else { 
                        $("#down_payment_due_section").hide();
                    }
                }
            });
        });

        function getCustomer(){
            var formData = {
                deposit_category: $("#deposit_category_id").val(),
            }; 
            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: "{{ route('get.customer.form.deposit.category') }}", 
                success: function(data) {
                    $("#customer_id").empty();  

                    if (data.customers.length) {
                        $.each(data.customers, function(i, customer) {
                            $("#customer_id").append(
                                $("<option>", {
                                    value: customer.id,
                                    text: customer.name+" ["+customer.customer_id+"]", 
                                })
                            );
                        });
                    }   
                    $('#customer_id').trigger('change');
                    getDue(); 
                },
                error: function(data) {
                    console.log('Error:', data);
                },
            });
        }

        function getDue(){
            var deposit_category_id = $("#deposit_category_id").val();
            var formData = {
                customer_id: $("#customer_id").val(),
                deposit_category_id: deposit_category_id,
            }; 
            $.ajax({
                type: "GET",
                data: formData,
                dataType: "json",
                url: "{{ route('get.customer.due') }}", 
                success: function(data) {   
                    $("#amount").val(data.due);  
                    $("#date").val(data.payment_date);

                    if(deposit_category_id==1||deposit_category_id==3){
                        $("#amount").attr('readonly',true);
                    }else{
                        $("#amount").attr('readonly',false); 
                    }
                    due = data.due; 
                },
                error: function(data) {
                    console.log('Error:', data);
                },
            });
        }
    </script>
@endsection