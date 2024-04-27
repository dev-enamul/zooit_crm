@extends('layouts.dashboard')
@section('title',"Customer List")
 @section('style') 
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" /> --}}
 @endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Customer List</h4>  

                            <div class="page-title-right">
                                <div class="btn-group flex-wrap mb-2">      
                                    <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                        <span><i class="fas fa-filter"></i> Filter</span>
                                    </button> 
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card"> 
                            <div class="card-body">
                                <div class="table-box">
                                    {{ $dataTable->table(['class' => 'table table-hover table-bordered table-striped dt-responsive nowrap fs-10']) }} 
                                </div> 
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div> 
    </div>  
    <div class="offcanvas offcanvas-end" id="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Select Filter Item</h5>
            <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
        <form action="" method="get">
            <div class="row">  
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="select2" id="status" name="status"> 
                            <option value = "1" {{$status==1?"selected":""}}>Previous</option>
                            <option value = "0" {{$status==0?"selected":""}}>Present</option>
                        </select> 
                    </div>
                </div> 
                
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="date_range" class="form-label">Date</label>
                        <input class="form-control" start="{{$start_date}}" end="{{$end_date}}" id="date_range" name="date" default="This Month" type="text" value="" />   
                    </div>
                </div> 

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Employee</label>
                        <select class="select2" search id="employee" name="employee"> 
                            <option value = "{{$employee->id}}" selected="selected">{{$employee->name}} [{{$employee->user_id}}]</option>
                        </select> 
                    </div>
                </div>   
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
                </div> 
            </div>
        </form>
        </div>
    </div> 
@endsection  
@section('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
{{-- <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script> --}}
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}  

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

    getDateRange('date_range');
</script>

<script> 
     getDateRange('date_range');
</script>
@endsection
  