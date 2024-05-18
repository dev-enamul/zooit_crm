@extends('layouts.dashboard')
@section('title',"Profile")
 

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9"> 
                    {{-- @include('includes.freelancer_profile_data') --}}
                    <div class="card overflow-hidden"> 
                        <div class="card-body border-top">
                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="card-title">About</h4>
                                <div>
                                    <button data-bs-toggle="modal" data-bs-target="#change_password" class="btn btn-secondary cursor-pointer" title="Change Password"  data-bs-toggle="modal" data-bs-target="#change_password_modal">
                                        <i class="mdi mdi-key-change"></i> Change password 
                                    </button>  
                                    @can('bypass-login')
                                        <a href="{{route('bypass',encrypt($user->id))}}" class="btn btn-primary cursor-pointer"> 
                                                Login
                                        </a>
                                    @endcan   

                                    @if (auth()->user()->hasPermission('admin')) 
                                        @if ($user->user_type==1)
                                            <a href="{{route('employee.edit',encrypt($user->id))}}" class="btn btn-primary cursor-pointer"> 
                                                <i class="mdi mdi-account-edit"></i> Edit Profile
                                            </a> 
                                        @elseif($user->user_type==2)
                                            <a href="{{route('freelancer.edit',encrypt($user->id))}}" class="btn btn-primary cursor-pointer"> 
                                                <i class="mdi mdi-account-edit"></i> Edit Profile
                                            </a>
                                        @endif
                                        
                                    @endif

                                </div>
                               
                            </div> 
                            {{-- <p class="text-muted mb-4">Hi I'm Charlie Stone,has been the industry's standard dummy text To an English person, it will seem like simplified English, as a skeptical Cambridge.</p> --}}
                          <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Full Name :</th>
                                                <td>{{$user->name}}</td>
                                            </tr>  
                                            <tr>
                                                <th scope="row">User ID :</th>
                                                <td>{{$user->user_id}}</td>
                                            </tr>   
                                            <tr>
                                                <th scope="row">Phone :</th>
                                                <td>{{$user->phone}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Marital Status :</th>
                                                <td>{{$user->marital_status}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Date of Birth :</th>
                                                <td>{{get_date($user->dob)}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Finger Id :</th>
                                                <td>{{$user->finger_id??"-"}}</td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">Office Phone :</th>
                                                <td>{{$user->userContact->office_phone??"-"}}</td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">Personal Phone :</th>
                                                <td>{{$user->userContact->personal_phone??"-"}}</td>
                                            </tr>  
                                            <tr>
                                                <th scope="row">Office Email :</th>
                                                <td>{{$user->userContact->office_email??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Personal Email :</th>
                                                <td>{{$user->userContact->personal_email??"-"}}</td>
                                            </tr>   
                                            <tr>
                                                <th scope="row">Division :</th>
                                                <td>{{$user->userAddress->division->name??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">District :</th>
                                                <td>{{$user->userAddress->district->name??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Upazila :</th>
                                                <td>{{$user->userAddress->upazila->name??"-"}}</td>
                                            </tr>  
                                            <tr>
                                                <th scope="row">Union :</th>
                                                <td>{{$user->userAddress->union->name??"-"}}</td>
                                            </tr>  
                                            <tr>
                                                <th scope="row">Father Name :</th>
                                                <td>{{$user->userFamily->father_name??"-"}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Father's Number :</th>
                                                <td>{{$user->userFamily->father_mobile??"-"}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Mother's Number :</th>
                                                <td>{{$user->userFamily->mother_name??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Bank :</th>
                                                <td>{{$user->userTransaction->bank->name??"-"}}</td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">branch :</th>
                                                <td>{{$user->userTransaction->branch??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Account Number :</th>
                                                <td>{{$user->userTransaction->bank_account_number??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Account Number :</th>
                                                <td>{{$user->userId->nid_number??"-"}}</td>
                                            </tr> 
                                             
                                            <tr>
                                                <th scope="row">DOB Number :</th>
                                                <td>{{$user->userId->birth_cirtificate_number??"-"}}</td>
                                            </tr> 
 

                                            <tr>
                                                <th scope="row">Passport Number :</th>
                                                <td>{{$user->userId->passport_number??"-"}}</td>
                                            </tr> 
 
                                            <tr>
                                                <th scope="row">Passport Issue Date :</th>
                                                <td>{{$user->userId->passport_issue_date??"-"}}</td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">Passport Exp Date :</th>
                                                <td>{{$user->userId->passport_exp_date??"-"}}</td>
                                            </tr>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-borderless mb-0">
                                        <tbody> 
                                            <tr>
                                                <th scope="row">Reporting Person :</th>
                                                <td>{{$reporting_user->name??"-"}} [ {{@$reporting_user->user_id}} ] {{@$reporting_user->phone}}</td>
                                            </tr>  
                                            <tr>
                                                <th scope="row">Top Reporting Person :</th>
                                                <td>{{$top_reporting_user->name??"-"}} [ {{@$top_reporting_user->user_id}} ] {{@$top_reporting_user->phone}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Religion :</th>
                                                <td>{{ \App\Enums\Religion::values()[$user->religion??null] ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Blood Group :</th>
                                                <td>{{ \App\Enums\BloodGroup::values()[$user->blood_group??null] ?? '-' }}</td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">Gender :</th>
                                                <td>{{ \App\Enums\Gender::values()[$user->gender??null] ?? '-' }}</td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">Nationality :</th>
                                                <td>{{$user->nationality==0?"Bangladeshi":"Indian"}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Imo/Whatsapp number :</th>
                                                <td>{{$user->userContact->imo_number??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Facebook ID :</th>
                                                <td>{{$user->userContact->facebook_id??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Emergency Number :</th>
                                                <td>{{$user->userContact->emergency_contact_number??"-"}}</td>
                                            </tr>  
                                            <tr>
                                                <th scope="row">Emergency Person :</th>
                                                <td>{{$user->userContact->emergency_contact_person??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Village :</th>
                                                <td>{{$user->userAddress->village->name??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Address :</th>
                                                <td>{{$user->userAddress->address??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Zone :</th>
                                                <td>{{$user->userAddress->zone->name??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Area :</th>
                                                <td>{{$user->userAddress->area->name??"-"}}</td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">Mother's Mobile :</th>
                                                <td>{{$user->userFamily->mother_mobile??"-"}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Spouse Name :</th>
                                                <td>{{$user->userFamily->spouse_name??"-"}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Spouse Contact :</th>
                                                <td>{{$user->userFamily->spouse_contact??"-"}}</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Bank Details :</th>
                                                <td>{{$user->userTransaction->bank_details??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Mobile Bank:</th>
                                                <td>{{$user->userTransaction->mobileBank->name??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">Mobile Number:</th>
                                                <td>{{$user->userTransaction->mobile_bank_account_number??"-"}}</td>
                                            </tr> 
                                            <tr>
                                                <th scope="row">NID :</th>
                                                <td>
                                                    <img src="{{$user?->userId?->nid_image()}}" alt="" width="50px">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Birth Certificate :</th>
                                                <td>
                                                    <img src="{{$user?->userId?->birth_image()}}" alt="" width="50px">
                                                </td>
                                            </tr> 

                                            <tr>
                                                <th scope="row">Passport :</th>
                                                <td>
                                                    <img src="{{$user?->userId?->passport_image()}}" alt="" width="50px">
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Tin Number :</th>
                                                <td>{{$user->userId->tin_number??"-"}}</td>
                                            </tr>

                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </div>
                        </div>  
                    </div>  
                </div>
            </div> 
        </div> 
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

 
<div class="modal fade" id="change_password">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Change Password</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div>

            <div class="modal-body">
                <form action="{{route('update.password')}}" method="post"> 
                    @csrf  
                    <div class="form-group mb-2">
                        <label class="mb-1" for="old_password">Old Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password" required>
                    </div> 
                    <div class="form-group mb-2">
                        <label class="mb-1 mt-2" for="password">New Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Old Password" required>
                    </div> 

                    <div class="form-group mb-2">
                        <label class="mb-1 mt-2" for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Old Password" required>
                    </div> 

                    <div class="modal-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                        </div> 
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>

@endsection 
 
@section('script')
  
@endsection