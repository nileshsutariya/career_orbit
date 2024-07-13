
@extends('backend.settings.setting-layout')
@section('title') {{ __('create_country') }} @endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create_country') }}</h3>
                        <a href="{{ route('location.country.country') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('location.country.store') }}" method="POST">
                                @csrf
                                <div class="form-group row mb-2">
                                    <x-forms.label name="country" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="name" value="" placeholder="Enter Country Name" required>
                                        
                                    </div>
                                    @error('name') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                                <div class="form-group row mb-2">
                                    <x-forms.label name="short_name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="short_name" value="" placeholder="Enter Country Short Name" required>
                                        
                                    </div>
                                    @error('short_name') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                                <div class="form-group row mb-2">
                                    <x-forms.label name="latitude" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="lat" value="" placeholder="Enter latitude " required> 
                                    </div>
                                    @error('lat') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                                <div class="form-group row mb-2">
                                    <x-forms.label name="longitude" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="long" value="" placeholder="Enter longitude" required>  
                                    </div>
                                    @error('long') <span class="invalid-feedback"
                                    role="alert"><strong>{{ $message }}</strong></span> @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-plus"></i>&nbsp;{{ __('create') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


