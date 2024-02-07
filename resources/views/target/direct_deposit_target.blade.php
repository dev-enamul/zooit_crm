@extends('layouts.dashboard')
@section('title',"Monthly Deposit Target")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Monthly Deposit Target </h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Monthly Deposit Target</li>
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12"> 
                    <form class="needs-validation" method="POST" action="{{route('deposit.target.save')}}" novalidate>
                        @csrf  
                        <div class="card"> 
                            <div class="card-body"> 
                                    <div class="row">  
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="assign_to" class="form-label">Assign To <span class="text-danger">*</span></label>
                                                <select class="form-select" name="assign_to" id="assign_to" required>
                                                    <option value="">Select Employee</option>
                                                    @foreach ($employees as $key => $item)
                                                        <option {{$key==0?"selected":""}} value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> 
 

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="new_deposit" class="form-label">New Deposit <span class="text-danger">*</span></label>
                                                <input type="number" name="new_deposit" id="new_deposit" min="0" class="form-control" placeholder="0" required> 
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="existing_deposit" class="form-label">Existing Deposit <span class="text-danger">*</span></label>
                                                <input type="number" name="existing_deposit" id="existing_deposit" min="0" class="form-control" placeholder="o" required> 
                                            </div>
                                        </div> 
                                    </div>  
                            </div> 

                            <div class="card-footer">
                                <div class="text-end">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger refresh_btn" type="submit"><i class="mdi mdi-refresh"></i> Reset</button>
                                </div> 
                            </div> 
                        </div>   
                    </form>
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

  @include('includes.footer')

</div>
@endsection