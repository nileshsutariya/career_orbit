@extends('backend.layouts.app')
@section('title')
    {{ __('create') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('create') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('module.country.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>
                <form class="form-horizontal" action="{{ route('module.country.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="card-body custom-input">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('name') }}<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="name" type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid ' : '' }}"
                                            placeholder="{{ __('enter') }} {{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('image') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="">
                                            <input name="image" type="file" data-show-errors="true" data-width="100%"
                                                data-default-file=""
                                                class="form-control dropify  @error('image') is-invalid @enderror border-0">
                                            @error('image')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="dropify-preview">
                                                <span class="dropify-render"></span>
                                                <div class="dropify-infos">
                                                    <div class="dropify-infos-inner">
                                                        <p class="dropify-filename">
                                                            <span class="file-icon">
                                                            </span>
                                                            <span class="dropify-filename-inner"></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3">
                                        {{ __('icon') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="icon" id="icon" value="{{ old('icon') }}"
                                            class="form-control" />
                                        <div class="" data-icon="fab fa-twitter" id="target"></div>
                                        @error('icon')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit"><i class="icofont icofont-plus"></i>
                                {{ __('create') }}</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
  

    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();

      
        // dropify
        var drEvent = $('.dropify').dropify();
        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });
        $('.search-control').val('');
    </script>
@endsection
