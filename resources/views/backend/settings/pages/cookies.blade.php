@extends('backend.settings.setting-layout')

@section('title')
    {{ __('gdpr_cookie_consent') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('gdpr_cookie_consent') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('cookies_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('cookies_settings') }}</li>
            </ol>
        </div>
    </div>
@endsection



@section('website-settings')
    <div class="row justify-content-center">

        <div class="col-md-6">


            <div class="card">
                <div class="card-header">
                    <h4>{{ __('cookies_settings') }}</h4>
                </div>


                <form class="form-horizontal" action="{{ route('settings.cookies.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('allow_cookies_consent') }}</label>
                                    <div class="col-sm-9">


                                        <input class="tgl tgl-flip" data-bootstrap-switch value="1"
                                            name="allow_cookies" id="cb1" type="checkbox"
                                            {{ $cookie->allow_cookies ? 'checked' : '' }} data-size="large">
                                        <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb1"></label>
                                        <x-forms.error name="allow_cookies" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3" for="cookie_name">{{ __('cookie_name') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="cookie_name" id="cookie_name" class="form-select select2">
                                            <option value="gdpr_cookie" @if ($cookie->cookie_name == 'gdpr_cookie') selected @endif>
                                                {{ __('gdpr_cookie') }} </option>
                                            <option value="ccpa_cookie" @if ($cookie->cookie_name == 'ccpa_cookie') selected @endif>
                                                {{ __('ccpa_cookie') }}</option>
                                            <option value="lgpd_cookie" @if ($cookie->cookie_name == 'lgpd_cookie') selected @endif>
                                                {{ __('lgpd_cookie') }} </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3" for="cookie_expiration">{{ __('cookie_expiration_day') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input class="form-control digits" type="number" max="365"
                                            id="cookie_expiration" name="cookie_expiration"
                                            placeholder="{{ __('enter_cookie_expiration_day') }}"
                                            value="{{ $cookie->cookie_expiration }}" />
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('force_consent') }}</label>
                                    <div class="col-sm-9">

                                        <input class="tgl tgl-flip" data-bootstrap-switch value="1"
                                            name="force_consent" id="cb2" type="checkbox"
                                            {{ $cookie->force_consent ? 'checked' : '' }} data-size="large">
                                        <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb2"></label>

                                        <x-forms.error name="force_consent" />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3" for="darkmode">{{ __('theme') }}</label>
                                    <div class="col-sm-9">


                                        <input class="tgl tgl-flip" data-bootstrap-switch value="1" name="darkmode"
                                            id="cb3" type="checkbox" {{ $cookie->darkmode ? 'checked' : '' }}
                                            data-size="large">
                                        <label class="tgl-btn" data-tg-off="LIGHT" data-tg-on="DARK" for="cb3"></label>
                                        <x-forms.error name="darkmode" />
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        @if (userCan('setting.update'))
                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i>
                                        {{ __('update') }}</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection


{{-- @section('script')
        <script>
            $("#allow_cookies").bootstrapSwitch();
            $("#force_consent").bootstrapSwitch();
            $("#darkmode").bootstrapSwitch();
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endsection --}}
