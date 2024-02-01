@extends('layouts.dashboard')
@section('title',"Special Offer List")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Special Offer Achiver</h4> 
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a class="btn btn-secondary mb-2" href="{{route('special-offer.index')}}">
                                    <span><i class="mdi mdi-clipboard-plus-outline"></i> Back</span>
                                </a> 
                            </ol>
                        </div> 
                    </div>
                </div>
            </div>

           
            <div class="row">
                <div class="col-12">
                    <div class="card"> 
                        <div class="card-body"> 
                           <div class="table-box" style="overflow-x: scroll;">
                            <table class="table table-hover table-bordered table-striped dt-responsive fs-11" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr class="">  
                                        <th>S/L</th>
                                        <th>Employee Name</th>
                                        <th>Total Deposit</th>
                                        <th>Start Offer Customer</th> 
                                        <th>End Offer Customer</th>
                                        <th>Follow Up</th>
                                        <th>Negotiation</th> 
                                        <th>Reporting Person</th>
                                        <th>Area</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>$10,000</td>
                                        <td>MD Enamul Haque [Cus-2]</td>
                                        <td>Jamil Hossain [Cus-3]</td>
                                        <td>12</td>
                                        <td>32</td>
                                        <td>Jamil Hossain [Cus-3]</td>
                                        <td>Downtown</td> 
                                    </tr> 
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
 
@endsection
 