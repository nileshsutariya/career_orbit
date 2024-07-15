@extends('backend.layouts.app')
@section('title')
    {{ __('tag_list') }}
@endsection

@section('style')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('script')
    <script>
        // tag status change call ajax
        $('.tag-status').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            var url = "{{ route('tags.status.change', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: url,
                data: {
                    'status': status,
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });
    </script>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-warning dark">
                    This list will be displayed on the job creation page. The company can select relevant job tags from a
                    list.
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title">{{ __('tag_list') }}
                                    ({{ count($tags) }})</h4>
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
                                        <th>
                                            {{ __('show_popular_list') }}

                                            <i class=" text-danger fa fa-exclamation-circle fa-lg"></i>

                                        </th>
                                        @if (userCan('tags.update') || userCan('tags.delete'))
                                            <th width="10%">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tags as $item)
                                        <tr>
                                            <td>
                                                <h5>{{ Str::ucfirst($item->name) }}</h5>
                                                <div>
                                                    @foreach ($item->translations as $translation)
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
                                            <td>
                                                <a href="#">
                                                    <div class="form-check-size">
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input class="form-check-input switch-primary check-size"
                                                                type="checkbox" data-id="{{ $item->id }}"
                                                                role="switch"
                                                                {{ $item->show_popular_list == 1 ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                @if (userCan('tags.update'))
                                                    <a href="{{ route('tags.edit', $item->id) }}" class="btn"><i
                                                            class="fa fa-edit fa-2x"></i></a>
                                                @endif
                                                @if (userCan('tags.delete'))
                                                    <form action="{{ route('tags.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                            class="btn"><i class="text-dark fa fa-trash-o fa-2x"></i>
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
                @if (empty($tag) && userCan('tags.create'))
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('create') }} {{ 'tag' }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">
                                @if (userCan('tags.create'))
                                    <form class="row g-3" action="{{ route('tags.store') }}" method="POST"
                                        enctype="multipart/form-data">
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
                                                <label class="form-label" name="$label" for="name"
                                                    @required(true)>{{ __($label) }}<spna class="text-red"> * </spna>
                                                </label>
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
                                @else
                                    <p>{{ __('dont_have_permission') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                @if (!empty($tag) && userCan('tags.update'))
                    <div class="card">
                        <div class="card-header">

                            <div class="float-start">
                                <h4>{{ __('edit') }} {{ 'tag' }}</h4>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('tags.index') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>{{ __('create') }}
                                </a>
                            </div>



                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">

                                <form class="row g-3" action="{{ route('tags.update', $tag->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    @foreach ($app_language as $key => $language)
                                        @php
                                            $label =
                                                __('name') .
                                                ' ' .
                                                getLanguageByCodeInLookUp($language->code, $app_language);
                                            $name = "name_{$language->code}";
                                            $code = $tag->translations[$key]['locale'] ?? '';
                                            $data = $tag->translations->where('locale', $language->code)->first();
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

        <div class="modal fade" id="tooltipmodal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('bulk_import') }}</h4>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.tags.bulk.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-warning dark" role="alert">
                                <p> Before importing, please download the example file and match the fields structure. If
                                    any
                                    field data is missing, the system will generate it</p>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="experience">{{ __('example_file') }}</label> <br>
                                <div class="d-grid gap-2">
                                    <a href="/backend/dummy/tags_example.xlsx" target="_blank" class="btn btn-primary">
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
