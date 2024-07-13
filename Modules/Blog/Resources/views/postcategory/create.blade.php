@extends('backend.layouts.app')
@section('title')
    {{ __('create_category') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('create_category') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('module.category.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>
                <form class="form-horizontal" action="{{ route('module.category.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="author_id" value="{{ auth()->id() }}">
                    <div class="card-body custom-input">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('name') }}<small class="text-danger">*</small> </label>
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('enter') }} {{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('image') }} </label>
                                    <div class="col-sm-9">
                                        <input name="image" type="file"
                                            class="form-control @error('image') is-invalid @enderror">
                                        @error('image')
                                            <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit"><i class="icofont icofont-plus"></i>
                                {{ __('save') }}</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
