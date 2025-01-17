@extends('backend.settings.setting-layout')
@section('title')
    {{ __('edit_language') }}
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
                <li class="breadcrumb-item active">{{ __('edit_language') }}</li>
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
                            <h4>{{ __('edit_language') }}</h4>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('languages.index') }}" class="btn bg-primary">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>

                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" action="{{ route('languages.update', $language->id) }}"
                            method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <x-forms.label name="name" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <select name="name"
                                        class="form-control select2 m-b-10 @error('name') is-invalid @enderror">
                                        @foreach ($translations as $key => $country)
                                            <option {{ $country['name'] == $language->name ? 'selected' : '' }}
                                                data-key="{{ $key }}" value="{{ $country['name'] }}">
                                                {{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"> <strong> {{ $message }}
                                            </strong> </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="code" id="code_input" value="{{ $language->code }}" />
                                <!-- Set the initial value -->
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="direction" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <select name="direction"
                                        class="form-control select2  @error('direction') is-invalid @enderror">
                                        <option {{ $language->direction == 'ltr' ? 'selected' : '' }} value="ltr">
                                            {{ __('ltr') }}
                                        </option>
                                        <option {{ $language->direction == 'rtl' ? 'selected' : '' }} value="rtl">
                                            {{ __('rtl') }}
                                        </option>
                                    </select>
                                    @error('direction')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="flag" required="true" class="col-sm-3" />
                                <div class="col-sm-9" style="overflow-x: auto;">
                                    <input type="hidden" name="icon" id="icon"
                                        value="{{ old('icon', $language->icon) }}" />
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
                                <div class="offset-sm-3 col-sm-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-refresh"></i>&nbsp; {{ __('update') }}</button>
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
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend') }}/plugins/flagicon/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set the initial value of the hidden input field
            var selectedOption = $('select[name="name"]').find(':selected');
            var dataKey = selectedOption.data('key');
            $('#code_input').val(dataKey);

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
            icon: '{{ $language->icon }}',
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
