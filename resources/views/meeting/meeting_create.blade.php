@extends('layouts.dashboard')
@section('title',$title)

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$title}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{$title}}</li>
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
                            <form class="needs-validation" action="{{route('meeting.store')}}" method="post" novalidate>
                                @csrf
                                <div class="row">   
                                    <input type="hidden" name="meeting_id" value="{{$meeting->id}}">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Customer</label>
                                            <select class="select2" search name="customer_id" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($selected_data['customer'])
                                                    <option value="{{ $selected_data['customer']->id }}" selected>
                                                        {{ $selected_data['customer']->user->name }} ({{ $selected_data['customer']->visitor_id }})
                                                    </option>
                                                @endisset
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Meeting Title<span class="text-danger">*</span></label>
                                            <input type="text" value="{{old('title',@$meeting->title)}}" class="form-control" name="title" placeholder="Enter Title" id="title">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', @$meeting->date_time ? date('Y-m-d', strtotime(@$meeting->date_time)) : '') }}" placeholder="Select date" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="time" class="form-label">Time <span class="text-danger">*</span></label>
                                            <input type="time" name="time" id="time" class="form-control" value="{{ old('time', @$meeting->date_time ? date('H:i', strtotime(@$meeting->date_time)) : '') }}" placeholder="Select Time" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>
                                      

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="agenda" class="form-label">Agenda</label> 
                                            <textarea class="form-control" id="agenda" rows="3" name="agenda" placeholder="Meeting Agenda">{{old('title',@$meeting->agenda)}} </textarea>
                                        </div>
                                    </div>
                                </div>
                                  
                                <div class="text-end ">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
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
        $('#customer').select2({
            placeholder: "Select Customer",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.followup.customer') }}',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        term: params.term
                    }
                    return query;
                },
                success: function(data) {
                    get_customer_data();
                }
            }
        });
    });
</script> 

    <script>
        $(document).ready(function() {
        $('#employee').select2({
            placeholder: "Select who will attend",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.employee.freelancer') }}',
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