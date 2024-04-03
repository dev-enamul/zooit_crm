@extends('layouts.dashboard')
@section('title','Upazila List')

@section('style')
{{-- <script src="https://cdn.tailwindcss.com"></script> --}}
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Upazila</h4>  
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Upazila List</li>
                                </ol>
                            </div> 
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">

                            <div class="d-flex justify-content-between"> 
                                <div class=""> 
                                    @can('village-manage')
                                        <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                            <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Upazila</span>
                                        </button> 
                                    @endcan
                                </div>

                                <div class="">
                                  

                                  
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        @can('village-manage')
                                        <th>Action</th>
                                        @endcan
                                        <th>S/N</th> 
                                        <th>Upazilla</th> 
                                        <th>District</th> 
                                        <th>Division</th>     
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($datas as $key => $item)
                                    <tr>
                                        @can('village-manage')
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    {{-- <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($item)}})">Edit</a> --}}
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('upazila.destroy',$item->id) }}')" >Delete</a>  
                                                </div>
                                            </div> 
                                        </td> 
                                        @endcan
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>  
                                        <td>{{@$item->name}}</td>
                                        <td>{{@$item->district->name}}</td>
                                        <td>{{@$item->district->division->name}}</td> 
                                    </tr>   
                                    @endforeach  
                                </tbody>  
                            </table>

                            {{$datas->links()}}
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div> 
    @include('includes.footer')
</div> 

<div class="modal fade" id="create_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create new Upazila</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="{{route('upazila.store')}}" method="post"> 
                    @csrf 
                  <div class="row">
                    @include('common.area', [
                        'div'       => 'col-md-6',
                        'mb'        => 'mb-3',
                        'visible'   => ['division', 'district'],
                        'required'  => ['division', 'district'],
                    ])
                    <div class="col-md-12">
                        <label class="mb-1" for="upazila">Upazila <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="upazila" name="upazila" placeholder="Enter Upazila" required>
                    </div>
                  </div>  
                    
                    
                    <div class="modal-footer">
                        <div class="text-end">
                            <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                        </div> 
                    </div>
                </form>
            </div> 

            <!-- <div class="modal-footer"><button class="btn btn-primary">Submit</button> <button class="btn btn-outline-danger">Reset</button></div> -->
        </div>
    </div>
</div> 
 
@endsection 
