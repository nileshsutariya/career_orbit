@extends('backend.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('edit') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('module.testimonial.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>

                <div class="row pt-3 pb-3">
                    <div class="col-6 offset-md-3 text-center">
                        @if ($testimonial->image)
                            <img class="rounded m-auto p-3 border" id="image" width="150px" height="150px"
                                src=" {{ asset($testimonial->image) }}" alt="user image">
                        @else
                            <img class="rounded m-auto p-3 border" width="150px" height="150px" id="image"
                                src="{{ asset('backend/image/default.png') }}" alt="User profile picture">
                        @endif
                    </div>
                </div>

                <form class="form theme-form" action="{{ route('module.testimonial.update', $testimonial->id) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body custom-input">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('name') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input value="{{ $testimonial->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('position') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input value="{{ $testimonial->position }}" name="position" type="text"
                                            class="form-control @error('position') is-invalid @enderror"
                                            placeholder="{{ __('position') }}">
                                        @error('position')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('image') }}</label>
                                    <div class="col-sm-9">

                                        <input name="image" autocomplete="image"
                                            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                            type="file"
                                            class="form-control form-control-sm @error('image') is-invalid @enderror"
                                            id="customFile">
                                        <label class="custom-file-label" for="customFile">{{ __('choose_file') }}</label>
                                        @error('image')
                                            <span class="text-danger invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('stars') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        

                                        <div class="main-star-rating">
                                            <div class="common-flex star-box justify-content-center">
                                                <i class="fa fa-star" data-index="1"></i>
                                                <i class="fa fa-star" data-index="2"></i>
                                                <i class="fa fa-star" data-index="3"></i>
                                                <i class="fa fa-star" data-index="4"></i>
                                                <i class="fa fa-star" data-index="5"></i>
                                            </div>
                                        </div>
    
                                      
                                        <input value="{{ $testimonial->stars }}" type="hidden" name="stars"
                                            id="rating" class="form-control @error('stars') is-invalid @enderror">
                                        @error('stars')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror 
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('language') }}<span class="text-danger">*</span></label>
                                    <div class="col-sm-9 d-flex">
                                        @foreach ($app_languages as $lang)
                                            <div class="form-check form-check-inline radio radio-primary">
                                                <input class="form-check-input" type="radio"
                                                    id="lang_code_{{ $lang->id }}" name="code"
                                                    {{ $lang->code == $testimonial->code ? 'checked' : '' }}
                                                    value="{{ $lang->code }}">
                                                <label for="lang_code_{{ $lang->id }}"
                                                    class="form-check-label mb-0 text-dark">{{ $lang->name }}</label>
                                            </div>
                                        @endforeach
                                        @error('code')
                                            <span
                                                class="text-danger font-size-13 d-block"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('description') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <textarea rows="8" type="text" class="form-control" name="description"
                                            placeholder="{{ __('description') }}... ">{{ $testimonial->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger font-size-13"><strong>{{ $message }}</strong></span>
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
@endsection

@section('script')
<script>
    $(document).ready(function() {
    $('.fa-star').click(function() {
        var index = $(this).data('index');
        var isActive = $(this).hasClass('active');

        if (isActive) {
            $(this).removeClass('active');
            $(this).nextAll('.fa-star').removeClass('active');
            var rating = $('.fa-star.active').length;
            $('#rating').val(rating);
        } else {
            $('.fa-star').removeClass('active');
            $(this).addClass('active');
            $(this).prevAll('.fa-star').addClass('active');
            var rating = $('.fa-star.active').length;
            $('#rating').val(rating);
        }
    });
});
</script>
@endsection
