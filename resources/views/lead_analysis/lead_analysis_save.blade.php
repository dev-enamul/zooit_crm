@extends('layouts.dashboard')
@section('title','Lead Analysis Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lead Analysis Form</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Lead Analysis form</li>
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
                            @if(isset($lead_analysis))
                                <form action="{{route('lead_analysis.save',$lead_analysis->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                <input type="hidden" name="id" value="{{$lead_analysis->id}}">
                            @else 
                                <form action="{{route('lead_analysis.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                            @endif 
                            @csrf
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="select2" search name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($selected_data['customer'])
                                                    <option value="{{ $selected_data['customer']->id }}" selected>
                                                        {{ $selected_data['customer']->name }} [{{ $selected_data['customer']->customer_id }}]
                                                    </option>
                                                @endisset
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="employee" class="form-label">Employee <span class="text-danger">*</span></label>
                                            <select class="select2" search name="employee" id="employee" required>
                                                <option value="{{Auth::user()->id}}" selected>
                                                    {{Auth::user()->name}}
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <label for="project" class="form-label">Preferred Project Name <span class="text-danger">*</span></label>
                                        <select class="form-select reset-data" name="project" id="project" required>
                                            <option data-display="Select a project *" value="">
                                                Select a Project
                                            </option>
                                            @isset($projects)
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ old('project', isset($lead_analysis) ? $lead_analysis->project_id : null) == $project->id ? 'selected' : '' }}>
                                                        {{ $project->name }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('project'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('project') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="unit" class="form-label">Preferred Unit Name <span class="text-danger">*</span></label>
                                        <select class="form-select reset-data" name="unit" id="unit" required>
                                            <option data-display="Select a unit *" value="">
                                                Select a unit
                                            </option>
                                            @isset($units)
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}" {{ old('unit', isset($lead_analysis) ? $lead_analysis->unit_id : null) == $unit->id ? 'selected' : '' }}>
                                                        {{ $unit->title }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        
                                        @if ($errors->has('unit'))
                                            <span class="text-danger" role="alert">
                                                {{ $errors->first('unit') }}
                                            </span>
                                        @endif
                                    </div> 
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="hobby" class="form-label">Hobby </label>
                                            <input type="text" name="hobby" class="form-control" id="hobby" placeholder="Hobby" value="{{ isset($lead_analysis) ? $lead_analysis->hobby : old('hobby') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="income_range" class="form-label">Income Range</label>
                                            <input type="number" name="income_range" class="form-control" id="income_range" placeholder="Income Range" value="{{ isset($lead_analysis) ? $lead_analysis->income_range : old('income_range') }}"> 
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="profession_year" class="form-label">Job/Business/Others Service Year</label> 
                                            <input type="number" name="profession_year" class="form-control" id="profession_year" placeholder="Profession Year" value="{{ isset($lead_analysis) ? $lead_analysis->profession_year : old('profession_year') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_need" class="form-label">Customer's Need</label> 
                                            <input type="text" name="customer_need" class="form-control" id="customer_need" placeholder="Customer's Need" value="{{ isset($lead_analysis) ? $lead_analysis->customer_need : old('customer_need') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tentative_amount" class="form-label">Tentative Sales Amount</label> 
                                            <input type="number" name="tentative_amount" class="form-control" id="tentative_amount" placeholder="Tentative Sales Amount" value="{{ isset($lead_analysis) ? $lead_analysis->tentative_amount : old('tentative_amount') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="facebook_id" class="form-label">Facebook Id</label> 
                                            <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook Id" value="{{ isset($lead_analysis) ? $lead_analysis->facebook_id : old('facebook_id') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer_problem" class="form-label">Customer's Problem</label> 
                                            <textarea class="form-control" id="customer_problem" rows="1" name="customer_problem" placeholder="Customer's Problem"> {{ isset($lead_analysis) ? $lead_analysis->customer_problem : old('customer_problem') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="referral" class="form-label">Referral</label> 
                                            <input type="text" name="referral" class="form-control" id="referral" placeholder="Referral" value="{{ isset($lead_analysis) ? $lead_analysis->refferal : old('refferal') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="influencer" class="form-label">Influencer</label> 
                                            <input type="text" name="influencer" class="form-control" id="influencer" placeholder="Influencer" value="{{ isset($lead_analysis) ? $lead_analysis->influencer : old('influencer') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="family_member" class="form-label">Family Member Qty</label> 
                                            <input type="number" name="family_member" class="form-control" id="family_member" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->family_member : old('family_member') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="decision_maker" class="form-label">Decision Maker</label> 
                                            <input type="text" name="decision_maker" class="form-control" id="decision_maker" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->decision_maker : old('decision_maker') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="previous_experience" class="form-label">Previous Experiance to Purchase this kind of product</label> 
                                            <input type="text" name="previous_experience" class="form-control" id="previous_experience" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->previous_experiance : old('previous_experiance') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="instant_investment" class="form-label">Instant Investment</label> 
                                            <input type="text" name="instant_investment" class="form-control" id="instant_investment" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->instant_investment : old('instant_investment') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buyer" class="form-label">Buyer</label> 
                                            <input type="text" name="buyer" class="form-control" id="buyer" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->buyer : old('buyer') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buyer" class="form-label">Area</label> 
                                            <input type="text" name="area" class="form-control" id="area" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->area : old('area') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="presentation_date" class="form-label">Presentation Date</label> 
                                            <input type="date" name="presentation_date" class="form-control" id="presentation_date" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->area : old('area') }}"> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="consumer" class="form-label">Consumer</label> 
                                            <input type="text" name="consumer" class="form-control" id="consumer" placeholder="" value="{{ isset($lead_analysis) ? $lead_analysis->consumer : old('consumer') }}"> 
                                        </div>
                                    </div> 
                                    
                                </div>
                                  
                                <div class="text-end ">
                                    <button class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
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

@section('script')  
    <script>
        $(document).ready(function() {
            $('#employee').select2({
                placeholder: "Select Employee",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.employee') }}',
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


        $(document).ready(function() { 
            $('#customer').select2({
                placeholder: "Select Customer",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.lead_analysis.customer') }}',
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
    </script> 

    <script>   
        $(document).ready(function(){
            get_customer_data();
            $('#customer').on('change', function() {
                get_customer_data();
            });
        })
      function get_customer_data(){
            var formData = {
                    customer_id: $("#customer").val()
                };  
                $.ajax({
                    type: "GET",
                    data: formData,
                    dataType: "json",
                    url: "{{ route('get.lead.data') }}",

                    success: function(data) {
                        $('#priority').val(data.priority);
                        $('#project').val(data.project_id);
                        $('#unit').val(data.unit_id); 
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    },
                });
        }
    </script>
@endsection