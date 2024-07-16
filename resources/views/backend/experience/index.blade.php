@extends('backend.layouts.app')

@section('title')
{{ __('experience_list') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-warning dark">
                This list will be displayed on the candidate settings page. The candidate can choose his experiance from
                a list.
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                        <div class="pb-3 pb-md-0">
                            <h4 class="title">{{ __('experience_list') }}
                                ({{ count($experiences) }})</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="dt-ext table-responsive theme-scrollbar">
                        <table class="table" id="export-button">
                            <thead>
                                <tr>
                                    <th>{{ __('name') }}</th>
                                    @if (userCan('professions.update') || userCan('professions.delete'))
                                    <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($experiences as $exp)
                                <tr>
                                    <td>
                                        <h5>{{ $exp->name }}</h5>
                                        <div>
                                            @foreach ($exp->translations as $translation)
                                            @if (app()->getLocale() == $translation->locale)
                                            @else
                                            <span class="d-block"><b>{{ getLanguageByCodeInLookUp($translation->locale,
                                                    $app_language) }}</b>:
                                                {{ $translation->name }}
                                            </span>
                                            @endif
                                            @endforeach
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if (userCan('professions.update'))
                                            <a href="{{ route('experience.edit', $exp->id) }}" class="btn"> <i
                                                    class="fa fa-edit fa-2x txt-success"> </i>
                                            </a>
                                            @endif
                                            @if (userCan('professions.delete'))
                                            <form action="{{ route('experience.destroy', $exp->id) }}" method="POST"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                    class="btn"><i class="txt-danger fa fa-trash-o fa-2x"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
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

        <div class="col-md-4">
            @if (!empty($experience) && userCan('professions.update'))
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        <h4>{{ __('edit') }} {{ __('experience') }}</h4>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('experience.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i>{{
                            __('create') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <form class="row g-3" action="{{ route('experience.update', $experience->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        @foreach ($app_language as $key => $language)
                        @php
                        $label =
                        __('name') .
                        ' ' .
                        getLanguageByCodeInLookUp($language->code, $app_language);
                        $name = "name_{$language->code}";
                        $code = $experience->translations[$key]['locale'] ?? '';
                        $data = $experience->translations
                        ->where('locale', $language->code)
                        ->first();
                        $value = $data ? $data->name : '';
                        @endphp
                        <div class="col-md-12">
                            <label class="form-label" name="$label" for="name" @required(true)>{{ __($label) }}
                                <spna class="text-red"> * </spna>
                            </label>
                            <input id="name" type="text" name="{{ $name }}" placeholder="{{ __('name') }}"
                                value="{{ $value }}" class="form-control @if ($errors->has($name)) is-invalid @endif">
                            @if ($errors->has($name))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first($name) }}</strong>
                            </span>
                            @endif
                        </div>
                        @endforeach
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"> </i> {{ __('save') }} </button>
                        </div>
                    </form>
                </div>
            </div>
            @else
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('create') }} {{ __('experience') }}</h4>
                </div>
                <div class="card-body">

                    @if (userCan('job_role.create'))
                    <form class="row g-3" action="{{ route('experience.store') }}" method="POST">
                        @csrf
                        @foreach ($app_language as $key => $language)
                        @php
                        $label =
                        __('name') .
                        ' ' .
                        getLanguageByCodeInLookUp($language->code, $app_language);
                        $name = "name_{$language->code}";
                        @endphp
                        <div class="col-md-12">
                            <label class="form-label" name="$label" for="name" @required(true)>{{ __($label) }}
                                <spna class="text-red"> * </spna>
                            </label>
                            <input id="name" type="text" name="{{ $name }}" placeholder="{{ __('name') }}"
                                value="{{ old('name') }}"
                                class="form-control @if ($errors->has($name)) is-invalid @endif">
                            @if ($errors->has($name))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first($name) }}</strong>
                            </span>
                            @endif
                        </div>
                        @endforeach
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"> </i>
                                {{ __('save') }} </button>
                        </div>
                    </form>
                    @else
                    <p>{{ __('dont_have_permission') }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection