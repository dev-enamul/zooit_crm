@extends('layouts.dashboard')
@section('title',$title)
 @section('style')
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{asset('assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" /> --}}
 @endsection
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$title}}</h4>

                        <div class="page-title-right">
                            <div class="btn-group flex-wrap mb-2">
                                <button class="btn btn-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
                                    <span><i class="fas fa-filter"></i> Filter</span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-box">
                                {{ $dataTable->table(['class' => 'table table-hover table-bordered table-striped dt-responsive nowrap fs-10']) }}
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
</div>


<div class="offcanvas offcanvas-end" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Select Filter Item</h5>
        <button class="btn btn-label-danger btn-icon" data-bs-dismiss="offcanvas">
            <i class="fa fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="" method="get">
            <div class="row">  
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="employee" class="form-label">Employee</label>
                        <select class="select2" search id="employee" name="employee">
                            <option value = "{{$employee->id}}" selected="selected">{{$employee->name}} [{{$employee->user_id}}]</option>
                        </select>
                    </div>
                </div>  

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="service" class="form-label">Employee</label>
                        <select class="select2" id="service" name="service">
                            @foreach ($services as $service)
                                <option value = "{{$service->id}}">{{$service->service}} </option>
                            @endforeach 
                        </select>
                    </div>
                </div>  

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="date_range" class="form-label">Next Followup Date</label>
                        <input class="form-control" start="{{$start_date}}" end="{{$end_date}}" id="date_range" name="date" default="This Month" type="text" value="" />
                    </div>
                </div>  
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
@include('includes._send_mail_modal')
@endsection
@section('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script>
{{-- <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')}}"></script> --}}
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}

<script>
    getDateRange('date_range');
    $(document).ready(function() {
           $('#employee').select2({
               placeholder: "Select Employee",
               allowClear: true,
               dropdownParent: $('#offcanvas'),
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
        $('body').on('click', '.copy-phone', function() {
            var phone = $(this).data('phone');
             
            var tempInput = $('<input>');
            $('body').append(tempInput);
            tempInput.val(phone).select();
            document.execCommand('copy');
            tempInput.remove();
 
            Toast.fire({ icon: "success", title: 'Phone number copied to clipboard!' });  
        });
    });

    function openSendMailModalCustomer(userId, $name='') {
        const toField = $('#to_modal');
        const ccField = $('#cc_modal');
        const subjectField = $('#subject_modal');
        const messageField = $('#message_modal');
        const modal = $('#send-mail-modal');
        const mailForm = $('#send-mail-form');

        // Clear previous data
        mailForm.find('input[name="invoice_ids[]"]').remove();
        toField.empty().trigger('change');
        ccField.empty().trigger('change');
        subjectField.val('Interview Invitation – MERN Stack Developer Intern');
        messageField.val(`Dear ${name},

We have reviewed your CV and are pleased to invite you for an interview for the MERN Stack Developer Intern position. 

📍 Address: 24/A-1, A-2 Bosila Road, Mohammadpur, Dhaka-1207
🗺️ Google Map: https://maps.app.goo.gl/tiBpS5kD9jJKgDdX9

🕙 Time: 10:00 AM, [Insert Date]
🆔 Interview ID: ${userId} (Please remember this ID for a smooth interview process)`);


        // Fetch contacts via AJAX
        $.ajax({
            url: `/users/${userId}/contacts`,
            type: 'GET',
            beforeSend: function() {
                // You can add a loading spinner here
            },
            success: function(emails) {
                toField.empty();
                ccField.empty();

                if (emails && emails.length > 0) {
                    emails.forEach(function(email) {
                        toField.append(new Option(email, email, false, false));
                        ccField.append(new Option(email, email, false, false));
                    });

                    toField.val([emails[0]]).trigger('change');
                    if (emails.length > 1) {
                        ccField.val(emails.slice(1)).trigger('change');
                    }
                }

                modal.modal('show');
            },
            error: function() {
                alert('Failed to load user contacts.');
            }
        });
    }

    $(document).ready(function() { 
        const toField = $('#to_modal');
        const ccField = $('#cc_modal');

        $('.select2-tags-modal').select2({
            tags: true,
            tokenSeparators: [ ',', ' ' ],
            dropdownParent: $('#send-mail-modal')
        });

        toField.on('change', function () {
            let toValues = $(this).val() || [];
            let ccValues = ccField.val() || [];
            let newCcValues = ccValues.filter(v => !toValues.includes(v));

            if (newCcValues.length < ccValues.length) {
                ccField.val(newCcValues).trigger('change');
            }
        });

        ccField.on('change', function () {
            let ccValues = $(this).val() || [];
            let toValues = toField.val() || [];
            let newToValues = toValues.filter(v => !ccValues.includes(v));

            if (newToValues.length < toValues.length) {
                toField.val(newToValues).trigger('change');
            }
        });
    });
</script>
@endsection


