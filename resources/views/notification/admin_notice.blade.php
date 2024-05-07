@extends('layouts.dashboard')
@section('title','Notice List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Notice List</h4>
                        @can('bank-manage') 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> New Notice</span>
                                </button> 
                            </ol>
                        </div> 
                        @endcan
                    </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">
 

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>Action</th> 
                                        <th>S/N</th> 
                                        <th>Title</th> 
                                        <th>Content</th>  
                                        <th>Link</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $data)
                                        <tr> 
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($data)}})">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('bank.destroy',$data->id) }}')">Delete</a>    
                                                    </div>
                                                </div> 
                                            </td>  
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->title}}</td>
                                            <td>{{$data->content}}</td>
                                            <td>{{$data->link}}</td>
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
                <h5 class="modal-title">Send new notice</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="{{route('admin-notice.store')}}" method="POST">  
                @csrf
                    <div class="modal-body"> 
                        <div class="form-group mb-2">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter notice title" required>
                        </div> 

                        <div class="form-group mb-2">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" placeholder="Enter notice content" required></textarea>
                        </div> 

                        <div class="form-group mb-2">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="Enter notice title">
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
                <h5 class="modal-title">Update Bank</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="" method="POST">  
                @csrf  
                @method('PUT')
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="name">Bank Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Bank" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="bank_type">Bank Type <span class="text-danger">*</span></label>
                        <select id="bank_type" class="select2" name="type" required> 
                            <option value="1">Mobile Banking</option> 
                            <option value="0" selected>Bank</option> 
                        </select> 
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
    <script>
        function editItem(data){
            let url = "{{route('bank.update',':id')}}";
            url = url.replace(':id',data.id);
            $('#edit_modal form').attr('action',url);
            $('#edit_modal form input[name="name"]').val(data.name);
            $('#edit_modal form select[name="type"]').val(data.type).trigger('change');
            $('#edit_modal').modal('show');
        }
    </script>
@endsection
