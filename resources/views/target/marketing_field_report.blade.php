@extends('layouts.dashboard')
@section('title',"Marketing Target vs Achievemen")
@section('style')
    <style>
        .select2{
            min-width: 230px;
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
                        <h4 class="mb-sm-0">Marketing Target vs Achievement</h4>
                        <p class="d-none">Name : {{$employee->name}}, </p>
                        <p class="d-none">ID : {{$employee->user_id}}, </p>
                        <p class="d-none">Area: {{@$employee->userAddress->area->name}},</p>
                        <p class="d-none">Zone: {{@$employee->userAddress->zone->name}},</p>  
                        <input type="hidden" id="hideExport" value=""> 
                        <input type="hidden" id="pageSize" value="legal">
                        <input type="hidden" id="fontSize" value="8">

                        <div class="page-title-right">
                            <a class="btn btn-secondary me-1" href="{{route(Route::currentRouteName())}}"><i class="mdi mdi-refresh"></i> </a> 
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
                                        <tr class=""> 
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">Freelancer Name & ID</th>
                                            <th>FL Recruitment [T-A-%]</th>  
                                            <th>Customer [T-A-%]</th> 
                                            <th>Prospecting [T-A-%]</th> 
                                            <th>Cold calling [T-A-%]</th> 
                                            <th>LEAD [T-A-%]</th> 
                                            <th>LEAD Analysis [T-A-%]</th>  
                                        </tr> 
                                    </thead>
                                    <tbody> 
                                        @foreach ($datas as $key => $data)
                                        @php
                                            $target = App\Models\FieldTarget::where('assign_to',$data->id)
                                                ->whereMonth('month',$date)
                                                ->whereYear('month',$date)
                                                ->first(); 
                                        @endphp
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->name}} [{{$data->user_id}}]</td>
                                                <td>{{$target->freelancer??0}} - {{$monthly_achive['freelancer']??0}} - {{get_percent($monthly_achive['freelancer']??0, $target->freelancer??0)}}</td>
                                                <td>{{$target->customer??0}} - {{$monthly_achive['customer']??0}} - {{get_percent($monthly_achive['customer']??0, $target->customer??0)}}</td>
                                                <td>{{$target->prospecting??0}} - {{$monthly_achive['prospecting']??0}} - {{get_percent($monthly_achive['prospecting']??0, $target->prospecting??0)}}</td>
                                                <td>{{$target->cold_calling??0}} - {{$monthly_achive['cold_calling']??0}} - {{get_percent($monthly_achive['cold_calling']??0, $target->cold_calling??0)}}</td>
                                                <td>{{$target->lead??0}} - {{$monthly_achive['lead']??0}} - {{get_percent($monthly_achive['lead']??0, $target->lead??0)}}</td>
                                                <td>{{$target->lead_analysis??0}} - {{$monthly_achive['lead_analysis']??0}} - {{get_percent($monthly_achive['lead_analysis']??0, $target->lead_analysis??0)}}</td> 
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
        <h5 class="offcanvas-title">Filter Leads</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="" method="get">
            <div class="row">  
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="freelancer" class="form-label">Marketing Executive</label>
                        <select id="freelancer" class="select2" name="freelancer" search>
                            @foreach ($employees as $data)
                                <option {{$employee->id==$data->id?"selected":""}} value="{{encrypt($data->id)}}">{{$data->name}} [{{$data->user_id}}]</option> 
                            @endforeach 
                        </select> 
                    </div>
                </div>  
    
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="freelancer" class="form-label">Month</label>
                        <input type="month" class="form-control" name="month" value="{{ date('Y-m', $date->timestamp) }}">
                    </div>
                </div> 
     
                <div class="text-end ">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button> <button type="button" class="btn btn-outline-danger btn_refresh"><i class="mdi mdi-refresh"></i> Reset</button>
                </div>  
            </div>
        </form>
    </div>
</div>

@endsection 

@section('script')
@include('includes.data_table')
    <script>
        getDateRange('daterangepicker');
    </script>
@endsection