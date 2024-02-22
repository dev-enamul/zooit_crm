@extends('layouts.dashboard')
@section('title','Presentation List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Presentations</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Presentation List</li>
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
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>

                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-pdf"></i> PDF</span>
                                        </button> 
                                    </div> 
                                </div>
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Profession</th>
                                        <th>Address</th>
                                        <th>M/S</th>
                                        <th>Last Lead</th>
                                        <th>Project</th>
                                        <th>Unit</th> 
                                        <th>Presentation</th> 
                                        <th>Freelancer</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($presentations as  $presentation)
                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>

                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    <a class="dropdown-item" href="{{route('presentation.edit',$presentation->id)}}">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('presentation.delete',$presentation->id) }}')">Delete</a>  
                                                    <a class="dropdown-item" href="customer_profile.html">Customer Profile</a> 
                                                    <a class="dropdown-item" href="project_visit_create.html">Project Visit Analysis</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ $loop->iteration }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->created_at }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->customer->user->name }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->customer->profession->name }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->customer->user->userAddress->address }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->customer->user->marital_status }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->created_at }} #dummy</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->project->name }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->unit->title }}</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->created_at  }} #dummy</td>
                                        <td class="{{ $presentation->status == 0 ? 'text-danger' : '' }}">{{ @$presentation->employee->name }}</td>
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

@endsection