@extends('backend.layouts.app')

@section('title')
    {{ __('pages') }}
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
                <li class="breadcrumb-item active">{{ __('pages') }}</li>
            </ol>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            <h3>{{ __('pages') }}</h3>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('settings.pages.create') }}" class="btn bg-primary">
                                <i class="fa fa-plus"></i>
                                {{ __('create') }}
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive theme-scrollbar">
                            <table class="table" id="export-button">
                                <thead>
                                    <tr>
                                        <th>{{ __('title') }}</th>
                                        <th>{{ __('page_url') }}</th>
                                        <th>{{ __('show_on_header') }}</th>
                                        <th>{{ __('show_on_footer') }}</th>
                                        <th width="15%">{{ __('action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pages as $key => $page)
                                        <tr>
                                            <td>{{ $page->title }}</td>
                                            <td><a href="{{ route('showCustomPage', $page->slug) }}"
                                                    target="_blank">{{ route('showCustomPage', $page->slug) }}</a></td>
                                            <td tabindex="0">
                                                <a href="javascript:void(0)">
                                                    <div class="form-check-size">
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input data-id="{{ $page->id }}"
                                                                class="form-check-input switch-primary check-size success show_in_header"
                                                                type="checkbox" role="switch"
                                                                {{ $page->show_header ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td tabindex="0">
                                                <a href="javascript:void(0)">
                                                    <div class="form-check-size">
                                                        <div class="form-check form-switch form-check-inline ">
                                                            <input data-userid="{{ $page->id }}"
                                                                class="form-check-input switch-primary check-size success show_in_footer"
                                                                type="checkbox" role="switch"
                                                                {{ $page->show_footer ? 'checked' : '' }}>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('settings.pages.edit', $page->id) }}" class="btn">
                                                        <i class="txt-secondary fa fa-edit fa-2x"></i>
                                                    </a>
                                                    <form action="{{ route('settings.pages.delete', $page->id) }}"
                                                        class="d-inline" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-bs-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                            class="btn"><i
                                                                class="txt-danger fa fa-trash fa-2x"></i></button>
                                                    </form>
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
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $('.show_in_header').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('settings.pages.header.status') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });

        $('.show_in_footer').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('userid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('settings.pages.footer.status') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        });
    </script>
@endsection
