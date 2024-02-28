@extends('layouts.dashboard')
@section('title', @$user->name)
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
                    <div class="page-title-box d-flex align-items-cjustify-content-between">
                        <h4 class="mb-sm-0">
                            {{@$user->name}} 
                        </h4>  
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="align-items-center d-flex flex-column"> 
                            <img src="{{asset('assets/images/logo-sm.png')}}" alt="" width="50px">
                            <h4 class="card-title">Employee Details</h4>
                            <p class="p-0 m-0">Employee Name: <strong>{{@$user->name}} </strong></p>
                            <p class="p-0 m-0">Employee ID: <strong>{{@$user->user_id}} </strong></p>
                        </div>
                        <div class="card-body">
                            <form>  
                                <div class="row">
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Personal Information</h6>
                                    <hr>
                                    <div class="col-5">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name </label>
                                            <input type="text" class="form-control"  value="{{@$user->name}}">
                                          
                                        </div>
                                    </div>   
                                    <div class="col-5">
                                        <div class="mb-3">
                                            <label class="form-label">Marital Status </label> 
                                            <input type="text" class="form-control"  value="{{ \App\Enums\MaritualStatus::values()[@$user->marital_status] }}">
                                        </div>
                                    </div> 
                                    <div class="col-2 text-end">
                                        <img src="{{@$user->image()}}" alt="" height="50px">
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date of Birth </label>
                                            <input type="text" class="form-control"  value="{{@$user->dob}}"> 
                                            
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label  class="form-label">Card/Finger ID </label>
                                            <input type="text" class="form-control"  value="{{@$user->finger_id}}">  
                                        </div>
                                    </div>
                                      
 
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Religion </label>
                                            <input type="text" class="form-control"  value="{{ \App\Enums\Religion::values()[@$user->religion] }}">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Blood Group </label>
                                            <input type="text" class="form-control"  value="{{ \App\Enums\BloodGroup::values()[@$user->blood_group] }}">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Gender </label>
                                            <input type="text" class="form-control" value="{{ \App\Enums\Gender::values()[@$user->gender] }}">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label">Nationality </label>
                                            <input type="text" class="form-control" value="{{ \App\Enums\Nationality::values()[@$user->nationality??1] }}">  
                                        </div>
                                    </div> 

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Contact Information</h6>
                                    <hr>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mobile Number 1 </label>
                                            <input type="text" class="form-control"value="{{ @$user->phone }}">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mobile Number 2 </label>
                                            <input type="text" class="form-control" value="{{ @$user->userContact->office_phone }}">
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Office Email</label>
                                           <input type="text" class="form-control" value="{{ @$user->userContact->office_email}}">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Personal Email</label>
                                            <input type="text" class="form-control" value="{{ @$user->userContact->personal_email }}"> 
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Imo/WhatsApp Number</label>
                                            <input type="text" class="form-control" value="{{ @$user->userContact->imo_number }}">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Facebook ID</label>
                                            <input type="text" class="form-control" value="{{ @$user->userContact->facebook_id }}">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Emergency Contact Name</label>
                                            <input type="text" class="form-control" value="{{ @$user->userContact->emergency_contact_person }}">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Emergency Contact Person Number</label>
                                            <input type="text" class="form-control" value="{{ @$user->userContact->emergency_contact_number }}">  
                                        </div>
                                    </div> 

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Address</h6>
                                    <hr>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Division</label>
                                            <input value="{{ @$user->userAddress->division->name }}" type="text" class="form-control">  
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">District</label>
                                            <input value="{{ @$user->userAddress->district->name }}" type="text" class="form-control">  
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Upazila</label>
                                            <input value="{{ @$user->userAddress->upazila->name }}" type="text" class="form-control">  
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Union</label>
                                            <input value="{{ @$user->userAddress->union->name }}" type="text" class="form-control">  
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Village</label>
                                            <input value="{{ @$user->userAddress->village->name }}" type="text" class="form-control">  
                                        </div>
                                    </div>  

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input value="{{ @$user->userAddress->address }}" type="text" class="form-control">    
                                        </div>
                                    </div>

                                    <h6 class="text-primary page-break"> <i class="mdi mdi-check-all"></i> Family Details</h6>
                                    <hr>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Father's Name </label>
                                            <input value="{{ @$user->userFamily->father_name }}" type="text" class="form-control">    
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Father's Mobile</label>
                                            <input value="{{ @$user->userFamily->father_mobile }}" type="text" class="form-control">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mother's Name </label>
                                            <input value="{{ @$user->userFamily->mother_name }}" type="text" class="form-control">  
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mother Mobile</label>
                                            <input value="{{ @$user->userFamily->mother_mobile }}" type="text" class="form-control">   
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Spouse Name</label>
                                            <input value="{{ @$user->userFamily->spouse_name }}" type="text" class="form-control">  
                                        </div>
                                    </div> 

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Spouse Mobile</label>
                                            <input value="{{ @$user->userFamily->spouse_contact }}" type="text" class="form-control">    
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Transaction Info</h6>
                                    <hr>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Bank </label>
                                            <input value="{{ @$user->userTransaction->bank->name }}" type="text" class="form-control">  
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Branch Name</label>
                                            <input value="{{ @$user->userTransaction->branch }}" type="text" class="form-control">                                              
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Account Number</label>
                                            <input value="{{ @$user->userTransaction->bank_account_number }}" type="text" class="form-control"> 
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                            <input value="{{ @$user->userTransaction->bank_details }}" type="text" class="form-control">                                           
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank" class="form-label">Mobile Bank</label>
                                            <input value="{{ @$user->userTransaction->mobileBank->name }}" type="text" class="form-control">                                            
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank_number" class="form-label">Mobile Bank Number</label>
                                            <input value="{{ @$user->userTransaction->mobile_bank_account_number }}" type="text" class="form-control"> 
                                        </div>
                                    </div> 
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> ID Detail</h6>
                                    <hr> 
                                    <div class="col-9">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">NID Number</label>
                                            <input value="{{ @$user->userId->nid_number }}" type="text" class="form-control">                                             
                                        </div>
                                    </div> 
                                    <div class="col-3">
                                        <img src="{{ @$user?->userId?->nid_image()??"-" }}" alt="" width="100%">
                                    </div>

                                    <div class="col-9">
                                        <div class="mb-3">
                                            <label for="birth_certificate_number" class="form-label">Birth Certificate Number</label>
                                            <input value="{{ @$user->userId->birth_cirtificate_number }}" type="text" class="form-control"> 
                                        </div>
                                    </div> 
                                     
                                    <div class="col-3">
                                        <img src="{{ @$user?->userId?->birth_image() }}" alt="" width="100%">
                                    </div>

                                    <div class="col-9">
                                        <div class="mb-3">
                                            <label for="passport_number" class="form-label">Passport Number</label>
                                            <input value="{{ @$user->userId->passport_number }}" type="text" class="form-control">                                             
                                        </div>
                                    </div>  
                                    <div class="col-3">
                                        <img src="{{ @$user?->userId?->passport_image() }}" alt="" width="100%">
                                    </div> 
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="passport_expire_date" class="form-label">Passport Expire Date</label>
                                            <input value="{{ @$user->userId->passport_exp_date }}" type="text" class="form-control"> 
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="tin_number" class="form-label">TIN Number</label>
                                            <input value="{{ @$user->userId->tin_number }}" type="text" class="form-control">  
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
 