@extends('backend.settings.setting-layout')

@section('title')
    {{ __('create_state') }}
@endsection

@section('website-settings')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <h4>{{ __('create_state') }}</h4>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('location.state.state') }}" class="btn bg-primary "><i class="fa fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">

                        <form class="form-horizontal" action="{{ route('location.state.store') }}" method="POST">
                            @csrf
                            <div class="form-group row mb-2">
                                <x-forms.label name="country" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <select name="country_id" class="form-select select2 @error('state_id') is-invalid @enderror">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $key => $country)
                                            <option {{ old('id') == $country['id'] ? 'selected' : '' }}
                                                value="{{ $country['id'] }}">
                                                {{ $country['name'] }}
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
                                    <input class="form-control" type="text" name="state_name" value=""
                                        placeholder="Enter City Name" required>

                                </div>
                                @error('state_name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="latitude" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="lat" value=""
                                        placeholder="Enter latitude " required>
                                </div>
                                @error('lat')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group row mb-2">
                                <x-forms.label name="longitude" required="true" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="long" value=""
                                        placeholder="Enter longitude" required>
                                </div>
                                @error('long')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;{{ __('create') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
