@extends('layouts.dashboard')
@section('title',"Customer List")

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
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
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer List</li>
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
                                <div class=""> </div>
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>
                           
                            <table id="customer_table" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                                        <a class="dropdown-item" href="{{ route('customer.print', $data->id) }}">Print Customer</a>
                                                        <a class="dropdown-item" href="{{route('customer.profile')}}">View Profile</a>
                                                        <a class="dropdown-item" href="{{route('customer.edit',$data->id)}}" >Edit</a>
                                                        <a class="dropdown-item" href="#"  onclick="deleteItem('{{ route('customer.delete',$data->id) }}')">Delete</a>
                                                        <a class="dropdown-item" href="{{ route('prospecting.create', ['customer' => $data->id]) }}">Prospecting</a>
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
                                            <td>{{@$data->user->user_id}}</td> 
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="{{asset('assets/js/print.js')}}"></script>

    <script>
       $(document).ready(function () {
            $(window).on('load', function () {
                console.log('DataTable initialized');
                var table = $('#customer_table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Excel',
                            filename: 'export',
                            exportOptions: {
                                columns: ':visible:not(:first-child)'
                            }
                        },
                        {
                            extend: 'print',
                            text: 'Print',
                            title: 'Customer Data',
                            exportOptions: {
                                columns: ':visible:not(:first-child)'
                            }
                        }
                    ]
                });
            });
        });

        function resetFormFields() {
            $("#division").val('');
            $("#district").val('');
            $("#upazila").val('');
            $("#union").val('');
            $("#village").val('');
            $("#status").val('');
            $("#daterange").val('');
            $("#profession").val('');
            $("#customer").val('');
            $("#employee").val('');
        
            $("#status").trigger('change');
            $("#division").trigger('change');
            $("#district").trigger('change');
            $("#upazila").trigger('change');
            $("#union").trigger('change');
            $("#village").trigger('change');
            $("#daterange").trigger('change');
            $("#profession").trigger('change');
            $("#customer").trigger('change');
            $("#employee").trigger('change');

            $('#filter_button').prop('disabled', true);
        }
    
        getDateRange('daterangepicker');
    </script>

    @yield('script-bottom')
@endsection
