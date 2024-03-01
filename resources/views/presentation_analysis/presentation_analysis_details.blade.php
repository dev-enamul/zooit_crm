@extends('layouts.dashboard')
@section('title','Presentation Analysis')
@section('style')
    <style>
        @media print {
            @page {
                size: A4;
            }
            .page-break {
                page-break-before: always;
            }  
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
                        <h4 class="mb-sm-0">Visit Analysis</h4>  
                        <div class="page-title-right">
                            <button class="btn btn-primary" onclick="printPage()">Print</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="align-items-center mt-3 pb-2 d-flex flex-column page_head"> 
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" width="50px">
                            <h4 class="card-title">Visit Analysis</h4> 
                        </div>

                        <div class="card-body"> 
                            <table class="table table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tbody> 
                                    <tr> 
                                        <td class="p-1"><strong>Name & ID : </strong> {{$employee->name}} [{{$employee->user_id}}]</td>
                                        <td class="p-1"><strong>Project Name : </strong> {{is_array($project)?implode(", ", $project):""}}</td> 
                                    </tr> 
            
                                    <tr> 
                                        <td class="p-1"><strong> Designation : </strong> {{@$employee->employee->designation->title}}</td>
                                        <td class="p-1"><strong>Project Visit Date : </strong>{{get_date($data->created_at)}}</td> 
                                    </tr> 
                                </tbody>
                            </table>
                            <table class="table table-hover table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr> 
                                        <th>S/N</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>CUS ID</th>
                                        <th>FL ID</th>
                                        <th>EMP ID</th> 
                                        <th>Negotiation Person</th> 
                                        <th>Mobile No</th> 
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($visitors as $key => $visitor)
                                   
                                        <tr> 
                                            <td>{{$key+1}}</td>
                                            <td>{{$visitor->name}}</td>
                                            <td>{{$visitor->phone}}</td>
                                            <td>{{$visitor->user_type==3?@$visitor->customer[0]->customer_id:"-"}}</td>
                                            <td>{{$visitor->user_type==2?$visitor->user_id:"-"}}</td>
                                            <td>{{$visitor->user_type==1?$visitor->user_id:"-"}}</td> 
                                            <td>{{@$customer->name}} [{{@$customer->customer_id}}]</td> 
                                            <td>{{$user->phone}}</td>
                                        </tr> 
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
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
        function printPage() {
            window.print();
        }
    </script> 
@endsection
 