@extends('backend.layouts.app')
@section('title')
    {{ __('organization_types_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-warning dark">
                    This list will be displayed on the company settings page as well as the profile setup page. The company
                    can select which organization type his company was in from a list.
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title">{{ __('organization_types_list') }}
                                    ({{ $organizationTypes ? count($organizationTypes) : '0' }})</h4>
                            </div>
                            <div>
                                <div class="d-flex flex-row">

                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                        data-bs-target="#tooltipmodal"><i class="fa fa-plus"> </i>
                                        {{ __('bulk_import') }}</button>


                                </div>
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
                                    @forelse ($organizationTypes as $key => $organizationtype)
                                        <tr>
                                            <td>
                                                <h5>{{ $organizationtype->name }}</h5>
                                                <div>
                                                    @foreach ($organizationtype->translations as $translation)
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
                                                <a href="{{ route('organizationType.edit', $organizationtype->id) }}"
                                                    class="btn">
                                                    <i class="text-dark fa fa-edit fa-2x"></i>
                                                </a>

                                                <form
                                                    action="{{ route('organizationType.destroy', $organizationtype->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                        class="btn"> <i class="text-dark fa fa-trash-o fa-2x"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                {{ __('no_data_found') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>{{ __('name') }}</th>
                                        <th width="10%">{{ __('action') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4">
                @if (empty($organizationType))
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('create') }} {{ __('organization_type') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">

                                <form class="row g-3" action="{{ route('organizationType.store') }}" method="POST">
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
                                            <label class="form-label" name="$label" for="name" @required(true)>Name
                                                English<spna class="text-red"> * </spna></label>
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

                @if (!empty($organizationType))
                    <div class="card">
                        <div class="card-header">

                            <div class="float-start">
                                <h4>{{ __('edit') }} {{ __('organization_type') }}</h4>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('organizationType.index') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>{{ __('create') }}
                                </a>
                            </div>



                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">

                                <form class="row g-3"
                                    action="{{ route('organizationType.update', $organizationType->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    @foreach ($app_language as $key => $language)
                                        @php
                                            $label =
                                                __('name') .
                                                ' ' .
                                                getLanguageByCodeInLookUp($language->code, $app_language);
                                            $name = "name_{$language->code}";
                                            $code = $organizationType->translations[$key]['locale'] ?? '';
                                            $data = $organizationType->translations
                                                ->where('locale', $language->code)
                                                ->first();
                                            $value = $data ? $data->name : '';
                                        @endphp
                                        <div class="col-md-12">
                                            <label class="form-label" name="$label" for="name" @required(true)>Name
                                                English
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


        <div class="modal fade" id="tooltipmodal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('bulk_import') }}</h4>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.organization.type.bulk.import') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning dark" role="alert">
                                <p> Before importing, please download the example file and match the fields structure. If
                                    any
                                    field data is missing, the system will generate it</p>
                            </div>

                            <div class="col-md-12">
                                <label for="experience">{{ __('example_file') }}</label> <br>
                                <div class="d-grid gap-2">
                                    <a href="/backend/dummy/organization_type_example.xlsx" target="_blank"
                                        class="btn btn-primary">
                                        <i class="fa fa-download"></i>
                                        {{ __('download') }} {{ __('example_file') }}
                                    </a>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="experience">{{ __('choose_file') }}</label> <br>
                                <input type="file" class="form-control dropify" name="import_file"
                                    data-allowed-file-extensions='["csv", "xlsx","xls"]' accept=".csv,.xlsx,.xls"
                                    data-max-file-size="3M">
                                @error('import_file')
                                    <span class="invalid-feedback d-block" role="alert">{{ __($message) }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="submit">{{ __('submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
@endsection
