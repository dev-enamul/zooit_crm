@extends('layouts.dashboard')
@section('title','Reporting Person')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            Last Subit Time
                        </h4>  
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form action="{{route('submit.time.setting.update')}}" method="POST"  class="needs-validation" novalidate> 
                                @csrf
                                <div class="row mb-2">   
                                    <div class="mb-12">
                                        <label for="submit_time" class="form-label">Daily Submit Last Time <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" id="submit_time" name="submit_time" value="{{$data?->submit_time}}" required>
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
                <!-- end col -->

            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 
    @include('includes.footer') 
</div>
@endsection 

@section('script')  
    <script>
        $(document).ready(function() { 
            $('#reporting_id').select2({
                placeholder: "Select Employee",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.reporting.user') }}',
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