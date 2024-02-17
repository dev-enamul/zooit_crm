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
                        <h4 class="mb-sm-0">
                            <h4 class="mb-sm-0">Project visit 
                                @if(isset($visit))
                                    Edit
                                @else
                                    Entry
                                @endif
                            </h4>
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
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Visitor <span class="text-danger">*</span></label>
                                            <select id="freelancer" class="select2" tags search name="freelancer[]" multiple>
                                                @isset($freelancers)
                                                    @foreach ($freelancers as $freelancer)
                                                        <option value="{{ $freelancer->name }}" {{ in_array($freelancer->name, old('freelancer', isset($visit) ? json_decode($visit->visitors) : [])) ? 'selected' : '' }}>
                                                            {{ $freelancer->name }} ({{ $freelancer->user_id }})
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
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
                                    

                                    
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="customer_id" class="form-label">Negotiation Person </label>
                                            <select id="customer_id" class="select2" search name="customer_id">
                                                @isset($customers)
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}" {{ old('customer', isset($visit) ? $visit->customer_id : null) == $customer->id ? 'selected' : '' }}>
                                                            {{ @$customer->user->name }} ({{ $customer->user->user_id}})
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
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
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