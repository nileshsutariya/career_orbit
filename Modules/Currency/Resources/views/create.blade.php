@extends('backend.settings.setting-layout')
@section('title')
    {{ __('create_currency') }}
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
                <li class="breadcrumb-item active">{{ __('create_currency') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <h4> {{ __('create_currency') }} </h4>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('module.currency.index') }}" class="btn bg-primary">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('back') }}
                            </a>
                        </div>


                    </div>
                    <form class="form-horizontal" action="{{ route('module.currency.store') }}" method="POST">
                        @csrf
                        <div class="card-body">


                            <div class="form-group row mb-2">
                                <x-forms.label name="name" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="E.g - Dollar">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="code" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input type="text" name="code" id="code"
                                        class="form-control @error('code') is-invalid @enderror"
                                        value="{{ old('code') }}" placeholder="E.g - USD">
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="rate" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input type="text" name="rate" id="rate"
                                        class="form-control @error('rate') is-invalid @enderror"
                                        value="{{ old('rate') }}" placeholder="E.g - Currency current rate againest USD">
                                    @error('rate')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="Symbol" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input type="text" name="symbol" id="symbol"
                                        class="form-control @error('symbol') is-invalid @enderror"
                                        value="{{ old('symbol') }}" placeholder="E.g - $">
                                    @error('symbol')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="position" class="col-sm-3" />

                                <input class="tgl tgl-flip" id="cb5" type="checkbox" checked="0" value="left"
                                    name="symbol_position" type="checkbox" checked="0">
                                <label class="tgl-btn" data-tg-off="{{ __('right') }}" data-tg-on="{{ __('left') }}"
                                    for="cb5"></label>

                            </div>
                        </div>

                        <div class="card-footer ">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;
                                    {{ __('create') }}</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

