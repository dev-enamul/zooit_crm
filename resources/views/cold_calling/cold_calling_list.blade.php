@extends('layouts.dashboard')
@section('title','Cold Calling List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Cold-Calling List</h4> 
                        <p class="d-none">Employee: MD Enamul Haque</p> 
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="legal">
                        <input type="hidden" id="fontSize" value="8">
                        <div class="page-title-right">
                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                <span><i class="fas fa-filter"></i> Filter</span>
                            </button> 
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Profession</th>
                                        <th>Upazilla/Thana</th>
                                        <th>Union</th>
                                        <th>Village</th>
                                        <th>Last Prospecting</th>
                                        <th>Project</th>
                                        <th>Unit</th>
                                        <th>Mobile No</th>
                                        <th>Freelancer</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($cold_callings as  $cold_calling)
                                    <tr class="{{$cold_calling->approve_by==null?"table-warning":""}}">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="{{@$cold_calling->customer->user->image()}}">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    @if ($cold_calling->approve_by==null)
                                                        @can('cold-calling-manage')
                                                            <a class="dropdown-item" href="{{route('cold-calling.edit',$cold_calling->id)}}">Edit</a>   
                                                        @endcan 
                                                    @endif 
                                                    
                                                    @can('cold-calling-delete')
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('cold_calling.delete',$cold_calling->id) }}')">Delete</a>  
                                                    @endcan 
                                                    
                                                    @if ($cold_calling->approve_by!=null) 
                                                        @can('lead-manage')
                                                            <a class="dropdown-item" href="{{route('lead.create',['customer' => $cold_calling->customer->id])}}">Lead</a>
                                                        @endcan 
                                                    @endif
                                                   
                                                </div>
                                            </div> 
                                        </td> 
                                        <td class="">{{ $loop->iteration }}</td>
                                        <td class="">{{ @$cold_calling->customer->name }} [{{ @$cold_calling->customer->customer_id }}]</td>
                                        <td class="">{{ @$cold_calling->customer->profession->name }}</td>
                                        <td class="">{{ @$cold_calling->customer->user->userAddress->upazila->name }}</td>
                                        <td class="">{{ @$cold_calling->customer->user->userAddress->union->name }}</td>
                                        <td class="">{{ @$cold_calling->customer->user->userAddress->village->name }}</td>
                                        @php
                                            $prospecting = \App\Models\Prospecting::where('customer_id',$cold_calling->customer->id)->first();
                                            $last_prospecting = $prospecting->updated_at;
                                        @endphp
                                        <td class="">{{ get_date($last_prospecting) }}</td>
                                        <td class="">{{ @$cold_calling->project->name }}</td>
                                        <td class=""> {{@$cold_calling->unit->title }} </td>
                                        <td class="">{{ @$cold_calling->customer->user->phone }}</td>
                                        <td class="">{{ @$cold_calling->customer->reference->name }} [{{ @$cold_calling->customer->reference->user_id }}]</td>
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
        <div class="row"> 
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
            {{-- <div class="col-md-6">
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer name <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Customer name" >
                </div>
            </div>   --}}
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
    </div>
</div>
@endsection

@section('script')
@include('includes.data_table')
@endsection