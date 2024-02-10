@extends('layouts.dashboard')
@section('title','Prospecting List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Prospecting List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Prospecting List</li>
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
                                    
                                </div>
                                <div class="">
                                    <div class="dt-buttons btn-group flex-wrap mb-2">      
                                        <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                            <span><i class="fas fa-filter"></i> Filter</span>
                                        </button> 
                                    </div>
                                </div>
                           </div>

                            <table id=" " class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Profession</th>
                                        <th>Upazilla/Thana</th>
                                        <th>Union</th>
                                        <th>Village</th>
                                        <th>Prospecting</th>
                                        <th>Mobile No</th>
                                        <th>Freelancer</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($prospectings as  $prospecting)
                                    <tr class="">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>

                                                <div class="dropdown-menu dropdown-menu-animated"> 
                                                    <a class="dropdown-item" href="{{route('prospecting.edit',$prospecting->id)}}">Edit</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="deleteItem('{{ route('prospecting.delete',$prospecting->id) }}')">Delete</a>  
                                                    <a class="dropdown-item" href="">Cold Calling</a>
                                                </div>
                                            </div> 
                                        </td> 
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ @$prospecting->customer->user->name }}</td>
                                        <td>{{ @$prospecting->customer->profession }}</td>
                                        <td>{{ @$prospecting->customer->upazilla }}</td>
                                        <td>{{ @$prospecting->customer->union }}</td>
                                        <td>{{ @$prospecting->customer->village }}</td>
                                        <td>{{ @$prospecting->prospecting }}</td>
                                        <td>{{ @$prospecting->customer->user->mobile }}</td>
                                        <td>{{ @$prospecting->freelancer->user->name }}</td>
                                        <td>{{ @$prospecting->remark }}</td>
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

<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <div class="row">

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="freelancer" class="form-label">Freelancer</label>
                    <select class="select2" search id="freelancer" name="freelancer" required>
                        <option value="">Select Freelancer</option> 
                        <option value="">Md Enamul Haque #FL1545 01796351081</option> 
                        <option value="">Jamil Hosain #FL1545 01796351081</option> 
                        <option value="">Md Mehedi Hasan #FL1545 01796351081</option> 
                        <option value="">Suvo Hasan #FL1545 01796351081</option>  
                    </select> 
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer name <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Customer name" >
                </div>
            </div> 

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                    <select class="form-select" name="profession" id="profession">
                        <option value="">Select Profession</option>
                        <option value="">Doctors</option>
                        <option value="">Lawyers</option> 
                        <option value="">Banker</option>
                        <option value="">Teacher</option>
                        <option value="">Engineer</option>
                    </select>  
                </div>
            </div> 

            <div class="text-center">
                <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
            </div>

        </div>
    </div>
</div>
@endsection