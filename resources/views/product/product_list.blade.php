@extends('layouts.dashboard')
@section('title','Product List')
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product List</h4>
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
                            <div class="table-box">
                                <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr class="">
                                            <th>Action</th>
                                            <th>S/N</th>
                                            <th>Name & ID</th>
                                            <th>Address</th>
                                            <th>Floor</th>
                                            @foreach($unit_headers as $header)
                                                <th>{{ ucfirst($header->title) }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($projects as  $project)
                                        <tr class="">
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                        @if($project->approved_by !=null)
                                                            <i class="fas fa-check"></i>
                                                        @endif
                                                        <img class="rounded avatar-2xs p-0" src="{{asset($project->image())}}" alt="Header Avatar">
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="{{route('product.edit',$project->id)}}">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('product.delete',$project->id) }}')">Delete</a>
                                                        <a class="dropdown-item" href="{{route('sold.unsold',encrypt($project->id))}}">Sold & Unsold</a>
                                                        <a class="dropdown-item" href="{{route('salse.index')}}">Sales History</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration}} </td>
                                            <td>{{ @$project->name }}</td>
                                            <td>{{ @$project->address }}</td>
                                            <td>{{ @$project->total_floor}}</td>
                                            @foreach($unit_headers as $header)
                                                <td>{{$salse->where('project_id',$project->id)->where('unit_id',$header->id)->count()}} / {{ $project->units->where('unit.title', $header->title)->count() }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="offcanvas offcanvas-end" id="offcanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Select Filter Item</h5>
                    <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <form action="{{route('product.search')}}" method="POST">
                        @csrf
                        <div class="row">
                            @include('common.search', [
                                'div' => 'col-md-6',
                                'visible' => ['division', 'district', 'upazila','union','village'],
                            ])
                            <input type="hidden" id="division" value="{{ @$division }}">
                            <input type="hidden" id="district" value="{{ @$district }}">
                            <input type="hidden" id="upazila" value="{{ @$upazila }}">
                            <input type="hidden" id="union" value="{{ @$union }}">
                            <input type="hidden" id="village" value="{{ @$village }}">
                            <div class="text-end ">
                                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                <button class="btn btn-outline-danger" type="button" onclick="resetFormFields()">
                                    <i class="mdi mdi-refresh"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
@endsection

@section('script')

@include('includes.data_table')
@endsection
