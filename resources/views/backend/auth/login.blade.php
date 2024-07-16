@extends('backend.layouts.auth')
@section('content')
    <form class="theme-form" method="POST" action="{{ route('admin.login') }}">
        @csrf
        <h4>Sign in to account</h4>
        <p>Enter your email & password to login</p>
        <div class="form-group">
            <label class="col-form-label">Email Address</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value=""
                placeholder="{{ __('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group">
            <label class="col-form-label">Password</label>
            <div class="form-input position-relative">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="******">
                {{-- <input class="form-control" type="password" name="login[password]" required="" placeholder="*********"> --}}
                <div class="show-hide"><span class="show"> </span></div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="form-group mb-0">
            <div class="checkbox p-0">
                <input id="remember" type="checkbox">
                <label class="text-muted" name="remember_me" :required="false" for="remember">Remember password</label>
            </div><a class="link" href="{{ route('admin.password.request') }}">{{ __('i_forgot_my_password') }}</a>

            {{-- @if (config('captcha.active'))
                <div class="input-group mt-3 text-center">
                    {!! NoCaptcha::display() !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="text-danger text-sm">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                </div>
            @endif --}}

            <div class="text-end mt-3">
                <button class="btn btn-primary btn-block w-100" type="submit"> {{ __('sign_in') }}</button>
            </div>
        </div>

    </form>
@endsection

@section('backend_auth_script')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
