@extends('layouts.dashboard')
@section('title','Sales List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sales</h4>
                        <input type="hidden" id="hideExport" value=":nth-child(1),:nth-child(2)">
                        <input type="hidden" id="pageSize" value="a3">
                        <input type="hidden" id="fontSize" value="8">
                        <div class="page-title-right">
                            <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                <span><i class="fas fa-filter"></i> Filter</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                           <div class="table-box" style="overflow-x: scroll;">
                            <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>S/N</th>
                                        <th>Date</th>
                                        <th>CUS ID</th>
                                        <th>Cus. Name</th>
                                        <th>Cus. Mobile Number</th>
                                        <th>Project Name</th>
                                        <th>Unit Name</th>
                                        <th>Unit Qty</th>
                                        <th>Unit Facility</th>
                                        <th>Type No</th>
                                        <th>Floor No</th>
                                        <th>Unit No</th>
                                        <th>Lottery</th>
                                        <th>Regular Price</th>
                                        <th>Sold Price</th>
                                        <th>Discount Amount</th>
                                        <th>Installment Qty.</th>
                                        <th>Collection Amount</th>
                                        <th>DUE Amount</th>
                                        <th>FL Name & ID</th>
                                        <th>Deed Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td class="text-center" data-bs-toggle="tooltip" title="Action">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                        @if($data->approve_by !=null)
                                                            <i class="fas fa-check"></i>
                                                        @endif
                                                        <img class="rounded avatar-2xs p-0" src="{{@$data->customer->user->image()}}">
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-animated">
                                                        <a class="dropdown-item" href="{{route('customer.profile',encrypt($data->customer_id))}}">Customer Profile</a>
                                                        <a class="dropdown-item" href="{{route('salse.details',encrypt($data->id))}}">Salse Details</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$key+1}}</td>
                                            <td>{{get_date($data->created_at)}}</td>
                                            <td>{{@$data->customer->customer_id}}</td>
                                            <td>{{@$data->customer->name}}</td>
                                            <td>{{@$data->customer->user->phone}}</td>
                                            <td>{{$data->project->name}}</td>
                                            <td>{{$data->unit->title}}</td>
                                            <td>{{$data->unit_qty}}</td>
                                            <td>{{$facilityText = App\Enums\UnitFacility::values()[$data->facility] ?? 'Unknown';}}</td>
                                            @php
                                                if($data->select_type==1){
                                                    $project_unti = json_decode($data->project_units);
                                                    $unit_type = "";
                                                    $floor_no = "";
                                                    $unit_no = "";
                                                    foreach ($project_unti as $key => $value) {
                                                        $unit = App\Models\ProjectUnit::find($value);
                                                        if(isset($unit) && $unit!=null){
                                                            if($key!=0){
                                                                $unit_type .= ', ';
                                                                $floor_no .= ', ';
                                                                $unit_no .= ', ';
                                                            }
                                                            $unit_type .= $unit->unitCategory->title;
                                                            $floor_no .= $unit->floor;
                                                            $unit_no .= $unit->name;
                                                        }
                                                    }
                                                }else{
                                                    $unit_type = "-";
                                                    $floor_no = "-";
                                                    $unit_no = "-";
                                                }
                                            @endphp
                                            <td>{{$unit_type}}</td>
                                            <td>{{$floor_no}}</td>
                                            <td>{{$unit_no}}</td>
                                            <td>{{$data->select_type==1?"onChoice":"Lottery"}}</td>
                                            <td>{{get_price($data->regular_amount)}}</td>
                                            <td>{{get_price($data->sold_value)}}</td>
                                            <td>{{get_price($data->regular_amount-$data->sold_value)}}</td>
                                            <td>{{$data->total_installment}}</td>
                                            <td>{{$data->total_installment}}</td>
                                            <td>{{get_price($data->total_deposit)}}</td>
                                            <td>{{$data->customer->reference->name}} [{{$data->customer->reference->user_id}}]</td>
                                            <td>{{$data->approve_by!=null?"Complete":"Pending"}}</td>
                                        </tr>
                                    @endforeach
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
                   dropdownParent: $('#offcanvas'),
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
