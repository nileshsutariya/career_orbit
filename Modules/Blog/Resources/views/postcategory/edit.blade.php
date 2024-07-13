@extends('backend.layouts.app')
@section('title')
    {{ __('edit') }}
@endsection




@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('edit') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('module.category.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>
                <form class="form-horizontal" action="{{ route('module.category.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body custom-input">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('name') }}<small class="text-danger">*</small> </label>
                                    <div class="col-sm-9">
                                        <input value="{{ $category->name }}" name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="{{ __('enter') }} {{ __('name') }}">
                                        @error('title')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3">{{ __('change_image') }} </label>
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
