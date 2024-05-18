@extends('layouts.dashboard')
@section('title', $title)
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-cjustify-content-between">
                        <h4 class="mb-sm-0">
                            {{$title}}
                        </h4>   
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card"> 
                        <div class="card-body">
                            <form action="{{route('freelancer.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                @csrf
                                <div class="row">
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Personal Information</h6>
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full name" value="{{old('full_name')}}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Profile Image <span class="text-danger">[jpeg, jpg, png, gif | Max : 2MB ]</span></label> 
                                            <input type="file" name="profile_image" class="form-control" id="profile_image" > 
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="marital_status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="marital_status" id="marital_status" required>
                                                <option value="">Select a Marital Status</option>
                                                @isset($maritalStatuses)
                                                    @foreach ($maritalStatuses as $id => $name)
                                                        <option value="{{ $id }}" {{ old('marital_status') == $id ? 'selected' : '' }}>
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
                                            <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                            <select class="form-select" name="profession" id="profession" required>
                                                <option value="">Select a Profession</option>
                                                @isset($professions)
                                                    @foreach ($professions as  $profession)
                                                        <option value="{{ $profession->id }}" {{ old('profession') == $profession->id ? 'selected' : '' }}>
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
                                            <label for="dob" class="form-label">Date of Birth</label>
                                            <input type="date" name="dob" class="form-control" id="dob" placeholder="Select date of birth" value="{{ old('dob')}}"> 
                                          
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="card_id" class="form-label">Card/Finger ID </label>
                                            <input type="text" name="card_id" class="form-control" id="card_id" placeholder="ID" value="{{ old('card_id') }}">  
                                        </div>
                                    </div>
                                      
 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="religion" class="form-label">Religion <span class="text-danger">*</span></label>
                                            <select class="form-select" name="religion" id="religion" required>
                                                <option value="">Select Religion</option>
                                                @isset($religions)
                                                    @foreach ($religions as $id => $name)
                                                        <option value="{{ $id }}" {{ old('religion')  == $id ? 'selected' : '' }}>
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
                                            <label for="blood_group" class="form-label">Blood Group </label>
                                            <select class="form-select" name="blood_group" id="blood_group">
                                                <option value="">Select a Blood Group</option>
                                                @isset($bloodGroups)
                                                    @foreach ($bloodGroups as $id => $blood)
                                                        <option value="{{ $id }}" {{ old('blood_group') == $id ? 'selected' : '' }}>
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
                                            <select class="form-select" name="gender" id="gender" required>
                                                <option value="">Select Gender</option>
                                                @isset($genders)
                                                    @foreach ($genders as $id => $gender)
                                                        <option value="{{ $id }}" {{ old('gender') == $id ? 'selected' : '' }}>
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

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span></label>
                                            <select class="form-select" name="nationality" id="nationality" required> 
                                                @isset($nationalites)
                                                    @foreach ($nationalites as $id => $data)
                                                        <option value="{{ $id }}" {{ old('nationality') == $id ? 'selected' : '' }}>
                                                            {{ $data }}
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
                                            <input type="text" name="phone1" class="form-control" id="phone1" maxlength="15" placeholder="Phone 1 Number" value="{{ old('phone1') }}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone2" class="form-label">Mobile Number 2 </label>
                                            <input type="text" name="phone2" class="form-control" maxlength="15" id="phone2" placeholder="Phone 2 Number" value="{{ old('phone2') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="office_email" class="form-label">Office Email</label>
                                           <input type="email" name="office_email" class="form-control" id="office_email" placeholder="Office Email ID" value="{{ old('office_email') }}"> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Personal Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Personal Email ID" value={{old('email') }}> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="imo_whatsapp_number" class="form-label">Imo/WhatsApp Number</label>
                                            <input type="text" name="imo_whatsapp_number" class="form-control" id="imo_whatsapp_number" placeholder="Imo/WhatsApp Number" value="{{ old('imo_whatsapp_number') }}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_id" class="form-label">Facebook ID</label>
                                            <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID" value="{{old('facebook_id')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_contact_person_name" class="form-label">Emergency Contact Name</label>
                                            <input type="text" name="emergency_contact_name" class="form-control" id="emergency_contact_person_name" placeholder="Emergency Contact Person Name" value="{{ old('emergency_contact_name') }}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_contact_person_number" class="form-label">Emergency Contact Person Number</label>
                                            <input type="text" name="emergency_person_number" class="form-control" id="emergency_contact_person_number" placeholder="Emergency Contact Person Number" value="{{ old('emergency_person_number') }}">  
                                        </div>
                                    </div> 

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Address</h6>
                                    <hr>
                                     
                                    @include('common.area', [
                                        'div'       => 'col-md-6',
                                        'mb'        => 'mb-3',
                                        'visible'   => ['division', 'district', 'upazila','union','village'],
                                        'required'  => [],
                                        'selected'  => $selected ?? null,
                                    ])  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="post_code" class="form-label">Post Code</label>
                                            <input type="text" class="form-control" name="post_code" id="post_code" placeholder="Enter post code">
                                        </div>
                                    </div> 

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="1" name="address" placeholder="Enter post code"></textarea> 
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Family Details</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="father_name" class="form-label">Father's Name </label>
                                            <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Father's Name" value="{{old('father_name')}}">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="father_phone" class="form-label">Father's Mobile</label>
                                            <input type="text" name="father_phone" class="form-control" maxlength="15" id="father_phone" placeholder="Father's Mobile" value="{{old('father_phone')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_name" class="form-label">Mother's Name</label>
                                            <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother's Name" value="{{old('mother_name')}}">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_phone" class="form-label">Mother Mobile</label>
                                            <input type="text" name="mother_phone" class="form-control" maxlength="15" id="mother_phone" placeholder="Mother's Mobile" value="{{old('mother_phone')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="spouse_name" class="form-label">Spouse Name</label>
                                            <input type="text" name="spouse_name" class="form-control" id="spouse_name" placeholder="Spouse Name" value="{{old('spouse_name')}}">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="spouse_phone" class="form-label">Spouse Mobile</label>
                                            <input type="text" name="spouse_phone" class="form-control" maxlength="15" id="spouse_phone" placeholder="Spouse Mobile" value="{{old('spouse_phone')}}">  
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Transaction Info</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank" class="form-label">Bank </label>
                                            <select class="form-select" name="bank" id="bank">
                                                <option value="">Select a Bank</option>
                                                @isset($banks)
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank->id }}" {{ old('bank') == $bank->id ? 'selected' : '' }}>
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
                                            <input type="text" name="branch" id="branch" class="form-control" placeholder="Bank Branch" value="{{old('branch')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_number" class="form-label">Account Number</label>
                                            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Bank Account Number" value="{{old('account_number')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                            <input type="text" name="account_holder_name" id="account_holder_name" class="form-control" placeholder="Bank Holder Name" value="{{old('account_holder_name')}}">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank" class="form-label">Mobile Bank</label>
                                            <select class="form-select" name="mobile_bank" id="mobile_bank">
                                                <option value="">Select a Mobile Bank</option>
                                                @isset($mobileBanks)
                                                    @foreach ($mobileBanks as $mobileBank)
                                                        <option value="{{ $mobileBank->id }}" {{ old('mobile_bank') == $mobileBank->id ? 'selected' : '' }}>
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
                                            <input type="text" name="mobile_bank_number" id="mobile_bank_number" class="form-control" placeholder="Mobile Bank Number" value="{{old('mobile_bank_number')}}">  
                                        </div>
                                    </div> 
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> ID Detail</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">NID Number</label>
                                            <input type="text" name="nid" id="nid" class="form-control" placeholder="NID Number" value="{{old('nid')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid_file" class="form-label">Upload NID <span class="text-danger">[jpeg, jpg, png, gif | Max : 2MB ]</span></label>
                                            <input type="file" name="nid_file" id="nid_file" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birth_certificate_number" class="form-label">Birth Certificate Number</label>
                                            <input type="text" name="birth_certificate_number" id="birth_certificate_number" class="form-control" placeholder="Birth Certificate Number" value="{{old('birth_certificate_number')}}"> 
                                          
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birth_certificate_file" class="form-label">Upload Birth Certificate <span class="text-danger">[jpeg, jpg, png, gif | Max : 2MB ]</span></label>
                                            <input type="file" name="birth_certificate_file" id="birth_certificate_file" class="form-control" > 
                                             
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_number" class="form-label">Passport Number</label>
                                            <input type="text" name="passport_number" id="passport_number" class="form-control" placeholder="Passport Number" value="{{old('passport_number')}}"> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="upload_passport" class="form-label">Upload Passport <span class="text-danger">[jpeg, jpg, png, gif | Max : 2MB ]</span></label>
                                            <input type="file" name="upload_passport" id="upload_passport" class="form-control">
                                             
                                        </div>
                                    </div>
 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_expire_date" class="form-label">Passport Expire Date</label>
                                            <input type="date" name="passport_expire_date" class="form-control w-100" id="passport_expire_date" placeholder="Select passport expire date" value="{{old('passport_expire_date')}}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tin_number" class="form-label">TIN Number</label>
                                            <input type="text" name="tin_number" id="tin_number" class="form-control" placeholder="TIN Number" value="{{old('tin_number')}}"> 
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Official Information</h6>
                                    <hr> 

                                    @can('admin') 
                                        <div class="col-md-4 mb-3">
                                            <label for="freelancer_id" class="form-label">Freelancer ID <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="freelancer_id" placeholder="Freelancer ID">
                                        </div>
                                    @endcan

                                    <div class="col-md-4 mb-3">
                                        <label for="designation" class="form-label">Designation <span class="text-danger">*</span></label>
                                        <select class="form-select select2" search name="designation" id="designation" required>
                                            <option value=""> Select a Designation</option>
                                            @isset($designations)
                                                @foreach ($designations as $designation)
                                                <option value="{{ $designation->id }}" {{ old('designation') == $designation->id ? 'selected' : '' }}>
                                                        {{ $designation->title }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select> 
                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div> 
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label for="reporting_user" class="form-label">Employee/Freelancer <span class="text-danger">*</span></label>
                                        <select class="select2" search name="reporting_user" id="reporting_id" required> 
                                               
                                        </select> 
                                        <div class="invalid-feedback">
                                            This field is required.
                                        </div>
                                         
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="zone" class="form-label">Zone <span class="text-danger">*</span></label>
                                        <select class="form-select select2" search name="zone" id="zone" required>
                                            <option data-display="Select a Zone" value=""> Select a Zone</option>
                                            @isset($zones)
                                                @foreach ($zones as $zone)
                                                    <option value="{{ $zone->id }}" {{ old('zone') == $zone->id ? 'selected' : '' }}>
                                                        {{ $zone->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>  
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="area" class="form-label">Area <span class="text-danger">*</span></label>
                                        <select class="form-select select2" search name="area" id="area" required>
                                            <option data-display="Select a Area *" value="">
                                                Select a Area
                                            </option>
                                            @isset($areas)
                                                @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}" {{ old('area') == $area->id ? 'selected' : '' }}>
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

                                </div>
                                  
                                <div>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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

@section('script2')
<script>
    $(document).ready(function() {
        $('#reporting_id').select2({
            placeholder: "Select Employee",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.reporting.user') }}',
                dataType: 'json',
                data: function (params) {
                    console.log(params);
                    var query = {
                        term: params.term
                    }
                    return query;
                }
            }
        });
    });
</script>
@endsection
 
 
 