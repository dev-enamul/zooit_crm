@extends('layouts.dashboard')
@section('title',"Invoice List")
 @section('style')
    <link href="{{asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}" rel="stylesheet" type="text/css" />
    
 @endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
 
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0"> Invoice List</h4> 
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
                        <label for="status" class="form-label">Status</label>
                        <select class="select2" id="status" name="status">
                            <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All</option>
                            <option value="unpaid" {{ $status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="partial" {{ $status == 'partial' ? 'selected' : '' }}>Partial</option>
                            <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="overdue" {{ $status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                    </div>
                </div>

                {{-- <div class="col-md-12">
                    <div class="mb-3">
                        <label for="date_range" class="form-label">Date</label>
                        <input class="form-control" start="{{$start_date}}" end="{{$end_date}}" id="date_range" name="date" default="This Month" type="text" value="" />
                    </div>
                </div> --}}

                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="project" class="form-label">Employee</label>
                        <select class="select2" search id="project" name="project_id">
                            <option value = "" selected="selected">All Employee</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="offcanvas">Filter</button>
                </div>
            </div>
        </form>
        </div>
    </div> 

    <div class="modal fade" id="edit_modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h5 class="modal-title">Share Invoice </h5>
                    <button type="button" class="btn btn-sm btn-label-danger btn-icon" data-bs-dismiss="modal"><i class="mdi mdi-close"></i></button>
                </div>
    
                <div class="modal-body">
                    <form action="{{route('village.update')}}" method="post"> 
                        @csrf  
                        <label for="word_no">Invoice Link <span class="text-danger">Copy and share with your customer.</span></label>
                        <input id="invoice-link" class="form-control" type="text" value="" readonly>
                    </form>
                </div>  
    
                <div class="modal-footer">
                    <div class="text-end">
                        <a  id="prevButton"  href="" target="blank" class="btn btn-primary"><i class="fas fa-eye"></i> Preview</a>
                        <button class="btn btn-primary" id="copyLinkButton"><i class="fas fa-link"></i> Copy Link</button>
                        {{-- <a id="whatsAppButton" href="" target="blank" class="btn btn-primary"><i class="fab fa-whatsapp"></i> Send WhatsApp</a> --}}
                    </div>                     
                </div>
            </div>
        </div>
    </div>

@include('includes._send_mail_modal')

@endsection
@section('script')
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')}}"></script> 
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}

<script>
    $(document).ready(function() {  
            $('#project').select2({
                placeholder: "Select Project",
                allowClear: true,
                dropdownParent: $('#offcanvas'),
                ajax: {
                    url: '{{ route('select2.project') }}',
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

    getDateRange('date_range');
</script>

<script>
    const appName = @json(config('app.name', 'ZOOM IT'));

    function shareLink(id,phone){
        var link = "{{ route('invoice.share', ':id') }}".replace(':id', id); 
        $('#invoice-link').val(link);
        $('#prevButton').attr('href',link);
        var whatsappLink = "https://api.whatsapp.com/send/?phone=+88"+phone+"&text="+link;
        $("#whatsAppButton").attr('href',whatsappLink);
        $('#edit_modal').modal('show');
    }

    function openSendMailModal(userId, encryptedInvoiceId, invoiceDate, rawInvoiceId) {
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
        subjectField.val('');
        messageField.val('');

        // Add invoice ID to form
        mailForm.append(`<input type="hidden" name="invoice_ids[]" value="${rawInvoiceId}">`);

        // Set Subject
        const date = new Date(invoiceDate);
        const month = date.toLocaleString('default', { month: 'long' });
        const year = date.getFullYear();
        subjectField.val(`Invoice for ${month}-${year}`);

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

                var messageBody = `Dear Customer,\nWe hope you are doing well. Please find your invoice attached below \nThank you for your business.`;
                messageField.val(messageBody);

                modal.modal('show');
            },
            error: function() {
                alert('Failed to load user contacts.');
            }
        });
    }

    function openSendUnpaidInvoicesModal(userId) {
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
        subjectField.val('');
        messageField.val('');

        // Fetch both contacts and unpaid invoices
        $.when(
            $.ajax({ url: `/users/${userId}/contacts` }),
            $.ajax({ url: `/customers/${userId}/unpaid-invoices` })
        ).done(function(contactsResponse, invoicesResponse) {
            const invoices = invoicesResponse[0];
            const emails = contactsResponse[0];

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

            // Add invoice IDs to form
            if (invoices && invoices.length > 0) {
                invoices.forEach(function(invoice) {
                    mailForm.append(`<input type="hidden" name="invoice_ids[]" value="${invoice.id}">`);
                });
            }

            // Generate Subject from invoice months
            let subjectMonths = '';
            if (invoices && invoices.length > 0) {
                const monthYearSet = new Set();
                invoices.forEach(function(invoice) {
                    const d = new Date(invoice.due_date);
                    const month = d.toLocaleString('default', { month: 'long' });
                    const year = d.getFullYear();
                    monthYearSet.add(`${month}-${year}`);
                });
                subjectMonths = Array.from(monthYearSet).join(', ');
            } else {
                const d = new Date();
                const month = d.toLocaleString('default', { month: 'long' });
                const year = d.getFullYear();
                subjectMonths = `${month}-${year}`;
            }
            subjectField.val(`Your Unpaid Invoices for ${subjectMonths}`);


            // Build message body from unpaid invoices
            let messageBody = '';
            if (invoices && invoices.length > 0) {
                const totalAmount = invoices.reduce((sum, invoice) => sum + parseFloat(invoice.due_amount), 0);
                const invoiceCount = invoices.length;
                messageBody = `Dear Customer,\nThis is a friendly reminder regarding ${invoiceCount} unpaid invoice(s) with a total amount of ${totalAmount.toFixed(2)}.\n\nPlease find the details below.`;
            } else {
                 messageBody = `Dear Customer, \nGood news! You currently have no pending invoices. 🎉  \nThank you for staying up to date — we truly appreciate your timely payments and continued support!`;
            }
            messageField.val(messageBody);

            modal.modal('show');

        }).fail(function() {
            alert('Failed to load customer data. Please try again.');
        });
    }


    $(document).ready(function() { 
        $('#copyLinkButton').click(function() {
            var copyText = $('#invoice-link');
            copyText.select();
            copyText[0].setSelectionRange(0, 99999);  
            document.execCommand('copy'); 
            Toast.fire({ icon: "success", title: 'Invoice link copied to clipboard!' });  
        });

        const toField = $('#to_modal');
        const ccField = $('#cc_modal');

        $('.select2-tags-modal').select2({
            tags: true,
            tokenSeparators: [ ',' ],
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