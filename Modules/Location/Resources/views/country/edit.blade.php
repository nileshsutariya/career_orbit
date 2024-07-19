@extends('backend.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('edit') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('module.country.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>
                <form class="form-horizontal" action="{{ route('module.country.update', $country->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body custom-input">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('name') }}<span class="text-danger">*</span>
                                    </label>

                                    <div class="col-sm-9">
                                        <select name="name"
                                            class="form-control @error('name') is-invalid @enderror select2 w-100-p">
                                            <option value="">{{ __('select_one') }}</option>
                                            @foreach ($countries as $countr)
                                                <option {{ $countr->id == $country->id ? 'selected' : '' }}
                                                    value="{{ $countr->name }}">
                                                    {{ $countr->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('image') }} <span class="text-danger">*</span></label>

                                    <div class="col-sm-9">
                                        <div class="">
                                            <input name="image" type="file" data-show-errors="true" data-width="100%"
                                                data-default-file="{{ asset($country->image) }}"
                                                class="form-control dropify  @error('image') is-invalid @enderror border-0">
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
                                    <div class="col-sm-9" style="overflow-x: auto;">
                                        <input type="hidden" name="icon" id="icon"
                                            value="{{ old('icon', $country->icon) }}" class="form-control" />
                                        <div class="" data-icon="fab fa-twitter" id="target"></div>
                                        @error('country_icon')
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
                                {{ __('update') }}</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('style')
    {{-- Flat Icon Css Link --}}
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/flag-icon.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css" />
@endsection
@section('script')
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/flagicon/dist/js/bootstrap-iconpicker.bundle.min.js"></script>

    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend') }}/plugins/flagicon/dist/js/bootstrap-iconpicker.bundle.min.js"></script>

    {{-- Image upload and Preview --}}
    <script src="{{ asset('backend') }}/plugins/dropify/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();

        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fa fa-angle-left',
            arrowNextIconClass: 'fa fa-angle-right',
            cols: 16,
            footer: true,
            header: true,
            icon: '{{ $country->icon }}',
            iconset: 'flagicon',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 4,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });
        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
        // dropify
        var drEvent = $('.dropify').dropify();
        drEvent.on('dropify.error.fileSize', function(event, element) {
            alert('Filesize error message!');
        });
        drEvent.on('dropify.error.imageFormat', function(event, element) {
            alert('Image format error message!');
        });
        $('.search-control').val('{{ $country->icon }}');
    </script>
@endsection
