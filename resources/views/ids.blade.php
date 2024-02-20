@extends('layouts.dashboard')
@section('title',"IDS")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">IDS</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">IDS</li>
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
                                            <label for="marital_status" class="form-label">Designation</label>
                                            <select class="select2" multiple name="marital_status" id="marital_status" required>
                                                @foreach ($designations as $item)
                                                    <option value="">{{$item->title}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Divisions" class="form-label">Divisions</label>
                                            <select class="select2" multiple name="Divisions" id="Divisions" required>
                                                @foreach ($divisions as $item)
                                                    <option value="">{{$item->name}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="districts" class="form-label">Districts</label>
                                            <select class="select2" multiple name="districts" id="districts" required>
                                                @foreach ($districts as $item)
                                                    <option value="">{{$item->name}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="upazilas" class="form-label">upazilas</label>
                                            <select class="select2" multiple name="upazilas" id="upazilas" required>
                                                @foreach ($upazilas as $item)
                                                    <option value="">{{$item->name}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unions" class="form-label">Unions</label>
                                            <select class="select2" multiple name="unions" id="unions" required>
                                                @foreach ($unions as $item)
                                                    <option value="">{{$item->name}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="vilages" class="form-label">Vilages</label>
                                            <select class="select2" multiple name="vilages" id="vilages" required>
                                                @foreach ($vilages as $item)
                                                    <option value="">{{$item->name}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="banks" class="form-label">Banks</label>
                                            <select class="select2" multiple name="banks" id="banks" required>
                                                @foreach ($banks as $item)
                                                    <option value="">{{$item->name}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_banks" class="form-label">Mobile Banks</label>
                                            <select class="select2" multiple name="mobile_banks" id="mobile_banks" required>
                                                @foreach ($mobile_banks as $item)
                                                    <option value="">{{$item->name}}  ID: {{$item->id}} </option> 
                                                @endforeach 
                                            </select>  
                                        </div>
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