@extends('layouts.dashboard')

@section('style')
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .highlight-row {
            background-color: #ffe0e0 !important; /* Light red background */
        }
    </style>
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daily Attendance</h4>

                            <form method="GET" action="{{ url('employee/daily-attendance') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->get('start_date', \Carbon\Carbon::now()->toDateString()) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->get('end_date', \Carbon\Carbon::now()->toDateString()) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                    </div>
                                </div>
                            </form>

                            {{ $dataTable->table(['class' => 'table table-hover table-bordered table-striped dt-responsive nowrap fs-10']) }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('admin.reports.partials.work_log_modal')

@section('script')
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}

    <script>
        $(document).on('click', '.view-work-log', function() {
            var userId = $(this).data('user-id');
            var date = $(this).data('date');
            var startDate = date; // For daily attendance, start and end date are the same
            var endDate = date;

            $('#workLogModalLabel').text('Work Log for ' + userId + ' on ' + date);
            $('#workLogTableContent').html('<p>Loading work logs...</p>');
            $('#workLogModal').modal('show');

            $.ajax({
                url: '{{ route('employee.work_logs') }}',
                method: 'GET',
                data: {
                    user_id: userId,
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    $('#workLogTableContent').html(response);
                },
                error: function(xhr, status, error) {
                    $('#workLogTableContent').html('<p class="text-danger">Error loading work logs: ' + error + '</p>');
                    console.error("Error loading work logs:", error);
                }
            });
        });
    </script>
@endsection
