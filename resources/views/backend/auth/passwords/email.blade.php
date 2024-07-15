@extends('backend.layouts.auth')
@section('content')
    <h3 class="mb-5">
        {{ __('reset_password') }}
    </h3>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form class="theme-form" method="POST" action="{{ route('admin.password.email') }}">
        @csrf

        <div class="mb-2 input-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" placeholder="{{ __('email') }}">

            <span class="input-group-text list-light-primary">
                <i class="fa fa-envelope txt-primary"> </i></span>
            @error('email')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>




        <button type="submit" class="btn btn-primary d-block w-100">
            {{ __('send_password_reset_link') }}
        </button>
    </form>
@endsection
