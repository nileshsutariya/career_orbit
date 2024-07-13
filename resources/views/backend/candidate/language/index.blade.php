@extends('backend.layouts.app')
@section('title')
    {{ __('candidate_language_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-warning dark">
                    This will show on the candidate's settings page. If the candidate wants, he can save from list on which
                    language
                    he knows.
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title">{{ __('candidate_language_list') }}
                                </h4>
                            </div>

                        </div>

                    </div>

                    <form id="formSubmit" action="{{ route('admin.candidate.language.index') }}" method="GET">
                        <div class="card-body border-bottom row">
                            <div class="col-4">
                                <input name="keyword" type="text" placeholder="{{ __('name') }}" class="form-control"
                                    value="{{ request('keyword') }}">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('search') }}
                                </button>
                            </div>
                        </div>
                    </form>


                    <div class="card-body">
                        <div class="dt-ext table-responsive theme-scrollbar">

                            <table class="table" id="export-button">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th>{{ __('name') }}</th>
                                        @if (userCan('candidate-language.update') || userCan('candidate-language.delete'))
                                            <th width="20%" class="text-center">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($candidate_languages->count() > 0)
                                        @foreach ($candidate_languages as $candidate_item)
                                            <tr>
                                                <td class="text-left" tabindex="0">
                                                    {{ $candidate_item->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if (userCan('candidate-language.update'))
                                                        <a href="{{ route('admin.candidate.language.edit', $candidate_item->id) }}"
                                                            class="btn">

                                                            <i class="fa fa-edit fa-2x"> </i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('candidate-language.delete'))
                                                        <form
                                                            action="{{ route('admin.candidate.language.destroy', $candidate_item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button
                                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                class="btn">
                                                                <i class="text-dark fa fa-trash-o fa-2x"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="8">
                                                {{ __('no_data_found') }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <tr>
                                        <th>{{ __('name') }}</th>
                                        @if (userCan('candidate-language.update') || userCan('candidate-language.delete'))
                                            <th width="20%" class="text-center">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                    </tr>
                                </tfoot>
                            </table>
                            @if ($candidate_languages->count())
                                <div class="mt-3 overflow-auto d-flex justify-content-center">
                                    {{ $candidate_languages->onEachSide(1)->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">
                        @if (request()->routeIs('admin.candidate.language.edit'))
                            <h3>{{ __('update') }}</h3>
                        @else
                            <h3>{{ __('create') }}</h3>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-wrapper border rounded-3">
                            @if (request()->routeIs('admin.candidate.language.edit'))
                                @if (userCan('candidate-language.update'))
                                    <form class="row g-3"
                                        action="{{ route('admin.candidate.language.update', $item->id) }}" method="POST">
                                        @method('PUT')
                                        @csrf

                                        <div class="col-md-12">
                                            <label class="form-label" name="name" @required(false)>Name </label>
                                            <input type="text" id="name" name="name" value="{{ $item->name }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="{{ __('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12 text-end">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"> </i>
                                                {{ __('Update') }} </button>
                                            <a href="{{ route('admin.candidate.language.index') }}" class="btn btn-light">
                                                {{ __('cancel') }}
                                            </a>
                                        </div>
                                    </form>
                                @endif
                            @else
                                @if (userCan('candidate-language.create'))
                                    <form class="row g-3" action="{{ route('admin.candidate.language.store') }}"
                                        method="POST">
                                        @csrf

                                        <div class="col-md-12">
                                            <label class="form-label" name="name" @required(false)>Name
                                            </label>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="{{ __('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>



                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus"> </i>
                                                {{ __('save') }} </button>
                                        </div>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection






{{-- @section('content')
    <div class="col-sm-12">
        <div class="alert alert-warning">
            This will show on the candidate's settings page. If the candidate wants, he can save from list on which language
            he knows.
        </div>
    </div>
    <div class="row">
    
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        @if (request()->routeIs('admin.candidate.language.edit'))
                            <h3 class="card-title line-height-36">{{ __('update') }}</h3>
                        @else
                            <h3 class="card-title line-height-36">{{ __('create') }}</h3>
                        @endif
                    </div>
                </div>
                <!-- Table  -->
                <div class="card-body table-responsive p-0">

                    @if (request()->routeIs('admin.candidate.language.edit'))
                        @if (userCan('candidate-language.update'))
                            <form action="{{ route('admin.candidate.language.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-forms.label name="name" :required="false" />
                                                <input type="text" id="name" name="name"
                                                    value="{{ $item->name }}"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="{{ __('name') }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn bg-success px-4">
                                                    {{ __('update') }}
                                                </button>
                                                <a href="{{ route('admin.candidate.language.index') }}"
                                                    class="btn bg-danger px-4">
                                                    {{ __('cancel') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @else
                        @if (userCan('candidate-language.create'))
                            <form action="{{ route('admin.candidate.language.store') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-forms.label name="name" :required="false" />
                                                <input type="text" id="name" name="name"
                                                    value="{{ old('name') }}"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="{{ __('name') }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn bg-success px-4">
                                                    {{ __('create') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection --}}
