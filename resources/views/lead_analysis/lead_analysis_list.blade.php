@extends('layouts.dashboard')
@section('title','Lead Analysis List')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lead Analysis List</h4> 
                        <p class="d-none">Employee: {{auth()->user()->name}}</p> 
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
                            <div class="table-box">
                                <table id="datatable" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>S/N</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Profession</th>
                                            <th>Upazilla/Thana</th>
                                            <th>Union</th>
                                            <th>Village</th>
                                            <th>Maritial</th>
                                            <th>Last Call</th>
                                            <th>Project</th>
                                            <th>Unit</th>
                                            <th>Capacity</th>
                                            <th>PP Date</th>
                                            <th>Mobile</th>
                                            <th>Freelancer</th> 
                                        </tr>
                                    </thead>
    
                                    <tbody>
                                        @foreach ($leads as  $lead)
                                            <tr class="{{$lead->approve_by==null?"table-warning":""}}">
                                                
                                                <td class="text-center" data-bs-toggle="tooltip" title="Action"> 
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <img class="rounded avatar-2xs p-0" src="{{@$lead->customer->user->image()}}">
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-animated">
                                                            @if ($lead->approve_by==null) 
                                                                @can('lead-analysis-manage')
                                                                    <a class="dropdown-item" href="{{route('lead-analysis.edit',$lead->id)}}">Edit</a>
                                                                @endcan
                                                            @endif
                                                            
                                                            @can('lead-analysis-delete')
                                                                <a class="dropdown-item" onclick="deleteItem('{{ route('lead-analysis.destroy',$lead->id) }}')">Delete</a>
                                                            @endcan 
    
                                                            @if ($lead->approve_by!=null)
                                                                <a class="dropdown-item" href="{{route('presentation.create',['customer'=> $lead->customer->id])}}">Entry Presentation</a>
                                                                <a class="dropdown-item" href="{{route('presentation_analysis.create',['customer'=> $lead->customer->id])}}">Project Visit Analysis</a>
                                                            @endif 
    
                                                            <a class="dropdown-item" href="{{route('lead.analysis.details', encrypt($lead->id))}}">Lead Analysis Print</a>
                                                        </div>
                                                    </div> 
                                                </td> 
    
                                                <td class="" >{{ $loop->iteration }}</td>
                                                <td class="" >{{ get_date($lead->created_at) }}</td>
                                                <td class=""> {{ @$lead->customer->name }}</td>
                                                <td class=""> {{ @$lead->customer->profession->name }}</td>
                                                <td class=""> {{ @$lead->customer->user->userAddress->upazila->name}}</td>
                                                <td class=""> {{ @$lead->customer->user->userAddress->union->name}}</td>
                                                <td class=""> {{ @$lead->customer->user->userAddress->village->name }}</td>
                                                @php
                                                   $marital_status =  @$lead->customer->user->marital_status;
                                                   if($marital_status == 1){
                                                       $marital_status = "Married";
                                                    }elseif($marital_status == 2){
                                                    $marital_status = "Unmarried";
                                                    }elseif($marital_status == 3){
                                                        $marital_status = "Divorce";
                                                    }else{
                                                        $marital_status = "-";
                                                    }
                                                @endphp
                                                <td class=""> {{ $marital_status }}</td>
                                                @php
                                                    $cold_lead = \App\Models\Lead::where('customer_id',$lead->customer_id)->first(); 
                                                    $last_lead= $cold_lead?->updated_at?? $cold_lead?->created_at;
                                                @endphp 
    
                                                <td class=""> {{get_date($last_lead)}} </td>
                                                <td class="">{{ $lead->project->name }}</td>
                                                <td class=""> {{  @$lead->unit->title}}</td>
                                                @php
                                                    $lead_capacity = App\Models\Lead::where('customer_id',$lead->customer_id)->first();
                                                @endphp
                                                <td class="text-primary"> 
                                                    @if(@$lead_capacity->purchase_capacity == 1)
                                                        High
                                                    @elseif(@$lead_capacity->purchase_capacity == 2)
                                                        Medium
                                                    @else
                                                        Low
                                                    @endif
                                                </td>
                                                <td class="">{{get_date(@$lead_capacity->possible_purchase_date) }}</td>
                                                <td class="">{{ @$lead->customer->user->phone}}</td>
                                                <td class="">{{ @$lead->customer->reference->name}} {{ @$lead->customer->reference->user_id}}</td> 
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