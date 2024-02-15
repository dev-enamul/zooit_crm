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
                                            <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="form-select select2" search name="customer_id" id="customer_id" required>
                                                @foreach ($customers as $data)
                                                    <option value="{{$data->id}}">{{$data->name}} [{{$data->customer_id}}] [{{$data->user->phone}}]</option>
                                                @endforeach
                                            </select>    
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="deposit_category_id" class="form-label">Deposit Category <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="deposit_category_id" id="deposit_category_id" required>
                                                <option value="0">Regular Deposit</option>
                                                @foreach($deposit_categories as $data)
                                                    <option {{$data->id==1?"selected":""}} value="{{$data->id}}">{{$data->name}}</option>
                                                @endforeach 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="amount" class="form-control" id="" min="0" placeholder="0" required> 
                                        </div>
                                    </div>   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Deposit Date <span class="text-danger">*</span></label>
                                            <input type="text" name="date" class="datepicker w-100" id="date" min="0" value="{{date('m/d/Y')}}" required> 
                                        </div>
                                    </div>

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
                                            <label for="cheque_no" class="form-label">Cheque No </label>
                                            <input type="text" name="cheque_no" class="form-control" id="cheque_no" > 
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