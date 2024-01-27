@extends('layouts.dashboard')
@section('title','Prospecting Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lead Analysis Form</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Lead Analysis form</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Select Customer</label>
                                            <select class="select2" search id="freelancer" name="freelancer" required>
                                                <option value="">Select Freelancer</option> 
                                                <option value="">Md Enamul Haque 01796351081</option> 
                                                <option value="">Jamil Hosain 01796351081</option> 
                                                <option value="">Md Mehedi Hasan 01796351081</option> 
                                                <option value="">Suvo Hasan 01796351081</option>  
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hobby" class="form-label">Hobby </label>
                                            <input type="text" name="hobby" class="form-control" id="hobby" placeholder="Hobby" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="income_range" class="form-label">Income Range</label>
                                            <input type="number" name="income_range" class="form-control" id="income_range" placeholder="Income Range" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="religion" class="form-label">Religion</label>
                                            <select class="select2" search name="religion" id="religion">
                                                <option value="">Select Religion</option>
                                                <option value="">Islam </option>
                                                <option value="">Hinduism</option> 
                                                <option value="">Buddhism</option>
                                                <option value="">Christianity</option>
                                                <option value="">Indigenous Beliefs</option>
                                                <option value="">Others</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession_year" class="form-label">Job/Business/Others Service Year</label> 
                                            <input type="number" name="profession_year" class="form-control" id="profession_year" placeholder="Profession Year" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_need" class="form-label">Custome's Need</label> 
                                            <input type="text" name="customer_need" class="form-control" id="customer_need" placeholder="Customer's Need" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tentative_amount" class="form-label">Tentative Sales Amount</label> 
                                            <input type="number" name="tentative_amount" class="form-control" id="tentative_amount" placeholder="Tentative Sales Amount" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_id" class="form-label">Facebook Id</label> 
                                            <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook Id" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_problem" class="form-label">Customer's Problem</label> 
                                            <textarea class="form-control" id="customer_problem" rows="1" name="customer_problem" placeholder="Customer's Problem"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="refferal" class="form-label">Referral</label> 
                                            <input type="text" name="refferal" class="form-control" id="refferal" placeholder="Refferal" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="influencer" class="form-label">Influencer</label> 
                                            <input type="text" name="influencer" class="form-control" id="influencer" placeholder="Influencer" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="family_member" class="form-label">Family Member Qty</label> 
                                            <input type="number" name="family_member" class="form-control" id="family_member" placeholder="family_member" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="decision_maker" class="form-label">Decision Maker</label> 
                                            <input type="text" name="decision_maker" class="form-control" id="decision_maker" placeholder="decision_maker" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="previous_experiance" class="form-label">Previous Experiance to Purchase this kind of product</label> 
                                            <input type="text" name="previous_experiance" class="form-control" id="previous_experiance" placeholder="previous_experiance" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instant_investment" class="form-label">Instant Investment</label> 
                                            <input type="text" name="instant_investment" class="form-control" id="instant_investment" placeholder="instant_investment" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buyer" class="form-label">Buyer</label> 
                                            <input type="text" name="buyer" class="form-control" id="buyer" placeholder="buyer" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buyer" class="form-label">Area</label> 
                                            <input type="text" name="area" class="form-control" id="area" placeholder="area" value=""> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="consumer" class="form-label">Consumer</label> 
                                            <input type="text" name="consumer" class="form-control" id="consumer" placeholder="consumer" value=""> 
                                        </div>
                                    </div> 
                                    
                                </div>
                                  
                                <div class="text-end ">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                                </div> 
                            </form>
                        </div>
                    </div> 
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>

    @include('includes.footer')

</div>
@endsection