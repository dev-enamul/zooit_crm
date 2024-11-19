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
                            @if(isset($lead))
                                Lead Edit
                            @else
                                Lead Entry
                            @endif
                        </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">
                                    @if(isset($lead))
                                        Lead Edit
                                    @else
                                        Lead Entry
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
                            @if(isset($lead))
                                <form action="{{route('lead.save',$lead->id)}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                <input type="hidden" name="id" value="{{$lead->id}}">
                            @else
                                <form action="{{route('lead.save')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                                                    <option value="{{$selected_data['customer']->id}}"  selected="selected">{{$selected_data['customer']->name}} [{{$selected_data['customer']->customer_id}}]</option>
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
                                                @isset($purchase_possibilitys)
                                                    @foreach ($purchase_possibilitys as $id => $name)
                                                        <option value="{{ $id }}" {{ old('purchase_possibility', @$lead->purchase_possibility) == $id || (isset($selected_data['purchase_possibility']) && $selected_data['purchase_possibility'] == $id) ? 'selected' : '' }}>
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
                                            <label for="presentation_date" class="form-label">Presentation Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="presentation_date" id="presentation_date" required value="{{old('presentation_date', @$lead->presentation_date)}}">
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark">{{isset($lead) ? $lead->remark : old('remark')}}</textarea>
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
                    url: "{{ route('get.cold.calling.data') }}",

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
