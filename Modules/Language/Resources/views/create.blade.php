@extends('backend.settings.setting-layout')
@section('title')
    {{ __('create_language') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('create_language') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <h4>{{ __('create_language') }}</h4>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('languages.index') }}" class="btn bg-primary">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('back') }}
                            </a>
                        </div>

                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" action="{{ route('languages.store') }}" method="POST">
                            @csrf
                            <div class="form-group row mb-2">
                                <x-forms.label name="name" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <select name="name" class="form-control select2 @error('name') is-invalid @enderror">
                                        @foreach ($translations as $key => $country)
                                            <option {{ old('name') == $country['name'] ? 'selected' : '' }}
                                                data-key="{{ $key }}" value="{{ $country['name'] }}">
                                                {{ $country['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <input type="hidden" name="code" id="code_input" />
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="direction" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <select name="direction"
                                        class="form-control select2 @error('direction') is-invalid @enderror">
                                        <option {{ old('direction') == 'ltr' ? 'selected' : '' }} value="ltr">
                                            {{ __('ltr') }}
                                        </option>
                                        <option {{ old('direction') == 'rtl' ? 'selected' : '' }} value="rtl">
                                            {{ __('rtl') }}
                                        </option>
                                    </select>
                                    @error('direction')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="flag" required="true" class="col-sm-3" />
                                <div class="col-sm-9" style="overflow-x: auto;">
                                    <input type="hidden" name="icon" id="icon" value="{{ old('icon') }}" />
                                    <div id="target">
                                        <div class="iconpicker-container"></div>
                                    </div>
                                    @error('icon')
                                        <span class="invalid-feedback d-block"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"></i>&nbsp;{{ __('create') }}</button>
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
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/flag-icon.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css" />
@endsection

@section('script')
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>

    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend') }}/plugins/flagicon/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Attach an event listener to the select element
            $('select[name="name"]').on('change', function() {
                // Get the selected option
                var selectedOption = $(this).find(':selected');

                // Get the value of the data-key attribute from the selected option
                var dataKey = selectedOption.data('key');

                // Set the data-key value as the value of the hidden input field
                $('#code_input').val(dataKey);
            });
        });




        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fa fa-angle-left',
            arrowNextIconClass: 'fa fa-angle-right',
            cols: 15,
            footer: true,
            header: true,
            icon: 'flag-icon-gb',
            iconset: 'flagicon',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
    </script>
@endsection
