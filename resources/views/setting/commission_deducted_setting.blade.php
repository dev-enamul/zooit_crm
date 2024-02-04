
@extends('layouts.dashboard')
@section('title','Commission Deducted Setting')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Commission Deducted Setting</h4> 
                        @can('commission-deducation-manage')
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Setting</span>
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
                                        @can('commission-deducation-manage')
                                        <th>Action</th>
                                        @endcan
                                        <th>S/L</th>
                                        <th>Start Amount</th>
                                        <th>End Amount</th>
                                        <th>Deduction</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $item)
                                        <tr>
                                            @can('commission-deducation-manage')
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($item)}})">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('commission-deducted-setting.destroy',$item->id) }}')">Delete</a>   
                                                    </div>
                                                </div> 
                                            </td> \
                                            @endcan
                                            <th>{{$key+1}}</th>
                                            <th>{{$item->start_amount}}</th>
                                            <th>{{$item->end_amount}}</th>
                                            <th>{{$item->deducted}}%</th>
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
                <h5 class="modal-title">Create new Setting</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="{{route('commission-deducted-setting.store')}}" method="POST">
                @csrf   
                @php 
                    $start_amount = $datas[count($datas)-1]->end_amount+1;
                @endphp
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label>Start Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" value="{{$start_amount}}" name="start_amount" readonly >
                    </div>

                    <div class="form-group mb-2">
                        <label for="end_amount">End Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="end_amount" min="{{$start_amount}}" name="end_amount" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="deducted">Deduction %<span class="text-danger">*</span></label>
                        <input type="number" step="any" class="form-control" id="deducted" name="deducted" required>
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
                <h5 class="modal-title">Edit Setting</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="" method="POST">
                @csrf     
                @method('PUT')
                <input type="hidden" name="id">
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label>Start Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" value="" name="start_amount">
                    </div>

                    <div class="form-group mb-2">
                        <label for="end_amount">End Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="end_amount" min="" name="end_amount" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="deducted">Deduction %<span class="text-danger">*</span></label>
                        <input type="number" step="any" class="form-control" id="deducted" name="deducted" required>
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
@endsection 

@section('script')
    <script>
        function editItem(data){   
            var url = "{{route('commission-deducted-setting.update',':id')}}";
            url = url.replace(':id',data.id);
            $('#edit_modal form').attr('action',url); 

            $('#edit_modal input[name="id"]').val(data.id);
            $('#edit_modal input[name="start_amount"]').val(data.start_amount);
            $('#edit_modal input[name="end_amount"]').val(data.end_amount);
            $('#edit_modal input[name="deducted"]').val(data.deducted);
            $('#edit_modal').modal('show');
        }
    </script>
@endsection