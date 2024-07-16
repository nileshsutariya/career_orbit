@extends('backend.layouts.app')
@section('title')
{{ __('post_list') }}
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('state_list') }}</h4>
                    </div>
                    <div class="float-end">
                        @if (userCan('post.create'))
                        <a href="{{ route('location.state.create') }}" class="btn bg-primary">
                            <i class="fa fa-plus"></i>&nbsp;{{ __('create_state') }}
                        </a>
                        @endif
                    </div>

                </div>
                <div class="">
                    <!-- filter -->
                    <form id="formSubmit" action="" method="GET" onchange="this.submit();">
                        <div class="card-body  row">
                            <div class="col-12 col-md-3">
                                <label>{{ __('search') }}</label>
                                <input name="keyword" type="text" placeholder="{{ __('title') }}" class="form-control"
                                    value="{{ request('keyword') }}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label>{{ __('country') }}</label>
                                <select name="country" class="select2  form-control w-100-p">
                                    <option value="" {{ !request('country') ? 'selected' : '' }}>
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($countries as $country)
                                    <option {{ request('country')==$country->id ? 'selected' : '' }}
                                        value="{{ $country->id }}">
                                        {{ Str::ucfirst($country->name) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 col-md-2">
                                <label></label>
                                <button type="submit" class="mt-2 form-control btn btn-primary">
                                    {{ __('search') }}
                                </button>
                            </div>
                        </div>

                    </form>
                    <div class="table-responsive theme-scrollbar signal-table">
                        <table class="table table-hover">
                            <thead>
                                <tr >
                                    <th scope="col">{{ __('state') }}</th>
                                    <th scope="col">{{ __('country') }}</th>
                                    @if (userCan('post.edit') || userCan('post.delete'))
                                    <th scope="col" width="100px"> {{ __('actions') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($states->count() > 0)
                                @foreach ($states as $state)
                                <tr >
                                    <td>{{ $state->name }}
                                    </td>
                                    <td>
                                        {{ Str::ucfirst($state->country->name) }}</td>
                                    @if (userCan('post.update') || userCan('post.delete'))
                                    <td class="d-flex justify-items-center">
                                        @if (userCan('post.update'))
                                        <a data-bs-toggle="tooltip" data-placement="top" title="{{ __('edit_state') }}"
                                            href="{{ route('location.state.edit', $state->id) }}" class="btn"><i
                                                class="txt-success fa fa-edit fa-2x"></i></a>
                                        @endif
                                        @if (userCan('post.delete'))
                                        <form action="{{ route('location.state.destroy', $state->id) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button data-bs-toggle="tooltip" data-placement="top"
                                                title="{{ __('delete_state') }}"
                                                onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                class="btn"><i class="txt-danger fa fa-trash-o fa-2x"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="text-center" colspan="4">{{ __('no_data_found') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>

                    <div class="card-footer">
                        @if (request('perpage') != 'all' && $states->total() > $states->count())
                        <div
                            class="d-flex  m-b-10 justify-content-center pagination pagination-primary pagin-border-primary">
                            {{ $states->appends(['country' => request('country')])->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection