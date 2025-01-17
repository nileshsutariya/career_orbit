@extends('backend.settings.setting-layout')

@section('title')
    {{ __('update_state') }}
@endsection

@section('website-settings')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <h3>{{ __('update_state') }}</h3>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('location.state.state') }}" class="btn bg-primary"><i class="fa fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                        </div>

                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" action="{{ route('location.state.update', $state->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT') <!-- Use PUT or PATCH method for updating -->
                            <div class="form-group row mb-2">
                                <x-forms.label name="country" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <select name="country_id"
                                        class="form-control select2 @error('country_id') is-invalid @enderror">
                                        <option value="">Select Country</option>

                                        @foreach ($countries as $country)
                                            <option
                                                {{ old('country_id', $state->country_id) == $country->id ? 'selected' : '' }}
                                                value="{{ $country->id }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="state" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="state_name"
                                        value="{{ old('state_name', $state->name) }}" placeholder="Enter State Name"
                                        required>
                                </div>
                                @error('state_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="latitude" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="lat"
                                        value="{{ old('lat', $state->lat) }}" placeholder="Enter latitude " required>
                                </div>
                                @error('lat')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="longitude" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="long"
                                        value="{{ old('long', $state->long) }}" placeholder="Enter longitude" required>
                                </div>
                                @error('long')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;{{ __('update') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
