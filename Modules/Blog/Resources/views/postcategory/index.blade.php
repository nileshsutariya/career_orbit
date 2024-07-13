@extends('backend.layouts.app')
@section('title')
    {{ __('category_list') }}
@endsection
{{-- @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-36">{{ __('category_list') }}</h3>
                        @if (userCan('post.create'))
                            <a href="{{ route('module.category.create') }}"
                                class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-plus"></i>&nbsp;{{ __('create') }}</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                        role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row" class="text-center">
                                                <th width="5%">#</th>
                                                <th>{{ __('image') }}</th>
                                                <th>{{ __('name') }} ({{ __('posts') }})</th>
                                                @if (userCan('post.update') || userCan('post.delete'))
                                                    <th width="150px"> {{ __('action') }}</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach ($categories as $category)
                                                <tr role="row" class="odd">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        <img width="50px" height="50px" class="rounded"
                                                            src="{{ $category->image_url }}" alt="{{ $category->name }}">
                                                    </td>
                                                    <td class="sorting_1 text-center" tabindex="0">
                                                        {{ $category->name }}({{ $category->posts_count }})
                                                    </td>
                                                    @if (userCan('post.update') || userCan('post.delete'))
                                                        <td class="sorting_1 text-center" tabindex="0">
                                                            @if (userCan('post.update'))
                                                                <a data-toggle="tooltip" data-placement="top"
                                                                    title="{{ __('edit') }}"
                                                                    href="{{ route('module.category.edit', $category->id) }}"
                                                                    class="btn bg-info"><i
                                                                        class="fas fa-edit"></i></a>
                                                            @endif
                                                            @if (userCan('post.delete'))
                                                                <form
                                                                    action="{{ route('module.category.delete', $category->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button data-toggle="tooltip" data-placement="top"
                                                                        title="{{ __('delete') }}"
                                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                        class="btn bg-danger"><i
                                                                            class="fas fa-trash"></i></button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection --}}


@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title"> {{ __('category_list') }}</h4>
                            </div>
                            <div>
                                <div class="d-flex flex-row">
                                    @if (userCan('post.create'))
                                        <a href="{{ route('module.category.create') }}" class="btn btn-primary"><i
                                                class="fa fa-plus"></i>&nbsp;{{ __('create') }}</a>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="dt-ext table-responsive theme-scrollbar">

                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('image') }}</th>
                                        <th>{{ __('name') }} ({{ __('posts') }})</th>
                                        @if (userCan('post.update') || userCan('post.delete'))
                                            <th width="150px"> {{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>
                                                <img width="50px" height="50px" class="rounded"
                                                    src="{{ $category->image_url }}" alt="{{ $category->name }}">
                                            </td>
                                            <td>
                                                {{ $category->name }}({{ $category->posts_count }})
                                            </td>
                                            @if (userCan('post.update') || userCan('post.delete'))
                                                <td>
                                                    @if (userCan('post.update'))
                                                        <a data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('edit') }}"
                                                            href="{{ route('module.category.edit', $category->id) }}"
                                                            class="btn"> <i class="text-dark fa fa-edit fa-2x"></i></a>
                                                    @endif
                                                    @if (userCan('post.delete'))
                                                        <form action="{{ route('module.category.delete', $category->id) }}"
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
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>

            {{-- <div class="col-md-4">
                @if (empty($industryType) && userCan('industry_types.create'))
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('create') }} {{ __('industry_type') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">
                                @if (userCan('industry_types.create'))
                                    <form class="row g-3" action="{{ route('industryType.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf


                                        @foreach ($app_language as $key => $language)
                                            @php
                                                $label = __('name') . ' ' . getLanguageByCode($language->code);
                                                $name = "name_{$language->code}";
                                            @endphp

                                            <div class="col-md-12">
                                                <label class="form-label" name="$label" for="name"
                                                    @required(true)>Name English<spna class="text-red"> * </spna></label>
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

                @if (!empty($industryType) && userCan('industry_types.update'))
                    <div class="card">
                        <div class="card-header">

                            <div class="float-start">
                                <h4>{{ __('edit') }} {{ 'industry Type' }}</h4>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('industryType.index') }}" class="btn btn-primary"><i
                                        class="fa fa-plus"></i>{{ __('create') }}
                                </a>
                            </div>



                        </div>
                        <div class="card-body">
                            <div class="card-wrapper border rounded-3">

                                <form class="row g-3" action="{{ route('industryType.update', $industryType->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    @foreach ($app_language as $key => $language)
                                        @php
                                            $label = __('name') . ' ' . getLanguageByCode($language->code);
                                            $name = "name_{$language->code}";
                                            $code = $industryType->translations[$key]['locale'] ?? '';
                                            $data = $industryType->translations
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

            </div> --}}
        </div>






    </div>
@endsection
