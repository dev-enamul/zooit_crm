@extends('layouts.dashboard')
@section('title',"Wallet")  
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
           
            <div class="row"> 
                <div class="col-md-3"> 
                    @include('includes.profile_menu')
                </div> 
                <div class="col-md-9">  
                    <div class="card">
                        <div class="card-body">
                            <form class="form" action="{{route('profile.document.store')}}" enctype="multipart/form-data" method="post">
                                @csrf 
                                
                                <div class="row">
                                    <div class="col-md-6 mt-3"> 
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <label for="tin_number" class="form-label">File Title</label>
                                        <input type="text" placeholder="Enter file title" class="form-control" name="title" id="">
                                    </div> 
                                    <div class="col-md-6 mt-3">
                                        <label for="tin_number" class="form-label">File</label>
                                        <input type="file" class="form-control" name="file" id="">
                                    </div> 
                                    <div class="col-md-2 mt-3"> 
                                        <button type="submit" class="btn btn-secondary">Add File</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                    <div class="accordion" id="accordionExample-Pricing">
                        @foreach ($datas as $data)
                            @php
                                $filePath = 'storage/' . $data->file;
                                $fileExtension = pathinfo(storage_path('app/public/' . $data->file), PATHINFO_EXTENSION);
                                $isImage = in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']);
                            @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-Pricing-{{ $loop->index }}" aria-expanded="true" aria-controls="collapseOne-Pricing-{{ $loop->index }}">
                                        <i class="fas {{ $isImage ? 'fa-file-image' : 'fa-file' }} text-primary"></i>  &nbsp; {{$data->title}}  
                                    </button>
                                </h2>
                                <div id="collapseOne-Pricing-{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample-Pricing">
                                    <div class="accordion-body">
                                        @if ($isImage)
                                            <img src="{{ asset($filePath) }}" alt="{{$data->title}}" style="width: 100%;">
                                        @elseif ($fileExtension === 'pdf')
                                            <embed
                                                src="{{ asset($filePath) }}"
                                                frameBorder="0"
                                                scrolling="auto"
                                                width="100%"
                                                height="600px"
                                            ></embed>
                                        @else
                                            <p>Unsupported file type.</p>
                                        @endif
                    
                                        <div style="margin-top: 10px;">
                                            <a href="{{ asset($filePath) }}" download class="btn btn-primary"> 
                                                <i class="fas fa-download"></i> Download {{$data->title}}
                                            </a>
                                            <button type="button" class="btn btn-info" onclick="sendDocument('{{ $user->id }}', '{{ $data->file }}', '{{ $data->title }}')">
                                                <i class="fas fa-paper-plane"></i> Send
                                            </button>
                                            <button type="button" class="btn btn-danger" onclick="deleteItem('{{ route('profile.document.delete', encrypt($data->id)) }}')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                </div>
            </div> 
        </div> 
    </div>  

    @include('includes._send_mail_modal')
    @include('includes.footer')
</div> 
@endsection 
 
@section('script')
<script>
    function sendDocument(userId, filePath, fileTitle) {
        const toField = $("#to_modal");
        const ccField = $("#cc_modal");
        const subjectField = $("#subject_modal");
        const messageField = $("#message_modal");
        const modal = $("#send-mail-modal");
        const mailForm = $("#send-mail-form");
        
        // Clear previous data
        mailForm.find('input[name="invoice_ids[]"]').remove();
        mailForm.find('input[name="attachment"]').remove();
        toField.empty().trigger('change');
        ccField.empty().trigger('change');
        subjectField.val('');
        messageField.val('');

        // Add attachment path to form
        mailForm.append(`<input type="hidden" name="attachment" value="${filePath}">`);

        // Set Subject
        subjectField.val(`Document: ${fileTitle}`);

        // Pre-fill message
        messageField.val(`Dear Customer,\n\nPlease find the document "${fileTitle}" attached.\n\nBest regards.`);

        // Fetch contacts via AJAX
        $.ajax({
            url: `/users/${userId}/contacts`,
            type: 'GET',
            success: function(emails) {
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
        const toField = $("#to_modal");
        const ccField = $("#cc_modal");

        $('.select2-tags-modal').select2({
            tags: true,
            tokenSeparators: [','],
            dropdownParent: $("#send-mail-modal")
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
