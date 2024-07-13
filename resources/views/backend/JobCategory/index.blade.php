@extends('backend.layouts.app')
@section('title')
{{ __('job_category_list') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                        <div class="pb-3 pb-md-0">
                            <h4 class="title"> {{ __('job_category_list') }} ({{ count($jobCategories) }})</h4>
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

                        <table class="display" id="keytable">
                            <thead>
                                <tr>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('icon') }}</th>
                                    <th>{{ __('name') }}</th>
                                    @if (userCan('job_category.update') || userCan('job_category.delete'))
                                    <th width="10%">{{ __('action') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobCategories as $category)
                                <tr>
                                    <td><img src="{{ $category->image_url }}" alt="category"
                                            class="img-fluid table-avtar" height="50px" width="50px"></td>
                                    <td>
                                        <i class="{{ $category->icon }}"></i>
                                    </td>
                                    <td>
                                        <h5>{{ $category->name }}</h5>
                                        <div>
                                            @foreach ($category->translations as $translation)
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
                                    <td class="d-flex align-items-center">
                                        @if (userCan('job_category.update'))
                                        <a href="{{ route('jobCategory.edit', $category->id) }}" class="btn">
                                            <p class="text-dark"><i class="fa fa-edit" style="font-size: 26px;"></i></p>
                                        </a>
                                        @endif
                                        @if (userCan('job_category.delete'))
                                        <form action="{{ route('jobCategory.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                class="btn">
                                                <p class="text-dark"><i class="fa fa-trash-o"
                                                        style="font-size: 26px;"></i></p>
                                            </button>
                                        </form>
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

        <div class="col-md-4">
            @if (empty($jobCategory) && userCan('job_category.create'))
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('create') }} {{ 'category' }}</h4>
                </div>
                <div class="card-body">

                    @if (userCan('job_category.create'))
                    <form class="row g-3" action="{{ route('jobCategory.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        @foreach ($app_language as $key => $language)
                        @php
                        $label = __('name') . ' ' . getLanguageByCode($language->code);
                        $name = "name_{$language->code}";
                        @endphp

                        <div class="col-md-12">
                            <label class="form-label" name="$label" for="name" @required(true)>Name <spna
                                    class="text-red"> * </spna></label>
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

                        <div class="col-md-12">
                            <label class="form-label">Image</label>
                            <input name="image" class="form-control" autocomplete="image" type="file" id="image">
                        </div>
                        <div class="col-md-12">
                            <div>
                                <label class="form-label" @required(true)>Icon</label>
                            </div>

                            <div style="overflow-x: auto;">
                                <input type="hidden" name="icon" id="icon" value="{{ old('icon') }}" />
                                <div id="target"></div>
                                @error('icon')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message
                                        }}</strong></span>
                                @enderror
                            </div>
                        </div>

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

            @if (!empty($jobCategory) && userCan('job_category.update'))
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('edit') }} {{ 'category' }}</h4>
                    </div>
                    <div class="float-end">
                        <a href="{{ route('jobCategory.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i>{{
                            __('create') }}
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    
                        <form class="row g-3" action="{{ route('jobCategory.update', $jobCategory->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @foreach ($app_language as $key => $language)
                            @php
                            $label = __('name') . ' ' . getLanguageByCode($language->code);
                            $name = "name_{$language->code}";
                            $code = $jobCategory->translations[$key]['locale'] ?? '';
                            $data = $jobCategory->translations
                            ->where('locale', $language->code)
                            ->first();
                            $value = $data ? $data->name : '';
                            @endphp

                            <div class="col-md-12">
                                <label class="form-label" name="$label" for="name" @required(true)>Name
                                    <spna class="text-red"> * </spna>
                                </label>
                                <input id="name" type="text" name="{{ $name }}" placeholder="{{ __('name') }}"
                                    value="{{ $value }}"
                                    class="form-control @if ($errors->has($name)) is-invalid @endif">
                                @if ($errors->has($name))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first($name) }}</strong>
                                </span>
                                @endif
                            </div>
                            @endforeach

                            <div class="col-md-12">
                                <label class="form-label">Image</label>
                                <input name="image" class="form-control" autocomplete="image" type="file" id="image">
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label" @required(true)>Icon</label>
                                </div>

                                <div class="col-sm-12" style="overflow-x: auto;">
                                    <input type="hidden" name="icon" id="icon" value="{{ $jobCategory->icon }}" />
                                    <div id="target"></div>
                                    @error('icon')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message
                                            }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-reload"> </i>
                                    {{ __('save') }} </button>
                            </div>
                        </form>
                    
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
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.job.category.bulk.import') }}" method="post"
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
                                <a href="/backend/dummy/job_category_example.xlsx" target="_blank"
                                    class="btn btn-primary">
                                    <i class="fa fa-download"></i>
                                    {{ __('download') }} {{ __('example_file') }}
                                </a>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="experience">{{ __('choose_file') }}</label> <br>
                            <input type="file" class="form-control" name="import_file"
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

@section('style')
<!-- Bootstrap-Iconpicker -->
<link rel="stylesheet"
    href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
@endsection

@section('script')
<!-- Bootstrap-Iconpicker Bundle -->
<script type="text/javascript"
    src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
<script type="text/javascript"
    src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js"></script>

<script>
    // iconpicker call
        $('#target').iconpicker({
            align: 'center', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 12,
            footer: true,
            header: true,
            icon: '{{ $jobCategory->icon ?? 'fas fa-bomb' }}',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 4,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: '',
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
</script>
@endsection