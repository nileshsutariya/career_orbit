@extends('backend.layouts.app')

@section('title')
    {{ __('edit') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('user_edit') }}</h3>
                        <a href="{{ route('user.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('back') }}
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="text-center mb-4 pt-2">
                                <img width="150px" height="150px" id="image" class="img-circle border-secondary m-auto p-3" src="{{ $user->image_url }}" alt="{{ __('user_profile_picture') }}">
                            </div>
                            <form class="form-horizontal" action="{{ route('user.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row mb-2">
                                    <x-forms.label name="name" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $user->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <x-forms.label name="email" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $user->email }}" name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="{{ __('email') }}">
                                        @error('email')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <x-forms.label name="{{ __('image') }}" class="col-sm-3" :required="false" />
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input name="image" autocomplete="image"
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label"
                                                for="customFile">{{ __('choose_file') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <x-forms.label name="{{ __('change_password') }}" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('password') }}" name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="{{ __('new_password') }}">
                                        @error('password')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <x-forms.label name="{{ __('assign_roles') }}" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="roles[]" class="select2 @error('roles') is-invalid @enderror" multiple="multiple" data-placeholder="{{ __('select_roles') }}" style="width: 100%;">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('roles')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i>
                                            {{ __('save') }}
                                        </button>
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


