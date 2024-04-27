@extends('layouts.dashboard')
@section('title','Rejection List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Rejection List</h4> 
                        <p class="d-none">Employee: {{auth()->user()->name}}</p>
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)"> 
                        <input type="hidden" id="pageSize" value="legal">
                        <input type="hidden" id="fontSize" value="8"> 
                        <div class="page-title-right">
                            <div class="flex-wrap mb-2">      
                                <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                    <span><i class="fas fa-filter"></i> Filter</span>
                                </button> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body">  
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Neg. Amount</th>
                                        <th>Project</th>
                                        {{-- <th>Product & Qty</th>  --}}
                                        <th>Freelancer</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($negotiations as  $negotiation)
                                    <tr class="{{$negotiation->approve_by==null?"table-warning":""}}">
                                        <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded avatar-2xs p-0" src="{{@$negotiation->customer->user->image()}}">
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-animated">
                                                    <a class="dropdown-item" href="{{route('customer.profile',encrypt($negotiation->customer_id))}}">Customer Profile</a>
                                                    <a class="dropdown-item" href="{{route('rejection.create',['customer'=>$negotiation->customer->id])}}">Write Reject Reason</a>
                                                    @if ($negotiation->approve_by != null)
                                                        @can('sales-manage')
                                                            <a class="dropdown-item" href="{{route('salse.create',['customer'=>$negotiation->customer->id])}}">Salse</a>
                                                        @endcan 
                                                    @endif
                                                </div>
                                            </div> 
                                        </td>
                                        <td class="">{{ $loop->iteration}}</td>
                                        <td class="">{{ get_date($negotiation->created_at) }}</td> 
                                        <td class="">{{ @$negotiation->customer->user->name }}</td>
                                        <td class=""> {{ @$negotiation->customer->user->phone }}</td>
                                        <td class=""> {{ @$negotiation->customer->user->userAddress->address }}</td>
                                        <td class=""> {{ get_price(@$negotiation->negotiation_amount) }}</td>
                                        <td class=""> {{ @$negotiation->project->name }}</td>
                                        {{-- <td class="">{{count(json_decode($negotiation->project_units))}} </td> --}}
                                        <td class="">{{ @$negotiation->customer->reference->name }} [{{ @$negotiation->customer->reference->user_id }}] </td>
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
 {{-- Modal ==================== --}} 

 <div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="" method="get">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="select2" id="status" name="status"> 
                            <option value = "1" >Previous</option>
                            <option value = "0" >Present</option>
                        </select> 
                    </div>
                </div> 

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="date_range" class="form-label">Date</label>
                        <input class="form-control" start="" end="" id="date_range" name="date" default="This Month" type="text" value="" />   
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Employee</label>
                        <select class="select2" search id="employee" name="employee"> 
                            <option value = "" selected="selected"></option>
                        </select> 
                    </div>
                </div>   
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
                </div> 
            </div>
        </form>
    </div>
</div> 
 
@endsection 

@section('script')
@include('includes.data_table')
<script>
    getDateRange('date_range'); 
    $(document).ready(function() { 
           $('#employee').select2({
               placeholder: "Select Employee",
               allowClear: true,
               ajax: {
                   url: '{{ route('select2.employee') }}',
                   dataType: 'json',
                   data: function (params) {
                       var query = {
                           term: params.term
                       }
                       return query;
                   }
               }
           });
       }); 
</script>
@endsection