@extends('layouts.dashboard')
@section('title','Project Visit & Presentation Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                  
                        <h4 class="mb-sm-0">Project visit 
                            @if(isset($visit))
                                Edit
                            @else
                                Entry
                            @endif
                        </h4> 

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Project Visit 
                                    @if(isset($visit))
                                        Edit
                                    @else
                                        Entry
                                    @endif
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            @if(isset($visit))
                                <form action="{{route('visit.save',$visit->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                <input type="hidden" name="id" value="{{$visit->id}}">
                            @else 
                                <form action="{{route('visit.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                            @endif 
                                @csrf
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Visitor <span class="text-danger">*</span></label>
                                            <select id="freelancer" class="select2" tags search name="freelancer[]" multiple>
                                                @isset($visitors)
                                                    @foreach ($visitors as $visitor)
                                                        <option value="{{ $visitor->name }}" {{ in_array($visitor->name, old('freelancer', isset($visit) ? json_decode($visit->visitors) : [])) ? 'selected' : '' }}>
                                                            {{ $visitor->name }} ({{ $visitor->customer[0]->customer_id }})
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="employee" class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select class="select2" search name="employee" id="employee" required>
                                                <option data-display="Select a employee *" value="">
                                                    Select a employee
                                                </option>
                                                @isset($employees)
                                                    @foreach ($employees as $employee)
                                                        <option value="{{ $employee->id }}" {{ old('employee', isset($visit) ? $visit->employee_id : null) == $employee->id || (isset($selected_data['employee']) && $selected_data['employee'] == $employee->id) ? 'selected' : '' }}>
                                                            {{ $employee->name }} ({{ $employee->user_id}})
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Project <span class="text-danger">*</span></label>
                                            <select id="projects" class="select2" tags search name="projects[]" multiple>
                                                @isset($projects)
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->name }}" {{ in_array($project->name, old('projects', isset($visit) ? json_decode($visit->projects) : [])) ? 'selected' : '' }}>
                                                            {{ $project->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                                                   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_id" class="form-label">Negotiation Person </label>
                                            <select id="customer_id" class="select2" search name="customer_id">
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a Negotiation Person
                                                </option>
                                                @isset($customers)
                                                    @foreach ($customers as $cstm)
                                                        <option value="{{ $cstm->customer_id }}" {{ isset($selected_data['customer']) || isset($visit->customer_id) == $cstm->customer_id ? 'selected' : '' }}>
                                                            {{ @$cstm->customer->name }} ({{ $cstm->customer->customer_id}})
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3" name="remark">{{isset($visit) ? $visit->remark : old('remark')}}</textarea>
                                        </div>
                                    </div> 
                                </div>
                                  
                                <div class="text-end ">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> 
                                </div> 
                            </form>
                        </div>
                    </div> 
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 
    @include('includes.footer')
</div>
@endsection