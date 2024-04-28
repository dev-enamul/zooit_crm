@extends('layouts.dashboard')
@section('title',$title)

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid"> 
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">
                            @if(isset($prospecting))
                                Prospecting Edit
                            @else
                                Prospecting Entry
                            @endif
                        </h4> 

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">
                                    @if(isset($prospecting))
                                        Prospecting Edit
                                    @else
                                        Prospecting Entry
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
                            @if(isset($prospecting))
                                <form action="{{route('prospecting.save',$prospecting->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                                <input type="hidden" name="id" value="{{$prospecting->id}}">
                            @else 
                                <form action="{{route('prospecting.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate> 
                            @endif 
                                @csrf
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="select2" search name="customer" id="customer">
                                                @if (isset($selected_data['customer']) && $selected_data['customer'] != null)
                                                    <option value="{{$selected_data['customer']->id}}"  selected="selected">{{$selected_data['customer']->name}} [{{$selected_data['customer']->customer_id}}]</option>
                                                @endif 
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
                                                <option value="{{auth()->user()->id}}" selected="selected">{{Auth::user()->name}}</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="media" class="form-label">Prospecting Media<span class="text-danger">*</span></label>
                                            <select class="select2" name="media" id="media" required>
                                                <option value="">Select Media</option>
                                                @isset($prospectingMedias)
                                                    @foreach ($prospectingMedias as $id => $name)
                                                        <option value="{{ $id }}" {{ old('media', isset($prospecting) ? $prospecting->media : null) == $id || (isset($selected_data['media']) && $selected_data['media'] == $id) ? 'selected' : '' }}>
                                                            {{ $name }}
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
                                            <label for="priority" class="form-label">Priority<span class="text-danger">*</span></label>
                                            <select class="select2" name="priority" id="priority" required>
                                                @isset($priorities)
                                                    @foreach ($priorities as $id => $name)
                                                        <option value="{{ $id }}" {{ old('priority', isset($prospecting) ? $prospecting->priority : null) == $id || (isset($selected_data['priority']) && $selected_data['priority'] == $id) ? 'selected' : '' }}>
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                @endisset
                                            </select> 
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3" name="remark">{{isset($prospecting) ? $prospecting->remark : old('remark')}}</textarea>
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
            $('#customer').select2({
                placeholder: "Select Customer",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.prospecting.customer') }}',
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
@endsection