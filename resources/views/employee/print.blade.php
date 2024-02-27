<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Emoloyee Information Print</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        :root {
            font-size: 12px
        }
    </style>
</head>
<body class="m-5 py-5" onload="window.print()">
    <div class="">
        <div class="row">
            <div class="col-md-11 text-center ">
                <ul class="navbar-nav ml-auto">
                    <li class="fw-bold"> Way Housing CRM</li> 
                    <h1 class="fw-bold pt-3" style="color:#454949">Employee Information</h1>
                    {{-- <h6 class="fw-bold">Created At : {{@$employee->created_at->format('Y-m-d') ?? '.......................................................'}} </h6> --}}
                </ul>
            </div>
            <div class="col-1" style="text-align: right;">
                <h5 class="fw-bold">  
                    @if($employee->user->image() != null)
                        <img src="{{$employee->user->image()}}" alt="" height="100px" style="border:1px solid black;padding:5px">
                    @else
                        <img src="{{asset('assets/images/men_image.jpg')}}" alt="" height="50px" style="border:1px solid black;padding:5px">
                    @endif
                </h5>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <h5 class="fw-bold">Full Name : {{ @$employee->user->name ?? '.......................................................' }}</h5>
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Marital Status :
                    @isset($employee->user->marital_status)
                        @if ($employee->user->marital_status == 1)
                            Married
                        @elseif($employee->user->marital_status == 2)
                            Unmarried
                        @else
                            Divorce
                        @endif
                    @else
                        .......................................................
                    @endisset
                </h5>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Date of Birth : {{@$employee->user->dob ?? '.......................................................'}} </h5>
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Card / Fingure ID : {{@$employee->user->finger_id  ?? ''}}</h5>
            </div>
        </div>
        
        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Religion :
                    @isset($employee->user->religion)
                        @foreach(App\Enums\Religion::values() as $id => $religion)
                            @if($employee->user->religion == $id)
                                {{ $religion }}
                            @endif
                        @endforeach
                    @else
                        .......................................................
                    @endisset
                </h5>
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Blood Group :  
                    @isset($employee->user->blood_group)
                        @foreach(App\Enums\BloodGroup::values() as $id => $blood_group)
                            @if($employee->user->blood_group == $id)
                                {{ $blood_group }}
                            @endif
                        @endforeach
                    @else
                        .......................................................
                    @endisset
                </h5>
            </div>
        </div>
       

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Gender :
                    @isset($employee->user->gender)
                        @foreach(App\Enums\Gender::values() as $id => $gender)
                            @if($employee->user->gender == $id)
                                {{ $gender }}
                            @endif
                        @endforeach
                    @else
                        .......................................................
                    @endisset
                </h5>
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Nationality: Bangladeshi  </h5>
            </div>
        </div>
    
        <div class="row">
            <h5 class="text-center pb-2 fw-bold mt-5" style="border-bottom: 1px solid rgb(158, 152, 152)">Personal Information</h5>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Phone No One : <span class="fw-thin" style="color: #646464"> {{ $employee->user->phone ?? '.......................................................' }}</span></h5> 
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Phone No Two : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userContact->office_phone ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Office Email : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userContact->office_email ?? '.......................................................' }}</span></h5> 
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Personal Email : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userContact->personal_email ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Imo / WhatsApp Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userContact->imo_number ?? '.......................................................' }}</span></h5> 
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Facebook ID : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userContact->facebook_id ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Emergency Contact Name : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userContact->emergency_contact_person ?? '.......................................................' }}</span></h5> 
            </div>
            <div class="col-6">
                <h5 class="fw-bold mt-3">Emergency Contact Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userContact->emergency_contact_number ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row mt-5">
            <h5 class="text-center pb-2 fw-bold mt-5" style="border-bottom: 1px solid rgb(158, 152, 152)">Address</h5>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3"> Division : <span class="fw-thin" style="color: #646464">
                    @isset($employee->user->userAddress->division_id)
                    @php
                        $divisionId = $employee->user->userAddress->division_id;
                        $division = App\Models\Division::find($divisionId);
                        
                    @endphp
                    {{ $division->name ?? '.......................................................' }}
                    @else
                        .......................................................
                    @endisset
                </h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3"> District : <span class="fw-thin" style="color: #646464">
                    @isset($employee->user->userAddress->district_id)
                    @php
                        $districtId = $employee->user->userAddress->district_id;
                        $district = App\Models\Division::find($districtId);
                        
                    @endphp
                    {{ $district->name ?? '.......................................................' }}
                @else
                    .......................................................
                @endisset 
            </div>
        </div>
        
        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3"> Upazila : <span class="fw-thin" style="color: #646464">
                    @isset($employee->user->userAddress->upazila_id)
                    @php
                        $upailaId = $employee->user->userAddress->upazila_id;
                        $upazila = App\Models\Upazila::find($upailaId);
                        
                    @endphp
                    {{ $upazila->name ?? '.......................................................' }}
                @else
                    .......................................................
                @endisset 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3"> Union : <span class="fw-thin" style="color: #646464">
                    @isset($employee->user->userAddress->union_id)
                    @php
                        $unionId = $employee->user->userAddress->union_id;
                        $union = App\Models\Union::find($districtId);
                        
                    @endphp
                    {{ $union->name ?? '.......................................................' }}
                @else
                    .......................................................
                @endisset 
            </div>
        </div>
        
        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3"> Village : <span class="fw-thin" style="color: #646464">
                    @isset($employee->user->userAddress->village_id)
                    @php
                        $villageId = $employee->user->userAddress->village_id;
                        $village = App\Models\Village::find($villageId);
                        
                    @endphp
                    {{ $village->name ?? '.......................................................' }}
                @else
                    .......................................................
                @endisset 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Address : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userAddress->address ?? '.......................................................' }}</span></h5> 

            </div>
        </div>

        <div class="row mt-5">
            <h5 class="text-center pb-2 fw-bold" style="border-bottom: 1px solid rgb(158, 152, 152)">Family Details</h5>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Father's Name : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userFamily->father_name ?? '.......................................................' }}</span></h5> 

            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Father's Mobile : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userFamily->father_mobile ?? '.......................................................' }}</span></h5> 

            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Mother's Name : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userFamily->mother_name ?? '.......................................................' }}</span></h5> 

            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Mother's Mobile : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userFamily->mother_mobile ?? '.......................................................' }}</span></h5> 

            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Spouse Name : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userFamily->spouse_name ?? '.......................................................' }}</span></h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Spouse Mobile : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userFamily->spouse_contact ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row mt-5">
            <h5 class="text-center pb-2 fw-bold" style="border-bottom: 1px solid rgb(158, 152, 152)">Transaction Information</h5>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Bank Name : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userTransaction->bank ?? '.......................................................' }}</span></h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Branch Name : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userTransaction->branch ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Account Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userTransaction->bank_account_number ?? '.......................................................' }}</span></h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Account Holder Name : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userTransaction->bank_details ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3"> Mobile Bank Name : <span class="fw-thin" style="color: #646464">
                    @isset($employee->user->userTransaction->mobile_bank_id)
                        @php
                            $mobileBankId = $employee->user->userTransaction->mobile_bank_id;
                            $mobileBank = App\Models\UserTransaction::find($mobileBankId);
                            
                        @endphp
                        {{ $mobileBank->name ?? '.......................................................' }}
                        @else
                            .......................................................
                    @endisset
                </h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Mobile Bank Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userTransaction->mobile_bank_account_number ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row mt-5">
            <h5 class="text-center pb-2 fw-bold mt-5 pt-4" style="border-bottom: 1px solid rgb(158, 152, 152); margin-top:10px">Identification Information</h5>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">NID Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userId->nid_number ?? '.......................................................' }}</span></h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Birth Certificate Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userId->birth_cirtificate_number ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">NID Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userId->nid_number ?? '.......................................................' }}</span></h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Birth Certificate Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userId->birth_cirtificate_number ?? '.......................................................' }}</span></h5> 
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">Passport Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userId->passport_number ?? '.......................................................' }}</span></h5> 
            </div>

            <div class="col-6">
                <h5 class="fw-bold mt-3">Passport Expire Date : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userId->passport_exp_date ?? '.......................................................' }}</span></h5> 
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-6">
                <h5 class="fw-bold mt-3">TIN Number : <span class="fw-thin" style="color: #646464"> {{ $employee->user->userId->tin_number ?? '.......................................................' }}</span></h5> 
            </div>
        </div>

    
        <div class="row pt-3">
            <div class="col-12 d-flex mt-3">
                <h5 class="fw-bold mt-3 me-3">Comments/ Others : ............................................................................................................................................................................................................................. </h5>
            </div>
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-md-6">
                <h5 class="fw-bold" style="padding-right: 40px !important"> Date : {{date('Y-m-d')}}</h5>

            </div>
            <div class="col-md-6 fw-bold" style="text-align: right">
                <h5 class="fw-bold"> Signature</h5>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>