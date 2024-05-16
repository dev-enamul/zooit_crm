@php
    use App\Models\User;
@endphp
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
                                                <th>Provable Cus ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile Number</th>
                                                <th>Profession</th>
                                                <th>Preferred Project Name</th>
                                                <th>Preferred Unit Name</th>
                                                <th>Customer Expectation</th>
                                                <th>Customer Need</th>
                                                <th>Customer Ability</th>
                                                <th>Influencer Openion</th>
                                                <th>Decision Maker Openion</th>
                                                <th>Franchise Partner Name & ID</th>
                                                <th>Incharge Marketing Name & ID</th>
                                                <th>Incharge Sales Name & ID</th>
                                                <th>Area Incharge Name & ID</th>
                                                <th>Zonal Manager Name & ID</th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            @foreach ($followUps as  $followUp)
                                            <tr class="">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="followUp_id[]" value="{{$followUp->id}}" id="flexCheckChecked" >
                                                </td>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{ @$followUp->customer->customer_id }}</td>
                                                <td>{{ @$followUp->customer->user->name }}</td>
                                                <td>{{ @$followUp->customer->user->phone }}</td>
                                                <td>{{ @$followUp->customer->profession->name ?? '-' }}</td>
                                                <td>{{ @$followUp->project->name ?? '-' }}</td>
                                                <td>{{ @$followUp->unit->name ?? '-' }}</td>
                                                <td>{{ @$followUp->customer_expectation ?? '-' }}</td>
                                                <td>{{ @$followUp->need ?? '-' }}</td>
                                                <td>{{ @$followUp->ability ?? '-' }}</td>
                                                <td>{{ @$followUp->influencer_opinion ?? '-' }}</td>
                                                <td>{{ @$followUp->decision_maker_opinion ?? '-' }}</td>
                                                <td>
                                                    @php
                                                        if(@$followUp->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }

                                                        $reporting = json_decode(@$followUp->customer->reference->user_reporting);
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
                                                        if(@$followUp->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }
                                                        $reporting = json_decode(@$followUp->customer->reference->user_reporting);
                                                        $dataReturn = marketingInChargeEmployee($reporting);
                                                    @endphp
                                                    <center>{{ $dataReturn }}</center>
                                                </td>
                                                <td>
                                                    @php
                                                        if(@$followUp->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }
                                                        $reporting = json_decode(@$followUp->customer->reference->user_reporting);
                                                        $dataReturn = salesInChargeEmployee($reporting);
                                                    @endphp
                                                    <center>{{ $dataReturn }}</center>
                                                </td>
                                                <td>
                                                    @php
                                                        if(@$followUp->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }
                                                        $reporting = json_decode(@$followUp->customer->reference->user_reporting);
                                                        $dataReturn = areaInChargeEmployee($reporting);
                                                    @endphp
                                                    <center>{{ $dataReturn }}</center>
                                                </td>
                                                <td>
                                                    @php
                                                        if(@$followUp->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }
                                                        $reporting = json_decode(@$followUp->customer->reference->user_reporting);
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