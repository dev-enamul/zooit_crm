@extends('layouts.dashboard')
@section('title','Project Visit & Presentation Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0">Project visit
                            @if(isset($visit))
                                Edit
                            @else
                                Entry
                            @endif
                        </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Project Visit
                                    @if(isset($visit))
                                        Edit
                                    @else
                                        Entry
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
                            @if(isset($visit))
                                <form action="{{route('visit.save',$visit->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input type="hidden" name="id" value="{{$visit->id}}">
                            @else
                                <form action="{{route('visit.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @endif
                                @csrf
                                <div class="row">
                                    @if (isset($selected_data['customer']) && $selected_data['customer'] != null)
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Reference</label>
                                                <input type="text" value="{{ $selected_data['customer']->reference->name??'' }}" disabled class="form-control"  >
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="visitor" class="form-label">Visitor <span class="text-danger">*</span></label>
                                            <select id="visitor" class="select2" tags search name="visitor[]" multiple required>
                                                @foreach ($selected_data['visitor'] as $visitor)
                                                    <option value="{{ $visitor->id }}" selected>
                                                        {{ $visitor->name }} [{{ $visitor->user_id }}]
                                                    </option>
                                                    
                                                @endforeach
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
                                               <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }} ({{ auth()->user()->user_id }})</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Project <span class="text-danger">*</span></label>
                                            <select id="projects" class="select2" tags search name="projects[]" multiple required>
                                                @isset($projects)
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->name }}" {{ in_array($project->name, old('projects', isset($visit) ? json_decode($visit->projects) : [])) ? 'selected' : '' }}>
                                                            {{ $project->name }}
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
                                            <label for="customer_id" class="form-label">Negotiation Person <span class="text-danger">*</span></label>
                                            <select id="customer_id" class="select2" search name="customer_id" required>

                                                @isset($selected_data['customer'])
                                                    <option value="{{ $selected_data['customer']->id }}" selected>
                                                        {{ $selected_data['customer']->name }} ({{ $selected_data['customer']->customer_id }})
                                                    </option>
                                                @endisset
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3" name="remark">{{isset($visit) ? $visit->remark : old('remark')}}</textarea>
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
    @can('data-input-for-others')
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
        </script>
    @endcan

<script>
    $(document).ready(function() {
        $('#customer_id').select2({
            placeholder: "Select Customer",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.presentation_analysis.customer') }}',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        term: params.term
                    }
                    return query;
                },
                success: function(data) {
                    get_customer_data();
                }
            }
        });
    });

    $(document).ready(function() {
        $('#visitor').select2({
            placeholder: "Select Customer",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.visitor') }}',
                dataType: 'json',
                data: function (params) {
                    var query = {
                        term: params.term
                    }
                    return query;
                },
                success: function(data) {
                    get_customer_data();
                }
            }
        });
    });
</script>
@endsection
