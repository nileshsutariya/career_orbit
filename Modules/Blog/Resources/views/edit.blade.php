@extends('backend.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection


@section('content')
    <div class="container-fluid">

        <form action="{{ route('module.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <h4>{{ __('edit') }} {{ __('post') }}</h4>
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
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('title') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input value="{{ $post->title }}" name="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="{{ __('enter') }} {{ __('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">
                                        {{ __('language') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    </br>
                                    @foreach ($languages as $lang)
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input"type="radio" id="lang_code_{{ $lang->id }}"
                                                name="locale" {{ $lang->code == $post->locale ? 'checked' : '' }}
                                                value="{{ $lang->code }}">
                                            <label class="form-check-label mb-0" for="lang_code_{{ $lang->id }}">
                                                {{ $lang->name }} </label>
                                        </div>
                                    @endforeach

                                    @error('locale')
                                        <span
                                            class="text-danger font-size-13 d-block"><strong>{{ $message }}</strong></span>
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
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('category') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="category_id"
                                        class="form-select select2 @error('category_id') is-invalid @enderror ">
                                        <option value="">{{ __('select_one') }}</option>
                                        @foreach ($categories as $category)
                                            <option {{ $post->category_id == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('thumbnail_image') }}
                                        <span class="text-danger">*</span>
                                    </label>

                                    <div class="upload-btn-wrapper">
                                        <input type="file" class="dropify" data-default-file="{{ $post->image_url }}"
                                            name="image" accept="image/png, image/jpg, image/jpeg, image/gif"
                                            data-allowed-file-extensions='["jpg", "jpeg","png", "gif"]'
                                            data-max-file-size="3M">

                                        <p class="tw-text-gray-500 tw-text-xs tw-text-left mt-2 recommended-img-note mb-0">
                                            Recommended Image Size: 800x500</p>
                                    </div>

                                    @error('image')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong>
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
                            <div class="col-md-12">
                                <label class="form-label">
                                    {{ __('short_description') }}
                                    <small class="text-danger">*</small>
                                </label>
                                <textarea rows="5" type="text" class="form-control" name="short_description"
                                    placeholder="{{ __('enter') }} {{ __('short_description') }}"> {{ $post->short_description }}</textarea>
                                @error('short_description')
                                    <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">
                                    {{ __('description') }}
                                    <small class="text-danger">*</small>
                                </label>
                                <textarea id="image_ckeditor" type="text" class="form-control" name="description"
                                    placeholder="{{ __('enter') }}  {{ __('description') }}">{{ $post->description }}</textarea>
                                @error('description')
                                    <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </form>
    </div>
@endsection
@section('script')
    <!-- Dropify-Script -->
    <script src="{{ asset('backend') }}/js/dropify.min.js"></script>

    <script>
        //Dropify function
        $('.dropify').dropify();
    </script>

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
