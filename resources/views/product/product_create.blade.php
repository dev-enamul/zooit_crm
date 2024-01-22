@extends('layouts.dashboard')
@section('title','Product Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Entry</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product Entry</li>
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
                                            <label for="first_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name" value="" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Product Image</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control">  
                                        </div>
                                    </div>

                                    @include('common.area', [
                                        'div'       => 'col-md-6',
                                        'mb'        => 'mb-3',
                                        'visible'   => ['division', 'district', 'upazila','union','village'],
                                        'required'  => ['division', 'district', 'upazila','union','village'],
                                    ])

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="total_flat" class="form-label">Total Floor</label>
                                            <input type="number" name="total_flat" id="total_flat" class="form-control">  
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="total_flat" class="form-label">Google Map Location</label>
                                            <input type="number" name="total_flat" id="total_flat" class="form-control">  
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="2" name="remark"></textarea> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Description</label>
                                            <textarea class="form-control" id="address" rows="2" name="remark"></textarea>
                                        
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
 
