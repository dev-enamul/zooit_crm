@extends('layouts.dashboard')
@section('title',"Employee Create")
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Freelancer Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Freelancer Entry</li>
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
                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Personal Information</h6>
                                    <hr>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="First name" value="" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="First name" value="" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="profession" id="profession" required>
                                                <option value="">Select Profession</option>
                                                <option value="">Doctors</option>
                                                <option value="">Lawyers</option> 
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
                                            <select class="form-select" name="marital_status" id="marital_status" required>
                                                <option value="">Select Marital Status</option>
                                                <option value="">Married</option>
                                                <option value="">Unmarried</option>
                                                <option value="">Devorce</option>  
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
                                                <option value="">Select Region</option>
                                                <option value="">Christianity</option>
                                                <option value="">Islam</option>
                                                <option value="">Hinduism</option>  
                                                <option value="">Buddhism</option>
                                                <option value="">Judaism</option>
                                                <option value="">Sikhism</option>  
                                                <option value="">Jainism</option>
                                                <option value="">Bahá'í Faith</option>
                                                <option value="">Confucianism</option> 
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
                                                <option value="">Select Blood Group</option>
                                                <option value="">A positive (A+)</option> 
                                                <option value="">A negative (A-)</option> 
                                                <option value="">B positive (B+)</option> 
                                                <option value="">B negative (B-)</option> 
                                                <option value="">AB positive (AB+)</option> 
                                                <option value="">AB negative (AB-)</option> 
                                                <option value="">O positive (O+)</option> 
                                                <option value="">O negative (O-)</option> 
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="blood_group" id="blood_group" required>
                                                <option value="">Select Gender</option>
                                                <option value="">Male</option> 
                                                <option value="">Female</option>  
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Nationality <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="gender" id="gender" required>
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
                                            <label for="phone1" class="form-label">Mobile Number 2 </label>
                                            <input type="text" name="phone1" class="form-control" id="phone1" placeholder="Phone 2 Number" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Office Email</label>
                                           <input type="email" name="email" class="form-control" id="email" placeholder="Email Number"> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Personal Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email Number"> 
                                            <div class="invalid-feedback">
                                                This field is invalid.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="imo_number" class="form-label">Imo/Whatsapp Number</label>
                                            <input type="text" name="imo_number" class="form-control" id="imo_number" placeholder="Emo Number">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_person" class="form-label">Facebook ID</label>
                                            <input type="text" name="emergency_person" class="form-control" id="emergency_person" placeholder="Emergency Contact Number">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_contact" class="form-label">Emergency Contact Number</label>
                                            <input type="text" name="emergency_contact" class="form-control" id="emergency_contact" placeholder="Emergency Contact Number">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emergency_person" class="form-label">Emergency Contact Person</label>
                                            <input type="text" name="emergency_person" class="form-control" id="emergency_person" placeholder="Emergency Contact Number">  
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

                                    <div class="col-md-6">
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
                                    </div>

                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="village" class="form-label">Word</label>
                                            <select class="form-select" name="village" id="village">
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
                                    </div> -->

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
                                            <label for="father_name" class="form-label">Father's Name</label>
                                            <input type="text" name="father_name" class="form-control" id="father_name" placeholder="Father Name">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="father_phone" class="form-label">Mobile</label>
                                            <input type="text" name="father_phone" class="form-control" id="father_phone" placeholder="Father Father Mobile">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_name" class="form-label">Mother's Name</label>
                                            <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother's Name">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_phone" class="form-label">Mobile</label>
                                            <input type="text" name="mother_phone" class="form-control" id="mother_phone" placeholder="Mother's Mobile">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_name" class="form-label">Spouse Name</label>
                                            <input type="text" name="mother_name" class="form-control" id="mother_name" placeholder="Mother's Name">  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mother_phone" class="form-label">Mobile</label>
                                            <input type="text" name="mother_phone" class="form-control" id="mother_phone" placeholder="Spouse Mobile">  
                                        </div>
                                    </div>

                                    <h6 class="text-primary"> <i class="mdi mdi-check-all"></i> Transaction Info</h6>
                                    <hr>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="bank" class="form-label">Bank <span class="text-danger">*</span></label>
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
                                            <label for="branch" class="form-label">Account Number</label>
                                            <input type="text" name="branch" id="branch" class="form-control" placeholder="Enter Bank Account Number">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Bank Other's Information</label>
                                            <input type="text" name="branch" id="branch" class="form-control" placeholder="Enter Bank Other's Information">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="mobile_bank" class="form-label">Mobile Bank <span class="text-danger">*</span></label>
                                            <select class="form-select select2" name="mobile_bank" id="mobile_bank" required>
                                                <option value="">Bksh</option>
                                                <option value="">Roket </option>
                                                <option value="">MCash </option>  
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Mobile Bank Number</label>
                                            <input type="text" name="branch" id="branch" class="form-control" placeholder="Enter Mobile Bank Number">  
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
                                            <label for="nid" class="form-label">Upload NID</label>
                                            <input type="file" name="nid" id="nid" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">Birth Cirtificate Number</label>
                                            <input type="text" name="nid" id="nid" class="form-control" placeholder="Enter NID Number"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">Upload Birth Cirtificate</label>
                                            <input type="file" name="nid" id="nid" class="form-control" > 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">Passport Number</label>
                                            <input type="text" name="nid" id="nid" class="form-control" placeholder="Enter NID Number"> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Upload Passport</label>
                                            <input type="file" name="profile_image" id="profile_image" class="form-control">  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">Expire Date</label>
                                            <input type="text" name="dob" class="form-control datepicker w-100" id="dob" placeholder="Select expire date" required> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="nid" class="form-label">TIN Number</label>
                                            <input type="text" name="nid" id="nid" class="form-control" placeholder="Enter NID Number"> 
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