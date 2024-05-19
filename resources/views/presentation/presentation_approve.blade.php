@php
    use App\Models\User;
@endphp
@extends('layouts.dashboard')
@section('title','Presentation Approve')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Presentations</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Presentation List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <form action="{{route('presentation.approve.save')}}" method="POST">
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
                                                <th>Presentation Date</th>
                                                <th>Franchise Partner Name & ID</th> 
                                                <th>Incharge Marketing Name & ID</th> 
                                                <th>Incharge Salse Name & ID</th> 
                                                <th>Area Incharge Name & ID</th> 
                                                <th>Zonal Manager Name & ID</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($presentations as  $presentation)
                                            <tr class="">
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="presentation_id[]" value="{{$presentation->id}}" id="flexCheckChecked" >
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $presentation->customer->customer_id??'-' }}</td>
                                                <td>{{ $presentation->customer->user->name??'-' }}</td>
                                                <td>{{ $presentation->customer->user->phone??'-' }}</td>
                                                <td>{{ $presentation->customer->profession->name??'-' }}</td>
                                                <td>{{ $presentation->project->name??'-' }}</td>
                                                <td>{{ $presentation->unit->name??'-' }}</td>
                                                <td>{{ get_date($presentation->created_at) }}</td>
                                                <td>
                                                    @php
                                                        if(@$presentation->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }
                                                        $reporting = json_decode(@$presentation->customer->reference->user_reporting);
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
                                                        if(@$presentation->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }
                                                        $reporting = json_decode(@$presentation->customer->reference->user_reporting);
                                                        $dataReturn = marketingInChargeEmployee($reporting);
                                                    @endphp
                                                    <center>{{ $dataReturn }}</center>
                                                </td>
                                                <td>
                                                    @php
                                                        if(@$presentation->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }

                                                        $reporting = json_decode(@$presentation->customer->reference->user_reporting);
                                                        $dataReturn = salesInChargeEmployee($reporting);
                                                    @endphp
                                                    <center>{{ $dataReturn }}</center>
                                                </td>
                                                <td>
                                                    @php
                                                        if(@$presentation->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }

                                                        $reporting = json_decode(@$presentation->customer->reference->user_reporting);
                                                        $dataReturn = areaInChargeEmployee($reporting);
                                                    @endphp
                                                    <center>{{ $dataReturn }}</center>
                                                </td>
                                                <td>
                                                    @php
                                                        if(@$presentation->customer->ref_id==null){
                                                            $dataReturn = '-';
                                                        }

                                                        $reporting = json_decode(@$presentation->customer->reference->user_reporting);
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