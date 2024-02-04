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
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full name" value="{{ isset($freelancer) ? $freelancer->user->name : old('name')}}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <input type="file" name="profile_image" class="form-control" id="profile_image" >
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="profession" id="profession" required>
                                                <option value="">Select Profession</option>
                                                <option value="">Doctor</option>
                                                <option value="">Lawyer</option> 
                                                <option value="">Banker</option>
                                                <option value="">Teacher</option>
                                                <option value="">Engineer</option>
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="marital_status" class="form-label">Marital Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="maritual_status" id="marital_status" required>
                                                <option value="">Select Marital Status</option>
                                                <option value="">Married</option>
                                                <option value="">Unmarried</option>
                                                <option value="">Divorce</option>  
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                            <input type="text" name="dob" class="form-control datepicker w-100 p-1" id="dob" placeholder="Select date of birth" required> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="card_id" class="form-label">Card/Finger ID </label>
                                            <input type="text" name="card_id" class="form-control" id="card_id" placeholder="Enter ID">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="religion" class="form-label">Religion <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="religion" id="religion" required>
                                                <option value="">Select Religion</option>
                                                <option value="1">Christianity</option>
                                                <option value="2">Islam</option>
                                                <option value="3">Hinduism</option>
                                                <option value="4">Buddhism</option>
                                                <option value="5">Judaism</option>
                                                <option value="6">Sikhism</option>
                                                <option value="7">Jainism</option>
                                                <option value="8">Bahá'í Faith</option>
                                                <option value="9">Confucianism</option>
                                                <option value="10">Others</option> 
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
                                                <option value="1">A positive (A+)</option>
                                                <option value="2">A negative (A-)</option>
                                                <option value="3">B positive (B+)</option>
                                                <option value="4">B negative (B-)</option>
                                                <option value="5">AB positive (AB+)</option>
                                                <option value="6">AB negative (AB-)</option>
                                                <option value="7">O positive (O+)</option>
                                                <option value="8">O negative (O-)</option>
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
                                                <option value="">Male</option> 
                                                <option value="">Female</option>  
                                                <option value="">Others</option> 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="nationality" id="nationality" required>
                                                <option value="">Select Nationality</option>
                                                <option value="">Bangladeshi</option>
                                                <option value="">Indian</option>  
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
                                            <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone 1 Number" value="" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone2" class="form-label">Mobile Number 2 </label>
                                            <input type="text" name="phone2" class="form-control" id="phone2" placeholder="Phone 2 Number" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="office_email" class="form-label">Office Email</label>
                                           <input type="email" name="office_email" class="form-control" id="office_email" placeholder="Office Email ID"> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Personal Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email ID"> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="imo_whatsapp_number" class="form-label">Imo/WhatsApp Number</label>
                                            <input type="text" name="imo_whatsapp_number" class="form-control" id="imo_whatsapp_number" placeholder="Imo/Emo Number">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_id" class="form-label">Facebook ID</label>
                                            <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_contact_person_name" class="form-label">Emergency Contact Name</label>
                                            <input type="text" name="emergency_contact_name" class="form-control" id="emergency_contact_person_name" placeholder="Emergency Contact Person Name">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_contact_person_number" class="form-label">Emergency Contact Person Number</label>
                                            <input type="text" name="emergency_person_number" class="form-control" id="emergency_contact_person_number" placeholder="Emergency Contact Person Number">  
                                        </div>
                                    </div> 

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Address</h6>
                                    <hr> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="division" id="division" required>
                                                <option value="">Select District</option>
                                                <option value="">Dhaka </option>
                                                <option value="">Chittagong </option> 
                                                <option value="">Rajshahi</option> 
                                                <option value="">Khulna </option> 
                                                <option value="">Barishal </option> 
                                                <option value="">Sylhet</option> 
                                                <option value="">Rangpur</option> 
                                                <option value="">Mymensingh</option>  
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="district" id="district" required>
                                                <option value="">Select District</option>
                                                <option value="">Dhaka </option>
                                                <option value="">Chittagong </option> 
                                                <option value="">Rajshahi</option> 
                                                <option value="">Khulna </option> 
                                                <option value="">Barishal </option> 
                                                <option value="">Sylhet</option> 
                                                <option value="">Rangpur</option> 
                                                <option value="">Mymensingh</option>  
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="upazila" class="form-label">Thana/Upazila <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="upazila" id="upazila" required>
                                                <option value="">Select Thana/Upazila</option>
                                                <option value="">Dhaka </option>
                                                <option value="">Chittagong </option> 
                                                <option value="">Rajshahi</option> 
                                                <option value="">Khulna </option> 
                                                <option value="">Barishal </option> 
                                                <option value="">Sylhet</option> 
                                                <option value="">Rangpur</option> 
                                                <option value="">Mymensingh</option>  
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="union" class="form-label">Union <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="union" id="union" required>
                                                <option value="">Select Union</option>
                                                <option value="">Dhaka </option>
                                                <option value="">Chittagong </option> 
                                                <option value="">Rajshahi</option> 
                                                <option value="">Khulna </option> 
                                                <option value="">Barishal </option> 
                                                <option value="">Sylhet</option> 
                                                <option value="">Rangpur</option> 
                                                <option value="">Mymensingh</option>  
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="post_office" class="form-label">Post Office <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="post_office" id="post_office" required>
                                                <option value="">Select Union</option>
                                                <option value="">Dhaka </option>
                                                <option value="">Chittagong </option> 
                                                <option value="">Rajshahi</option> 
                                                <option value="">Khulna </option> 
                                                <option value="">Barishal </option> 
                                                <option value="">Sylhet</option> 
                                                <option value="">Rangpur</option> 
                                                <option value="">Mymensingh</option>  
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="village" class="form-label">Village</label>
                                            <select class="form-select select2" name="village" id="village">
                                                <option value="">Select Village</option>
                                                <option value="">Dhaka </option>
                                                <option value="">Chittagong </option> 
                                                <option value="">Rajshahi</option> 
                                                <option value="">Khulna </option> 
                                                <option value="">Barishal </option> 
                                                <option value="">Sylhet</option> 
                                                <option value="">Rangpur</option> 
                                                <option value="">Mymensingh</option>  
                                            </select>  
                                        </div>
                                    </div>  

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Family Details</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="father_name" class="form-label">Father's Name <span class="text-danger">*</span></label>
                                            <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Father's Name">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="father_phone" class="form-label">Father Mobile</label>
                                            <input type="text" name="father_phone" class="form-control" id="father_phone" placeholder="Father Father Mobile">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_name" class="form-label">Mother's Name <span class="text-danger">*</span></label>
                                            <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother's Name">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_phone" class="form-label">Mother Mobile</label>
                                            <input type="text" name="mother_phone" class="form-control" id="mother_phone" placeholder="Mother's Mobile">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="spouse_name" class="form-label">Spouse Name</label>
                                            <input type="text" name="spouse_name" class="form-control" id="spouse_name" placeholder="Spouse Name">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="spouse_phone" class="form-label">Spouse Mobile</label>
                                            <input type="text" name="spouse_phone" class="form-control" id="spouse_phone" placeholder="Spouse Mobile">  
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Transaction Info</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank" class="form-label">Bank </label>
                                            <select class="form-select select2" name="bank" id="bank" required>
                                                <option value="">Select Bank</option>
                                                <option value="">Dhaka Bank </option>
                                                <option value="">Jamuna Bank </option>
                                                <option value="">Islamic Bank </option>
                                                <option value="">DBBL </option> 
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Branch Name</label>
                                            <input type="text" name="branch" id="branch" class="form-control" placeholder="Enter Bank Branch">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_number" class="form-label">Account Number</label>
                                            <input type="text" name="account_number" id="account_number" class="form-control" placeholder="Enter Bank Account Number">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                                            <input type="text" name="account_holder_name" id="account_holder_name" class="form-control" placeholder="Enter Bank Holder Name">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank" class="form-label">Mobile Bank</label>
                                            <select class="form-select select2" name="mobile_bank" id="mobile_bank" required>
                                                <option value="">Bkash</option>
                                                <option value="">Rocket </option>
                                                <option value="">MCash </option>  
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank_number" class="form-label">Mobile Bank Number</label>
                                            <input type="text" name="mobile_bank_number" id="mobile_bank_number" class="form-control" placeholder="Enter Mobile Bank Number">  
                                        </div>
                                    </div> 
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> ID Detail</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">NID Number</label>
                                            <input type="text" name="nid" id="nid" class="form-control" placeholder="Enter NID Number"> 
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
                                            <input type="text" name="birth_certificate_number" id="birth_certificate_number" class="form-control" placeholder="Enter Birth Certificate Number"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="birth_certificate_file" class="form-label">Upload Birth Certificate</label>
                                            <input type="file" name="birth_certificate_file" id="birth_certificate_file" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_number" class="form-label">Passport Number</label>
                                            <input type="text" name="passport_number" id="passport_number" class="form-control" placeholder="Enter Passport Number"> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="upload_passport" class="form-label">Upload Passport</label>
                                            <input type="file" name="upload_passport" id="upload_passport" class="form-control">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="passport_expire_date" class="form-label">Expire Date</label>
                                            <input type="text" name="passport_expire_date" class="form-control datepicker w-100" id="passport_expire_date" placeholder="Select expire date" required> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tin_number" class="form-label">TIN Number</label>
                                            <input type="text" name="tin_number" id="tin_number" class="form-control" placeholder="Enter TIN Number"> 
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
