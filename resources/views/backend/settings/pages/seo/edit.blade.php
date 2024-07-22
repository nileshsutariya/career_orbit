@extends('backend.settings.setting-layout')

@section('title')
    {{ __('edit') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('edit_seo') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-start">
                                <h3>
                                    {{ __('seo_page_list') }}
                                    <div class="badge badge-primary ml-1">
                                        {{ Str::ucfirst($seo->page_slug) }}
                                    </div>
                                </h3>
                            </div>
                            <div class="float-end">
                                <a width="100%" class="btn bg-primary"
                                    href="{{ route('settings.seo.index', ['lang_query' => request('lang_query')]) }}"> <i
                                        class="fa fa-arrow-left"></i>
                                    {{ __('back') }}
                                </a>
                            </div>


                        </div>
                        <div class="card-body">
                            <form id="language_code_form" action="{{ route('module.seo.content.create') }}" method="POST"
                                class="form-horizontal">
                                @csrf
                                <div class="form-group row mb-2">
                                    <x-forms.label name="Language" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <input type="hidden" class="d-none" name="page_id" value="{{ $seo->id }}">
                                        <input type="hidden" id="language_code_input" class="d-none" name="language_code"
                                            value="">
                                        @foreach ($languages as $key => $language)
                                            <button type="button" onclick="createContent('{{ $language->code }}')"
                                                class="btn btn-sm btn-light {{ request('lang_query') == $language->code ? 'btn-primary text-white' : 'btn-light' }}">
                                                {{ $language->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('settings.seo.update', $content->id) }}" class="form-horizontal"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row mb-2">
                                    <x-forms.label name="Title" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            name="title" value="{{ $content->title }}" id="inputName"
                                            placeholder="{{ __('Title') }}">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <x-forms.label name="description" class="col-sm-2" for="inputExperience">
                                        <small class="d-block">
                                            {{ __('standard_seo_meta_descriptions_consist_160_165_characters_maximum') }}
                                            <a href="https://www.searchenginejournal.com/on-page-seo/optimize-meta-description"
                                                target="_blank">{{ __('learn_more') }}</a>
                                        </small>
                                    </x-forms.label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('description') is-invalid @enderror" cols="4" rows="4"
                                            name="description" id="description" placeholder="{{ __('Description') }}">{{ $content->description }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <x-forms.label name="Image" class="col-sm-2">
                                        <small class="d-block">
                                            {{ __('it_should_be_at_least_pixels_but_or_larger_is_preferred_up_to_mb') }}
                                        </small>
                                    </x-forms.label>
                                    <div class="col-sm-10">
                                        <input type="file" data-default-file="{{ asset($content->image) }}"
                                            class="form-control dropify" name="image" id="image">
                                    </div>
                                </div>
                                <div class="form-group row text-end">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/dropify.css">
@endsection

@section('script')
    <script>
        // dropify call
        $('.dropify').dropify({
            messages: {
                'default': 'Add a Picture',
                'replace': 'New picture',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
        // create content
        function createContent(arg) {
            $('#language_code_input').val(arg);
            $('#language_code_form').submit();
        }
    </script>
@endsection
