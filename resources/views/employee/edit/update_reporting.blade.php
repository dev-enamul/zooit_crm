@extends('layouts.dashboard')
@section('title','Reporting Person')

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
                                    Update Reporting Person
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
                            <form action="{{route('reporting.user.update',$user->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                @csrf
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="reporting_id" class="form-label">Reporting Employee <span class="text-danger">*</span></label>
                                            <select class="select2" search name="reporting_id" id="reporting_id" required> 
                                                @foreach ($employees as $employee)
                                                 @if (isset($employee->reportingUser->id))
                                                    <option value="{{@$employee->reportingUser->id}}" {{@$user->reportingUser->user_id==$employee->id?"selected":""}}> {{$employee->name}} [ {{$employee->user_id}} ] </option>
                                                 @endif 
                                                @endforeach 
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Valid Document <span class="text-danger">* [jpeg, jpg, png, gif | Max : 2MB ]</span></label>
                                            <input class="form-control" type="file" name="image" id="image" accept="image" required>
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