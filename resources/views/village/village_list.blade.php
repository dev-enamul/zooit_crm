@extends('layouts.dashboard')
@section('title','Village List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Villages</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Village List</li>
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
                                <div class="">
                                    {{-- <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-primary buttons-copy buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-excel"></i> Excel</span>
                                        </button>

                                        <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="datatable-buttons" type="button">
                                            <span><i class="fas fa-file-csv"></i> CSV</span>
                                        </button>  
                                    </div>  --}}
                                    <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                        <span><i class="mdi mdi-clipboard-plus-outline"></i> Add Village</span>
                                    </button> 
                                </div>

                                <div class="">
                                    <div class="d-flex">   
                                        <div class="input-group">   
                                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#filter_offcanvas">
                                                <span><i class="fas fa-filter"></i> Filter</span>
                                            </button> 
                                        </div>
                                    </div> 

                                  
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th> 
                                        <th>Village</th>
                                        <th>Union</th> 
                                        <th>Upazilla</th> 
                                        <th>District</th> 
                                        <th>Division</th>     
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($villages as $key => $item)
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('village.destroy',$item->id) }}')" >Delete</a>  
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{$key+1}}</td>
                                        <td>{{$item->name}}</td>  
                                        <td>{{@$item->union->name}}</td>
                                        <td>{{@$item->union->upazilla->name}}</td>
                                        <td>{{@$item->union->upazilla->district->name}}</td>
                                        <td>{{@$item->union->upazilla->district->division->name}}</td> 
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
                <h5 class="modal-title">Create new Village</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="{{route('village.store')}}" method="post"> 
                    @csrf 
                  <div class="row">
                    @include('common.area', [
                        'div'       => 'col-md-6',
                        'mb'        => 'mb-3',
                        'visible'   => ['division', 'district', 'upazila','union'],
                        'required'  => ['division', 'district', 'upazila','union'],
                    ])
                  </div> 

                    <div class="form-group mb-2">
                        <label for="word_no">Word No <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="word_no" name="word_no" placeholder="Enter Word No" required>
                    </div>

                    <div class="form-group mb-2">
                        <label for="village">Village <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="village" name="village" placeholder="Enter Village" required>
                    </div>
                    
                    <div class="modal-footer">
                        <div class="text-end">
                            <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                        </div> 
                    </div>
                </form>
            </div> 

            <!-- <div class="modal-footer"><button class="btn btn-primary">Submit</button> <button class="btn btn-outline-danger">Reset</button></div> -->
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" id="filter_offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Filter Union</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row"> 
 
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="division_filter" class="form-label">Division</label>
                    <select id="division_filter" class="select2" name="division_filter" search>
                        <option value="">All Division</option> 
                        <option value="">Dhaka </option> 
                        <option value="">Rajshahi</option> 
                        <option value="">Rangpur</option> 
                        <option value="">Borisal</option>
                        <option value="">Sylet</option>  
                    </select> 
                </div>
            </div> 

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="district_filter" class="form-label">Districe</label>
                    <select id="district_filter" class="select2" name="district_filter" search>
                        <option value="">All Districe</option> 
                        <option value="">Naogaon </option> 
                        <option value="">Joypurhat</option> 
                        <option value="">Bogura</option> 
                        <option value="">Pabna</option>
                        <option value="">Rajshahi</option>  
                    </select> 
                </div>
            </div> 

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="thana_filter" class="form-label">Thana / Upazila</label>
                    <select id="thana_filter" class="select2" name="thana_filter" search>
                        <option value="">All Thana / Upazila</option> 
                        <option value="">Badulgachi </option> 
                        <option value="">Sapahar</option> 
                        <option value="">Mohadebpur</option> 
                        <option value="">Porsha</option>
                        <option value="">Attrai</option>  
                    </select> 
                </div>
            </div> 
            
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="union_filter" class="form-label">Union</label>
                    <select id="union_filter" class="select2" name="union_filter" search>
                        <option value="">All Union</option> 
                        <option value="">Mothorapur </option> 
                        <option value="">Jabaripur</option> 
                        <option value="">Badulgachhi</option> 
                        <option value="">Akkelpur</option>
                        <option value="">Sagorpur</option>  
                    </select> 
                </div>
            </div>
 
            <div class="text-end ">
                <button class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
            </div> 

        </div>
    </div>
</div>
@endsection