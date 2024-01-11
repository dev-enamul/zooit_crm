@extends('layouts.dashboard')
@section('title','Product Unit Create')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product Unit Entry</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product Unit Entry</li>
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
                                            <label for="division" class="form-label">Product <span class="text-danger">*</span></label>
                                            <select class="form-select" name="division" id="division" required>
                                                <option value="">Select Product</option>
                                                <option value="">City Housing </option>
                                                <option value="">Metro City </option> 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="floow" class="form-label">Unit Name <span class="text-danger">*</span></label>
                                             <input type="text" class="form-control" name="floow" id="floow" required>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="floow" class="form-label">Floor Number <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="floow" id="floow" required>
                                        </div>
                                    </div> 

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_type" class="form-label">Unit Type <span class="text-danger">*</span></label>
                                            <select class="form-select" name="unit_type" id="unit_type" required>
                                                <option value="">Select Unit</option>
                                                <option value="">Shop </option>
                                                <option value="">Flat </option> 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="unit_type" class="form-label">Unit Category Type <span class="text-danger">*</span></label>
                                            <select class="form-select" name="unit_type" id="unit_type" required>
                                                <option value="">Select Category</option>
                                                <option value="">A</option>
                                                <option value="">B</option> 
                                                <option value="">C</option> 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">On Choice Price [6 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">Lottery Select Price [6 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">On Choice Price [12 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">Lottery Select Price [12 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">On Choice Price [18 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">Lottery Select Price [18 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">On Choice Price [24 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">Lottery Select Price [24 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">On Choice Price [36 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="regular_price" class="form-label">Lottery Select Price [36 Month Payment] <span class="text-danger">*</span></label>
                                             <input type="number" class="form-control" name="regular_price" id="regular_price" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description<span class="text-danger">*</span></label>
                                             <textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
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
 
