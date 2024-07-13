@extends('backend.layouts.app')
@section('title')
    {{ __('send_mail') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="float-start">
                            <h3>{{ __('send_mail') }}</h3>
                            <p>{{ __('you_can_send_a_mail_to_multiple_email_addresses') }}</p>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('module.newsletter.index') }}" class="btn btn-primary">
                                <i class="fa fa-arrow-left"></i>&nbsp; {{ __('back') }}
                            </a>
                        </div>

                    </div>

                    <div class="card-body">
                        <form action="{{ route('module.newsletter.submit_mail') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="composeTo">{{ __('to') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="emails[]" class="form-control select2 @error('emails') is-invalid @enderror w-100-p"
                                        multiple data-placeholder="{{ __('start_typing_for_search') }}">
                                        @foreach ($emails as $email)
                                            <option {{ collect(old('emails'))->contains($email->id) ? 'selected' : '' }}
                                                value="{{ $email->email }}">{{ $email->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('emails')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="composeSubject">{{ __('subject') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" name="subject"
                                        class="form-control @error('subject') is-invalid @enderror"
                                        value="{{ old('subject') }}"
                                        placeholder="{{ __('enter') }} {{ __('subject') }}">
                                    @error('subject')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">{{ __('body') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <div class="toolbar-box">

                                        <div id="toolbar1">
                                            <button class="ql-bold">Bold </button>
                                            <button class="ql-italic">Italic </button>
                                            <button class="ql-underline">underline</button>
                                            <button class="ql-list" value="ordered">List </button>
                                            <button class="ql-list" value="bullet"> </button>
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                        </div>
                                        <div id="editor1"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-paper-plane"></i>
                                        &nbsp;{{ __('send_now') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/quill.snow.css') }}">
@endsection

@section('script')

    <script src="{{ asset('backend/assets/js/editors/quill.js') }}"></script>
    <script src="{{ asset('backend/assets/js/editors/custom-quill.js') }}"></script>

@endsection
