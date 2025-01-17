@extends('backend.layouts.app')
@section('title')
    {{ __('create') }}
@endsection


@section('script')
    <script>
        checkSubscriptionType('{{ old('subscription_type') }}');

        function checkSubscriptionType(type) {
            if (type == 'recurring') {
                $('#plan_interval').removeClass('d-none');
            } else {
                $('#plan_interval').addClass('d-none');
            }
        }

        $('.plan_type_selection').on('click', function(value) {
            var value = $("[name='subscription_type']:checked").val();
            checkSubscriptionType(this.value);
        });

        profileViewLimitation('{{ old('candidate_cv_view_limitation') }}');

        function profileViewLimitation(status) {
            if (status == 'unlimited') {
                $('#candidate_profile_view_count_field').addClass('d-none');
            } else {
                $('#candidate_profile_view_count_field').removeClass('d-none');
            }
        }

        $('.candidate_profile_view').on('click', function(value) {
            var value = $("[name='candidate_cv_view_limitation']:checked").val();
            profileViewLimitation(this.value);
        });
    </script>

    <script>
        // Define the debounce function
        function debounce(func, delay) {
            let timeout;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), delay);
            };
        }

        $(document).ready(function() {
            // Define the debounce delay in milliseconds
            const debounceDelay = 500;

            // Create a debounced version of the event handler
            const debouncedKeyUp = debounce(function() {
                var textareaValue = $('textarea[id="description_en"]').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('module.plan.description.translate') }}",
                    data: {
                        textToTranslate: textareaValue,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].valueProperty !== 'description_en') {
                                $('#' + data[i].valueProperty).val(data[i].translatedValue);
                            }
                        }
                    }
                });
            }, debounceDelay);

            // Attach the debounced event handler to the textarea's keyup event
            $('textarea[id="description_en"]').on('keyup', debouncedKeyUp);
        });
    </script>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">

                        <div class="float-start">
                            <h4>{{ __('create') }} {{ __('plan') }}</h4>
                        </div>
                        <div class="float-end"> <a href="{{ route('module.plan.index') }}" class="btn btn-primary">
                                <i class="icofont icofont-arrow-left"></i>
                                {{ __('back') }}
                            </a></div>
                    </div>
                    <form action="{{ route('module.plan.store') }}" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="label">{{ __('label') }} <small
                                            class="text-red">*</small></label>
                                    <input type="text" id="label" name="label" value="{{ old('label') }}"
                                        class="form-control @error('label') is-invalid @enderror"
                                        placeholder="{{ __('basic_standard_premium') }}">
                                    @error('label')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="price">{{ __('price') }}
                                        {{ defaultCurrencySymbol() }}<small class="text-red">*</small></label>
                                    <input type="number" id="price" name="price" value="{{ old('price') }}"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="{{ __('10') }}{{ defaultCurrencySymbol() }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="job_limit">{{ __('job_limit') }} <small
                                            class="text-red">*</small></label>
                                    <input type="number" id="job_limit" name="job_limit" value="{{ old('job_limit') }}"
                                        class="form-control @error('job_limit') is-invalid @enderror"
                                        placeholder="{{ __('enter') }} {{ __('job_limit') }}">
                                    @error('job_limit')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="featured_job_limit">{{ __('featured_job_limit') }}
                                        <small class="text-danger">*</small></label>
                                    <input type="number" id="featured_job_limit" name="featured_job_limit"
                                        value="{{ old('featured_job_limit') }}"
                                        class="form-control @error('featured_job_limit') is-invalid @enderror"
                                        placeholder="{{ __('enter') }} {{ __('featured_job_limit') }}">
                                    @error('featured_job_limit')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">

                                    <label class="form-label" for="highlight_job_limit">{{ __('highlight_job_limit') }}
                                        <small class="text-danger">*</small></label>
                                    <input type="number" id="highlight_job_limit" name="highlight_job_limit"
                                        value="{{ old('highlight_job_limit') }}"
                                        class="form-control @error('highlight_job_limit') is-invalid @enderror"
                                        placeholder="{{ __('enter') }} {{ __('highlight_job_limit') }}">
                                    @error('highlight_job_limit')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror

                                </div>





                                <div class="col-md-6">

                                    <label class="form-label" for="candidate_profile_view_limitation">
                                        {{ __('candidate_profile_view_limitation') }} <small class="text-danger">*</small>
                                    </label> <br>
                                    <div class="form-check form-check-inline radio radio-primary">
                                        <input
                                            {{ !old('candidate_cv_view_limitation') || old('candidate_cv_view_limitation') == 'limited' ? 'checked' : '' }}
                                            type="radio" id="limited_profile_view" name="candidate_cv_view_limitation"
                                            class="candidate_profile_view form-check-input" value="limited">
                                        <label class="form-check-label mb-0"
                                            for="limited_profile_view">{{ __('limited') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline radio radio-primary">
                                        <input {{ old('candidate_cv_view_limitation') == 'unlimited' ? 'checked' : '' }}
                                            type="radio" id="unlimited_profile_view" name="candidate_cv_view_limitation"
                                            class="candidate_profile_view form-check-input" value="unlimited">
                                        <label class="custom-control-label" for="unlimited_profile_view">
                                            {{ __('unlimited') }}
                                        </label>
                                    </div>
                                    @error('candidate_cv_view_limitation')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror

                                </div>


                                <div class="col-md-6" id="candidate_profile_view_count_field">
                                    <label class="form-label"
                                        for="candidate_cv_preview_limit">{{ __('candidate_cv_preview_limit') }}
                                        <small class="text-danger">*</small></label>
                                    <input type="number" id="candidate_cv_preview_limit" name="candidate_cv_view_limit"
                                        value="{{ old('candidate_cv_view_limit') }}"
                                        class="form-control @error('candidate_cv_view_limit') is-invalid @enderror"
                                        placeholder="{{ __('enter') }} {{ __('candidate_cv_preview_limit') }}"
                                        min="0">
                                    @error('candidate_cv_view_limit')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label" for="frontend_show">
                                        {{ __('show_frontend') }} <small class="text-danger">*</small>
                                    </label> <br>
                                    <div class="form-check form-check-inline radio radio-primary">
                                        <input class="form-check-input  plan_type_selection" type="radio"
                                            id="show_frontend_yes" name="frontend_show" value="1" checked>
                                        <label class="form-check-label mb-0"
                                            for="show_frontend_yes">{{ __('yes') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline radio radio-primary">
                                        <input class="form-check-input plan_type_selection" type="radio"
                                            id="show_frontend_no" name="frontend_show" value="0">
                                        <label class="form-check-label mb-0" for="show_frontend_no">
                                            {{ __('no') }}</label>
                                    </div>
                                    @error('frontend_show')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label" for="frontend_show">
                                        {{ __('mark_profile_verify') }} <small class="text-danger">*</small>
                                    </label> <br>

                                    <div class="form-check-size">
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input  plan_type_selection" type="radio"
                                                id="profile_verify_yes" name="profile_verify" value="1" checked>
                                            <label class="form-check-label mb-0"
                                                for="profile_verify_yes">{{ __('yes') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input plan_type_selection" type="radio"
                                                id="profile_verify_no" name="profile_verify" value="0">
                                            <label class="form-check-label mb-0" for="profile_verify_no">
                                                {{ __('no') }}</label>
                                        </div>

                                    </div>
                                    @error('profile_verify')
                                        <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                    @enderror

                                </div>

                                @foreach ($app_languages as $app_language)
                                    @php
                                        $name = "description_{$app_language->code}";
                                    @endphp
                                    <div class="col-md-12">
                                        <label class="form-label" for="description">{{ __('description') }}
                                            {{ $app_language->name }}
                                            <small class="text-danger">*</small></label>
                                        <textarea name="description_{{ $app_language->code }}" placeholder="{{ __('enter') }} {{ __('description') }}"
                                            value="{{ old('description') }}" class="form-control @if ($errors->has($name)) is-invalid @endif"
                                            id="description_{{ $app_language->code }}" cols="1" rows="4">{{ old('description') }}</textarea>

                                        @if ($errors->has($name))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first($name) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endforeach


                            </div>




                        </div>
                        <div class="card-body">
                            <div class="text-end">
                                <button class="btn btn-primary" type="submit"> <i class="icon-plus"></i>
                                    {{ __('save') }}</button>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
