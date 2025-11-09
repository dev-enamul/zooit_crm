@extends('layouts.dashboard')
@section('title','Salse Entry')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sales Entry</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Sales Entry</li>
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
                            <form class="needs-validation" action="{{route('salse.store')}}" novalidate method="post">
                                @csrf
                                <div class="row">  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="freelancer" class="form-label d-flex justify-content-between align-items-center">
                                                <div>
                                                    Customer <span class="text-danger">*</span>
                                                </div>
                                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCustomerModal">+</button>
                                            </label>
                                            <select class="select2" search name="customer" id="customer" required>
                                                <option data-display="Select a coustomer *" value="">
                                                    Select a customer
                                                </option>
                                                @isset($selected_data['customer'])
                                                    <option value="{{ $selected_data['customer']->id }}" selected>
                                                        {{ $selected_data['customer']->user->name }} [{{ $selected_data['customer']->visitor_id }}]
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
                                            <label for="title" class="form-label">Project Title</label>
                                            <input class="form-control" type="text" name="title" id="title" value="{{old('title',@$salse->title)}}" placeholder="Project Title">
                                        </div>
                                    </div>   

                                     <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="currency" class="form-label">Currency <span class="text-danger">*</span></label>
                                            <select class="select2" name="currency" id="currency" required> 
                                                <option value="bdt" {{ old('currency', $selected_data['currency'] ?? '') == 'bdt' ? 'selected' : '' }}>BDT</option>
                                                <option value="usd" {{ old('currency', $selected_data['currency'] ?? '') == 'usd' ? 'selected' : '' }}>USD</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label"><span id="company_name_label">Price</span><span class="text-danger">*</span></label>
                                            <input type="number" name="price" class="form-control" id="price" value="{{old("price",@$salse->price)}}" placeholder="Enter Price" required>
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="submit_date" class="form-label"><span id="submit_date">Submit Date</span><span class="text-danger">*</span></label>
                                            <input type="date" name="submit_date" class="form-control" id="submit_date" value="{{old("submit_date",@$salse->submit_date)}}" placeholder="Select Date" required>
                                            
                                            <div class="invalid-feedback">
                                                This field is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="1" name="remark" placeholder="Remark">{{old('remark',@$user->remark)}}</textarea> 
                                        </div>
                                    </div>  



                                </div> 
                                <div class="text-end ">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button> <button type="button" class="btn btn-outline-danger refresh_btn"><i class="mdi mdi-refresh"></i> Reset</button>
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

<!-- Customer Create Modal -->
<div class="modal fade" id="createCustomerModal" tabindex="-1" aria-labelledby="createCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCustomerModalLabel">Create New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="customerCreateForm" action="{{ route('customer.ajaxStore') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="full_name_modal" class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" name="full_name" class="form-control" id="full_name_modal" placeholder="Full name" required>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="phone_modal" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" id="phone_modal" placeholder="Phone Number" required>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email_modal" class="form-label">Email Address </label>
                                <input type="text" name="email" class="form-control" id="email_modal" placeholder="Email address">
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="service_id_modal" class="form-label">Service</label>
                                <select class="form-select select2" search name="service_id" id="service_id_modal">
                                    <option value="">Select a Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{$service->id}}">{{$service->service}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="remark_modal" class="form-label">Remark</label>
                                <textarea class="form-control" id="remark_modal" rows="1" name="remark" placeholder="Remark"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('script')
@section('script')
<script>
    $(document).ready(function() {
        // Initialize select2 for the main customer dropdown
        $('#customer').select2({
            placeholder: "Select Customer",
            allowClear: true,
            ajax: {
                url: '{{ route('select2.followup.customer') }}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Initialize select2 for modal dropdowns (only service_id_modal remains)
        $('#service_id_modal').select2({
            dropdownParent: $('#createCustomerModal') // Important for modals
        });

        // Handle modal form submission
        $('#customerCreateForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(form[0]); // Use FormData for file uploads (if any) and general form data

            // Clear previous errors
            form.find('.invalid-feedback').text('');
            form.find('.is-invalid').removeClass('is-invalid');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false, // Important for FormData
                contentType: false, // Important for FormData
                success: function(response) {
                    if (response.success) {
                        // Add new customer to the main select2 dropdown
                        var newOption = new Option(response.customer.name, response.customer.id, true, true);
                        $('#customer').append(newOption).trigger('change');

                        // Close the modal
                        $('#createCustomerModal').modal('hide');

                        // Reset the form
                        form[0].reset();
                        // Reset select2 for modal dropdowns
                        $('#service_id_modal').val(null).trigger('change');

                        toastr.success(response.success); // Assuming toastr is available for notifications
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) { // Validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            var input = form.find('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').text(value[0]);
                        });
                        toastr.error('Validation failed. Please check the form.');
                    } else {
                        toastr.error('An error occurred: ' + (xhr.responseJSON.error || 'Please try again.'));
                    }
                }
            });
        });

        // Reset form when modal is hidden
        $('#createCustomerModal').on('hidden.bs.modal', function () {
            var form = $('#customerCreateForm');
            form[0].reset();
            form.find('.invalid-feedback').text('');
            form.find('.is-invalid').removeClass('is-invalid');
            $('#service_id_modal').val(null).trigger('change');
        });
    });
</script>
@endsection
