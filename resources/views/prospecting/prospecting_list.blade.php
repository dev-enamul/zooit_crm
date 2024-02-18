@extends('layouts.dashboard')
@section('title','Prospecting List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Prospecting List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Prospecting List</li>
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
                            
                            <div class="d-flex justify-content-between"> 
                                <div class="">
                                    
                                </div>
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">
                                        <a class="btn btn-primary me-1" href="{{route(Route::currentRouteName())}}"><i class="mdi mdi-refresh"></i> </a>      
                                        <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Profession</th>
                                        <th>Upazilla/Thana</th>
                                        <th>Union</th>
                                        <th>Village</th>
                                        <th>Media</th>
                                        <th>Mobile No</th>
                                        <th>Freelancer</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($prospectings as  $prospecting)
                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="{{ isset($prospecting) ? 'storage/' . $prospecting->customer->user->profile_image : '../assets/images/users/avatar-6.png' }}" alt="Header Avatar">
                                                </a>
                                                
                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    <a class="dropdown-item" href="{{route('prospecting.edit',$prospecting->id)}}">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('prospecting.delete',$prospecting->id) }}')">Delete</a>  
                                                    <a class="dropdown-item" href="">Cold Calling</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">{{ @$prospecting->customer->name }}</td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">{{ @$prospecting->customer->profession->name }}</td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">{{ @$prospecting->customer->user->userAddress->upazila->name }}</td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">{{ @$prospecting->customer->user->userAddress->union->name }}</td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">{{ @$prospecting->customer->user->userAddress->village->name }}</td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">
                                            @if ($prospecting->media == 1)
                                                <span class="badge bg-primary">Phone</span>
                                            @elseif($prospecting->media == 2)
                                                <span class="badge bg-success">Meet</span>

                                            @endif 
                                        </td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">{{ @$prospecting->customer->user->phone }}</td>
                                        <td class="{{ $prospecting->status == 0 ? 'text-danger' : '' }}">{{ @$prospecting->employee->name }}</td>
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
                    <label for="prospecting_date" class="form-label">Date</label>
                    <input class="form-control" id="prospecting_date" name="date" default="This Month" type="text" value="" />   
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="employee" class="form-label">Employee</label>
                    <select class="select2" search id="employee" name="employee">
                        <option value="">Select Freelancer</option> 
                        @foreach ($employees as $item)
                            <option value="{{$item->id}}">{{$item->name}} [{{$item->user_id}}]</option> 
                        @endforeach 
                  
                    </select> 
                </div>
            </div>  

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="profession" class="form-label">Profession </label>
                    <select class="form-select select2" name="profession" id="profession">
                        <option value="">Select Profession</option>
                       @foreach ($professions as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option> 
                       @endforeach
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
<script>
     getDateRange('prospecting_date');
</script>
@endsection