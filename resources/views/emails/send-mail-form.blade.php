@extends('layouts.dashboard')
@section('title', 'Send Mail')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Send Mail</h4>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Send a New Mail') }}</div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('send.mail.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="to" class="form-label">{{ __('To') }}</label>
                                    <select id="to" class="form-control select2-tags @error('to') is-invalid @enderror" name="to[]" multiple required>
                                    </select>
                                    <div class="form-text">{{ __('Type an email and press Enter or Comma to add it.') }}</div>
                                    @error('to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="cc" class="form-label">{{ __('CC') }}</label>
                                    <select id="cc" class="form-control select2-tags @error('cc') is-invalid @enderror" name="cc[]" multiple>
                                    </select>
                                    <div class="form-text">{{ __('Type an email and press Enter or Comma to add it.') }}</div>
                                    @error('cc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="message" class="form-label">{{ __('Message') }}</label>
                                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="10" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Mail') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.select2-tags').select2({
            tags: true,
            tokenSeparators: [ ',' ]
        });
    });
</script>
@endsection