@extends('layouts.dashboard')
@section('title','Permission')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
           
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="mb-sm-0" id="#swal-11">Permission List </h4>  
                            <div class="">
                                <div class="btn-group flex-wrap mb-2">      
                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_profession">
                                        <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Permission</span>
                                    </button> 
                                </div>
                            </div>
                        </div>
                        <div class="card-body"> 
                            <div class="row">
                                @foreach ($datas as $data)
                                    <div class="col-md-4 mb-4"> 
                                        <div class="form-check">
                                            {{-- <input class="form-check-input" type="checkbox" value="user_create" name="permission" id="flexCheckChecked"> --}}
                                             <label class="form-check-label" for="flexCheckChecked"> <i class="mdi mdi-book-check text-primary"></i> {{$data->name}}</label>

                                            {{-- <button class="btn btn-secondary btn-sm mr-2">
                                                <span><i class="mdi mdi-clipboard-edit-outline"></i></span>
                                            </button> 

                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#create_profession">
                                                <span><i class="mdi mdi-delete"></i></span>
                                            </button>  --}}
                                        </div> 
                                    </div> 
                                @endforeach   
                            </div> 
                        </div>
                    </div>
                </div> <!-- end col -->
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
 <div class="modal fade" id="create_profession">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h5 class="modal-title">Create new Permission</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                </div> 
                <form action="{{route('permission.store')}}" method="POST">
                    @csrf
                    <div class="modal-body"> 
                            <div class="form-group mb-2">
                                <label for="name">Permission Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>   
                    </div> 
                    <div class="modal-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                            <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i>Reset</button>
                        </div> 
                    </div> 
                </form> 
            </div>
        </div>
    </div>


    {{-- Edit Modal  --}}
    <div class="modal fade" id="edit_permission">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h5 class="modal-title">Edit Permission</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                </div> 
                <form action=" " method="POST">
                    @csrf 
                    @method('put')
                    <div class="modal-body"> 
                            <div class="form-group mb-2">
                                <label for="name">Permission Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>   
                    </div> 
                    <div class="modal-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                            <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i>Reset</button>
                        </div> 
                    </div> 
                </form> 
            </div>
        </div>
    </div>
@endsection 
 