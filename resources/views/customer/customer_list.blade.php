@extends('layouts.dashboard')
@section('title',"Customer List")

 

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customer List</h4>
                        <p class="d-none">Employee: MD Enamul Haque</p> 
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="A4">
                        <input type="hidden" id="fontSize" value="10">

                        <div class="page-title-right">
                            <div class="dt-buttons btn-group flex-wrap mb-2">      
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
                                        <tr class="{{$data->approve_by==null?"table-warning":""}}">
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img class="rounded avatar-2xs p-0" src="{{$data->user->image()}}">
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="{{ route('customer.print', $data->id) }}">Print Customer</a>
                                                        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->id))}}">View Profile</a>
                                                        @can('customer-manage') 
                                                            @if ($data->approve_by==null)
                                                                <a class="dropdown-item" href="{{route('customer.edit',encrypt($data->id))}}" >Edit</a>
                                                            @endif
                                                        @endcan 

                                                        @can('customer-delete')
                                                            <a class="dropdown-item" href="#"  onclick="deleteItem('{{ route('customer.delete',encrypt($data->id)) }}')">Delete</a>
                                                        @endcan
                                                        
                                                        @can('prospecting')
                                                            @if ($data->approve_by!=null)
                                                                <a class="dropdown-item" href="{{ route('prospecting.create', ['customer' => $data->id]) }}">Prospecting</a>
                                                            @endif 
                                                        @endcan 
                                                    </div>
                                                </div> 
                                            </td> 
                                            <td>{{$key+1}}</td>
                                            <td>{{get_date($data->created_at)}}</td>
                                            <td>{{@$data->user->name}}</td>
                                            <td>{{@$data->profession->name}}</td>
                                            <td>{{@$data->user->userAddress->upazila->name}}</td>
                                            <td>{{@$data->user->userAddress->union->name }}</td>
                                            <td>{{@$data->user->userAddress->village->name}}</td>
                                            <td>{{@$data->user->phone}}</td>
                                            <td>{{@$data->reference->user_id}}</td> 
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
        <form action="{{route('customer.search')}}" method="POST">
            @csrf
            <div class="row">
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer </label>
                        <select class="form-select select2" name="customer" id="customer">
                            <option value="" data-display="Select a Customer">
                                Select a Customer
                            </option>
                            @isset($customers)
                                @foreach ($customers as $data)
                                    <option value="{{ $data->id }}" {{ old('customer', $selected['customer_id'] ?? null) == $data->id ? 'selected' : '' }}>
                                        {{ $data->user->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>  
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Marketing Executive </label>
                        <select class="select2" search name="employee" id="employee">
                            @isset($employees)
                                @foreach ($employees as $data)
                                    <option value="{{ $data->id }}" {{ old('employee', $selected['employee_id'] ?? null) == $data->id ? 'selected' : '' }}>
                                        {{ $data->user->name }}
                                    </option>
                                @endforeach
                            @endisset
                            
                        </select>  
                    </div>
                </div>
    
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="daterangepicker" class="form-label">Join Date </label>
                        <input class="form-control" type="text" id="daterangepicker" name="daterange" value="{{ old('daterange', $selected['daterange'] ?? '') }}" />   
                    </div>
                </div> 
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="profession" class="form-label">Profession </label>
                        <select class="form-select select2" name="profession" id="freelancer">
                            <option value="" data-display="Select a Profession">
                                Select a Profession
                            </option>
                            @isset($professions)
                                @foreach ($professions as $profession)
                                    <option value="{{ $profession->id }}" {{ old('profession', $selected['profession_id'] ?? null) == $profession->id ? 'selected' : '' }}>
                                        {{ $profession->name }}
                                    </option>
                                @endforeach
                            @endisset
                        </select>  
                    </div>
                </div>

                @include('common.search', [
                    'div' => 'col-md-6',
                    'visible' => ['division', 'district', 'upazila','union','village','progressStatus'],
                ])
                <input type="hidden" id="division" value="{{ @$division }}">
                <input type="hidden" id="district" value="{{ @$district }}">
                <input type="hidden" id="upazila" value="{{ @$upazila }}">
                <input type="hidden" id="union" value="{{ @$union }}">
                <input type="hidden" id="village" value="{{ @$village }}">
                <input type="hidden" id="status" value="{{ @$status }}">
                <div class="text-end ">
                    <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> 
                    <button class="btn btn-outline-danger" type="button" onclick="resetFormFields()">
                        <i class="mdi mdi-refresh"></i> Reset
                    </button>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
@include('includes.data_table')
    <script> 
        getDateRange('daterangepicker');
    </script> 
@endsection
