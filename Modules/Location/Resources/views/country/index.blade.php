@extends('backend.layouts.app')
@section('title')
    {{ __('country_list') }}
@endsection

@section('style')
    <style>
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .customRow1 {
                margin-top: 10px;
            }

            .customRow2 {
                margin-top: 10px;
                padding-left: 15px;
                padding-right: 15px;
            }

            .customdiv1 {
                margin-top: 5px;
                margin-right: .5rem !important;
            }

            .customdiv2 {
                margin-top: 5px;
                margin-right: .5rem !important;
            }

            .customdiv3 {
                margin-top: 5px;
                margin-bottom: 5px;
                margin-right: .5rem !important;
            }
        }
    </style>

    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/flag-icon.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection

@section('script')
    {{-- Flat Icon Css Link --}}
    <script src="{{ asset('backend') }}/plugins/flagicon/dist/js/bootstrap-iconpicker.bundle.min.js"></script>

    <script>
        $("#checkboxAll").on('click', function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
            SelectIds();
        });
        $(".sub_chk").on('click', function() {
            SelectIds();
        });

        function SelectIds() {

            var Ids = [];
            $(".sub_chk:checked").each(function() {
                Ids.push($(this).attr('data-id'));
            });
            $('#selectedCount').html(parseInt(Ids.length));
            if (Ids != 0) {
                // Show Delete Button
                $('#DeleteButton').removeClass('d-none');
            } else {
                // Hide Delete Button
                $('#DeleteButton').addClass('d-none');
            }
        }

        function MultiDelete() {

            var Ids = [];
            $(".sub_chk:checked").each(function() {
                Ids.push($(this).attr('data-id'));
            });

            if (Ids != 0) {

                if (confirm("{{ __('are_you_sure_you_want_to_delete_this_item') }}") == true) {
                    AjaxCall(Ids);
                } else {
                    return false;
                }

            } else {
                alert('Please Select First');
            }
        }

        function AjaxCall(value) {
            $.ajax({
                url: "{{ route('module.country.multiple.delete') }}",
                type: "Delete",
                data: {
                    ids: value,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    location.reload();
                }
            });
        };
    </script>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">

                        <div class="float-start">
                            <h4 class="title">{{ __('country_list') }}
                                ({{ $allCountries->count() }})</h4>
                        </div>
                        <div>
                            <div class="float-end">
                                @if (userCan('country.create'))
                                    <a href="{{ route('module.country.create') }}" class="btn btn-primary ">
                                        <i class="fa fa-plus"></i>
                                        &nbsp; {{ __('create') }}
                                    </a>
                                @endif

                                <button id="DeleteButton" onclick="MultiDelete()" data-toggle="tooltip" data-placement="top"
                                    title="{{ __('delete_selected_countries') }}" class="d-none btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                    <span class="ml-1">
                                        {{ __('delete') }}
                                        <span id="selectedCount"
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                        </span>


                                    </span>
                                </button>

                            </div>
                        </div>

                    </div>




                    <div
                        class="row {{ $setting->app_country_type === 'single_base' ? 'justify-content-between' : 'justify-content-end' }}">
                        @if ($setting->app_country_type === 'single_base')
                            <div class="col-md-6 col-sm-12 col-lg-4">
                                <div class="px-3">{{ __('app_country') }}</div>
                                <form action="{{ route('module.set.app.country') }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-space-between px-3">
                                        <select name="country" class="form-select  select2 m-r-20">
                                            @foreach ($allCountries as $country)
                                                <option {{ $setting->app_country == $country->id ? 'selected' : '' }}
                                                    value="{{ $country->id }}" class="">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary btn bg-primary" type="submit">
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="col-md-6 col-sm-12 col-lg-4">
                            <form id="formSubmit" action="{{ route('module.country.index') }}" method="GET">
                                <div class="d-flex justify-space-between px-3 my-4">
                                    <input type="text"
                                        @if (request('name')) value="{{ request('name') }}" @endif
                                        id="name" class="form-control m-r-20"
                                        placeholder="{{ __('enter') }} {{ __('search') }}..." name="name"
                                        aria-label="">
                                    <button class="btn btn-primary btn bg-primary" type="submit">
                                        {{ __('search') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card-body">


                        <div class="table-responsive theme-scrollbar signal-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        @if ($countries->count() > 1)
                                            <th scope="col" width="4%">
                                                <div class="icheck-primary ml-1">
                                                    <input type="checkbox" id="checkboxAll">
                                                    <label for="checkboxAll">
                                                    </label>
                                                </div>
                                            </th>
                                        @endif
                                        <th scope="col"width="5%">#</th>
                                        <th scope="col">{{ __('image') }}</th>
                                        <th scope="col">{{ __('name') }}</th>
                                        @if (userCan('country.update') || userCan('country.delete'))
                                            <th scope="col" width="12%">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($countries->count() > 0)
                                        @foreach ($countries as $country)
                                            <tr>
                                                @if ($countries->count() > 1)
                                                    <td>
                                                        <div class="icheck-primary ml-1">
                                                            <input type="checkbox" data-id={{ $country->id }}
                                                                class="sub_chk" id="checkbox{{ $country->id }}">
                                                            <label for="checkbox{{ $country->id }}">
                                                            </label>
                                                        </div>
                                                    </td>
                                                @endif
                                                <td>
                                                    {{ $country->id }}
                                                </td>
                                                <td>

                                                    <img class="img-60 img-h-60" src="{{ asset($country->image) }}"
                                                        alt="{{ $country->name }}">

                                                </td>
                                                <td>

                                                    {{ $country->name }}

                                                </td>
                                                @if (userCan('country.update') || userCan('country.delete'))
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if (userCan('country.update'))
                                                                <a data-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('edit') }}"
                                                                    href="{{ route('module.country.edit', $country->id) }}"
                                                                    class="btn"> <i
                                                                        class="text-dark fa fa-edit fa-2x"></i>
                                                                </a>
                                                            @endif
                                                            @if (userCan('country.delete'))
                                                                <form
                                                                    action="{{ route('module.country.delete', $country->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button data-toggle="tooltip" data-placement="top"
                                                                        title="{{ __('delete') }}"
                                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                        class="btn"> <i
                                                                            class="text-dark fa fa-trash-o fa-2x"></i></button>
                                                                </form>
                                                            @endif
                                                        </div>

                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>
                @if (request('perpage') != 'all' && $countries->total() > $countries->count())
                    <div class="m-b-10 d-flex justify-content-center pagination pagination-primary pagin-border-primary">
                        {{ $countries->links() }}
                    </div>
                @endif
            </div>

        </div>

    </div>
@endsection
