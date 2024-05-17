@php
    use App\Models\User;
@endphp
@extends('layouts.dashboard')
@section('title', 'Freelancer Create')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Freelancer List</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Freelancer List</li>
                                </ol>
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
                                    <table id=" "
                                        class="table table-hover table-bordered table-striped dt-responsive nowrap"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr class="">
                                                <th>Action</th>
                                                <th>S/N</th>
                                                <th>Fl Id</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Co-Ordinator Name_ID</th>
                                                <th>Executive Co-Ordinator Name_ID</th>
                                                <th>InCharge Sales</th>
                                                <th>Area InCharge</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($datas as $key => $data)
                                                <tr class="">
                                                    <td class="text-center" data-bs-toggle="tooltip" title="Action">
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0)" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <img class="rounded avatar-2xs p-0"
                                                                    src="{{ $data->user->image() }}">
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-animated">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('profile', encrypt($data?->user_id)) }}">Profile</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"
                                                                    onclick="approveFreelancer({{ $data->user_id }})">Approve</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ @$data->user->user_id }}</td>
                                                    <td>{{ @$data->user->name }}</td>
                                                    <td>{{ @$data->user->phone }}</td>
                                                    <td>
                                                        @php
                                                            $userInfo = coOrdinator(
                                                                json_decode($data->user->user_reporting),
                                                            );
                                                        @endphp
                                                        <center>{{ $userInfo }}<center>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $userInfo = exCoOrdinator(
                                                                json_decode($data->user->user_reporting),
                                                            );
                                                        @endphp
                                                        <center>{{ $userInfo }}<center>
                                                    </td>

                                                    <td>
                                                        @php
                                                            $reporting = json_decode($data->user->user_reporting);
                                                            $userInfo = '-'; // Set a default value
                                                            if (isset($reporting) && $reporting != null) {
                                                                $user = User::whereIn('id', $reporting)
                                                                    ->whereHas('freelancer', function ($q) {
                                                                        $q->whereIn('designation_id', [12, 13, 14, 15]);
                                                                    })
                                                                    ->first();
                                                                if (isset($user) && $user != null) {
                                                                    $userInfo =
                                                                        $user->name . ' [' . $user->user_id . ']';
                                                                }
                                                            }
                                                        @endphp
                                                        <center>{{ $userInfo }}<center>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $reporting = json_decode($data->user->user_reporting);
                                                            $userInfo = '-'; // Set a default value
                                                            if (isset($reporting) && $reporting != null) {
                                                                $user = User::whereIn('id', $reporting)
                                                                    ->whereHas('freelancer', function ($q) {
                                                                        $q->whereIn('designation_id', [11]);
                                                                    })
                                                                    ->first();
                                                                if (isset($user) && $user != null) {
                                                                    $userInfo =
                                                                        $user->name . ' [' . $user->user_id . ']';
                                                                }
                                                            }
                                                        @endphp
                                                        <center>{{ $userInfo }}<center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
        @include('includes.footer')
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
    <script>
        function approveFreelancer(user_id) {
            $('input[name="user_id"]').val(user_id);
            $('#approve_frelancer').modal('show');
        }
    </script>
@endsection
