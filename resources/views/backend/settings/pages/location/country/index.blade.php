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
                            <h4>{{ __('country_list') }}</h4>
                        </div>

                        <div class="float-end">
                            @if (userCan('post.create'))
                                <a href="{{ route('location.country.create') }}" class="btn bg-primary">
                                    <i class="fa fa-plus"></i>&nbsp;{{ __('create_country') }}
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
                                    <input name="keyword" type="text" placeholder="{{ __('title') }}"
                                        class="form-control" value="{{ request('keyword') }}">
                                </div>
                                <div class="col-3 col-md-2">
                                    <label></label>
                                    <button type="submit" class="mt-2 form-control btn btn-primary">
                                        {{ __('search') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                        <div class="card-body">
                            <div class="dt-ext table-responsive theme-scrollbar">

                                <table class="display" id="keytable">

                                    <thead>
                                        <tr role="row" class="text-center">
                                            <th>{{ __('country') }}</th>
                                            @if (userCan('post.edit') || userCan('post.delete'))
                                                <th width="100px"> {{ __('actions') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($posts->count() > 0)
                                            @foreach ($posts as $post)
                                                <tr role="row" class="odd">
                                                    <td class=" text-center" tabindex="0">{{ $post->name }}
                                                    </td>
                                                    @if (userCan('post.update') || userCan('post.delete'))
                                                        <td class=" d-flex justify-items-center" tabindex="0">
                                                            @if (userCan('post.update'))
                                                                <a data-bs-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('edit_country') }}"
                                                                    href="{{ route('location.country.edit', $post->id) }}"
                                                                    class="btn"><i class="fa fa-edit fa-2x"></i></a>
                                                            @endif
                                                            @if (userCan('post.delete'))
                                                                <form
                                                                    action="{{ route('location.country.destroy', $post->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button data-bs-toggle="tooltip" data-placement="top"
                                                                        title="{{ __('delete_post') }}"
                                                                        onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                                        class="btn "><i
                                                                            class="text-dark fa fa-trash fa-2x"></i></button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                        @endif
                                    </tbody>
                                </table>
                                {{-- @if (request('perpage') != 'all' && $posts->total() > $posts->count())
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-center">
                                            {{ $posts->appends(['state' => request('state')])->links() }}
                                        </div>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    {{-- <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style> --}}
@endsection

@section('script')
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        // //Initialize Select2 Elements
        // $('.select2bs4').select2({
        //     theme: 'bootstrap4'
        // })


        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 15,
            footer: true,
            header: true,
            icon: 'flag-icon-gb',
            iconset: 'flagicon',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
    </script>
@endsection
