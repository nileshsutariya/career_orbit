@extends('backend.layouts.app')

@section('title')
{{ __('user_create') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <h3 class="card-title line-height-36">{{ __('user_create') }}</h3>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('user.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fa fa-arrow-left mr-1"></i>
                            {{ __('back') }}
                        </a>
                    </div>
                </div>
                <div class="row pt-3 pb-4">
                    <div class="col-md-6 offset-md-3">
                        <div class="text-center mb-4">
                            <img width="150px" height="150px" id="image" class="img-circle border m-auto p-3"
                                src="{{ asset('backend/image/default.png') }}" alt="{{ __('user_profile_picture') }}">
                        </div>
                        <form class="form-horizontal" action="{{ route('user.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <x-forms.label name="{{ __('name') }}" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input value="{{ old('name') }}" name="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="{{ __('name') }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <x-forms.label name="{{ __('email') }}" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input value="{{ old('email') }}" name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="{{ __('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <x-forms.label name="{{ __('image') }}" class="col-sm-3" :required="false" />
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        
                                        <input name="image" autocomplete="image"
                                            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                            type="file" class=" form-control" id="customFile">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <x-forms.label name="{{ __('password') }}" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <input value="{{ old('password') }}" name="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="{{ __('password') }}">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <x-forms.label name="{{ __('assign_roles') }}" class="col-sm-3" />
                                <div class="col-sm-9">
                                    <select name="roles[]" class="w-100-p select2 @error('roles') is-invalid @enderror"
                                        multiple="multiple" data-placeholder="{{ __('select_one') }}">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                        {{ __('save') }}</button>
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
