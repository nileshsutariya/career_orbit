@extends('backend.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <h3>{{ __('edit') }}</h3>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('module.faq.index') }}" class="btn bg-primary"><i
                                    class="fa fa-arrow-left"></i>&nbsp;
                                {{ __('back') }}</a>
                        </div>

                    </div>

                    <form class="form theme-form" action="{{ route('module.faq.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body custom-input">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3">{{ __('language') }} <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-9">
                                            <div class="d-flex">
                                                @foreach ($app_languages as $lang)
                                                    <div class="custom-control custom-radio">
                                                        <input class="d-none" type="radio"
                                                            id="lang_code_{{ $lang->id }}" name="code"
                                                            {{ $lang->code == old('code') ? 'checked' : '' }}
                                                            {{ $lang->code == $faq->code ? 'checked' : '' }}
                                                            value="{{ $lang->code }}">
                                                        <label onclick="pushClass('lang_code_button_{{ $lang->id }}')"
                                                            for="lang_code_{{ $lang->id }}">
                                                            <span type="button" id="lang_code_button_{{ $lang->id }}"
                                                                class="c-btn btn btn-sm btn-light  m-r-10 {{ $lang->code == $faq->code ? 'btn-primary text-white' : '' }}">
                                                                {{ $lang->name }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('code')
                                                <div class="text-danger font-size-13">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3"> {{ __('select_one') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="faq_category_id"
                                                class="form-select select2 @error('faq_category_id') is-invalid @enderror w-100-p">
                                                @foreach ($faq_categories as $faq_category)
                                                    <option
                                                        {{ $faq_category->id == $faq->faq_category_id ? 'selected' : '' }}
                                                        value="{{ $faq_category->id }}"> {{ $faq_category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('faq_category_id')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="mb-3 row">
                                        <label class="col-sm-3"> {{ __('question') }}<span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">

                                            <input value="{{ old('question', $faq->question) }}" name="question"
                                                type="text" class="form-control @error('question') is-invalid @enderror"
                                                placeholder="{{ __('enter') }} {{ __('question') }}">
                                            @error('question')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-sm-3"> {{ __('answer') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea id="image_ckeditor" type="text" class="form-control" name="answer"
                                                placeholder="{{ __('enter') }} {{ __('answer') }}">{{ old('answer', $faq->answer) }}</textarea>
                                            @error('answer')
                                                <span class="text-danger font-size-13">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary me-3" type="submit"><i class="icofont icofont-plus"></i>
                                    {{ __('update') }}</button>

                            </div>
                        </div>
                    </form>

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

    <script>
        function pushClass(arg) {
            $('.c-btn').removeClass('btn-primary text-white');
            $('#' + arg).addClass('btn-primary text-white');
        }
    </script>
@endsection
