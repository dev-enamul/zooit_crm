@extends('layouts.dashboard')
@section('title','Presentation Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Presentation
                            @if(isset($presentation))
                                Edit
                            @else
                                Entry
                            @endif
                        </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Presentation
                                    @if(isset($presentation))
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
                            @if(isset($presentation))
                                <form action="{{route('presentation.save',$presentation->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input type="hidden" name="id" value="{{$presentation->id}}">
                            @else
                                <form action="{{route('presentation.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @endif
                                @csrf
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="customer" class="form-label">Customer <span class="text-danger">*</span></label>
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
                                            <label for="purchase_possibility" class="form-label">Purchase Possibility<span class="text-danger">*</span></label>
                                            <select class="select2" name="purchase_possibility" id="purchase_possibility" required>
                                                @isset($purchase_possibilitys)
                                                    @foreach ($purchase_possibilitys as $id => $name)
                                                        <option value="{{ $id }}" {{ old('purchase_possibility', isset($presentation) ? $presentation->purchase_possibility : null) == $id || (isset($selected_data['purchase_possibility']) && $selected_data['purchase_possibility'] == $id) ? 'selected' : '' }}>
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
                                            <label for="followup_date" class="form-label">Followup Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="followup_date" id="followup_date" required value="{{old('followup_date', @$presentation->followup_date)}}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark">{{isset($presentation) ? $presentation->remark : old('remark')}}</textarea>
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
@endsection

@section('script')

   

    <script>
        $(document).ready(function() {
            $('#customer').select2({
                placeholder: "Select Customer",
                allowClear: true,
                ajax: {
                    url: '{{ route('select2.presentation.customer') }}',
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            term: params.term
                        }
                        return query;
                    },
                    success: function(data) { 
                    }
                }
            });
        });
    </script>

    
@endsection
