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
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                          
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
                                                        <a class="dropdown-item" href="{{route('salse.index')}}">Sales History</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration}} </td>
                                            <td>{{ @$project->name }}</td> 
                                            <td>{{ @$project->price }}</td> 
                                            <td>{{$project->description}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
