@extends('backend.layouts.auth')
@section('content')
    <h3 class="mb-3">
        {{ __('confirm_password') }}
    </h3>
    {{ __('please_confirm_your_password_before_continuing') }}

    <form class="theme-form" method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="row mb-2">
            <x-forms.label name="password" for="password" class="col-md-4 text-md-right" />

            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>

        <div class="row">

            <button type="submit" class="btn btn-primary">
                {{ __('confirm_password') }}
            </button>
        </div>
        <div class="row float-end">
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('forgot_your_password') }}
                </a>
            @endif
        </div>
    </form>
@endsection
