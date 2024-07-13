@extends('backend.layouts.app')
@section('title')
{{ __('create_post') }}
@endsection

@section('content')
<div class="container-fluid">

    <form action="{{ route('module.blog.store') }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="author_id" value="{{ auth()->id() }}">
        @csrf


        <div class="card">
            <div class="card-body">
                <div class="float-start">
                    <h4>{{ __('create') }} {{ __('post') }}</h4>
                </div>
                <div class="float-end">

                    <button type="submit" value="draft" name="status" class="btn btn-secondary">
                        <i class="fa fa-archive"></i>&nbsp;{{ __('save_as_draft') }}
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i>&nbsp;{{ __('published') }}
                    </button>
                    <a href="{{ route('module.blog.index') }}" class="btn btn-primary"><i
                            class="fa fa-arrow-left"></i>&nbsp;{{ __('back') }}
                    </a>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('title') }}/{{ __('language') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 mb-2">
                                <label class="form-label">
                                    {{ __('title') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input value="{{ old('title') }}" name="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="{{ __('enter') }} {{ __('title') }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">
                                    {{ __('language') }}
                                    <span class="text-danger">*</span>
                                </label>
                                </br>
                                @foreach ($languages as $lang)
                                <div class="form-check form-check-inline radio radio-primary">
                                    <input class="form-check-input" id="lang_code_{{ $lang->id }}" type="radio"
                                        name="locale" {{ $lang->code == old('locale', currentLangCode()) ? 'checked' :
                                    '' }}
                                    value="{{ $lang->code }}">
                                    <label class="form-check-label mb-0" for="lang_code_{{ $lang->id }}">
                                        {{ $lang->name }} </label>
                                </div>
                                @endforeach

                                @error('locale')
                                <span class="text-danger font-size-13 d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ __('category') }}/{{ __('thumbnail_image') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12 mb-2">
                                <label class="form-label">
                                    {{ __('category') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <select name="category_id"
                                    class="form-select select2 @error('category_id') is-invalid @enderror ">
                                    <option value="">{{ __('select_one') }}</option>
                                    @foreach ($categories as $category)
                                    <option {{ old('category_id')==$category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label class="form-label">
                                    {{ __('thumbnail_image') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="dropzone-wrapper">
                                    <input type="file" class="form-control dropzone bg-light-primary"
                                        data-default-file="" name="image"
                                        accept="image/png, image/jpg, image/jpeg, image/gif"
                                        data-allowed-file-extensions='["jpg", "jpeg","png", "gif"]'
                                        data-max-file-size="3M">
                                    <p class="tw-text-gray-500 tw-text-xs tw-text-left mt-2 recommended-img-note mb-0">
                                        Recommended Image Size: 800x500</p>
                                </div>
                                @error('image')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('description') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 mb-2">
                            <label class="form-label">
                                {{ __('short_description') }}
                                <small class="text-danger">*</small>
                            </label>
                            <textarea rows="5" type="text" class="form-control" name="short_description"
                                placeholder="{{ __('enter') }} {{ __('short_description') }}">{{ old('short_description') }}</textarea>
                            @error('short_description')
                            <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="form-label">
                                {{ __('description') }}
                                <small class="text-danger">*</small>
                            </label>
                            <textarea id="image_ckeditor" type="text" class="form-control" name="description"
                                placeholder="{{ __('enter') }}  {{ __('description') }}">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </form>
</div>
@endsection