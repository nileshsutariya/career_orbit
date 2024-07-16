@extends('backend.layouts.app')
@section('title')
{{ __('post_list') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body student">
                    <div class="d-flex gap-2 align-items-end">
                        <div class="flex-grow-1">
                            <h2> {{ $blogs->total() ?? '0' }}</h2>
                            <p class="mb-0 text-truncate"> {{ __('total_post') }} </p>

                        </div>
                        <div class="flex-shrink-0"><i class="text-white fa fa-sticky-note fa-3x "></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body student-2">
                    <div class="d-flex gap-2 align-items-end">
                        <div class="flex-grow-1">
                            <h2> {{ $totalComments ?? '0' }} </h2>
                            <p class="mb-0 text-truncate">{{ __('total_comments') }}</p>

                        </div>
                        <div class="flex-shrink-0"><i class="text-white fa fa-comments fa-3x"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body student-3">
                    <div class="d-flex gap-2 align-items-end">
                        <div class="flex-grow-1">
                            <h2> {{ $totalAuthor ?? '0' }}</h2>
                            <p class="mb-0 text-truncate"> {{ __('total_authors') }}</p>

                        </div>
                        <div class="flex-shrink-0"><i class="text-white fa fa-users fa-3x"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body student-4">
                    <div class="d-flex gap-2 align-items-end">
                        <div class="flex-grow-1">
                            <h2>{{ $categories->count() ?? '0' }}</h2>
                            <p class="mb-0 text-truncate"> {{ __('total_category') }}</p>

                        </div>
                        <div class="flex-shrink-0"><i class="text-white fa fa-th fa-3x"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">

                    <div class="float-start">
                        <h4 class="title">{{ __('post_list') }}</h4>
                    </div>
                    <div class="float-end">
                        @if (request('keyword') ||
                        Route::current()->parameter('category') ||
                        request('author') ||
                        request('status') ||
                        request('sort_by'))
                        <a href="{{ route('module.blog.index') }}" class="btn btn-danger"><i class="fa fa-times"></i>
                            &nbsp;{{ __('clear') }}
                        </a>
                        @endif


                        @if (userCan('post.create'))
                        <a href="{{ route('module.blog.create') }}" class="btn btn-primary"><i
                                class="fa fa-plus"></i>&nbsp;{{ __('create_post') }}</a>
                        @endif

                        <a href="{{ route('module.category.create') }}" class="btn btn-secondary">
                            <i class="fa fa-plus"></i>&nbsp;{{ __('create_category') }}
                        </a>

                        <a href="{{ route('module.category.index') }}" class="btn btn-outline-primary">
                            <i class="fa fa-eye"></i>&nbsp;{{ __('all_category') }}
                        </a>
                    </div>
                </div>

                <form id="formSubmit" action="{{ route('module.blog.index') }}" method="GET" onchange="this.submit();">
                    <div class="card-body border-bottom row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <label>{{ __('search') }}</label>
                            <input name="keyword" type="text" placeholder="{{ __('search') }}" class="form-control"
                                value="{{ request('keyword') }}">
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <label>{{ __('category') }}</label>
                            <select name="category" class="form-control select2 w-100-p">
                                <option value="" {{ !Route::current()->parameter('category') ? 'selected' : '' }}>
                                    {{ __('all') }}
                                </option>
                                @foreach ($categories as $category)
                                <option {{ Route::current()->parameter('category') == $category->slug ? 'selected' : ''
                                    }}
                                    value="{{ $category->slug }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-md-6 col-12">
                            <label>{{ __('author') }}</label>
                            <select name="author" class="form-control select2 w-100-p">
                                <option value="" {{ !request('author') ? 'selected' : '' }}>
                                    {{ __('all') }}
                                </option>
                                @foreach ($authors as $key => $author)
                                <option value="{{ $author[0]->author->id }}" {{ request('author')==$author[0]->
                                    author->id ? 'selected' : '' }}>
                                    {{ $author[0]->author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-md-6 col-12">
                            <label>{{ __('status') }}</label>
                            <select name="status" class="form-control select2 w-100-p">
                                <option value="" {{ !request('status') ? 'selected' : '' }}>
                                    {{ __('all') }}
                                </option>
                                <option value="published" {{ request('status')=='published' ? 'selected' : '' }}>
                                    {{ __('published') }} ({{ $totalPublished ?? '0' }})
                                </option>
                                <option value="draft" {{ request('status')=='draft' ? 'selected' : '' }}>
                                    {{ __('draft') }} ({{ $totalDraft ?? '0' }})
                                </option>
                            </select>
                        </div>
                        <div class="col-xl-2 col-md-6 col-12">
                            <label>{{ __('language') }}</label>
                            <select name="code" class="form-control select2 w-100-p">
                                <option value="">
                                    {{ __('all') }}
                                </option>
                                @foreach ($languages as $lang)
                                <option value="{{ $lang->code }}" {{ request('code')==$lang->code ? 'selected' : '' }}>
                                    {{ $lang->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

                <div class="card-body">
                    <div class="dt-ext table-responsive theme-scrollbar">

                        <table class="table" id="export-button">
                            <thead>
                                <tr>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('category') }}</th>
                                    <th>{{ __('comments') }}</th>
                                    <th>{{ __('author') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th width="12%">
                                        {{ __('action') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($blogs as $post)
                                <tr>
                                    <td>
                                        <img class="img-60 img-h-60" src="{{ asset($post->image) }}"
                                            alt="Blog: {{ $post->category->name }}">



                                    </td>
                                    <td>
                                        <a href="{{ route('website.post', $post->slug) }}">{{ $post->title }}</a>
                                    </td>
                                    <td>
                                        {{ $post->category->name }}
                                    </td>
                                    <td>{{ $post->comments_count }}</td>
                                    <td>{{ $post->author->name }}</td>
                                    <td>

                                        <span class="{{ $post->status == 'draft' ? 'badge badge-danger' : 'badge badge-success' }} rounded f-16
                                                    ">
                                            {{ $post->status }}
                                        </span>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Comments"
                                            href="{{ route('website.post', $post->slug) }}#comments" class="btn">
                                            <i class="fa fa-comments fa-2x"></i>
                                        </a>
                                        @if (userCan('post.update'))
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"
                                            title="{{ __('edit') }}" href="{{ route('module.blog.edit', $post->id) }}"
                                            class="btn">
                                            <i class="txt-success fa fa-edit fa-2x"> </i></a>
                                        @endif
                                        @if (userCan('post.delete'))
                                        <form action="{{ route('module.blog.destroy', $post->id) }}" method="POST"
                                            class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Delete" title="{{ __('delete') }}"
                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                class="btn">
                                                <i class="txt-danger fa fa-trash-o fa-2x"></i>
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
    </div>
</div>
@endsection