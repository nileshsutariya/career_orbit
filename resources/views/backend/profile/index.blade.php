@extends('backend.layouts.app')

@section('title')
{{ __('profile') }}
@endsection

@section('breadcrumbs')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('profile') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('profile') }}</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="col-xl-6" style="float:none;margin:auto;">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">My Profile</h4>
            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                <i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#"
                    data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row mb-2">
                    <div class="profile-title">
                        <div class="d-flex"> <img class="img-70 rounded-circle" src="{{ auth()->user()->image_url }}"
                                alt="{{ __('user_profile_picture') }}">
                            <div class="flex-grow-1">
                                <h4 class="mb-1">{{ $user->name }}</h4>
                                <p>
                                    @foreach (auth()->user()->getRoleNames() as $role)
                                    (<span>{{ ucwords($role) }}</span>)
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">

                    <b>{{ __('email_address') }}</b>
                    <br />
                    <a class="float-right">{{ auth()->user()->email }}</a>

                </div>

                <div class="mb-3">
                    <b>{{ __('registered_at') }}</b>
                    <br />
                    <a class="float-right">{{ auth()->user()->created_at->diffForHumans() . ' ' . '( ' .
                        auth()->user()->created_at->format('M d, Y') . ' )' }}
                    </a>
                </div>
                <div class="mb-3">
                    <b>{{ __('updated_at') }}</b>
                    <br />
                    <a class="float-right">{{ auth()->user()->updated_at->diffForHumans() . ' ' . '( ' .
                        auth()->user()->created_at->format('M d, Y') . ' )' }}</a>
                </div>
                <div class="form-footer">
                    <a href="{{ route('profile.setting') }}" class="btn btn-primary btn-block">Setting</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .profile-user-img {
        height: 150px !important;
        width: 150px !important;
        object-fit: cover !important;
    }
</style>
@endsection