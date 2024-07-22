@extends('backend.settings.setting-layout')
@section('title')
    {{ __('currency_list') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('currency') }} {{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item ">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('currency_list') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('website-settings')
    <div class="container-fluid">
        <form class="row" action="{{ route('module.currency.default') }}" method="POST">
            @csrf
            <div class="col-md-3 mb-4">
                <div class="">
                    <x-forms.label name="{{ __('set_default_currency') }}" class="" for="inlineFormCustomSelect" />
                    <div class="d-flex align-items-center">
                        <select name="currency" class="form-select select2 " id="inlineFormCustomSelect">
                            <option value="" disabled selected>{{ __('Currency') }}</option>
                            @foreach ($currencies as $key => $currency)
                                <option {{ config('templatecookie.currency') == $currency->code ? 'selected' : '' }}
                                    value="{{ $currency->id }}">
                                    {{ $currency->name }} ( {{ $currency->code }} )
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary m-l-10">{{ __('save') }}</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    <h4>{{ __('currency_list') }}</h4>
                </div>

                <div class="float-end">
                    <a href="{{ route('module.currency.create') }}" class="btn bg-primary">
                        <i class="fa fa-plus"></i>
                        {{ __('create') }}
                    </a>
                </div>

            </div>
            <div class=" card-body dt-ext table-responsive theme-scrollbar">

                <table class="table" id="export-button">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>{{ __('name') }}</th>
                            <th>{{ __('code') }}</th>
                            <th>{{ __('symbol') }}</th>
                            <th>{{ __('rate') }}</th>
                            <th>{{ __('position') }}</th>
                            <th width="15%">{{ __('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($currencies as $key => $currency)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ $currency->name }}
                                    @if (config('templatecookie.currency') == $currency->code)
                                        <span class="badge badge-pill badge-primary">
                                            {{ __('default') }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $currency->code }}</td>
                                <td>{{ $currency->symbol }}</td>
                                <td>{{ $currency->rate }}</td>
                                <td>{{ ucfirst($currency->symbol_position) }}</td>
                                <td class="d-flex justify-content-center align-items-center">
                                    @if ($currency->code == 'USD')
                                        <a href="javascript:void(0)" class="btn " data-bs-toggle="tooltip"
                                            title="You can't delete or edit this currency">
                                            <i class="fa fa-lock fa-2x"></i>
                                        </a>
                                    @endif
                                    @if ($currency->code != 'USD')
                                        <a data-bs-toggle="tooltip" data-placement="top" title="{{ __('edit') }}"
                                            href="{{ route('module.currency.edit', $currency->id) }}" class="btn"><i
                                                class="txt-success fa fa-edit fa-2x"></i></a>
                                        <form action="{{ route('module.currency.delete', $currency->id) }}"
                                            class="d-inline" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button data-bs-toggle="tooltip" data-placement="top"
                                                title="{{ __('delete') }}"
                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                class="btn"><i class="txt-danger fa fa-trash fa-2x"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">
                                    <x-not-found word="currency" route="module.currency.create" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($currencies->total() > $currencies->count())
                <div class="card-footer ">
                    <div class="d-flex justify-content-center">
                        {{ $currencies->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $('input[name="default"]').on('switchChange.bootstrapSwitch', function(event, state) {
            $('#' + event.currentTarget.id).submit();
        });
    </script>
@endsection
