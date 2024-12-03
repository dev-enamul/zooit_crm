@extends('layouts.dashboard')
@section('title','Lead Source')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Soruce List</h4>  
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_service">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Source</span>
                                </button>
                            </ol>
                        </div>  
                    </div>
                </div>
            </div>
         
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">  
                            <table id="datatable-buttons" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th class="text-center">Action</th> 

                                        <th>S/N</th>
                                        <th>Source Name</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($datas as $key => $data)
                                        <tr> 
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        {{-- <a class="dropdown-item" href="javascript:void(0)" onclick="editItem(@json($data))">Edit</a> --}}
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('lead-source.destroy',$data->id) }}')">Delete</a>   
                                                    </div>
                                                </div> 
                                            </td>  
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->name}}</td> 
                                           
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

{{-- Create Modal   --}}
<div class="modal fade" id="create_service">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create new Source</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('lead-source.store')}}" method="POST">
                @csrf
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="name">Source Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div> 
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 
            </form> 
        </div>
    </div>
</div> 


{{-- Edit Modal  --}}
<div class="modal fade" id="edit_service">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Edit Service</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('profession.update')}}" method="POST"> 
                @csrf  

                <input type="hidden" name="id">
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="name">Profession Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div> 
                </div> 
                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 
            </form> 
        </div>
    </div>
</div> 

@endsection 

@section('script')
<script>
    var title = "Profession List";
    var Period = "";
</script> 
<script>  
    function editItem(data){   
        $('#edit_service').find(' input[name="service"]').val(data.service);
        $('#edit_service').find(' input[name="id"]').val(data.id);
        $('#edit_service').modal('show');
    }
</script>
@endsection