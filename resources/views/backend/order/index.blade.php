@extends('backend.layouts.app')

@section('title')
    {{ __('orders') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title"> {{ __('orders') }}</h4>
                            </div>
                            <div>
                                <div class="d-flex flex-row">

                                    <a class="btn btn-primary m-r-5" href="{{ route('order.create') }}"><i class="fa fa-plus"></i>
                                        {{ __('create') }}
                                    </a>

                                    @if (request('company') || request('provider') || request('plan') || request('sort_by'))
                                        <div>
                                            <a href="{{ route('order.index') }}" class="btn bg-danger"><i
                                                    class="fa fa-times"></i>
                                                &nbsp;{{ __('clear') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <form id="filterForm" action="{{ route('order.index') }}" method="GET" onchange="this.submit();">
                        <div class="card-body row">
                            <div class="col-xl-3 col-md-6 col-12">
                                <label>{{ __('companies') }}</label>
                                <select name="company" class="form-control select2">
                                    <option {{ request('company') ? '' : 'selected' }} value="" selected>
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($companies as $company)
                                        <option {{ request('company') == $company->id ? 'selected' : '' }}
                                            value="{{ $company->id }}">{{ $company->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <label>{{ __('payment_provider') }}</label>
                                <select name="provider" id="filter" class="form-control select2">
                                    <option {{ request('provider') ? '' : 'selected' }} value="" selected>
                                        {{ __('all') }}
                                    </option>
                                    <option {{ request('provider') == 'paypal' ? 'selected' : '' }} value="paypal">
                                        {{ __('paypal') }}
                                    </option>
                                    <option {{ request('provider') == 'stripe' ? 'selected' : '' }} value="stripe">
                                        {{ __('stripe') }}
                                    </option>
                                    <option {{ request('provider') == 'razorpay' ? 'selected' : '' }} value="razorpay">
                                        {{ __('razorpay') }}
                                    </option>
                                    <option {{ request('provider') == 'paystack' ? 'selected' : '' }} value="paystack">
                                        {{ __('paystack') }}
                                    </option>
                                    <option {{ request('provider') == 'sslcommerz' ? 'selected' : '' }} value="sslcommerz">
                                        {{ __('sslcommerz') }}
                                    </option>
                                    <option {{ request('provider') == 'instamojo' ? 'selected' : '' }} value="instamojo">
                                        {{ __('instamojo') }}
                                    </option>
                                    <option {{ request('provider') == 'flutterwave' ? 'selected' : '' }}
                                        value="flutterwave">
                                        {{ __('flutterwave') }}
                                    </option>
                                    <option {{ request('provider') == 'mollie' ? 'selected' : '' }} value="mollie">
                                        {{ __('mollie') }}
                                    </option>
                                    <option {{ request('provider') == 'midtrans' ? 'selected' : '' }} value="midtrans">
                                        {{ __('midtrans') }}
                                    </option>
                                    <option {{ request('provider') == 'offline' ? 'selected' : '' }} value="offline">
                                        {{ __('offline') }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <label>{{ __('plan') }}</label>
                                <select name="plan" class="form-control select2">
                                    <option {{ request('plan') ? '' : 'selected' }} value="" selected>
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($plans as $plan)
                                        @if ($plan->frontend_show)
                                            <option {{ request('plan') == $plan->id ? 'selected' : '' }}
                                                value="{{ $plan->id }}">{{ $plan->label }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12">
                                <label>{{ __('sort_by') }}</label>
                                <select name="sort_by" class="form-control select2">
                                    <option {{ !request('sort_by') || request('sort_by') == 'latest' ? 'selected' : '' }}
                                        value="latest" selected>
                                        {{ __('latest') }}
                                    </option>
                                    <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                        {{ __('oldest') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="card-body">
                        <div class="dt-ext table-responsive theme-scrollbar">
                            <table class="table" id="export-button">
                                <thead>
                                    <tr>
                                        <th>{{ __('order_and_transaction') }}</th>
                                        <th>{{ __('company') }}</th>
                                        <th>{{ __('plan') }}</th>
                                        <th>{{ __('amount') }}</th>
                                        <th>{{ __('payment_method') }}</th>
                                        <th>{{ __('created_time') }}</th>
                                        <th>{{ __('payment_status') }}</th>
                                        @if (userCan('order.download'))
                                            <th>{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($orders as $order)
                                        @if (isset($order->company->id))
                                            <tr>
                                                <td>
                                                    <p>#{{ $order->order_id }}</p>
                                                    <p>{{ __('transaction') }}:
                                                        <strong>{{ $order->transaction_id }}</strong>
                                                    </p>
                                                </td>
                                                <td>
                                                    <a href="{{ route('company.show', $order->company->id) }}"
                                                        class="company d-flex gap-1">
                                                        <img class="img-fluid table-avtar"
                                                            src="{{ $order->company->logo_url }}" alt="logo">
                                                        <div>
                                                            <h5>{{ $order->company->user->name }}</h5>
                                                            <p>{{ $order->company->user->email }}</p>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($order->payment_type == 'per_job_based')
                                                        <span>{{ ucfirst(Str::replace('_', ' ', $order->payment_type)) }}</span>
                                                    @else
                                                        <span>{{ $order->plan->label }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ currencyPosition(
                                                        currencyConversion($order->usd_amount, config('templatecookie.currency', 'USD')),
                                                        false,
                                                        $current_currency,
                                                    ) }}
                                                </td>
                                                <td>
                                                    @if ($order->payment_provider == 'offline')
                                                        {{ __('offline') }}
                                                        @if (isset($order->manualPayment) && isset($order->manualPayment->name))
                                                            (<b>{{ $order->manualPayment->name }}</b>)
                                                        @endif
                                                    @else
                                                        {{ ucfirst($order->payment_provider) }}
                                                    @endif
                                                </td>

                                                <td class="text-muted">
                                                    {{ formatTime($order->created_at, 'M d, Y') }}
                                                </td>
                                                <td>

                                                    @if ($order->payment_status == 'paid')
                                                        <span class="badge badge-light-success">{{ __('paid') }}</span>
                                                    @else
                                                        <span class="badge badge-light-warning">{{ __('unpaid') }}</span>
                                                       
                                                        <div>
                                                            <a onclick="return confirm('{{ __('are_you_sure') }}')"
                                                                href="{{ route('manual.payment.mark.paid', $order->id) }}">
                                                                {{ __('mark_as_paid') }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                    <a href="{{ route('order.show', $order->id) }}"
                                                        class="btn ll-btn ll-border-none">
                                                        {{ __('view_details') }}
                                                    </a>
                                                    @if (userCan('order.download'))
                                                        <form
                                                            action="{{ route('admin.transaction.invoice.download', $order->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn ll-p-0">
                                                                <i class="fa fa-download fa-2x txt-warning"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if (userCan('order.download'))
                                                        <form
                                                            action="{{ route('admin.transaction.invoice.view', $order->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn ll-p-0">
                                                                <i class="fa fa-eye fa-2x txt-secondary"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
