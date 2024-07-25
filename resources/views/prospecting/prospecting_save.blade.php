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
                                            <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
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
                                            <label for="purchase_possibility" class="form-label">Purchase Possibility<span class="text-danger">*</span></label>
                                            <select class="select2" search name="purchase_possibility" id="purchase_possibility" required>
                                                @isset($priorities)
                                                    @foreach ($priorities as $id => $name)
                                                        <option value="{{ $id }}" {{ old('purchase_possibility', isset($prospecting) ? $prospecting->purchase_possibility : null) == $id || (isset($selected_data['purchase_possibility']) && $selected_data['purchase_possibility'] == $id) ? 'selected' : '' }}>
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
                                            <label for="cold_call_date" class="form-label">Cold Calling Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="cold_call_date" id="cold_call_date" required value="{{old('cold_call_date', @$prospecting->cold_call_date)}}">
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
