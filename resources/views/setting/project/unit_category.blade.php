@extends('layouts.dashboard')
@section('title','Unit Category')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Unit Category</h4> 
                        @can('unit-category-manage')
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Unit Category</span>
                                </button> 
                            </ol>
                        </div> 
                        @endcan
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        @can('unit-category-manage')
                                        <th>Action</th>
                                        @endcan
                                        <th>S/N</th> 
                                        <th>Union Category Name</th>
                                        <th>Description</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $item)
                                    <tr>
                                        @can('unit-category-manage')
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($item)}})">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('unit.category.delete',$item->id) }}')">Delete</a>   
                                                </div>
                                            </div> 
                                        </td>
                                        @endcan 
                                        <td>{{$key + 1}}</td>
                                        <td>{{$item->title}}</td>  
                                        <td>{{$item->description}}</td> 
                                    </tr>  
                                    @endforeach 
                                </tbody>
                            </table>
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
                <h5 class="modal-title">Create Unit Category</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="{{route('unit.category.store')}}" method="post">
                @csrf 
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="title">Unit Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Union Category" required>
                    </div> 
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                    </div>   
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div>
            </form> 
        </div>
    </div>
</div> 

<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Update Unit Category</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="{{route('unit.category.update')}}" method="post">
                @csrf  
                <input type="hidden" name="id">
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="title">Unit Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Union Category" required>
                    </div> 
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="5"></textarea>
                    </div>   
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button> <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div>
            </form> 
        </div>
    </div>
</div> 
  
@endsection 

@section('script')
    <script>
        function editItem(data) {
            $('#edit_modal input[name=id]').val(data.id);
            $('#edit_modal input[name=title]').val(data.title);
            $('#edit_modal textarea[name=description]').val(data.description);
            $('#edit_modal').modal('show');
        }
    </script>
@endsection