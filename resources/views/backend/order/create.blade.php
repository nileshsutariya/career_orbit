@extends('backend.layouts.app')
@section('title')
    {{ __('user_create') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">

                    <div class="float-start">
                        <h4>{{ __('order_create') }}</h4>
                    </div>
                    <div class="float-end"> <a href="{{ route('order.index') }}" class="btn btn-primary">
                            <i class="icofont icofont-arrow-left"></i>
                            {{ __('back') }}
                        </a></div>
                </div>
                <form class="form theme-form" action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="card-body custom-input">
                        <div class="row">
                            <div class="col">
                                <div class="mb-2 row">
                                    <label class="col-sm-3">{{ __('comapanies_name') }} </label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm select2 @error('name') is-invalid @enderror"
                                            name="company_id" data-placeholder="{{ __('select_one') }}">
                                            <option selected="">Select Company Name </option>
                                            @foreach ($companies as $user)
                                                <option value="{{ $user->company->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label class="col-sm-3">{{ __('plans') }} </label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm select2" name="plan_id"
                                            data-placeholder="{{ __('select_one') }}">
                                            <option selected="">Select Plans </option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->label }}</option>
                                            @endforeach
                                        </select>
                                        @error('plan_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label class="col-sm-3">{{ __('status') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm select2 @error('status') is-invalid @enderror"
                                            name="status" data-placeholder="{{ __('select_one') }}">
                                            <option selected="">Select Status </option>
                                            <option value="paid">Paid</option>
                                            <option value="unpaid">Unpaid</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label class="col-sm-3">{{ __('payment_provider') }} </label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm select2 @error('plan') is-invalid @enderror"
                                            name="payment_provider" id="payment_provider"
                                            data-placeholder="{{ __('select_one') }}">
                                            <option selected="">Select Payment Provider </option>
                                            <option value="flutterwave">Flutterwave</option>
                                            <option value="mollie">Mollie</option>
                                            <option value="midtrans">Midtrans</option>
                                            <option value="paypal">Paypal</option>
                                            <option value="paystack">Paystack</option>
                                            <option value="razorpay">Razorpay</option>
                                            <option value="sslcommerz">Sslcommerz</option>
                                            <option value="stripe">Stripe</option>
                                            <option value="instamojo">Instamojo</option>
                                            <option value="offline">Offline</option>
                                        </select>
                                        @error('manual_payment_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="mb-2 row" id="payment_type">
                                    <label class="col-sm-3">{{ __('payment_type') }} </label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm select2 @error('plan') is-invalid @enderror"
                                            name="manual_payment_id" data-placeholder="{{ __('select_one') }}">
                                            <option selected="">Select Payment Type </option>
                                            @foreach ($manuals_payments as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('manual_payment_id')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit"><i class="icofont icofont-plus"></i>
                                {{ __('save') }}</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
       
        
        $(document).ready(function() {
            $('#payment_type').hide();

            $('#payment_provider').change(function() {
                if ($(this).val() === 'offline') {
                    $('#payment_type').show();
                } else {
                    $('#payment_type').hide();
                }
            });
        });
    </script>
@endsection