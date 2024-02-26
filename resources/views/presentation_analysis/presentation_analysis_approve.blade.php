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
                        <h4 class="mb-sm-0">Visit Analysis Approve</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Visit Analysis Approve List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('presentation-analysis.approve.save')}}" method="POST">
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
                                            <th>Project Name</th>
                                            <th>Negotiation Person</th>
                                            <th>Phone</th>
                                            <th>Total Visitor</th> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach ($presentations as  $visit)
                                        <tr class="">
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" name="customer_id[]" value="{{$visit->customer_id}}" id="flexCheckChecked" >
                                            </td>
                                            <td class="">{{ $loop->iteration}}</td>
                                        <td class="">{{ get_date($visit->created_at) }}</td>
                                        <td class="">
                                            @php
                                                $projects = json_decode($visit->projects);
                                            @endphp
                                            @foreach($projects as $key => $project)
                                            @if ($key!=0)
                                                ,
                                            @endif
                                            {{ $project }}
                                            @endforeach
                                        </td>
                                        <td class="">{{ @$visit->customer->user->name }}</td>
                                        <td class=""> {{ @$visit->customer->user->phone }}</td>
                                        <td class=""><span class="badge badge-label-success"> 
                                            @php
                                                $visitors = json_decode($visit->visitors);
                                                $totalVisitors = count($visitors);
                                            @endphp
                                           {{ $totalVisitors }}    
                                        
                                        </span></td> 
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