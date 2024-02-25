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
                                            <th>Purchase Date</th>
                                            <th>Mobile</th>
                                            <th>Freelancer</th> 
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($leads as  $lead)
                                            <tr class="">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="lead_id[]" value="{{$lead->id}}" id="flexCheckChecked" >
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $lead->created_at->format('Y-m-d') }}</td>
                                                <td>{{ @$lead->customer->user->name }}</td>
                                                <td>{{ @$lead->customer->profession->name }}</td>
                                                <td>{{ @$lead->customer->user->userAddress->upazila->name }}</td>
                                                <td>{{ @$lead->customer->user->userAddress->union->name }}</td>
                                                <td>{{ @$lead->customer->user->userAddress->village->name }}</td>
                                                <td>{{ @$lead->customer->user->marital_status }}</td>
                                                <td>{{ @$lead->prospecting }} #dummy</td>
                                                <td>{{ @$lead->project->name }}</td>
                                                <td>{{ @$lead->unit->title }}</td>
                                                <td class="text-primary">
                                                   @if ($lead->purchase_capacity ==1)
                                                       High
                                                   @elseif($lead->purchase_capacity ==2)
                                                       Regular
                                                    @else
                                                        Low
                                                   @endif
                                                </td>
                                                <td>{{ @$lead->possible_purchase_date }}</td>
                                                <td>{{ @$lead->customer->user->phone }}</td>
                                                <td>{{ @$lead->employee->name ?? 'N/A' }}</td>  
                                            </tr>
                                        @endforeach  
                                    </tbody>
                                </table>
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