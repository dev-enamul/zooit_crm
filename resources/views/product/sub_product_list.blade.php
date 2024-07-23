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
                       <div>
                            <h4 class="mb-sm-0">Sub Product List</h4>
                            <p class="d-none"></p>
                            <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">
                            <input type="hidden" id="pageSize" value="A4">
                            <input type="hidden" id="fontSize" value="10"> 
                       </div> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add SubProduct</span>
                                </button> 
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
                            <div class="table-box">
                                <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr class="">
                                            <th>Action</th>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Product Name</th> 
                                            <th>Price</th>
                                            <th>Description</th> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach ($datas as  $data)
                                        <tr class="">
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"> 
                                                        <i class="fa fa-ellipsis-h fs-12"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($data)}})">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('sub-product.destroy',$data->id) }}')">Delete</a>
                                                        {{-- <a class="dropdown-item" href="{{route('salse.index')}}">Sales History</a> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration}} </td>
                                            <td>{{ @$data->name }}</td> 
                                            <td>{{ @$data->project->name }}</td> 
                                            <td>{{$data->price}}</td>
                                            <td>{{$data->description}}</td>
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
    @include('includes.footer')
</div>

<div class="modal fade" id="create_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create Sub Product</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('sub-product.store')}}" method="POST">  
                @csrf
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label class="form-label" for="project_id">Product <span class="text-danger">*</span></label>
                        <select id="project_id" class="select2" name="project_id" required> 
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach 
                        </select> 
                    </div> 

                    <div class="form-group mb-2">
                        <label class="form-label" for="name">Sub Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Bank" required>
                    </div>
                    
                    <div class="form-group mb-2">
                        <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price">
                    </div>  

                    <div class="form-group mb-2">
                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="text-end">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
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
                <h5 class="modal-title">Product Bank</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="" method="POST">  
                @csrf  
                @method('PUT')
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label class="form-label" for="project_id">Product <span class="text-danger">*</span></label>
                        <select id="project_id" class="select2" name="project_id" required> 
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}">{{$project->name}}</option>
                            @endforeach 
                        </select> 
                    </div> 

                    <div class="form-group mb-2">
                        <label class="form-label" for="name">Sub Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Bank" required>
                    </div>
                    
                    <div class="form-group mb-2">
                        <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price">
                    </div>  

                    <div class="form-group mb-2">
                        <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="text-end">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 
            </form>
        </div>
    </div>
</div>  

@endsection

@section('script') 
@include('includes.data_table')


<script>
    function editItem(data){
        let url = "{{route('sub-product.update',':id')}}";
        url = url.replace(':id',data.id);
        $('#edit_modal form').attr('action',url);
        $('#edit_modal form select[name="project_id"]').val(data.project_id).trigger('change');
        $('#edit_modal form input[name="name"]').val(data.name); 
        $('#edit_modal form input[name="price"]').val(data.price); 
        $('#edit_modal form input[name="description"]').val(data.description); 
        $('#edit_modal').modal('show');
    }
</script>
@endsection
