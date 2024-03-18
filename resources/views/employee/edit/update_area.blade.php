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
                                    Change Reason
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form action="{{route('user.area.update',$user->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                @csrf
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="zone_id" class="form-label">Zone</label>
                                            <select class="select2" search name="zone_id" id="zone_id"> 
                                                <option value="">Select Zone</option>
                                                @foreach ($zones as $zone)
                                                    <option value="{{$zone->id}}" {{(old('zone_id',@$user->userAddress->zone_id==$zone->id?"selected":""))}}> {{$zone->name}} </option>
                                                @endforeach 
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="area_id" class="form-label">Area</label>
                                            <select class="select2" search name="area_id" id="area_id">
                                                <option value="">Select Area</option> 
                                                @foreach ($areas as $area)
                                                    <option value="{{$area->id}}" {{(old('zone_id',@$user->userAddress->area_id==$area->id?"selected":""))}}> {{$area->name}} </option>
                                                @endforeach 
                                            </select> 
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
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