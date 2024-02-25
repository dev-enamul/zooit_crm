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
                        <h4 class="mb-sm-0">Presentation Analysis</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Presentation Analysis List</li>
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
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" name="presentation[]" value="{{$presentation->id}}" id="flexCheckChecked" >
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ @$presentation->created_at }}</td>
                                            <td>{{ @$presentation->customer->user->name }}</td>
                                            <td>{{ @$presentation->customer->profession->name }}</td>
                                            <td>{{ @$presentation->customer->user->userAddress->address }}</td>
                                            <td>{{ @$presentation->customer->user->marital_status }}</td>
                                            <td>{{ @$presentation->created_at }} #dummy</td>
                                            <td>{{ @$presentation->project->name }}</td>
                                            <td>{{ @$presentation->unit->title }}</td>
                                            <td> Dummy </td>
                                            <td>{{ @$presentation->created_at  }} #dummy</td>
                                            <td>{{ @$presentation->freelancer->user->name }}</td>
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