@extends('layouts.dashboard')
@section('title','Special Offer Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Special Offer Create</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Special Offer Create</li>
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
                                            <label for="offer_name" class="form-label">Offer Name <span class="text-danger">*</span></label>
                                            <input type="text" name="offer_name" class="form-control" id="offer_name" placeholder="Special Offer Name" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input class="form-control datepicker w-100" id="start_date" name="start_date" type="text"/>   
                                        </div>
                                    </div> 

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input class="form-control datepicker w-100" id="end_date" name="end_date" type="text"/>   
                                        </div>
                                    </div> 
                                      
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer_comission" class="form-label">Freelancer Comission </label>
                                            <input type="number" name="freelancer_comission" class="form-control" id="freelancer_comission" value="0">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer_comission" class="form-label">Freelancer Comission </label>
                                            <input type="number" name="freelancer_comission" class="form-control" id="freelancer_comission" value="0">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer_comission" class="form-label">Marketing Executive Comission </label>
                                            <input type="number" name="freelancer_comission" class="form-control" id="freelancer_comission" value="0">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer_comission" class="form-label">Salse Executive Comission </label>
                                            <input type="number" name="freelancer_comission" class="form-control" id="freelancer_comission" value="0">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer_comission" class="form-label">Area Manager Comission </label>
                                            <input type="number" name="freelancer_comission" class="form-control" id="freelancer_comission" value="0">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer_comission" class="form-label">Zonal Manager Comission </label>
                                            <input type="number" name="freelancer_comission" class="form-control" id="freelancer_comission" value="0">  
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
    
@endsection