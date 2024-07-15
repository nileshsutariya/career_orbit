@extends('backend.layouts.app')
@section('title')
    {{ __('salary_types_list') }}
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-warning dark">
                    This list will be displayed on the company settings page as well as the profile setup page. The company
                    can select which Salary type from a list.
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title">{{ __('salary_types_list') }}
                                    ({{ $salaryTypes ? count($salaryTypes) : '0' }})</h4>
                            </div>

                        </div>
                    </div>


                    <div class="card-body">
                        <div class="dt-ext table-responsive theme-scrollbar">

                            <table class="table" id="export-button">
                                <thead>
                                    <tr>
                                        <th>{{ __('name') }}</th>
                                        <th width="10%">{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($salaryTypes as $key => $salaryType)
                                        <tr>
                                            <td>
                                                <h5>{{ $salaryType->name }}</h5>
                                                <div>
                                                    @foreach ($salaryType->translations as $translation)
                                                        @if (app()->getLocale() == $translation->locale)
                                                        @else
                                                            <span
                                                                class="d-block"><b>{{ getLanguageByCodeInLookUp($translation->locale, $app_language) }}</b>:
                                                                {{ $translation->name }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <a href="{{ route('salaryType.edit', $salaryType->id) }}" class="btn">
                                                    <i class="fa fa-edit fa-2x"> </i>
                                                </a>

                                                <form action="{{ route('salaryType.destroy', $salaryType->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                        class="btn"><i class="text-dark fa fa-trash-o fa-2x"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <tr>
                                        <th>{{ __('name') }}</th>
                                        <th width="10%">{{ __('action') }}</th>
                                    </tr>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                @if (empty($salaryType_id))
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('create') }} {{ __('salary_type') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">

                                <form class="row g-3" action="{{ route('salaryType.store') }}" method="POST">
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
                                            <label class="form-label" name="$label" for="name" @required(true)>
                                                {{ __($label) }}<spna class="text-red"> * </spna></label>
                                            <input id="name" type="text" name="{{ $name }}"
                                                placeholder="{{ __('name') }}" value="{{ old('name') }}"
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

                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($salaryType_id))
                    <div class="card">
                        <div class="card-header">

                            <div class="float-start">
                                <h4>{{ __('edit') }} {{ __('salary_type') }}</h4>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('salaryType.index') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>{{ __('create') }}
                                </a>
                            </div>



                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">

                                <form class="row g-3" action="{{ route('salaryType.update', $salaryType_id->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    @foreach ($app_language as $key => $language)
                                        @php
                                            $label =
                                                __('name') .
                                                ' ' .
                                                getLanguageByCodeInLookUp($language->code, $app_language);
                                            $name = "name_{$language->code}";
                                            $code = $salaryType_id->translations[$key]['locale'] ?? '';
                                            $data = $salaryType_id->translations
                                                ->where('locale', $language->code)
                                                ->first();
                                            $value = $data ? $data->name : '';
                                        @endphp
                                        <div class="col-md-12">
                                            <label class="form-label" name="$label" for="name"
                                                @required(true)>{{ __($label) }}
                                                <spna class="text-red"> * </spna>
                                            </label>
                                            <input id="name" type="text" name="{{ $name }}"
                                                placeholder="{{ __('name') }}" value="{{ $value }}"
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
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
@endsection
