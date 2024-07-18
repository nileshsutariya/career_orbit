@extends('backend.layouts.app')
@section('title')
    {{ __('testimonial_list') }}
@endsection


@section('content')
    <div class="container-fluid">
        @if (userCan('testimonial.create'))
            <div class="text-end mb-3">
                <a href="{{ route('module.testimonial.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                    {{ __('create') }}</a>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-2">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item border rounded mb-1">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">
                                    {{ __('all') }}
                                </a>
                            </li>
                            @foreach ($group_testimonials as $key => $testimonial)
                                <li class="nav-item border rounded mb-1">
                                    <a class="nav-link" data-bs-toggle="tab" href="#home_{{ $key }}">
                                        {{ getLanguageByCode($key) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="col-12 col-sm-12 col-md-10">
                        <div class="tab-content no-padding">
                            <div class="tab-pane show active" id="home">
                                <div class="row">
                                    @forelse ($testimonials as $testimonial)
                                        <div class="col-md-3">
                                            <div class="card text-center">
                                                @if ($testimonial->image)
                                                    <img src="{{ asset($testimonial->image) }}" class="card-img-top"
                                                        alt="user image">
                                                @else
                                                    <img src="{{ asset('backend/image/default.png') }}" class="card-img-top"
                                                        alt="user image">
                                                @endif
                                                <div class="card-body">
                                                    <h4>{{ $testimonial->name }}</h4>
                                                    <h6 class="badge badge-primary">{{ $testimonial->position }}</h6> <br>
                                                    <div class="mx-auto justify-content-center align-items-center">
                                                        @for ($i = 0; $i < $testimonial->stars; $i++)
                                                            <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                        @endfor
                                                    </div>
                                                    <p class="card-text">{!! Str::limit($testimonial->description, 100, '...') !!}</p>
                                                    @if (userCan('testimonial.update') || userCan('testimonial.delete'))
                                                        <div class="mx-auto justify-content-center align-items-center">
                                                            @if (userCan('testimonial.update'))
                                                                <a title="{{ __('edit') }}"
                                                                    href="{{ route('module.testimonial.edit', $testimonial->id) }}"
                                                                    class="btn"><i
                                                                        class="txt-success fa fa-edit fa-2x "></i></a>
                                                            @endif
                                                            @if (userCan('testimonial.delete'))
                                                                <form
                                                                    action="{{ route('module.testimonial.destroy', $testimonial->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button title="{{ __('delete') }}"
                                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                        class="btn"><i
                                                                            class="txt-danger fa fa-trash fa-2x"></i></button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-md-12">
                                            <div class="card text-center">
                                                <div class="card-body">
                                                    @if (userCan('testimonial.create'))
                                                        <x-admin.not-found word="testimonial"
                                                            route="module.testimonial.create" />
                                                    @else
                                                        <x-admin.not-found word="testimonial" route="" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            @foreach ($group_testimonials as $key => $lang_testimonials)
                                <div class="tab-pane" id="home_{{ $key }}">
                                    <div class="row">
                                        @forelse ($lang_testimonials as $testimonial)
                                            <div class="col-md-3">
                                                <div class="card text-center">
                                                    @if ($testimonial->image)
                                                        <img src="{{ asset($testimonial->image) }}" class="card-img-top"
                                                            alt="user image">
                                                    @else
                                                        <img src="{{ asset('backend/image/default.png') }}"
                                                            class="card-img-top" alt="user image">
                                                    @endif
                                                    <div class="card-body">
                                                        <h4>{{ $testimonial->name }}</h4>
                                                        <h6 class="badge badge-primary">{{ $testimonial->position }}</h6>
                                                        <br>
                                                        <div class="mx-auto justify-content-center align-items-center">
                                                            @for ($i = 0; $i < $testimonial->stars; $i++)
                                                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                                            @endfor
                                                        </div>
                                                        <p class="card-text">{!! Str::limit($testimonial->description, 100, '...') !!}</p>
                                                        @if (userCan('testimonial.update') || userCan('testimonial.delete'))
                                                            <div class="mx-auto justify-content-center align-items-center">
                                                                @if (userCan('testimonial.update'))
                                                                    <a title="{{ __('edit') }}"
                                                                        href="{{ route('module.testimonial.edit', $testimonial->id) }}"
                                                                        class="btn"><i
                                                                            class="txt-success fa fa-edit fa-2x"></i></a>
                                                                @endif
                                                                @if (userCan('testimonial.delete'))
                                                                    <form
                                                                        action="{{ route('module.testimonial.destroy', $testimonial->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button title="{{ __('delete') }}"
                                                                            onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                            class="btn"><i
                                                                                class="txt-danger fa fa-trash   m-l-10 fa-2x"></i></button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-md-12">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        @if (userCan('testimonial.create'))
                                                            <x-admin.not-found word="testimonial"
                                                                route="module.testimonial.create" />
                                                        @else
                                                            <x-admin.not-found word="testimonial" route="" />
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .card {
        border-radius: 10px;
    }

    .card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 20px auto 0;

    }
</style>
