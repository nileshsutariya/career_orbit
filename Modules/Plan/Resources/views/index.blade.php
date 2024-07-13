@extends('backend.layouts.app')
@section('title')
    {{ __('plan_list') }}
@endsection
{{-- @section('content')
    <div class="container-fluid">


        <div class="row justify-content-between align-items-center">
            <div class="col-sm-12 col-md-4">
                @if (userCan('plan.update') && $plans->count())
                    <form action="{{ route('module.plan.recommended') }}" method="POST">
                        @csrf
                        <div>
                            {{ __('set_recommended_package') }}
                        </div>
                        <div class="d-flex">
                            <select name="plan_id" class="form-control" id="">
                                <option value="" hidden>{{ __('select_one') }}</option>
                                @foreach ($plans as $plan)
                                    <option {{ $plan->recommended ? 'selected' : '' }} value="{{ $plan->id }}">
                                        {{ $plan->label }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">{{ __('update') }}</button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-sm-12 col-md-4">
                @if (userCan('plan.update') && $plans->count())
                    <form action="{{ route('module.plan.default') }}" method="POST">
                        @csrf
                        <div>
                            {{ __('set_default_package') }}
                        </div>
                        <div class="d-flex">
                            <select name="plan_id" class="form-control" id="inlineFormCustomSelect">
                                <option value="" hidden>{{ __('select_one') }}</option>
                                @foreach ($plans as $plan)
                                    <option {{ $setting->default_plan == $plan->id ? 'selected' : '' }}
                                        value="{{ $plan->id }}">
                                        {{ $plan->label }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary ml-2">{{ __('update') }}</button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-sm-12 col-md-4 text-md-right">

                @if (userCan('plan.create'))
                    <a href="{{ route('module.plan.create') }}" class="btn bg-primary rounded mt-2"><i
                            class="fas fa-plus"></i>&nbsp;
                        {{ __('create') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="row h-100 mt-4">
            @forelse ($plans as $plan)
                <div class="col-md-6 col-lg-4 col-xl-4 mb-3 col-12">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header text-center py-4">
                            <h4>{{ $plan->label }}</h4>
                            @if ($plan->recommended)
                                <div class="badge badge-info">{{ __('recommended') }}</div>
                            @endif
                            @if ($plan->id == $setting->default_plan)
                                <div class="badge badge-secondary">{{ __('default') }}</div>
                            @endif
                            <h1 class="text-dark">{{ config('templatecookie.currency_symbol') }}{{ $plan->price }}</h1>
                            <p class="mb-0">
                                @if (isset($plan->descriptions) && isset($plan->descriptions[0]))
                                    {!! $plan->descriptions[0]->description !!}
                                @else
                                    @php
                                        $default_description = $plan_descriptions->where('plan_id', $plan->id)->first();
                                    @endphp

                                    @if ($default_description && $default_description->description)
                                        {!! $default_description->description !!}
                                    @else
                                        <span class="text-danger">{!! __('no_description_has_been_added_to_this_language') !!}</span>
                                    @endif
                                @endif
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-check-icon width="22" height="22" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('job_limit') }} :
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->job_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-check-icon width="22" height="22" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('featured_job_limit') }} :
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->featured_job_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-check-icon width="22" height="22" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('highlight_job_limit') }} :
                                    </h5>
                                </div>
                                <h5 class="mb-0"> {{ $plan->highlight_job_limit }}</h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-check-icon width="22" height="22" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('candidate_cv_preview_limit') }} :
                                    </h5>
                                </div>
                                <h5 class="mb-0">
                                    {{ $plan->candidate_cv_view_limitation == 'limited' ? $plan->candidate_cv_view_limit : __('unlimited') }}
                                </h5>
                            </div>
                            <div class="mb-2 align-items-center d-flex {{ $plan->frontend_show ? 'active' : '' }}">
                                <span class="icon mr-2">
                                    <x-check-icon width="22" height="22" />
                                </span>
                                <h5 class="mb-0">
                                    @if ($plan->frontend_show)
                                        {{ __('show_frontend') }}
                                    @else
                                        <del>{{ __('show_frontend') }}</del>
                                    @endif
                                </h5>
                            </div>
                            <div class="mb-2 d-flex align-items-center justify-content-between">
                                <div class="d-flex">
                                    <span class="icon mr-2">
                                        <x-check-icon width="22" height="22" />
                                    </span>
                                    <h5 class="mb-0">
                                        {{ __('ability_to_profile_verify') }} :
                                    </h5>
                                </div>

                                @if ($plan->profile_verify)
                                    <span class="rounded-full text-white ml-4">

                                        <svg style="margin-right: -10px" width="34" height="34"
                                            xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                @else
                                    <span class="rounded-full text-white ml-4">

                                        <svg style="margin-right: -10px" width="34" height="34"
                                            xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class=" d-flex justify-content-between">
                                @if (userCan('plan.update') || userCan('plan.delete'))
                                    @if (userCan('plan.update'))
                                        <a href="{{ route('module.plan.edit', $plan->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                            {{ __('edit') }}
                                        </a>
                                    @endif
                                    @if ($plan->id !== $setting->default_plan)
                                        @if (userCan('plan.delete'))
                                            <form action="{{ route('module.plan.delete', $plan->id) }}" class=""
                                                method="POST"
                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger w-100-p">
                                                    <i class="fas fa-trash"></i>
                                                    {{ __('delete') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <x-not-found message="{{ __('no_data_found') }}" />
                            <p class="plan-p">{{ __('there_is_no_plan_found_in_this_page') }}.</p>
                            @if (userCan('plan.create'))
                                <a href="{{ route('module.plan.create') }}" class="plan-btn">
                                    {{ __('add_your_first_plan') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection --}}



@section('script')
    <script>
        function MonthlyPrice(plan) {

            if ($('#customSwitch' + plan.id).is(":checked")) {
                $('#price' + plan.id).html("$" + plan.monthly_price);
                $('#monthoryear' + plan.id).html("{{ __('/monthly') }}");
            } else {
                $('#price' + plan.id).html("$" + plan.yearly_price);
                $('#monthoryear' + plan.id).html("{{ __('/yearly') }}");
            }
        }
    </script>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">


            <div class="row justify-content-between">
                <div class="col-sm-12 col-md-4">
                    @if (userCan('plan.update') && $plans->count())
                        <form action="{{ route('module.plan.recommended') }}" method="POST">
                            @csrf
                            <div>
                                {{ __('set_recommended_package') }}
                            </div>
                            <div class="d-flex mb-2">
                                <select name="plan_id" class="form-control m-r-10 " id="">
                                    <option value="" hidden>{{ __('select_one') }}</option>
                                    @foreach ($plans as $plan)
                                        <option {{ $plan->recommended ? 'selected' : '' }} value="{{ $plan->id }}">
                                            {{ $plan->label }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-2">{{ __('update') }}</button>
                            </div>
                        </form>
                    @endif
                </div>

                <div class="col-sm-12 col-md-4">
                    @if (userCan('plan.update') && $plans->count())
                        <form action="{{ route('module.plan.default') }}" method="POST">
                            @csrf
                            <div>
                                {{ __('set_default_package') }}
                            </div>
                            <div class="d-flex">
                                <select name="plan_id" class="form-control  m-r-10" id="inlineFormCustomSelect">
                                    <option value="" hidden>{{ __('select_one') }}</option>
                                    @foreach ($plans as $plan)
                                        <option {{ $setting->default_plan == $plan->id ? 'selected' : '' }}
                                            value="{{ $plan->id }}">
                                            {{ $plan->label }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-2">{{ __('update') }}</button>
                            </div>
                        </form>
                    @endif
                </div>
                <div class="col-sm-12 col-md-4 text-end">

                    @if (userCan('plan.create'))
                        <a href="{{ route('module.plan.create') }}" class="btn bg-primary rounded mt-2"><i
                                class="fa fa-plus"></i>&nbsp;
                            {{ __('create') }}
                        </a>
                    @endif
                </div>
            </div>

            @forelse ($plans as $plan)
                <div class="col-md-4">

                    <div class="card">
                        <div class="card text-center">
                            <div class="card-header">

                                <h4>{{ $plan->label }}</h4>
                                @if ($plan->recommended)
                                    <div class="badge badge-info">{{ __('recommended') }}</div>
                                @endif
                                @if ($plan->id == $setting->default_plan)
                                    <div class="badge badge-secondary">{{ __('default') }}</div>
                                @endif
                                <h1 class="text-dark">
                                    {{ config('templatecookie.currency_symbol') }}{{ $plan->price }}
                                </h1>
                                <p class="mb-0">
                                    @if (isset($plan->descriptions) && isset($plan->descriptions[0]))
                                        {!! $plan->descriptions[0]->description !!}
                                    @else
                                        @php
                                            $default_description = $plan_descriptions
                                                ->where('plan_id', $plan->id)
                                                ->first();
                                        @endphp

                                        @if ($default_description && $default_description->description)
                                            {!! $default_description->description !!}
                                        @else
                                            <span class="text-danger">{!! __('no_description_has_been_added_to_this_language') !!}</span>
                                        @endif
                                    @endif
                                </p>

                            </div>
                        </div>
                        <div class="card-body" style="font-size: 20px">

                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <span style="color:#007bff ;">
                                        <i class="fa fa-check-square"></i>
                                    </span>
                                    {{ __('job_limit') }} :
                                </div>
                                <div class="p-2">
                                    <h5> {{ $plan->job_limit }}</h5>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <span style="color:#007bff ;">
                                        <i class="fa fa-check-square"></i>
                                    </span>
                                    {{ __('featured_job_limit') }} :
                                </div>
                                <div class="p-2">
                                    <h5>{{ $plan->featured_job_limit }}</h5>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <span style="color:#007bff ;">
                                        <i class="fa fa-check-square"></i>
                                    </span>
                                    {{ __('highlight_job_limit') }} :
                                </div>
                                <div class="p-2">
                                    <h5>{{ $plan->highlight_job_limit }} </h5>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <span style="color:#007bff ;">
                                        <i class="fa fa-check-square"></i>
                                    </span>
                                    {{ __('candidate_cv_preview_limit') }} :
                                </div>
                                <div class="p-2">
                                    <h5> {{ $plan->candidate_cv_view_limitation == 'limited' ? $plan->candidate_cv_view_limit : __('unlimited') }}
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <span style="color:#007bff ;">
                                        <i class="fa fa-check-square"></i>
                                    </span>
                                    @if ($plan->frontend_show)
                                        {{ __('show_frontend') }}
                                    @else
                                        <del>{{ __('show_frontend') }}</del>
                                    @endif
                                </div>

                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="p-2">
                                    <span style="color:#007bff ;">
                                        <i class="fa fa-check-square"></i>
                                    </span>
                                    {{ __('ability_to_profile_verify') }} :
                                </div>
                                <div class="p-2">
                                    <h5>
                                        @if ($plan->profile_verify)
                                            <span style="color: green; font-size : 2em">
                                                <i class="fa fa-check-circle-o"></i>
                                            </span>
                                        @else
                                            <span style="color:red ; font-size : 2em">
                                                <i class="fa fa-times-circle-o"></i>
                                            </span>
                                        @endif
                                    </h5>
                                </div>
                            </div>



                        </div>

                        <div class="card-footer">
                            <div class=" d-flex justify-content-between">
                                @if (userCan('plan.update') || userCan('plan.delete'))
                                    @if (userCan('plan.update'))
                                        <a href="{{ route('module.plan.edit', $plan->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                            {{ __('edit') }}
                                        </a>
                                    @endif
                                    @if ($plan->id !== $setting->default_plan)
                                        @if (userCan('plan.delete'))
                                            <form action="{{ route('module.plan.delete', $plan->id) }}" class=""
                                                method="POST"
                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                    {{ __('delete') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            @empty
                <div class="col-md-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <x-not-found message="{{ __('no_data_found') }}" />
                            <p class="plan-p">{{ __('there_is_no_plan_found_in_this_page') }}.</p>
                            @if (userCan('plan.create'))
                                <a href="{{ route('module.plan.create') }}" class="plan-btn">
                                    {{ __('add_your_first_plan') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
