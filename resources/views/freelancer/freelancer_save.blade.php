@extends('layouts.dashboard')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            @if(isset($freelancer))
                                Freelancer Edit
                            @else
                                Freelancer Entry
                            @endif
                        </h4> 

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">
                                    @if(isset($freelancer))
                                        Freelancer Edit
                                    @else
                                        Freelancer Entry
                                    @endif
                                </li>
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
                            @if(isset($freelancer))
                                <form action="{{route('freelancer.save',$freelancer->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                <input type="hidden" name="id" value="{{$freelancer->id}}">
                            @else 
                                <form action="{{route('freelancer.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                            @endif 
                                @csrf
                                <div class="row">
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Personal Information</h6>
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full name" value="{{ isset($freelancer) ? $freelancer->user->name : old('full_name')}}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            
                                            <input type="file" name="profile_image" class="form-control" id="profile_image" >
                                            @if (isset($freelancer) && !empty($freelancer->user->profile_image))
                                            <img src="{{ asset('storage/' . $freelancer->user->profile_image) }}" alt="" width="100" height="100">
                                        @endif                                        </div>
                                    </div>
                                     
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="profession" id="profession" required>
                                                @isset($professions)
                                                    @foreach ($professions as $profession)
                                                        <option value="{{ $profession->id }}" {{ old('profession', isset($freelancer) ? $freelancer->profession_id : null) == $profession->id ? 'selected' : '' }}>
                                                            {{ $profession->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="marital_status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="marital_status" id="marital_status" required>
                                                <option value="">Select a Marital Status</option>
                                                @isset($maritalStatuses)
                                                    @foreach ($maritalStatuses as $id => $name)
                                                        <option value="{{ $id }}" {{ old('marital_status', isset($freelancer) ? $freelancer->user->marital_status : null) == $id ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                            <input type="text" name="dob" class="form-control datepicker w-100 p-1" id="dob" placeholder="Select date of birth" value="{{ isset($freelancer) ? $freelancer->user->dob : old('dob')}}" required> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="card_id" class="form-label">Card/Finger ID </label>
                                            <input type="text" name="card_id" class="form-control" id="card_id" placeholder="Enter ID" value="{{ isset($freelancer) ? $freelancer->user->finger_id : old('card_id') }}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="religion" class="form-label">Religion <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="religion" id="religion" required>
                                                <option value="">Select Religion</option>
                                                @isset($religions)
                                                    @foreach ($religions as $id => $name)
                                                        <option value="{{ $id }}" {{ old('religion', isset($freelancer) && isset($freelancer->user->religion) && $freelancer->user->religion == $id) ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            
                                            
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="blood_group" id="blood_group" required>
                                                <option value="">Select a Blood Group</option>
                                                @isset($bloodGroups)
                                                    @foreach ($bloodGroups as $id => $blood)
                                                        <option value="{{ $id }}" {{ old('blood_group', isset($freelancer) ? $freelancer->user->blood_group : null) == $id ? 'selected' : '' }}>
                                                            {{ $blood }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="gender" id="gender" required>
                                                <option value="">Select Gender</option>
                                                @isset($genders)
                                                    @foreach ($genders as $id => $gender)
                                                        <option value="{{ $id }}" {{ old('gender', isset($freelancer) ? $freelancer->user->gender : null) == $id ? 'selected' : '' }}>
                                                            {{ $gender }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Contact Information</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone1" class="form-label">Mobile Number 1 <span class="text-danger">*</span></label>
                                            <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone 1 Number" value="{{ isset($freelancer) ? $freelancer->user->phone : old('phone1') }}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone2" class="form-label">Mobile Number 2 </label>
                                            <input type="text" name="phone2" class="form-control" id="phone2" placeholder="Phone 2 Number" value="{{ isset($freelancer) ? $freelancer->user->userContact->office_phone : old('phone2') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="office_email" class="form-label">Office Email</label>
                                           <input type="email" name="office_email" class="form-control" id="office_email" placeholder="Office Email ID" value="{{ isset($freelancer) ? $freelancer->user->userContact->office_email : old('office_email') }}"> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Personal Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email ID" value={{ isset($freelancer) ? $freelancer->user->userContact->personal_email : old('email') }}> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="imo_whatsapp_number" class="form-label">Imo/WhatsApp Number</label>
                                            <input type="text" name="imo_whatsapp_number" class="form-control" id="imo_whatsapp_number" placeholder="Imo/Emo Number" value="{{ isset($freelancer) ? $freelancer->user->userContact->imo_number : old('imo_whatsapp_number') }}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_id" class="form-label">Facebook ID</label>
                                            <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID" value="{{ isset($freelancer) ? $freelancer->user->userContact->facebook_id : old('facebook_id') }}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_contact_person_name" class="form-label">Emergency Contact Name</label>
                                            <input type="text" name="emergency_contact_name" class="form-control" id="emergency_contact_person_name" placeholder="Emergency Contact Person Name" value="{{ isset($freelancer) ? $freelancer->user->userContact->emergency_contact_person : old('emergency_contact_name') }}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_contact_person_number" class="form-label">Emergency Contact Person Number</label>
                                            <input type="text" name="emergency_person_number" class="form-control" id="emergency_contact_person_number" placeholder="Emergency Contact Person Number" value="{{ isset($freelancer) ? $freelancer->user->userContact->emergency_contact_number : old('emergency_person_number') }}">  
                                        </div>
                                    </div> 

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Address</h6>
                                    <hr>
                                    <div class="col-md-6 mb-3">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <select class="form-select" name="country" id="country" required>
                                            <option data-display="Select a country *" value="">
                                                Select a country
                                            </option>
                                            @isset($countries)
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" 
                                                        {{ (old('country') == $country->id) || (isset($freelancer) && $freelancer->user->userAddress->country_id == $country->id) ? 'selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            @endisset

                                            @isset($countries)
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" 
                                                        {{ (old('country') == $country->id) || (!isset($freelancer) && $country->id == 18) || (isset($freelancer) && $freelancer->user->userAddress->country_id == $country->id) ? 'selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endforeach
                                            @endisset

                                        </select>
                                        
                                        @if ($errors->has('country'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('country') }}
                                            </span>
                                        @endif
                                    </div> 

                                    @include('common.area', [
                                        'div'       => 'col-md-6',
                                        'mb'        => 'mb-3',
                                        'visible'   => ['division', 'district', 'upazila','union','village'],
                                        'required'  => ['division', 'district', 'upazila','union','village'],
                                        'selected'  => $selected ?? null,
                                    ])

                                    <div class="col-md-6 mb-3">
                                        <label for="zone" class="form-label">Zone <span class="text-danger">*</span></label>
                                        <select class="form-select" name="zone" id="zone" required>
                                            <option data-display="Select a Zone *" value="">
                                                Select a Zone
                                            </option>
                                            @isset($zones)
                                                @foreach ($zones as $zone)
                                                    <option value="{{ $zone->id }}" {{ old('zone', isset($freelancer) ? $freelancer->user->userAddress->zone_id : null) == $zone->id ? 'selected' : '' }}>
                                                        {{ $zone->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('zone'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('zone') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="area" class="form-label">Area <span class="text-danger">*</span></label>
                                        <select class="form-select" name="area" id="area" required>
                                            <option data-display="Select a Area *" value="">
                                                Select a Area
                                            </option>
                                            @isset($areas)
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}" {{ old('area', isset($freelancer) ? $freelancer->user->userAddress->area_id : null) == $area->id ? 'selected' : '' }}>
                                                        {{ $area->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('area'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('area') }}
                                            </span>
                                        @endif
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="2" name="address">{{isset($freelancer) ? $freelancer->user->userAddress->address : old('address')}}</textarea> 
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Family Details</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="father_name" class="form-label">Father's Name <span class="text-danger">*</span></label>
                                            <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Father's Name" value="{{isset($freelancer) ? $freelancer->user->userFamily->father_name : old('father_name')}}">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="father_phone" class="form-label">Father Mobile</label>
                                            <input type="text" name="father_phone" class="form-control" id="father_phone" placeholder="Father Father Mobile" value="{{isset($freelancer) ? $freelancer->user->userFamily->father_mobile : old('father_phone')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_name" class="form-label">Mother's Name <span class="text-danger">*</span></label>
                                            <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother's Name" value="{{isset($freelancer) ? $freelancer->user->userFamily->mother_name : old('mother_name')}}">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_phone" class="form-label">Mother Mobile</label>
                                            <input type="text" name="mother_phone" class="form-control" id="mother_phone" placeholder="Mother's Mobile" value="{{isset($freelancer) ? $freelancer->user->userFamily->mother_mobile : old('mother_phone')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="spouse_name" class="form-label">Spouse Name</label>
                                            <input type="text" name="spouse_name" class="form-control" id="spouse_name" placeholder="Spouse Name" value="{{isset($freelancer) ? $freelancer->user->userFamily->spouse_name : old('spouse_name')}}">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="spouse_phone" class="form-label">Spouse Mobile</label>
                                            <input type="text" name="spouse_phone" class="form-control" id="spouse_phone" placeholder="Spouse Mobile" value="{{isset($freelancer) ? $freelancer->user->userFamily->spouse_contact : old('spouse_phone')}}">  
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Transaction Info</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank" class="form-label">Bank </label>
                                            <select class="form-select select2" name="bank" id="bank" required>
                                                <option value="">Select a Bank</option>
                                                @isset($banks)
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank->id }}" {{ old('bank', isset($freelancer) ? $freelancer->user->userTransaction->bank_id : null) == $bank->id ? 'selected' : '' }}>
                                                            {{ $bank->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Branch Name</label>
                                            <input type="text" name="branch" id="branch" class="form-control" placeholder="Enter Bank Branch" value="{{isset($freelancer) ? $freelancer->user->userTransaction->branch : old('branch')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_number" class="form-label">Account Number</label>
                                            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Enter Bank Account Number" value="{{isset($freelancer) ? $freelancer->user->userTransaction->bank_account_number : old('account_number')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                            <input type="text" name="account_holder_name" id="account_holder_name" class="form-control" placeholder="Enter Bank Holder Name" value="{{isset($freelancer) ? $freelancer->user->userTransaction->bank_details : old('account_holder_name')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank" class="form-label">Mobile Bank</label>
                                            <select class="form-select select2" name="mobile_bank" id="mobile_bank" required>
                                                <option value="">Select a Mobile Bank</option>
                                                @isset($mobileBanks)
                                                    @foreach ($mobileBanks as $mobileBank)
                                                        <option value="{{ $mobileBank->id }}" {{ old('mobile_bank', isset($freelancer) ? $freelancer->user->userTransaction->mobile_bank_id : null) == $mobileBank->id ? 'selected' : '' }}>
                                                            {{ $mobileBank->name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank_number" class="form-label">Mobile Bank Number</label>
                                            <input type="text" name="mobile_bank_number" id="mobile_bank_number" class="form-control" placeholder="Enter Mobile Bank Number" value="{{isset($freelancer) ? $freelancer->user->userTransaction->mobile_bank_account_number : old('mobile_bank_number')}}">  
                                        </div>
                                    </div> 
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> ID Detail</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">NID Number</label>
                                            <input type="text" name="nid" id="nid" class="form-control" placeholder="Enter NID Number" value="{{isset($freelancer) ? $freelancer->user->userId->nid_number : old('nid')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid_file" class="form-label">Upload NID</label>
                                            <input type="file" name="nid_file" id="nid_file" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birth_certificate_number" class="form-label">Birth Certificate Number</label>
                                            <input type="text" name="birth_certificate_number" id="birth_certificate_number" class="form-control" placeholder="Enter Birth Certificate Number" value="{{isset($freelancer) ? $freelancer->user->userId->birth_cirtificate_number : old('birth_certificate_number')}}"> 
                                            @if (isset($freelancer) && !empty($freelancer->user->userId->nid_image))
                                                <img src="{{ asset('storage/' . $freelancer->user->userId->nid_image) }}" alt="" width="100" height="100">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birth_certificate_file" class="form-label">Upload Birth Certificate</label>
                                            <input type="file" name="birth_certificate_file" id="birth_certificate_file" class="form-control" > 
                                            @if (isset($freelancer) && !empty($freelancer->user->userId->birth_cirtificate_image))
                                                <img src="{{ asset('storage/' . $freelancer->user->userId->birth_cirtificate_image) }}" alt="" width="100" height="100">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_number" class="form-label">Passport Number</label>
                                            <input type="text" name="passport_number" id="passport_number" class="form-control" placeholder="Enter Passport Number" value="{{isset($freelancer) ? $freelancer->user->userId->passport_number : old('passport_number')}}"> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="upload_passport" class="form-label">Upload Passport</label>
                                            <input type="file" name="upload_passport" id="upload_passport" class="form-control">
                                            @if (isset($freelancer) && !empty($freelancer->user->userId->passport_image))
                                                <img src="{{ asset('storage/' . $freelancer->user->userId->passport_image) }}" alt="" width="100" height="100">
                                            @endif  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_expire_date" class="form-label">Passport Issue Date</label>
                                            <input type="text" name="passport_issue_date" class="form-control datepicker w-100" id="passport_issue_date" placeholder="Select passport issue date" value="{{isset($freelancer) ? $freelancer->user->userId->passport_issue_date : old('passport_issue_date')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_expire_date" class="form-label">Passport Expire Date</label>
                                            <input type="text" name="passport_expire_date" class="form-control datepicker w-100" id="passport_expire_date" placeholder="Select passport expire date" value="{{isset($freelancer) ? $freelancer->user->userId->passport_exp_date : old('passport_expire_date')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tin_number" class="form-label">TIN Number</label>
                                            <input type="text" name="tin_number" id="tin_number" class="form-control" placeholder="Enter TIN Number" value="{{isset($freelancer) ? $freelancer->user->userId->tin_number : old('tin_number')}}"> 
                                        </div>
                                    </div>
                                </div>
                                  
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
