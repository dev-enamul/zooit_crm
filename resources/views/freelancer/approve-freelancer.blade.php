@php
    use App\Models\User;
@endphp
@extends('layouts.dashboard')
@section('title', 'Freelancer Create') 
@section('script')
<link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
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
                                    {{ $dataTable->table(['class' => 'table table-hover table-bordered table-striped dt-responsive nowrap']) }}
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

    <div class="modal fade" id="approve_frelancer">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approve Freelancer</h5><button type="button"
                        class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i
                            class="mdi mdi-close"></i></button>
                </div>

                <form action="{{ route('approve-freelancer.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id">

                    <div class="modal-body">
                        @can('freelancer-counselling')
                            <div class="form-group mb-2">
                                <label for="counselling">Counselling</label>
                                <select name="counselling" class="select2" id="counselling">
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        @endcan

                        @can('freelancer-interview')
                            <div class="form-group mb-2">
                                <label for="interview">Interview</label>
                                <select name="interview" class="select2" id="interview">
                                    <option value="1" selected>Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        @endcan

                        @can('freelancer-meeting')
                            <div class="form-group mb-2">
                                <label for="meeting_date">Meeting Date</label>
                                <input type="date" name="meeting_date" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="meeting_time">Meeting Time</label>
                                <input type="time" name="meeting_time" class="form-control">
                            </div>
                        @endcan

                        @can('freelancer-training')
                            <div class="form-group mb-2">
                                <label for="training_id">Recommendation Training</label>
                                <select name="training_id" class="select2" id="training_id">
                                    <option value="">Select Training</option>
                                    @foreach ($trainings as $training)
                                        <option value="{{ $training->id }}">{{ $training->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endcan

                        @can('freelancer-remark')
                            <div class="form-group mb-2">
                                <label for="remark">Remark</label>
                                <textarea name="" id="" class="form-control" rows="3"></textarea>
                            </div>
                        @endcan

                        @can('freelancer-id-create')
                            <label for="fl_id">Freelancer ID</label>
                            <input class="form-control" type="text" value="{{ $next_freelancer_id }}" name="fl_id"
                                id="fl_id" readonly>
                        @endcan
                    </div>
                    <div class="modal-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                            <button type="button" class="btn btn-outline-danger refresh_btn"><i
                                    class="mdi mdi-refresh"></i> Reset</button>
                        </div>
                    </div>
                </form>
            </div>
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
        function approveFreelancer(user_id) {
            $('input[name="user_id"]').val(user_id);
            $('#approve_frelancer').modal('show');
        }
    </script>

    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {
                $('#employee').select2({
                    placeholder: "Select Employee",
                    allowClear: true,
                    dropdownParent: $('#offcanvas'),
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

        getDateRange('date_range');
    </script>
@endsection
