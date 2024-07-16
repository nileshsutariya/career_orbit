@extends('backend.layouts.app')

@section('title')
    {{ __('settings') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-xl-6" style="float:none;margin:auto;">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">My Profile</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i
                            class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                        data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">

                <div class="row mb-2">
                    <div class="profile-title">
                        <div class="d-flex"> <img class="img-70 rounded-circle"src="{{ $user->image_url }}"
                                alt="{{ __('profile_picture') }}" id="admin_image">
                            <div class="flex-grow-1">
                                <h4 class="mb-1"> {{ $user->name }}</h4>
                                <p>
                                    @foreach (auth()->user()->getRoleNames() as $role)
                                        (<span>{{ ucwords($role) }}</span>)
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST"
                    enctype="multipart/form-data" autocomplete="off">
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" name="name" for="name">Name</label>
                        <input required name="name" value="{{ $user->name }}" type="text"
                            class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label name="email" for="email" class="form-label"> Email </label>

                        <input required name="email" value="{{ $user->email }}" type="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                    </div>


                    <div class="mb-3">
                        <label class="form-label" name="image" for="change_image">Profile Update</label>


                        <div class="custom-file">
                            <input class="form-control" type="file" name="image"
                                onchange="document.getElementById('admin_image').src = window.URL.createObjectURL(this.files[0])"
                                accept="image/jpg, image/jpeg, image/png">

                        </div>

                        @error('image')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label name="password" for="change-password-visibility" class="form-label" :required="false">
                            Password </label>

                        <input type="hidden" value="0" name="isPasswordChange">
                        <div class="icheck-success d-inline">
                            <input value="1" name="isPasswordChange" type="checkbox"
                                {{ old('isPasswordChange') ? 'checked' : '' }} id="change-password-visibility">
                            <label for="change-password-visibility">
                            </label>
                        </div>
                    </div>

                    <div id="password_visibility" class="{{ old('isPasswordChange') ? 'd-block' : 'd-none' }}">
                        <div class="mb-3">
                            <label name="current_password" for="change-password-visibility"> Current Password </label>
                            <input name="current_password" type="password" value="{{ old('current_password') }}"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="{{ __('current_password') }}">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label name="new_password"> New Password </label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="{{ __('new_password') }}">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label name="confirm_password"> Cofirm Password </label>
                            <input name="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="{{ __('confirm_password') }}">
                            @error('password_confirmation')
                                <div class="invalid-feedback"> {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="form-footer">
                        <button class="btn btn-primary btn-block">Update</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <style>
        .profile-user-img {
            height: 150px !important;
            width: 150px !important;
            object-fit: cover !important;
        }
    </style>
@endsection

@section('script')
    <script>
        $('#change-password-visibility').on('change', function() {
            var value = $(this).prop('checked') == true ? 1 : 0;

            if (value == 1) {
                $('#password_visibility').addClass('d-block')
                $('#password_visibility').removeClass('d-none')
            } else {
                $('#password_visibility').addClass('d-none')
                $('#password_visibility').removeClass('d-block')
            }
        })
    </script>
@endsection
