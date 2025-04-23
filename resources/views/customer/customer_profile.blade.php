@extends('layouts.dashboard')
@section('title',"Profile")
@section('content')
<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('customer.includes.customer_sidebar')
                </div>
                @php
                    $customer_id = $customer->customer_id;
                    if($customer_id==null){
                        $customer_id = $customer->visitor_id;
                    }
                @endphp 
                <div class="col-md-9">   
                    @include('customer.includes.customer_menu')  
                    <div class="card overflow-hidden"> 
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">{{$customer_id}}</h4>
                                <div>
                                    <button class="btn btn-primary  mx-1 btn-md">
                                        <a href="{{route('rejection.create', ['customer' => $customer->id])}}" class="text-white" type="submit">
                                            Sales
                                        </a> 
                                    </button>
                                    <button class="btn btn-danger  mx-1 btn-md">
                                        <a href="{{route('rejection.create', ['customer' => $customer->id])}}" class="text-white" type="submit">
                                            Reject
                                        </a> 
                                    </button> 
                                </div>
                            </div>  
                            <hr>
                            <div class="timeline timeline-zigzag">

                                {{-- Customer  --}}
                                 {{-- @if (isset($customer) && $customer != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                                <p class="m-0 bold-lg">Join by {{@$customer->reference->name}} [{{@$customer->reference->user_id}}]</p>
                                                <p class="m-0 fs-10">Created At: {{get_date($customer->created_at,'j M, Y g:i A')}}</p> 
                                                
                                        </div>
                                    </div>
                                 @endif --}}
                                
                                

                                @if (isset($communication['follow_up']) && count($communication['follow_up'])>0)
                                    @foreach ($communication['follow_up'] as $follwoup)
                                        <div class="timeline-item">
                                            <div class="timeline-pin">
                                                <i class="marker marker-circle text-info"></i>
                                            </div>
                                            <div class="timeline-content"> 
                                                <p class="m-0 bold-lg">Follow Up by {{$follwoup->employee->name??"-"}}</p>
                                                    <p class="m-0 fs-10">Created At: {{get_date(@$follwoup->created_at,'j M, Y g:i A')}}</p>  
                                                    {{$follwoup->remark}}  <br>
                                                    <span class="badge badge-secondary mb-1">#Possibility: {{$follwoup->purchase_possibility??0}}%</span>
                                                    <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $follwoup->negotiation_amount??0)}}</span> 
                                                    <span class="badge badge-secondary mb-1">#Next Followup: {{get_date( $follwoup->next_followup_date??now())}}%</span>
                                                    
                                            </div>
                                        </div>
                                    @endforeach 
                                @endif   

                                @if (isset($communication['rejection']) && $communication['rejection'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Regotiation by {{$communication['rejection']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['rejection']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['rejection']->remark}} 
                                        </div>
                                    </div>
                                @endif  

                                @if (isset($communication['salse']) && $communication['salse'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-danger"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Salse by {{$communication['salse']->employee->name??"-"}}</p>
                                            <p class="m-0 fs-10">{{get_date($communication['salse']->created_at??date('y-m-d'))}}</p>
                                            {{$communication['salse']->remark??""}}  
                                            <span class="badge badge-secondary mb-1">#project: {{$communication['salse']->project->name??"-"}} </span>
                                            <span class="badge badge-secondary m-1">#unit: {{$communication['salse']->unit->title??"-"}}</span>
                                            <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['salse']->regular_amount??0)}}</span>
                                            <span class="badge badge-secondary mb-1">#Sold Amount: {{get_price( $communication['salse']->sold_value??0)}}</span>
                                        </div>
                                    </div>
                                @endif    

                                @if (isset($communication['salse_return']) && $communication['salse_return'] != null)
                                    <div class="timeline-item">
                                        <div class="timeline-pin">
                                            <i class="marker marker-circle text-info"></i>
                                        </div>
                                        <div class="timeline-content"> 
                                            <p class="m-0 bold-lg">Salse Return by {{$communication['salse_return']->employee->name??"-"}}</p>
                                                <p class="m-0 fs-10">{{get_date($communication['salse_return']->created_at??date('y-m-d'))}}</p>
                                                {{$communication['salse_return']->remark}} 

                                                <span class="badge badge-secondary mb-1">#project: {{$communication['salse_return']->project->name??"-"}} </span>
                                                <span class="badge badge-secondary m-1">#unit: {{$communication['salse_return']->unit->title??"-"}}</span>
                                                <span class="badge badge-secondary mb-1">#Regular Amount: {{get_price( $communication['salse_return']->regular_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Sold Amount: {{get_price( $communication['salse_return']->sold_value??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Total Deposit: {{get_price( $communication['salse_return']->total_deposit??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Deduction: {{get_price( $communication['salse_return']->deduction_amount??0)}}</span>
                                                <span class="badge badge-secondary mb-1">#Return: {{get_price( $communication['salse_return']->sales_return_amount??0)}}</span>

                                        </div>
                                    </div>
                                @endif  
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header"> 
                                <h3 class="card-title">Contacts Information</h3>
                                <div class="card-addon">
                                    <button class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#create_modal">
                                        <span><i class="mdi mdi-clipboard-plus-outline"></i> Add New</span>
                                    </button> 
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="rich-list rich-list-bordered rich-list-action">
                                    @foreach ($contacts as $contact)
                                    <div class="d-flex justify-content-between">
                                        <h5>{{@$contact->designation->title}}</h5>
                                        <div>
                                            <a href="javascript:void(0)" class="update_contact btn btn-primary" data-contact="{{ json_encode($contact) }}"> 
                                                <i class="mdi mdi-pencil align-middle"></i>
                                            </a> 
    
                                            <a href="{{route('contact.delete',$contact->id)}}" class="btn btn-danger"> 
                                                <i class="mdi mdi-delete align-middle"></i> 
                                            </a>
                                        </div>
                                    </div>

                                    <hr class="mt-1 mb-1"> 

                                    <div class="row">
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Name</b></small></p>
                                            <p class="m-0">{{$contact->name}}</p>
                                        </div> 
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Phone</b></small></p>
                                            <p class="m-0">{{$contact->phone}}</p>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Email</b></small></p>
                                            <p class="m-0">{{$contact->email??"-"}}</p>
                                        </div>  
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Gender</b></small></p>
                                            <p class="m-0">{{ \App\Enums\Gender::values()[$contact->gender] ?? '-' }}</p>
                                        </div>
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Religion</b></small></p>
                                            <p class="m-0">{{ \App\Enums\Religion::values()[$contact->religion] ?? '-' }}</p>
                                        </div>
                                        
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Date of Birth</b></small></p>
                                            <p class="m-0">{{get_date($contact->dob)}}</p>
                                        </div>  
                                        
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>WhatsApp</b></small></p>
                                            <p class="m-0">{{$contact->imo_number??"-"}}</p>
                                        </div>   
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Facebook Id</b></small></p>
                                            <p class="m-0">{{$contact->facebook_id??"-"}}</p>
                                        </div>   
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Linkedin Id</b></small></p>
                                            <p class="m-0">{{$contact->linkedin_id??"-"}}</p>
                                        </div>   
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Twiter Id</b></small></p>
                                            <p class="m-0">{{$contact->twiter_id}}</p>
                                        </div>   
                                        <div class="col-sm-4 mb-2">
                                            <p class="m-0"><small><b>Instragram Id</b></small></p>
                                            <p class="m-0">{{$contact->instragram_id??"-"}}</p>
                                        </div>   
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>   

                </div>
            </div> 
        </div> 
    </div>  
</div> 


{{-- Create Contact Modal  --}}
<div class="modal fade" id="create_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Create Contact</h5><button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
            </div> 
            <form action="{{route('contact.store')}}" method="POST">  
                @csrf  
                <input type="hidden" name="user_id" value="{{$customer->user_id}}">
                <div class="modal-body">  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="contact_name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="designation">Designation <span class="text-danger">*</span></label>
                                <select class="form-control" id="designation_id" name="designation_id">
                                    <option value="">Select Gender</option>
                                    @foreach($designations as  $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    @foreach(\App\Enums\Gender::values() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="religion">Religion</label>
                                <select class="form-control" id="religion" name="religion">
                                    <option value="">Select Religion</option>
                                    @foreach(\App\Enums\Religion::values() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="imo_number">Imo/WhatsApp</label>
                                <input type="text" class="form-control" id="imo_number" name="imo_number" placeholder="Enter WhatsApp Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="facebook">Facebook ID</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Enter Facebook ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="linkedin">LinkedIn ID</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter LinkedIn ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="twitter">Twitter ID</label>
                                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Enter Twitter ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="instagram">Instagram ID</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Enter Instagram ID">
                            </div>
                        </div>
                    </div>   
                    
                </div>
            
                <div class="modal-footer">
                    <div class="text-end">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> 
                        <button type="reset" class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 
            </form>
            
        </div>
    </div>
</div>   

 
 <!-- Update Contact Modal -->
<div class="modal fade" id="update_modal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title">Update Contact</h5>
                <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal">
                    <i class="mdi mdi-close"></i>
                </button>
            </div> 
            <form action="{{route('contact.update')}}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="id" name="id">
                
                <div class="modal-body">  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="contact_name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="designation">Designation <span class="text-danger">*</span></label>
                                <select class="form-control" id="designation_id" name="designation_id">
                                    <option value="">Select Designation</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    @foreach(\App\Enums\Gender::values() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="religion">Religion</label>
                                <select class="form-control" id="religion" name="religion">
                                    <option value="">Select Religion</option>
                                    @foreach(\App\Enums\Religion::values() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="imo_number">Imo/WhatsApp</label>
                                <input type="text" class="form-control" id="imo_number" name="imo_number" placeholder="Enter WhatsApp Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="facebook">Facebook ID</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Enter Facebook ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="linkedin">LinkedIn ID</label>
                                <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Enter LinkedIn ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="twitter">Twitter ID</label>
                                <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Enter Twitter ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="instagram">Instagram ID</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Enter Instagram ID">
                            </div>
                        </div>
                    </div>   
                </div>
            
                <div class="modal-footer">
                    <div class="text-end">
                        <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button> 
                        <button type="reset" class="btn btn-outline-danger"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div> 
                </div> 
            </form>
        </div>
    </div>
</div>



@endsection  

@section('script')
<script>
     $(document).ready(function(){
        $(document).on('click', '.update_contact', function(){
            var contact = $(this).data('contact');   

            // Populate modal fields
            $('#update_modal #id').val(contact.id);
            $('#update_modal #contact_name').val(contact.name);
            $('#update_modal #phone').val(contact.phone);
            $('#update_modal #email').val(contact.email);
            $('#update_modal #designation_id').val(contact.designation_id);
            $('#update_modal #gender').val(contact.gender);
            $('#update_modal #religion').val(contact.religion);
            $('#update_modal #dob').val(contact.dob);
            $('#update_modal #imo_number').val(contact.imo_number);
            $('#update_modal #facebook').val(contact.facebook_id);
            $('#update_modal #linkedin').val(contact.linkedin_id);
            $('#update_modal #twitter').val(contact.twiter_id);
            $('#update_modal #instagram').val(contact.instragram_id);

            // Open the modal
            $('#update_modal').modal('show');
        });
    });

</script>
@endsection

 