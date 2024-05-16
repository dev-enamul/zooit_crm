@php
    use App\Models\User;
@endphp
@extends('layouts.dashboard')
@section('title','Product Create')
@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lead Approve</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Lead Approve</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('lead.approve.save')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="table-box">
                                    <div class="d-flex justify-content-between"> 
                                        <div class="mb-1">
                                            <input class="form-check-input" type="checkbox" value="" id="selectAll" > 
                                            <label for="selectAll">Check All</label>
                                        </div> 
    
                                        <div class="mb-1">
                                            <button class="btn btn-primary" type="submit">
                                                Approve
                                            </button>
                                        </div>
                                    </div>
                                
                                    <table id="approve_table" class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>S/N</th>
                                                <th>Provable Cus ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Profession</th>
                                                <th>Preferred Project Name</th>
                                                <th>Preferred Unit Name</th>
                                                <th>Franchise Partner Name & ID</th>
                                                <th>Co-ordinator Name & ID</th>
                                                <th>Executive Co-ordinator Name & ID</th>
                                                <th>Incharge Marketing Name & ID</th>
                                                <th>Incharge Salse Name & ID</th>
                                                <th>Area Incharge Name & ID</th>
                                                <th>Zonal Manager Name & ID</th>
                                            </tr>
                                        </thead>
    
                                        <tbody>
                                            @foreach ($leads as  $lead)
                                                <tr class="">
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox" name="lead_id[]" value="{{$lead->id}}" id="flexCheckChecked" >
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $lead->customer_id }}</td>
                                                    <td>{{ @$lead->project->name ?? '-' }}</td>
                                                    <td>{{ @$lead->customer->user->phone ?? "-" }}</td>
                                                    <td>{{ @$lead->customer->profession->name??'-' }}</td>
                                                    <td>{{ @$lead->project->name??'-' }}</td>
                                                    <td>{{ @$$lead->unit->name??'-'; }}</td>

                                                    <td>
                                                        @php
                                                            if(@$lead->customer->ref_id==null){
                                                                $dataReturn = '-';
                                                            }
                                                            $reporting = json_decode($lead->customer->reference->user_reporting);
                                                            if(isset($reporting) && $reporting!= null){
                                                                $user = User::whereIn('id',$reporting)->whereHas('freelancer',function($q){
                                                                    $q->whereIn('designation_id',[20]);
                                                                })->first();
                                                                if(isset($user) && $user != null){
                                                                    $dataReturn = $user->name.' ['.$user->user_id.']';
                                                                }
                                                            }
                                                            $dataReturn = "-";
                                                        @endphp
                                                        <center>{{ $dataReturn }}</center>    
                                                    </td>
                                                    <td>
                                                        @php
                                                            if(@$lead->customer->ref_id==null){
                                                                $dataReturn = '-';
                                                            }
                                                            $reporting = json_decode($lead->customer->reference->user_reporting);
                                                            if(isset($reporting) && $reporting!= null){
                                                                $user = User::whereIn('id',$reporting)->whereHas('freelancer',function($q){
                                                                    $q->whereIn('designation_id',[18]);
                                                                })->first();
                                                                if(isset($user) && $user != null){
                                                                    $dataReturn = $user->name.' ['.$user->user_id.']';
                                                                }
                                                            }
                                                            $dataReturn = "-";
                                                        @endphp
                                                        <center>{{ $dataReturn }}</center>    
                                                    </td>
                                                    <td>
                                                        @php
                                                            if(@$lead->customer->ref_id==null){
                                                                $dataReturn = '-';
                                                            }
                                                            $reporting = json_decode($lead->customer->reference->user_reporting);
                                                            if(isset($reporting) && $reporting!= null){
                                                                $user = User::whereIn('id',$reporting)->whereHas('freelancer',function($q){
                                                                    $q->whereIn('designation_id',[17]);
                                                                })->first();
                                                                if(isset($user) && $user != null){
                                                                    $dataReturn = $user->name.' ['.$user->user_id.']';
                                                                }
                                                            }
                                                            $dataReturn = "-";
                                                        @endphp
                                                        <center>{{ $dataReturn }}</center>    
                                                    </td>
                                                    <td>
                                                        @php
                                                            if(@$lead->customer->ref_id==null){
                                                                $dataReturn = '-';
                                                            }
                                                            $reporting = json_decode($lead->customer->reference->user_reporting);
                                                            $dataReturn = inChargeEmployee($reporting);
                                                        @endphp
                                                        <center>{{ $dataReturn }}</center> 
                                                    </td>
                                                    <td>
                                                        @php
                                                            if(@$lead->customer->ref_id==null){
                                                                $dataReturn = '-';
                                                            }
                                                            $reporting = json_decode($lead->customer->reference->user_reporting);
                                                            $dataReturn = salesInChargeEmployee($reporting);
                                                        @endphp
                                                        <center>{{ $dataReturn }}</center> 
                                                    </td>
                                                    <td>
                                                        @php
                                                            if(@$lead->customer->ref_id==null){
                                                                $dataReturn = '-';
                                                            }
                                                            $reporting = json_decode($lead->customer->reference->user_reporting);
                                                            $dataReturn = areaInChargeEmployee($reporting);
                                                        @endphp
                                                        <center>{{ $dataReturn }}</center> 
                                                    </td>
                                                    <td>
                                                        @php
                                                            if(@$lead->customer->ref_id==null){
                                                                $dataReturn = '-';
                                                            }
                                                            $reporting = json_decode($lead->customer->reference->user_reporting);
                                                            $dataReturn = zonalManagerEmployee($reporting);
                                                        @endphp
                                                        <center>{{ $dataReturn }}</center> 
                                                    </td>  
                                                </tr>
                                            @endforeach  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <script>document.write(new Date().getFullYear())</script> © Zoom IT.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="http://Zoom IT.in/" target="_blank" class="text-muted">Zoom IT</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection 

@section('script')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () { 
        $('#selectAll').click(function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });
</script>

{{-- <script>
    $(document).ready(function () {
        $(window).on('load', function () {
            console.log('DataTable initialized');
            var table = $('#approve_table').DataTable({});
        });
    });
</script> --}}
@endsection