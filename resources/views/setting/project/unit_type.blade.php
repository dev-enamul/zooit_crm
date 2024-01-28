@extends('layouts.dashboard')
@section('title','Unit Type')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Unit Type</h4>  
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Unit Type</span>
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

                            <div class="d-flex justify-content-between"> 
                                
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th> 
                                        <th>Union Name</th>
                                        <th>Down Payment</th>
                                        <th>Booking Money</th>  
                                    </tr>
                                </thead>
                                <tbody>  

                                    @foreach ($datas as $key => $item)
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>  
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->title}}</td>  
                                        <td>{{get_price($item->down_payment)}}</td>
                                        <td>{{get_price($item->booking)}}</td>
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
                <h5 class="modal-title">Create Unit Type</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>  
            <form action="{{route('unit.type.store')}}" method="post">  
                @csrf
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                            <label for="union">Unit Type <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="union" name="union"  required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="down_payment">Down Payment <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="down_payment" name="down_payment"  required>
                        </div> 

                        <div class="form-group mb-2">
                            <label for="booking">Booking Money <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="booking" name="booking"  required>
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