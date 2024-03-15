@extends('layouts.dashboard')
@section('title','Unit List')
 
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Unit List</h4>
                        <p class="d-none"></p> 
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="A4">
                        <input type="hidden" id="fontSize" value="10"> 

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
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">
                                        <th>Action</th>
                                        <th>S/N</th> 
                                        <th>Unit Name</th>
                                        <th>Project Name</th>
                                        <th>Unit Type</th>
                                        <th>Category</th>
                                        <th>Price</th> 
                                        <th>Status</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($projectUnits as  $projectUnit)
                                        <tr class="">
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img class="rounded avatar-2xs p-0" src="{{ asset('../assets/images/users/avatar-6.png') }}" alt="Header Avatar">
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-animated"> 
                                                        <a class="dropdown-item" href="{{route('unit.edit',$projectUnit->id)}}">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('project.unit.delete',$projectUnit->id) }}')">Delete</a>  
                                                        <a class="dropdown-item" href="{{route('sold.unsold',$projectUnit->id)}}">Sold & Unsold</a>
                                                        <a class="dropdown-item" href="{{route('salse.index')}}">Sales History</a>  
                                                    </div>
                                                </div> 
                                            </td>  
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ @$projectUnit->name }}</td>
                                            <td>{{ @$projectUnit->project->name }}</td>
                                            <td>{{ @$projectUnit->unit->title}}</td>
                                            <td>{{ @$projectUnit->unitCategory->title}}</td>
                                            <td>{{ get_price(@$projectUnit->lottery_price)}}</td>
                                            <td>
                                                Unsold
                                            </td>
                                        </tr> 
                                    @endforeach
                                </tbody>
                            </table> <!-- end table -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer> 
</div> 

<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('project.unit.search') }}" method="POST">
            @csrf
            <div class="row">
                @include('common.search', [
                    'div' => 'col-md-12',
                    'visible' => ['statusUnit', 'project'],
                ])
                <input type="hidden" id="status" value="{{ @$status }}">
                <input type="hidden" id="project" value="{{ @$project }}">
        
                <div class="text-end">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                    <button class="btn btn-outline-danger" type="button" onclick="resetFormFields()">
                        <i class="mdi mdi-refresh"></i> Reset
                    </button>
                </div>
            </div>
        </form> 
    </div> 
</div>
@endsection

@section('script') 
@include('includes.data_table')
@endsection