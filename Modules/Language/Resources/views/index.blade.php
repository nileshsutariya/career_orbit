@extends('backend.settings.setting-layout')
@section('title')
    {{ __('language_list') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('language_list') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4 mb-3">
                @php
                    $current_language = currentLanguage() ? currentLanguage() : loadDefaultLanguage();
                @endphp
                <form action="{{ route('setDefaultLanguage') }}" method="POST">
                    @csrf
                    @method('put')
                    <x-forms.label name="set_default_language" for="inlineFormCustomSelect" class="mr-sm-2" />
                    <div class="d-flex">
                        <select name="code" class="form-select mr-sm-2" id="inlineFormCustomSelect">
                            <option value="" hidden>{{ __('language') }}</option>
                            @foreach ($languagesList as $language)
                                <option {{ $current_language->code === $language->code ? 'selected' : '' }}
                                    value="{{ $language->code }}">
                                    {{ $language->name }}({{ $language->code }})
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary m-l-10">{{ __('update') }}</button>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <h4>{{ __('language_list') }}</h4>
                        </div>
                        <div class="float-end"> <a href="{{ route('languages.create') }}" class="btn bg-primary">
                                {{ __('create') }}
                            </a></div>
                    </div>

                    <div class="card-body dt-ext table-responsive theme-scrollbar ">
                        <table class="display" id="keytable">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th>{{ __('direction') }}</th>
                                    <th>{{ __('flag') }}</th>
                                    <th width="15%">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($languagesList as $key => $language)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $language->name }}
                                            @if (config('templatecookie.default_language') == $language->code)
                                                <span class="badge badge-pill badge-primary">{{ __('default') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $language->code }}</td>
                                        <td>{{ __($language->direction) }}</td>
                                        <td><i class="flag-icon {{ $language->icon }}"></i></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('languages.view', $language->code) }}"
                                                class="btn border m-r-10">
                                                <i class="fa fa-cog fa-2x"></i>
                                            </a>
                                            @if ($language->code == 'en')
                                                <a data-bs-toggle="tooltip" data-placement="top"
                                                    title="{{ __('translate_language') }}" href="javascript:void(0)"
                                                    class="btn border m-r-10" data-bs-toggle="tooltip"
                                                    title="You can't delete or edit this language">
                                                    <i class="fa fa-lock fa-2x"></i>
                                                </a>
                                            @endif
                                            @if ($language->code != 'en')
                                                <a data-bs-toggle="tooltip" data-placement="top"
                                                    title="{{ __('sync_language_contents') }}"
                                                    onclick="return confirm('{{ __('are_you_sure') }}');"
                                                    href="{{ route('language.syncLanguage', $language->id) }}"
                                                    class="btn border m-r-10">
                                                    <i class="fa fa-refresh fa-2x"></i>
                                                </a>
                                                <a data-bs-toggle="tooltip" data-placement="top"
                                                    title="{{ __('edit_language') }}"
                                                    href="{{ route('languages.edit', $language->id) }}"
                                                    class="btn border m-r-10">
                                                    <i class="fa fa-edit fa-2x"></i>
                                                </a>
                                                @if ($language->code !== 'en')
                                                    <form action="{{ route('languages.destroy', $language->id) }}"
                                                        class="d-inline" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-bs-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_language') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                            class="btn border m-r-10"><i
                                                                class="text-dark fa fa-trash fa-2x"></i></button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
