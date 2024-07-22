@extends('backend.settings.setting-layout')

@section('title')
    {{ __('seo') }}
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
                <li class="breadcrumb-item active">{{ __('seo') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="alert alert-warning mb-3">
        {{ __('improve_your_site_ranking_by_adding_seo_information_to_your_pages') }}
        <hr class="my-2">
        {{ __('seo_is_crucial_because_it_makes_your_website_more_visible_and_that_means_more_traffic_and_more_opportunities_to_convert_prospects_into_customers_check_out_the_seo_tools_you_can_use_for_optimal_ranking') }}
    </div>
    <div class="card">
        <div class="card-header">
            <div class="d-md-flex justify-content-between">
                <div class="row flex-grow-1">
                    <h3 class="col-12 col-md-4">{{ __('seo_page_list') }}</h3>
                    <div class="col-md-8">
                        <div class="d-flex flex-wrap align-items-center ">
                            @foreach ($languages as $language)
                                <a href="{{ route('settings.seo.index', ['lang_query' => $language->code]) }}"
                                    class="a-color">
                                    <div class="badge rounded-pill text-dark m-r-10">
                                        <div
                                            class="single-tag {{ request('lang_query') == $language->code || (!request('lang_query') && $language->code == 'en') ? 'single-tag-active' : '' }}">
                                            {{ $language->name }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-2 mt-md-0">
                    <a href="{{ route('settings.generateSitemap') }}" class="btn btn-primary">
                        {{ __('generate_sitemap') }}
                    </a>
                    <a target="_blank" href="/sitemap.xml" class="btn btn-secondary">
                        {{ __('view_sitemap') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-ext table-responsive theme-scrollbar">

                <table class="table" id="export-button">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="max-width: 300px;"> {{ __('page_name') }} </th>
                            <th style="max-width: 300px;"> {{ __('meta_title') }} </th>
                            <th style="max-width: 500px;">
                                {{ __('meta_description') }}
                                ({{ request('lang_query') ?? __('en') }})
                            </th>
                            <th width="250">{{ __('page_preview_image') }} </th>
                            <th width="100">{{ __('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($seos->count() > 0)
                            @foreach ($seos as $seo)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <div class="badge badge-primary">
                                            {{ Str::ucfirst($seo->page_slug) }}
                                        </div>
                                    </td>
                                    <td style="max-width: 300px; white-space: normal">
                                        @foreach ($seo->contents as $content)
                                            {{ $content->title }}
                                        @endforeach
                                    </td>
                                    <td style="max-width: 500px; white-space: normal">
                                        @foreach ($seo->contents as $content)
                                            {{ $content->description }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($seo->contents as $content)
                                            <img style="height: auto; width: 200px; object-fit: contain"
                                                src="{{ asset($content->image) }}" alt="image">
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('settings.seo.edit', [$seo->id, 'lang_query' => request('lang_query') ?? 'en']) }}"
                                            class="btn border">
                                            <i class="fa fa-gear fa-2x "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
