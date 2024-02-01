@extends('layouts.dashboard')
@section('title',"Special Offer List")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
           
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                           <div class="table-box" style="overflow-x: scroll;">
                            <table class="table table-hover table-bordered table-striped dt-responsive fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class=""> 
                                        <th>Action</th>
                                        <th>S/L</th>
                                        <th>Offer Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Extension Date</th>
                                        <th>Designation</th> 
                                        <th>Deposit Type</th>
                                        <th>Employee</th>
                                        <th>Project Name</th>
                                        <th>Unit Name</th>
                                        <th>Unit Qty</th>
                                        <th>Min Deposit</th>
                                        <th>Follow Up</th>
                                        <th>Negotiation</th> 
                                        <th>Incentive Name & Amount</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('special.offer.achiver')}}">View Achiever</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#extension_date">Date Extension</a> 
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a> 
                                                </div>
                                            </div> 
                                        </td>
                                        <td>1</td>
                                        <td><a href="{{route('special.offer.achiver')}}">Special Promotion</a></td>
                                        <td>2024-02-01</td>
                                        <td>2024-02-15</td>
                                        <td>2024-02-20</td>
                                        <td>Sales Executive, Marketing Executive</td>
                                        <td>Regular</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>10</td>
                                        <td>$5000</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>Bonus - $1000</td>
                                    </tr> 

                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('special.offer.achiver')}}">View Achiever</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#extension_date">Date Extension</a> 
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a> 
                                                </div>
                                            </div> 
                                        </td>
                                        <td>1</td>
                                        <td><a href="{{route('special.offer.achiver')}}">Special Promotion</a></td>
                                        <td>2024-02-01</td>
                                        <td>2024-02-15</td>
                                        <td>2024-02-20</td>
                                        <td>Sales Executive, Marketing Executive</td>
                                        <td>Regular</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>10</td>
                                        <td>$5000</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>Bonus - $1000</td>
                                    </tr> 

                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('special.offer.achiver')}}">View Achiever</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#extension_date">Date Extension</a> 
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a> 
                                                </div>
                                            </div> 
                                        </td>
                                        <td>1</td>
                                        <td><a href="{{route('special.offer.achiver')}}">Special Promotion</a></td>
                                        <td>2024-02-01</td>
                                        <td>2024-02-15</td>
                                        <td>2024-02-20</td>
                                        <td>Sales Executive, Marketing Executive</td>
                                        <td>Regular</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>10</td>
                                        <td>$5000</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>Bonus - $1000</td>
                                    </tr> 

                                    <tr>
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v align-middle ms-2 cursor-pointer"></i></a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('special.offer.achiver')}}">View Achiever</a>
                                                    <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#extension_date">Date Extension</a> 
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a> 
                                                </div>
                                            </div> 
                                        </td>
                                        <td>1</td>
                                        <td><a href="{{route('special.offer.achiver')}}">Special Promotion</a></td>
                                        <td>2024-02-01</td>
                                        <td>2024-02-15</td>
                                        <td>2024-02-20</td>
                                        <td>Sales Executive, Marketing Executive</td>
                                        <td>Regular</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>All</td>
                                        <td>10</td>
                                        <td>$5000</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>Bonus - $1000</td>
                                    </tr> 
                                </tbody>
                            </table>
                           </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>  
    @include('includes.footer') 
</div> 

<div class="modal fade" id="extension_date">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Extension </h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <form action="{{route('zone.store')}}" method="POST">
                @csrf
                <div class="modal-body"> 
                    <div class="form-group mb-2">
                        <label for="name">Extension Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="name" name="name" required>
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
 
@endsection
 