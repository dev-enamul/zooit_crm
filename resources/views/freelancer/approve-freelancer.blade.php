@extends('layouts.dashboard')
@section('title',"Freelancer Create")
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
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>Full Name</th>
                                        <th>Profession</th>
                                        <th>Upazilla/Thana</th>
                                        <th>Union</th>
                                        <th>Village</th>
                                        <th>Mobile No</th>
                                        <th>F/L ID</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('freelancer.profile')}}">View Profile</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="approveFreelancer({{$data->id}},{{$data->user_id}})">Approve</a> 
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{$key+1}}</td>
                                        <td>{{get_date($data->created_at)}}</td>
                                        <td>{{@$data->name}}</td>
                                        <td>{{@$data->freelancer->profession->name}}</td>
                                        <td>Badulgachhi</td>
                                        <td>Mothorapur</td>
                                        <td>Chalkmothor</td>
                                        <td>01796351081</td>
                                        <td>FL-154</td> 
                                    </tr> 
                                    @endforeach 
                                </tbody>
                            </table>
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
                <h5 class="modal-title">Approve <span class="text-primary">Md Enamul Haque</span></h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('approve-freelancer.store')}}" method="POST">
                @csrf 
                <input type="hidden" name="freelancer_id">
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
                                    <option value="{{$training->id}}">{{$training->title}}</option> 
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
                        <label for="remark">Freelancer ID</label> 
                        <input type="text" name="user_id" id="user_id" readonly>
                    @endcan
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 
            </form> 
        </div>
    </div>
</div> 
@endsection 

@section('script')
<script>
    function approveFreelancer(id){ 
        $('input[name="freelancer_id"]').val(id);
        $('input[name="user_id"]').val(id);
        $('#approve_frelancer').modal('show');
    }
</script>
@endsection