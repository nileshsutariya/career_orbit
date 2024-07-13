@extends('backend.layouts.app')

@section('title')
    {{ __('update_user_plan_benefits') }}
@endsection

@section('content')
    <div class="row justify-content-center">

        <div>
            <div class="alert alert-secondary dark alert-dismissible fade show" role="alert"><i data-feather="info"></i>
                <p>{{ __('do_you_want_to_update_the_plan_data_of_the_user_under_this_order') }} ?</p>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-hidden="true"aria-label="Close"></button>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card height-equal">
                <div class="card-header bg-secondary text-center">
                    <h3 class="text-white"> {{ $plan->label }}</h3>
                    <h5 class="text-white"> {{ config('templatecookie.currency_symbol') }} {{ $plan->price }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2 border-right">
                            <div class="description-block">
                                <h5 class="description-header">
                                    {{ __('job_limit') }}
                                </h5>
                                <span class="description-text text-capilatize">
                                    {{ $plan->job_limit }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-2 border-right">
                            <div class="description-block">
                                <h5 class="description-header">
                                    {{ __('featured_job_limits') }}
                                </h5>
                                <span class="description-text text-capilatize">
                                    {{ $plan->featured_job_limit }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-2 border-right">
                            <div class="description-block">
                                <h5 class="description-header">
                                    {{ __('highlight_job_limit') }}
                                </h5>
                                <span class="description-text text-capilatize">
                                    {{ $plan->highlight_job_limit }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                                <h5 class="description-header">
                                    {{ __('candidate_cv_view_limit') }}
                                </h5>
                                <span class="description-text text-capilatize">
                                    {{ $plan->candidate_cv_view_limit }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="description-block">
                                <h5 class="description-header">
                                    {{ __('candidate_cv_view_limitation') }}
                                </h5>
                                <span class="description-text text-capilatize">
                                    {{ Str::ucfirst($plan->candidate_cv_view_limitation) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('update_user_plan_benefits') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('order.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>
                <div class="card-body">
                    <form class="row g-3" action="{{ route('user.plan.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-md-4 position-relative">
                            <label class="form-label" name="user_plan" required="true">User Plan</label>
                            <select class="form-select select2 @error('user_plan') is-invalid @enderror" name="user_plan"
                                required="true">
                                <option selected="" disabled="" value="">Choose...</option>
                                @foreach ($plans as $item)
                                    <option {{ $plan->id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                        {{ $item->label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_plan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="col-md-4 position-relative">
                            <label class="form-label" name="job_limit" required="true">Job Post Limit</label>
                            <input type="number" name="job_limit"
                                class="form-control @error('job_limit') is-invalid @enderror"
                                value="{{ $user->userPlan->job_limit }}" placeholder="{{ __('job_limit') }}">
                            @error('job_limit')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 position-relative">
                            <label class="form-label" name="featured_job_limit" required="true">Featured Job Post
                                Limit</label>
                            <input type="number" name="featured_job_limit"
                                class="form-control @error('job_limit') is-invalid @enderror"
                                value="{{ $user->userPlan->featured_job_limit }}"
                                placeholder="{{ __('featured_job_limit') }}">
                            @error('featured_job_limit')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" name="highlight_job_limit" required="true">Highlighted
                                Job Post Limit</label>
                            <input type="number" name="highlight_job_limit"
                                class="form-control @error('highlight_job_limit') is-invalid @enderror"
                                value="{{ $user->userPlan->highlight_job_limit }}"
                                placeholder="{{ __('highlight_job_limit') }}">

                            @error('highlight_job_limit')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 position-relative">
                            <label class="form-label" name="candidate_cv_view_limit" required="true">Candidate Cv View
                                Limit</label>
                            <input type="number" name="candidate_cv_view_limit"
                                class="form-control @error('candidate_cv_view_limit') is-invalid @enderror"
                                value="{{ $user->userPlan->candidate_cv_view_limit }}"
                                placeholder="{{ __('candidate_cv_view_limit') }}">

                            @error('candidate_cv_view_limit')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="col-md-6 position-relative">
                            <label class="form-label" for="validationTooltip05">Zip</label>
                            <input class="form-control" id="validationTooltip05" type="text" required="">
                            <div class="invalid-tooltip">Please provide a valid zip.</div>
                        </div> --}}
                        <div class="col-12  text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="icofont icofont-plus"></i>
                                &nbsp;{{ __('update_user_plan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        .card-footer {
            padding-top: 0px !important;
        }

        @media screen and (max-width: 768px) {
            .border-right {
                border-right: 0px !important;
            }
        }

        .widget-user .widget-user-header {
            height: 93px !important;
        }

        /* .select2-results__option[aria-selected=true] {
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
        } */

        .description-block>.description-text {
            text-transform: none !important;
        }
    </style>
@endsection

