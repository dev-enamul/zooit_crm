@extends('layouts.dashboard')
@section('title',"Training Create") 

@section('style')
    <link rel="stylesheet" href="{{asset('assets/libs/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Training Create</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Training Create</li>
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
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="training_name" class="form-label">Training Name <span class="text-danger">*</span></label>
                                            <input type="text" name="training_name" class="form-control" id="training_name" placeholder="First name" value="" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date_time" class="form-control" id="date" placeholder="Select Date Time" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                                            <input type="time" name="date_time" class="form-control " id="time" placeholder="Select Date Time" value="" required>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="seat_qty" class="form-label">Seat Qty <span class="text-danger">*</span></label>
                                            <input type="text" name="seat_qty" class="form-control" id="seat_qty" placeholder="First name" value="" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession" class="form-label">Trainer<span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="profession" id="profession" required>
                                                <option value="">Select Trainer</option>
                                                <option value="1">Dr. Jon #867666</option>
                                                <option value="2">Dr. Smith #123456</option>
                                                <option value="3">Dr. Anderson #789012</option>
                                                <option value="4">Dr. Miller #345678</option>
                                                <option value="5">Dr. Johnson #901234</option>
                                                <option value="6">Dr. Wilson #567890</option>
                                                <option value="7">Dr. Davis #234567</option>
                                                <option value="8">Dr. Moore #876543</option>
                                                <option value="9">Dr. Brown #432109</option>
                                                <option value="10">Dr. Taylor #098765</option> 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="seat_qty" class="form-label">Venue <span class="text-danger">*</span></label>
                                             <textarea class="form-control" name="" id="" cols="30" rows="3"></textarea>
                                        </div>
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

@section('script')
<script src="{{asset('assets/js/pages/form-datetimepicker.init.js')}}"></script>
@endsection