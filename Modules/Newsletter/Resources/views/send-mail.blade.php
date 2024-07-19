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
                                    <select name="emails[]"
                                        class="form-control select2 @error('emails') is-invalid @enderror w-100-p" multiple
                                        data-placeholder="{{ __('start_typing_for_search') }}">
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

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">{{ __('body') }} <small
                                        class="text-danger">*</small></label>
                                <div class="col-sm-10">
                                    <textarea id="image_ckeditor" type="text" class="form-control @error('body') is-invalid @enderror" name="body">
                                        {{ old('body') }}
                                    </textarea>
                                    @error('body')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
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


@section('script')
    <script>
        $(document).ready(function() {
            $('#image_ckeditor').summernote({
                height: 300, // Set the height of the editor
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

        });
    </script>
@endsection
