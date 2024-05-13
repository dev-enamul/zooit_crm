@extends('layouts.dashboard')
@section('title','Negotiation Analysis Approve')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Negotiation Analysis</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Negotiation Analysis List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('negotiation-analysis-approve.save')}}" method="POST">
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
                                
    
                                    <table class="table table-hover table-bordered table-striped dt-responsive nowrap fs-10" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                                <th>Product & Qty</th> 
                                                <th>Freelancer</th> 
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach ($negotiations as  $negotiation)
                                            <tr class="">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="negotiation_id[]" value="{{$negotiation->id}}" id="flexCheckChecked" >
                                                </td>
                                                <td>{{ $loop->iteration}}</td>
                                                <td class="">{{ get_date($negotiation->created_at) }}</td> 
                                                <td class="">{{ @$negotiation->customer->user->name }}</td>
                                                <td class=""> {{ @$negotiation->customer->user->phone }}</td>
                                                <td class=""> {{ @$negotiation->customer->user->userAddress->address }}</td>
                                                <td class=""> {{ get_price(@$negotiation->negotiation_amount) }}</td>
                                                <td class=""> {{ @$negotiation->project->name }}</td>
                                                <td class="">{{$negotiation->unit_qty}} </td>
                                                <td class="">{{ @$negotiation->customer->reference->name }} [{{ @$negotiation->customer->reference->user_id }}] </td>
                                               
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
    @include('includes.footer')
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