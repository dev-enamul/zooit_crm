@extends('layouts.dashboard')
@section('title','Bank Day')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Bank Day</h4> 
                        @can('bank-day-manage')
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i>Add Bank Day</span>
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
                                        @can('bank-day-manage')
                                        <th>Action</th>
                                        @endcan
                                        <th>S/N</th> 
                                        <th>Month</th> 
                                        <th>Bank Day</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($datas as $key => $item)
                                        <tr>
                                            @can('bank-day-manage')
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($item)}})">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)"onclick="deleteItem('{{ route('bank-day.destroy',$item->id) }}')">Delete</a>  
                                                    </div>
                                                </div> 
                                            </td> 
                                            @endcan
                                            <td>{{$key+1}}</td>
                                            <td>{{get_date($item->month, 'M-Y')}}</td> 
                                            <td>
                                                @foreach(json_decode($item->bank_day) as $bank_day)
                                                <div class="btn btn-sm btn-primary mb-2">{{$bank_day}}</div>
                                                @endforeach
                                            </td>
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
                <h5 class="modal-title">Create Monthly Bank Day</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="{{route('bank-day.store')}}" method="POST">  
                @csrf
                <div class="modal-body"> 
                        <div class="form-group mb-2">
                            <label for="month">Month <span class="text-danger">*</span></label>
                            <input type="month" class="form-control" id="month" name="month" placeholder="Enter Bank" required>
                        </div> 

                        <div class="form-group mb-2">
                            <label for="bank_day">Bank Days<span class="text-danger">*</span></label>
                            <select id="bank_day" multiple class="select2" name="bank_day[]" required> 
                                @for($i=1; $i<=31;$i++)
                                <option value="{{$i}}" selected>{{$i}}</option> 
                                @endfor
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

<div class="modal fade" id="edit_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Edit Monthly Bank Day</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="{{route('bank-day.store')}}" method="POST">  
                @csrf 
                @method('PUT')
                <div class="modal-body"> 
                        <div class="form-group mb-2">
                            <label for="month">Month <span class="text-danger">*</span></label>
                            <input type="month" class="form-control" id="month" name="month" placeholder="Enter Bank" required disabled>
                        </div> 

                        <div class="form-group mb-2">
                            <label for="new_bank_day">Bank Days<span class="text-danger">*</span></label>
                            <select id="new_bank_day" multiple class="select2" name="bank_day[]" required> 
                                @for($i=1; $i<=31;$i++)
                                <option value="{{$i}}">{{$i}}</option> 
                                @endfor
                            </select> 
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
        function editItem(data){  
                let url = "{{route('bank-day.update',':id')}}";
                url = url.replace(':id',data.id);
 
                $('#edit_modal form').attr('action',url);
                $('#edit_modal #month').val(data.month);
                
                $('#new_bank_day option').each(function() { 
                if (data.bank_day.includes($(this).val())) { 
                    $(this).prop('selected', true);
                }
            });
 
            $('#new_bank_day').select2();

                $('#edit_modal').modal('show'); 
        }
    </script>
@endsection
