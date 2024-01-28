@extends('layouts.dashboard')
@section('title','Area List')
@section('style')
    <style>
        .select2{
            min-width: 150px !important;
        }
    </style>
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Areas</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                             
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
                            <div class="d-flex justify-content-between mb-3"> 
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#create_area">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Area</span>
                                </button>

                                <div class="">  
                                    <form action="" method="get">
                                        <div class="input-group">   
                                            <select name="zone" id="search_zone_id" class="select2">
                                                <option value="">All</option>
                                                @foreach($zones as $zone)
                                                    <option {{$zone_id==$zone->id?"selected":""}} value="{{$zone->id}}">{{$zone->name}}</option>
                                                @endforeach
                                            </select>  
                                            <button class="btn btn-secondary" type="submit">
                                                <span><i class="fas fa-filter"></i> Filter</span>
                                            </button>  
                                        </div>
                                    </form>
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Action</th>
                                        <th>S/N</th>
                                        <th>Area Name</th>  
                                        <th>Zone Name</th>  
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($datas as $key => $data)
                                        <tr>
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="editItem({{json_encode($data)}})">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('area.destroy',$data->id) }}')">Delete</a>   
                                                    </div>
                                                </div> 
                                            </td> 
                                            <td>{{$key+1}}</td>
                                            <td>{{$data->name}}</td>  
                                            <td>{{@$data->zone->name}}</td> 
                                            
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
<div class="modal fade" id="create_area">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create new Area</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('area.store')}}" method="POST">
                @csrf 


                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="zone_id">Zone <span class="text-danger">*</span></label>
                        <select name="zone_id" id="zone_id" class="select2">
                            @foreach($zones as $zone)
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="form-group mb-2">
                        <label for="name">Area Name <span class="text-danger">*</span></label>
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
<div class="modal fade" id="edit_area">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create new Area</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('area.update')}}" method="POST"> 
                @csrf  

                <input type="hidden" name="id">
                <div class="modal-body">  
                    <div class="form-group mb-2">
                        <label for="update_zone_id">Zone <span class="text-danger">*</span></label>
                        <select name="zone_id" id="update_zone_id" class="select2">
                            @foreach($zones as $zone)
                                <option value="{{$zone->id}}">{{$zone->name}}</option>
                            @endforeach
                        </select>
                    </div> 

                    <div class="form-group mb-2">
                        <label for="name">Area Name <span class="text-danger">*</span></label>
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
        function editItem(data){   
            $('#update_zone_id').val(data.zone_id); 
            $('#update_zone_id').select2();
            $('#edit_area').find(' input[name="name"]').val(data.name);
            $('#edit_area').find(' input[name="id"]').val(data.id);
            $('#edit_area').modal('show');
        }
    </script>
@endsection