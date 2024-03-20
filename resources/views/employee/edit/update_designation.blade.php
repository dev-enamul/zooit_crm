@extends('layouts.dashboard')
@section('title','Update Designation')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            {{$user->name}}
                        </h4>  
                        

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">
                                    Update Designation
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
                            <form action="{{route('designation.user.update',$user->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                @csrf
                                <div class="row">  

                                    <div class="col-md-12 mb-3">
                                        <label for="designations" class="form-label">Designations <span class="text-danger">*</span></label>
                                        <select class="form-select select2" search multiple name="designations[]" id="designations" required>
                                            <option value="">Select a Designation</option>
                                            @isset($designations)
                                                @foreach ($designations as $designation)
                                                    <option value="{{ $designation->id }}" 
                                                        {{  
                                                            in_array($designation->id, (array) old('designations', json_decode($user->employee->designations ?? '[]')))
                                                            ? 'selected' 
                                                            : '' 
                                                        }}
                                                    >
                                                        {{ $designation->title }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div> 
                                    </div>

                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="designation_id" class="form-label">Commission Designation <span class="text-danger">*</span></label>
                                            <select class="select2" search name="designation_id" id="designation_id" required> 
                                                @foreach ($designations as $designation)
                                                    <option value="{{@$designation->id}}" {{$user->employee->designation_id==$designation->id?"selected":""}}> {{$designation->title}} </option>
                                                @endforeach 
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Valid Document <span class="text-danger">* [jpeg, jpg, png, gif | Max : 2MB ]</span> </label>
                                            <input class="form-control" type="file" name="image" id="image" accept="image">
                                        </div>
                                    </div> 
                                </div>
                                  
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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