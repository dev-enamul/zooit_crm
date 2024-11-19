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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="company_type" class="form-label">Customer Type</label>
                                            <select class="form-select select2" name="company_type" id="company_type"> 
                                                 <option value="1">Person</option>
                                                 <option value="2" selected>Company</option>
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="find_media_id" class="form-label">How find us</label>
                                            <select class="form-select select2" search name="find_media_id" id="find_media_id"> 
                                                @foreach ($find_medias as $find_media)
                                                    <option value="{{$find_media->id}}">{{$find_media->name}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="full_name" class="form-label"><span id="company_name_label">Company Name</span><span class="text-danger">*</span></label>
                                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full name" value="{{old('full_name')}}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person_name" class="form-label">Contact Person Name </label>
                                            <input type="text" name="contact_person_name" class="form-control" id="contact_person_name" placeholder="Contact Person Name" value="{{old('contact_person_name')}}">
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
                                                    <option value="{{$designation->id}}">{{$designation->title}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" id="phone" maxlength="15" placeholder="Phone Number" value="{{ old('phone') }}" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                   

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="serivce_id" class="form-label">Service</label>
                                            <select class="form-select select2" search name="serivce_id" id="serivce_id">
                                                <option value="">Select a Service</option> 
                                                @foreach ($services as $service)
                                                    <option value="{{$service->id}}">{{$service->service}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>
 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark" placeholder="Remark">{{old('remark')}}</textarea> 
                                        </div>
                                    </div>   

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="2" name="address" placeholder="address">{{old('address')}}</textarea> 
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
                var id = $(this).val();
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
            });
  
        

            
        </script>  
    @endsection 
 