@extends('layouts.dashboard')
@section('title','Presentation Analysis Approve')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Rejections Approve</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Rejection Approve List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('rejection.approve.save')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex justify-content-between"> 
                                    <div class="mb-1">
                                        <input class="form-check-input" type="checkbox" value="" id="selectAll" > 
                                        <label for="selectAll">Check All</label>
                                    </div> 

                                    <div class="mb-1">
                                        <button class="btn btn-primary" type="submit">
                                            Approve
                                        </button>
                                    </div>
                                </div>
                            

                                <table class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>S/N</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Neg. Amount</th>
                                            <th>Project</th>
                                            <th>Product & Qty</th> 
                                            <th>Freelancer</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($rejections as  $rejection)
                                        <tr class="">
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" name="rejection_id[]" value="{{$rejection->id}}" id="flexCheckChecked" >
                                            </td>
                                            <td> {{ $loop->iteration}}</td>
                                            <td> {{ $negotiation->created_at }}</td>
                                            <td> {{ @$negotiation->customer->user->name }}</td>
                                            <td> {{ @$negotiation->customer->user->phone }}</td>
                                            <td> {{ @$negotiation->customer->user->userAddress->address }}</td>
                                            <td> {{ @$negotiation->negotiation_amount }}</td>
                                            <td> {{ @$negotiation->project->name }}</td>
                                            <td>  2 #dummmy </td>
                                            <td>  {{ @$negotiation->employee->user->name }} </td>
                                        </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 
    @include('includes.footer')
</div>


@endsection 

@section('script')

@endsection