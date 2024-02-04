@extends('layouts.dashboard')
@section('title','Commission')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Commission</h4>  
                        @can('regular-commission-manage')
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_profession">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Commision</span>
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
                                        @can('regular-commission-manage')
                                            <th>Action</th>
                                        @endcan
                                        <th>S/N</th>
                                        <th>Commission Title</th>
                                        <th>Designation</th> 
                                        <th>Commission</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $item)
                                    <tr>
                                        @can('regular-commission-manage')
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($item)}})">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('commission.destroy',$item->id) }}')">Delete</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        @endcan
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->title}}</td>  
                                        <th>
                                            @if ($item->designations->count() == 0)
                                                -
                                            @else
                                                @foreach ($item->designations as $designation)
                                                    <span class="badge badge-primary mb-1">{{@$designation->title}}</span>
                                                @endforeach 
                                            @endif
                                        </th>
                                        <th>{{$item->commission}}%</th> 
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

<div class="modal fade" id="create_profession">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create Commission</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 

            <form action="{{route('commission.store')}}" method="POST">
                @csrf
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>  
                    <div class="form-group mb-2">
                        <label for="commission">Commission [%]<span class="text-danger">*</span></label>
                        <input type="number" step="any" class="form-control" id="commission" name="commission" required>
                    </div>   
                </div>

                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button type="button" class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div>
            </form> 
        </div>
    </div>
</div>  


<div class="modal fade" id="update_profession">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Update Commission</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>  
            <form action="{{route('commission.update')}}" method="POST">
                @csrf 
                <input type="hidden" name="id">
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>  
                    <div class="form-group mb-2">
                        <label for="commission">Commission [%]<span class="text-danger">*</span></label>
                        <input type="number" step="any" class="form-control" id="commission" name="commission" required>
                    </div>   
                </div>

                <div class="modal-footer">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button type="button" class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div>
            </form> 
        </div>
    </div>
</div> 


 

@endsection 

@section('script')
<script>
    function editItem(id){   
        $('#update_profession input[name=id]').val(id.id); 
        $('#update_profession input[name=title]').val(id.title); 
        $('#update_profession input[name=commission]').val(id.commission); 
        $('#update_profession').modal('show');
    } 
</script>
@endsection