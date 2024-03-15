@extends('layouts.dashboard')
@section('title','Presentation Analysis Approve')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Follow Up</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Follow Up List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('followUp-analysis.approve.save')}}" method="POST">
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
                                        @foreach ($followUps as  $followUp)
                                        <tr class="">
                                            <td class="text-center">
                                                <input class="form-check-input" type="checkbox" name="followUp_id[]" value="{{$followUp->id}}" id="flexCheckChecked" >
                                            </td>
                                            <td>{{ $loop->iteration}}</td>
                                            <td class="">{{ get_date($followUp->created_at) }}</td> 
                                            <td class="">{{ @$followUp->customer->user->name }}</td>
                                            <td class=""> {{ @$followUp->customer->user->phone }}</td>
                                            <td class=""> {{ @$followUp->customer->user->userAddress->address }}</td>
                                            <td class=""> {{ get_price(@$followUp->negotiation_amount) }}</td>
                                            <td class=""> {{ @$followUp->project->name }}</td>
                                            <td class=""> {{$followUp->unit_qty}} </td>
                                            <td class=""> {{ @$followUp->customer->reference->name }} [{{ @$followUp->customer->reference->user_id }}] </td>
                                           
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