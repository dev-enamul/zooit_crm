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
                            <form action="{{route('customer.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                @csrf 
                                @if (isset($user)  && !empty($user))
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                @endif                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_type" class="form-label">Customer Type</label>
                                            <select class="form-select select2" name="company_type" id="company_type"> 
                                                <option {{old("company_type",@$user->type)==2?"selected":""}} value="2">Company</option>
                                                 <option {{old("company_type",@$user->type)==1?"selected":""}} value="1">Person</option> 
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="find_media_id" class="form-label">How find us</label>
                                            <select class="form-select select2" search name="find_media_id" id="find_media_id"> 
                                                @foreach ($find_medias as $find_media)
                                                    <option {{old("find_media_id",@$user->find_media_id)==$find_media->id?"selected":""}} value="{{$find_media->id}}">{{$find_media->name}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label"><span id="company_name_label">Company Name</span><span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" value="{{old("full_name",@$user->user->name)}}" placeholder="Full name" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_name" class="form-label">Contact Person Name </label>
                                            <input type="text" name="contact_person_name" value="{{old("contact_person_name",@$user->user->userContact->name)}}" class="form-control" id="contact_person_name" placeholder="Contact Person Name">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="designation_id" class="form-label">Contact Person Designation</label>
                                            <select class="form-select select2" search name="designation_id" id="designation_id"> 
                                                @foreach ($designations as $designation)
                                                    <option {{old("designation_id",@$user->user->userContact->designation_id)==$designation->id?"selected":""}} value="{{$designation->id}}">{{$designation->title}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" id="phone" maxlength="25" placeholder="Phone Number" value="{{ old('phone',@$user->user->phone) }}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="text" name="email" class="form-control" id="email" maxlength="15" placeholder="Email address" value="{{ old('email') }}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="service_id" class="form-label">Service</label>
                                            <select class="form-select select2" search name="service_id" id="service_id">
                                                <option value="">Select a Service</option> 
                                                @foreach ($services as $service)
                                                    <option {{old("service_id",@$user->service_id)==$service->id?"selected":""}} value="{{$service->id}}">{{$service->service}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark" placeholder="Remark">{{old('remark',@$user->remark)}}</textarea> 
                                        </div>
                                    </div>   

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="1" name="address" placeholder="address">{{old('address',@$user->user->userAddress->address)}}</textarea> 
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
  @include('includes.footer')

</div>
@endsection  
 
    @section('script2')  
        <script>  
            $("#company_type").on("change",function(){
                changeType();
            }); 

            $(document).ready(function(){
                changeType();
            })

            function changeType(){
                var id = $("#company_type").val();
                if(id==1){
                    $('#company_name_label').text("Full Name");
                    $('#full_name').attr("placeholder","Full Name");
                    $('#contact_person_name').closest('.col-md-6').hide();
                    $('#contact_person_name').val('').trigger('change')
                    $('#designation_id').closest('.col-md-6').hide();
                    $('#designation_id').val('').trigger('change')
                    $("#image_label").text("Profile Photo"); 
                    
                }else{
                    $('#company_name_label').text("Company Name");
                    $('#full_name').attr("placeholder","Company Name");
                    $('#contact_person_name').closest('.col-md-6').show();
                    $('#designation_id').closest('.col-md-6').show();
                    $("#image_label").text("Logo"); 
                }
            }
  
        

            
        </script>  
    @endsection 
 