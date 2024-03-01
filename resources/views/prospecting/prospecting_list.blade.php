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
                        <p class="d-none">{{auth()->user()->name}}</p> 
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="A4">
                        <input type="hidden" id="fontSize" value="10">

                        <div class="page-title-right">
                            <div class="dt-buttons btn-group flex-wrap mb-2">
                                <a class="btn btn-primary me-1" href="{{route(Route::currentRouteName())}}"><i class="mdi mdi-refresh"></i> </a>      
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

                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                    <tr class="{{$prospecting->approve_by==null?"table-warning":""}}">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="{{@$prospecting->customer->user->image()}}" alt="Header Avatar">
                                                </a>
                                                
                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    @can('prospecting-manage')
                                                        @if ($prospecting->approve_by==null)
                                                            <a class="dropdown-item" href="{{route('prospecting.edit',$prospecting->id)}}">Edit</a>
                                                        @endif  
                                                    @endcan
                                                   

                                                    @can('prospecting-delete')
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('prospecting.delete',$prospecting->id) }}')">Delete</a>  
                                                    @endcan 
                                                    @if ($prospecting->approve_by!=null) 
                                                        @can('cold-calling-manage')
                                                            <a class="dropdown-item" href="{{route('cold-calling.create',['customer' => $prospecting->customer->id])}}">Cold Calling</a>
                                                        @endcan 
                                                    @endif 
                                                    <a class="dropdown-item" href="{{route('customer.details', encrypt($prospecting->customer_id))}}">Print Customer</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="">{{ @$prospecting->customer->name }} [{{@$prospecting->customer->customer_id}}]</td>
                                        <td class="">{{ @$prospecting->customer->profession->name }}</td>
                                        <td class="">{{ @$prospecting->customer->user->userAddress->upazila->name }}</td>
                                        <td class="">{{ @$prospecting->customer->user->userAddress->union->name }}</td>
                                        <td class="">{{ @$prospecting->customer->user->userAddress->village->name }}</td>
                                        <td class="">
                                            @if ($prospecting->media == 1)
                                            Phone
                                            @elseif($prospecting->media == 2)
                                            Meet

                                            @endif 
                                        </td>
                                        <td class="">{{ @$prospecting->customer->user->phone }}</td>
                                        <td class="">{{ @$prospecting->customer->reference->name }} [{{ @$prospecting->customer->reference->user_id }}]</td>
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
@include('includes.data_table')
<script>
     getDateRange('prospecting_date');
</script>
@endsection