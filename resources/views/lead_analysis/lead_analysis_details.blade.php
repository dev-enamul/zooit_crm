@extends('layouts.dashboard')
@section('title','Lead Analysis Entry')
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

        .text-small{
            font-size: 10px;
        }
        label{
            font-size: 10px;
        }
        .form-control{
            font-size: 10px;
            padding: 3px
        }
      
        
    </style>
@endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">  
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lead Analysis Form</h4>

                        <div class="page-title-right">
                            <button class="btn btn-primary" onclick="printPage()">Print</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="align-items-center mt-3 pb-2 d-flex flex-column page_head"> 
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" width="50px">
                            <h4 class="card-title">Customer LEAD Analysis</h4> 
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr class="text-small">
                                    <td>Name & ID: <strong>{{@$data->employee->name}} [{{@$data->employee->user_id}}]</strong></td>
                                    <td>Mobile: <strong>{{@$data->employee->phone}}</strong></td>
                                    <td>Reporting Name & ID: <strong>{{$data->employee->my_reporting()->name??""}} [{{$data->employee->my_reporting()->user_id??""}}]</strong></td>
                                    <td>Area: <strong>{{@$data->userAddress->area->name}}</strong></td>
                                </tr>
                            </table> 
                            <form class="needs-validation"> 
                                <div class="row"> 
                                    <div class="col-6">
                                        <div class="">
                                            <label for="freelancer" class="form-label">Customer Name</label>
                                            <input value="{{$customer->name}} [{{$customer->customer_id}}]" type="text" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="freelancer" class="form-label">Age</label>
                                            <input value="{{$customer->user->age()??""}}" type="text" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="freelancer" class="form-label">Profession</label>
                                            <input value="{{$customer->profession->name}}" type="text" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="income_range" class="form-label">Income Range</label>
                                            <input value="{{$data->income_range}} " type="text" class="form-control" >
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="">
                                            <label for="profession_year" class="form-label">Job/Business/Others Service Year</label> 
                                            <input value="{{$data->profession_year}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="customer_need" class="form-label">Customer's Need</label>  
                                            <input value="{{$data->customer_need}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <label for="project" class="form-label">Product </label> 
                                        <input value="{{$data->project->name}} " type="text" class="form-control" >
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <label for="tentative_amount" class="form-label">Tentative Sales Amount</label> 
                                            <input value="{{$data->tentative_amount}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="customer_problem" class="form-label">Customer's Problem</label> 
                                            <input value="{{$data->customer_problem}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="influencer" class="form-label">Influencer</label> 
                                            <input value="{{$data->influencer}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="decision_maker" class="form-label">Decision Maker</label>  
                                            <input value="{{$data->decision_maker}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="instant_investment" class="form-label">Instant Investment</label> 
                                            <input value="{{$data->instant_investment}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="buyer" class="form-label">Buyer</label> 
                                            <input value="{{$data->buyer}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="consumer" class="form-label">Consumer</label> 
                                            <input value="{{$data->consumer}} " type="text" class="form-control" >
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="">
                                            <label for="consumer" class="form-label">Cold Calling</label> 
                                            <input value="{{get_date($cold_calling->created_at)}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="consumer" class="form-label">Presentation Date</label> 
                                            <input value="{{get_date($data->presentation_date)}} " type="text" class="form-control" >
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="">
                                            <label for="hobby" class="form-label">Hobby </label>
                                            <input value="{{$data->unit->hobby}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="hobby" class="form-label">Religion </label>
                                            <input value="{{ \App\Enums\Religion::values()[@$user->religion] }} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="hobby" class="form-label">Hobby </label>
                                            <input value="{{$user->phone}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="hobby" class="form-label">Address </label>
                                            <input value="{{@$user->userAddress->address}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="hobby" class="form-label">Email </label>
                                            <input value="{{$user->userContact->office_email??$user->userContact->personal_email??""}} " type="text" class="form-control" >
                                        </div>
                                    </div> 
 

                                    <div class="col-6">
                                        <div class="">
                                            <label for="facebook_id" class="form-label">Facebook Id</label> 
                                            <input value="{{$data->facebook_id}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                   

                                    <div class="col-6">
                                        <div class="">
                                            <label for="refferal" class="form-label">Referral</label> 
                                            <input value="{{$data->referral}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    

                                    <div class="col-6">
                                        <div class="">
                                            <label for="family_member" class="form-label">Family Member Qty</label> 
                                            <input value="{{$data->family_member}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    

                                    <div class="col-6">
                                        <div class="">
                                            <label for="previous_experiance" class="form-label">Previous Experiance to Purchase this kind of product</label> 
                                            <input value="{{$data->previous_experience}} " type="text" class="form-control" >
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="">
                                            <label for="buyer" class="form-label">Executive Name & ID</label> 
                                            <input value="{{$data->employee->name}} [{{$data->employee->user_id}}]" type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="buyer" class="form-label">Area</label> 
                                            <input value="{{$data->area}} " type="text" class="form-control" >
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="">
                                            <label for="buyer" class="form-label">Freelancer</label> 
                                            <input value="{{$customer->reference->name}} [{{$customer->reference->user_id}}]" type="text" class="form-control" >
                                        </div>
                                    </div>  
                                </div> 
                            </form>
                        </div>
                    </div> 
                </div>  
            </div> 
        </div>  
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
 