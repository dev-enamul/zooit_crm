@extends('layouts.dashboard')
@section('title','Unit List')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Unit List</h4> 
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
                            <table id="unit_table" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                                    <a class="dropdown-item" href="{{route('sold.unsold')}}">Sold & Unsold</a>
                                                    <a class="dropdown-item" href="{{route('salse.index')}}">Sales History</a>  
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ @$projectUnit->name }}</td>
                                        <td>{{ @$projectUnit->project->name }}</td>
                                        <td>{{ @$projectUnit->unit->title}}</td>
                                        <td>{{ @$projectUnit->unitCategory->title}}</td>
                                        <td>{{ @$projectUnit->unit->down_payment}}</td>
                                        <td>{{ @$projectUnit->status == 1 ?'Active' : 'Inactive' }}</td> 
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

{{-- <div class="offcanvas offcanvas-end" id="offcanvas">
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
                    <label for="status" class="form-label">Status </label>
                    <select class="select2" name="status" id="status"> 
                        <option value="">Sold </option> 
                        <option value="">Blocked </option> 
                        <option value="">Available </option>
                    </select>  
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="project" class="form-label">Project </label>
                    <select class="select2" search name="project" id="project">
                        <option value="">All</option>
                        <option value="1">City Plaza</option>
                        <option value="2">Green Valley</option>
                        <option value="3">Ocean View</option>  
                    </select>  
                </div>
            </div> 
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div>

<div class="offcanvas-body">
    <form action="{{route('project.unit.search')}}" method="POST">
        @csrf
        <div class="row"> 
            @include('common.search', [
                'div' => 'col-md-12',
                'visible' => ['status', 'project'],
            ])
            <input type="hidden" id="status" value="{{ @$division }}">
            <input type="hidden" id="project" value="{{ @$project }}">

            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> 
                <button class="btn btn-outline-danger" type="button" onclick="resetFormFields()">
                    <i class="mdi mdi-refresh"></i> Reset
                </button>                            
            </div> 
        </div>
    </form>
</div> --}}
@endsection

@section('script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    
    <script>
        $(document).ready(function () {
            var table = $('#unit_table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Excel',
                        filename: 'export',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        text: 'CSV',
                        filename: 'export',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            }); 
        });
    </script>
@endsection