@extends('backend.layouts.app')
@section('title')
    {{ __('create') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-7 ">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('create') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('module.faq.category.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>
                <form action="{{ route('module.faq.category.store') }}" method="POST">
                    @csrf

                    <div class="card-body custom-input">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('name') }}<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('icon') }} <span class="text-danger">*</span></label>
                                    <div class="col-sm-9" style="overflow-x: auto;">
                                        <input type="hidden" name="icon" value="{{ old('icon') }}" id="icon"
                                            class="@error('icon') is-invalid @enderror" />
                                        <div id="target" class="iconpicker-container"></div>
                                        @error('icon')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
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

@section('style')
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
@endsection

@section('script')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>

    <script>
        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 15,
            footer: true,
            header: true,
            icon: 'fas fa-bomb',
            iconBase: 'fas',
            iconset: 'fontawesome5',
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

<!-- HTML remains the same -->
