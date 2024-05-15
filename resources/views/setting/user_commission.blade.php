@extends('layouts.dashboard')
@section('title','User Commission')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                           User Commission
                        </h4> 

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">
                                    User Commission
                                </li>
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
                            <form action="{{route('user.commission.save')}}" method="POST" class="needs-validation" novalidate> 
                                @csrf
                                <div class="row">   
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="employee" class="form-label">Employee/Freelancer <span class="text-danger">*</span></label>
                                            <select class="select2" search name="user_id" id="employee" required>
                                                <option value="{{auth()->user()->id}}" selected="selected">{{Auth::user()->name}}</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>   

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Total Regular Commission <span class="text-danger">*</span></label>
                                            <input type="number" name="total_regular_commission" class="form-control" value="0" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Total Special Commission <span class="text-danger">*</span></label>
                                            <input type="number" name="total_special_commission" class="form-control" value="0" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Paid Commission <span class="text-danger">*</span></label>
                                            <input type="number" name="paid_commission" class="form-control" value="0" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Last Paid Date <span class="text-danger">*</span></label>
                                            <input type="date" name="updated_at" class="form-control"  required>
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
            $('#employee').select2({
                placeholder: "Select Employee",
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
    <script>
        $(document).ready(function() { 
            $('#employee').on('change', function() { 
                var user_id = $(this).val(); 
                $.ajax({
                    url: '{{ route('user.commission.get') }}',
                    type: 'GET',
                    data: {user_id: user_id},
                    success: function(response) {
                        console.log(response);
                        $('input[name="total_regular_commission"]').val(response.total_regular_commission);
                        $('input[name="total_special_commission"]').val(response.total_special_commission);
                        $('input[name="paid_commission"]').val(response.paid_commission);
                        $('input[name="updated_at"]').val(response.updated_at);
                    } 

                });
            });
        });
    </script>
@endsection