@extends('layouts.dashboard')
@section('title', 'Import Employee')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-cjustify-content-between">
                        <h4 class="mb-sm-0">
                            Import Employee
                        </h4>  
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form action="{{route('employee.import')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                @csrf
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">Import Employee <span class="text-danger">*</span></label>
                                        <input type="file" name="file" class="form-control" id="file" placeholder="Full name" value="{{ isset($employee) ? $employee->user->name : old('full_name')}}" required>
                                        <div class="invalid-feedback">
                                            This field is required.
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
            </div> 
        </div>  
    </div> 
  @include('includes.footer')

</div>
@endsection 


 
