<div class="modal fade" id="send-mail-modal" tabindex="-1" aria-labelledby="sendMailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMailModalLabel">Send Mail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('send.mail.store') }}" id="send-mail-form">
                    @csrf
                    <input type="hidden" name="invoice_ids[]" id="invoice_ids_modal">

                    <div class="mb-3">
                        <label for="to_modal" class="form-label">{{ __('To') }}</label>
                        <select id="to_modal" class="form-control select2-tags-modal @error('to') is-invalid @enderror" name="to[]" multiple required style="width: 100%;">
                        </select>
                        <div class="form-text">{{ __('Type an email and press Enter or Comma to add it.') }}</div>
                        @error('to')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cc_modal" class="form-label">{{ __('CC') }}</label>
                        <select id="cc_modal" class="form-control select2-tags-modal @error('cc') is-invalid @enderror" name="cc[]" multiple style="width: 100%;">
                        </select>
                        <div class="form-text">{{ __('Type an email and press Enter or Comma to add it.') }}</div>
                        @error('cc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subject_modal" class="form-label">{{ __('Subject') }}</label>
                        <input id="subject_modal" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" required>
                        @error('subject')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="message_modal" class="form-label">{{ __('Message') }}</label>
                        <textarea id="message_modal" class="form-control @error('message') is-invalid @enderror" name="message" rows="8" required>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="send-mail-form">Send Mail</button>
            </div>
        </div>
    </div>
</div>
