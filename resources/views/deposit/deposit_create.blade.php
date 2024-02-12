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
                    <div class="card"> p
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                                <div class="row"> 
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="form-select select2" sear name="customer" id="customer" required>
                                                <option value="">Select Customer</option>
                                                <option value="1">Md Jamil Hossain #24545</option>
                                                <option value="2">Sarah Johnson #12345</option>
                                                <option value="3">Alex Williams #67890</option>
                                                <option value="4">Emily Davis #98765</option>
                                                <option value="5">Michael Wilson #54321</option>
                                                <option value="6">Sophia Miller #13579</option>
                                                <option value="7">William Jones #24680</option>
                                                <option value="8">Olivia Brown #11223</option>
                                                <option value="9">Liam Taylor #33445</option>
                                                <option value="10">Emma Anderson #55667</option>
                                            </select>  
                                        </div>
                                    </div>  
                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="deposit_category" class="form-label">Deposit Category <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="deposit_category" id="deposit_category" required>
                                                <option value="">Select Deposit Category</option>
                                                @foreach($deposit_categories as $data)
                                                    <option {{$data->id==1?"selected":""}} value="{{$data->id}}">{{$data->name}}</option>
                                                @endforeach 
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Amount <span class="text-danger">*</span></label>
                                            <input type="number" name="amount" class="form-control" id=""> 
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Remark <span class="text-danger">*</span></label>
                                            <textarea name="remark" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div> 
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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