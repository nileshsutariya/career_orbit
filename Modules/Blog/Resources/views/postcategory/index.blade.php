@extends('backend.layouts.app')
@section('title')
    {{ __('category_list') }}
@endsection


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
                                                            class="btn"> <i
                                                                class="text-success fa fa-edit fa-2x"></i></a>
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
                                                                    class="text-danger fa fa-trash-o fa-2x"></i></button>
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
@endsection
