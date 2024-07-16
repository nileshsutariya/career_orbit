@extends('backend.settings.setting-layout')

@section('title')
    {{ __('email_templates') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('email_templates') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('cms') }} {{ __('settings') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-2">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($mail_templates as $mail_template)
                        <li class="nav-item border rounded mb-1">
                            <a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#item-{{ $mail_template->id }}">{{ $mail_template->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-10">
                    <div class="tab-content no-padding">
                        @foreach ($mail_templates as $mail_template)
                            @include("backend.layouts.partials.company-create", [
                                "id" => $mail_template->id,
                                "name" => $mail_template->name,
                                "subject" => $mail_template->subject,
                                "message" => $mail_template->message,
                                "available_flags" => getFormatFlagsByType("new_user"),
                                "active" => $loop->first
                            ])
                        @endforeach
                        {{-- @note For developer use only. Use it to create new template. --}}
                        {{-- @include("backend.layouts.partials.company-create", [
                            "name" => "",
                            "subject" => "",
                            "message" => "",
                            "is_new" => "new"
                        ]) --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

