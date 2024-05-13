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
                        <h4 class="mb-sm-0">Cold Calling Approve</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Cold Calling Approve</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('cold-calling.approve.save')}}" method="POST">
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
                                
                                    <table id="approve_table" class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>S/N</th>
                                                <th>Full Name</th>
                                                <th>Profession</th>
                                                <th>Upazilla/Thana</th>
                                                <th>Union</th>
                                                <th>Village</th>
                                                <th>Last Prospecting</th>
                                                <th>Project</th>
                                                <th>Unit</th>
                                                <th>Mobile No</th>
                                                <th>Freelancer</th>
                                            </tr>
                                        </thead>
    
                                        <tbody> 
                                            @foreach ($cold_callings as  $cold_calling)
                                            <tr class="">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="cold_calling_id[]" value="{{$cold_calling->id}}" id="flexCheckChecked" >
                                                </td>
                                                <td >{{ $loop->iteration }}</td>
                                                <td >{{ @$cold_calling->customer->user->name }}</td>
                                                <td >{{ @$cold_calling->customer->profession->name }}</td>
                                                <td >{{ @$cold_calling->customer->user->userAddress->upazila->name }}</td>
                                                <td >{{ @$cold_calling->customer->user->userAddress->union->name }}</td>
                                                <td >{{ @$cold_calling->customer->user->userAddress->village->name }}</td>
                                                @php
                                                    $prospecting = \App\Models\Prospecting::where('customer_id',$cold_calling->customer->id)->first();
                                                    $last_prospecting = $prospecting->updated_at;
                                                @endphp
                                                <td >{{ $last_prospecting->format('Y-m-d') }}</td>
                                                <td >{{ @$cold_calling->project->name }}</td>
                                                <td > {{@$cold_calling->unit->title }} </td>
                                                <td >{{ @$cold_calling->customer->user->phone }}</td>
                                                <td >{{ @$cold_calling->employee->name }}</td>
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