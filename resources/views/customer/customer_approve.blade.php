@extends('layouts.dashboard')
@section('title','Customer Approve')
 
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customer Approve</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer Approve</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('customer.approve.save')}}" method="POST">
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
                                                <th>Mobile No</th>
                                                <th>Employee</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($customers as  $customer)
                                                <tr class="">
                                                    <td class="text-center">
                                                        <input class="form-check-input" type="checkbox" name="customer_id[]" value="{{$customer->id}}" id="flexCheckChecked" >
                                                    </td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td >{{ @$customer->name }} [{{ @$customer->customer_id }}]</td>
                                                    <td >{{ @$customer->profession->name }}</td>
                                                    <td >{{ @$customer->user->userAddress->upazila->name }}</td>
                                                    <td >{{ @$customer->user->userAddress->union->name }}</td>
                                                    <td >{{ @$customer->user->userAddress->village->name }}</td> 
                                                    <td >{{ @$customer->user->phone }}</td>
                                                    <td >{{ @$customer->reference->name}} [{{ @$customer->reference->user_id}}]</td>     
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

<script>
    $(document).ready(function () { 
        $('#selectAll').click(function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });
</script> 
 
@endsection