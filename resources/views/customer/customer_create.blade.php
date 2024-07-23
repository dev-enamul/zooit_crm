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
                                    <h6 class="text-white bg-primary p-2"> <i class="mdi mdi-check-all"></i> Primary Information</h6>  

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
                                            <label for="profile_image" class="form-label"> <span id="image_label">Logo</span> <span class="text-danger">[jpeg, jpg, png, gif | Max : 2MB ]</span></label> 
                                            <input type="file" name="profile_image" class="form-control" id="profile_image" > 
                                        </div>
                                    </div>    

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="project_id" class="form-label">Product</label>
                                            <select class="form-select select2" search name="project_id" id="project_id">
                                                <option value="">Select a Project</option> 
                                                @foreach ($projects as $project)
                                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                                @endforeach
                                            </select>  
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sub_project" class="form-label">Sub Product </label>
                                            <select class="form-select select2" search name="sub_project" id="sub_project">
                                                <option value="">Select a Project</option>  
                                            </select>  
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark" placeholder="Remark">{{old('remark')}}</textarea> 
                                        </div>
                                    </div> 

                                    <h6 class="text-white bg-primary p-2"> <i class="mdi mdi-check-all"></i> Contact Information</h6>  

                                     
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                           <input type="email" name="email" class="form-control" id="email" placeholder="Email ID" value="{{ old('email') }}"> 
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
                                            <label for="linkedin_id" class="form-label">Website / Linkedin</label>
                                            <input type="text" name="linkedin_id" class="form-control" id="linkedin_id" placeholder="Linkedin ID" value="{{old('linkedin_id')}}">  
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_id" class="form-label">Facebook ID</label>
                                            <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID" value="{{old('facebook_id')}}">  
                                        </div>
                                    </div>  

                                    <h6 class="text-white bg-primary p-2"> <i class="mdi mdi-check-all"></i> Address</h6> 
                                    @include('common.area', [
                                        'div'       => 'col-md-6',
                                        'mb'        => 'mb-3',
                                        'visible'   => ['division', 'district', 'upazila','union','village'],
                                        'required'  => [],
                                        'selected'  => $selected ?? null,
                                    ]) 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" rows="1" name="address" placeholder="Address">{{old('address')}}</textarea> 
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
            $(document).ready(function() { 
                $('#reporting_user').select2({
                    placeholder: "Select Employee",
                    allowClear: true,
                    ajax: {
                        url: '{{ route('select2.employee.freelancer') }}',
                        dataType: 'json',
                        data: function (params) {
                            var query = {
                                term: params.term
                            }
                            return query;
                        }
                    }
                });
            }); 


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

            $("#project_id").on("change", function() { 
                var formData = {
                    id: $(this).val(),
                }; 
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('project-get-subproject') }}",

                    success: function(data) {
                        $("#sub_project").empty().append(
                            $("<option>", {
                                value: '',
                                text: 'Select Sub Project',
                            })
                        );

                        console.log(data);
                        if (data.length) {
                            $.each(data, function(i, sub_project) {
                                $("#sub_project").append(
                                    $("<option>", {
                                        value: sub_project.id,
                                        text: sub_project.name,
                                    })
                                );
                            });
                        }

                        $('#sub_project').trigger('change');

                       
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
            });

            
        </script>  
    @endsection 
 