@extends('layouts.dashboard')
@section('title','Asign Deposit Target')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Asign Deposit Target</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Target Asign</li>
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
                                            <label for="freelancer" class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select class="select2" tabindex="-1" placeholder="Select Trainer" required>
                                                <option value="CT" >Select Employee</option>
                                                <option value="CT" >Enamul #652</option>
                                                <option value="DE" >Jamul #42</option>
                                                <option value="FL" >Mehedi #763</option>
                                                <option value="GA" >Karim #73</option> 
                                            </select>
                                        </div>
                                    </div> 
                                    <hr>
                                    <h6 class="text-left text-primary">Wahidul Islam Plaza, Ramgonj</h6>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Existing Unit 4/10 <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="" id="">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Existing Deposit <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="" id="">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">New Unit <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="" id="">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">New Deposit <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="" id="">
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

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection