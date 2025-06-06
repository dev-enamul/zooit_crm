@extends('layouts.dashboard')
@section('title','Training Create')

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
                            <form class="needs-validation" action="{{route('training.store')}}" method="post" novalidate>
                                @csrf
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="category" class="form-label">Training Category <span class="text-danger">*</span></label>
                                            <select class="select2" name="category_id" id="category" tabindex="-1" search  placeholder="Select Training Category" required>
                                                @foreach ($categoris as $caegory)
                                                    <option value="{{$caegory->id}}">{{$caegory->title}}</option> 
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="employee" class="form-label">Trainer <span class="text-danger">*</span></label>
                                            <select class="select2" name="trainer[]" id="employee" tabindex="-1" multiple placeholder="Select Trainer" required>
                                                
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="seat" class="form-label">Total Seat <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="seat" min="1" value="1" id="seat">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" id="date" class="form-control" placeholder="Select date" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                                            <input type="time" name="time" id="time" class="form-control" placeholder="Select Time" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="agenda" class="form-label">Agenda</label> 
                                            <textarea class="form-control" id="agenda" rows="3" name="agenda" placeholder="Training Agenda"></textarea>
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

@section('script')
    <script>
        $(document).ready(function() {
        $('#employee').select2({
            placeholder: "Select Employee",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.employee') }}',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        term: params.term
                    }
                    return query;
                }
            }
        });
    });
    </script>
@endsection