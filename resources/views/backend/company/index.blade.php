@extends('backend.layouts.app')
@section('title')
    {{ __('company_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title"> {{ __('company_list') }}</h4>
                            </div>
                            <div>
                                <div class="d-flex flex-row">


                                    <a class="btn btn-primary m-r-5" href="{{ route('company.create') }}"><i
                                            class="fa fa-plus"></i>
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

                    <form id="formSubmit" action="{{ route('company.index') }}" method="GET" onchange="this.submit();">
                        <div class="card-body row">
                            <div class="col-xl-3 col-md-6 col-12">
                                <label>{{ __('search') }}</label>
                                <input name="keyword" type="text" placeholder="{{ __('search') }}" class="form-control"
                                    value="{{ request('keyword') }}">
                            </div>
                            <div class="col-xl-2 col-md-6 col-12">
                                <label>{{ __('organization_type') }}</label>
                                <select name="organization_type" class="form-control select2">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($organization_types as $organization_type)
                                        <option
                                            {{ request('organization_type') == $organization_type->id ? 'selected' : '' }}
                                            value="{{ $organization_type->id }}">
                                            {{ $organization_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2 col-md-6 col-12">
                                <label>{{ __('industry_type') }}</label>
                                <select name="industry_type" class="form-control select2">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    @foreach ($industry_types as $industry_type)
                                        <option {{ request('industry_type') == $industry_type->id ? 'selected' : '' }}
                                            value="{{ $industry_type->id }}">
                                            {{ $industry_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2 col-md-6 col-12">
                                <label>{{ __('email_verification') }}</label>
                                <select name="ev_status" class="form-control select2">
                                    <option value="">
                                        {{ __('all') }}
                                    </option>
                                    <option {{ request('ev_status') == 'true' ? 'selected' : '' }} value="true">
                                        {{ __('verified') }}
                                    </option>
                                    <option {{ request('ev_status') == 'false' ? 'selected' : '' }} value="false">
                                        {{ __('not_verified') }}
                                    </option>
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
                                        <th>{{ __('company') }}</th>
                                        <th>{{ __('active') }} {{ __('job') }}</th>
                                        <th>{{ __('organization') }}/{{ __('country') }}</th>
                                        <th>{{ __('establishment_date') }}</th>
                                        @if (userCan('company.update'))
                                            <th>{{ __('account') }} {{ __('status') }}</th>
                                        @endif
                                        @if (userCan('company.update'))
                                            <th>{{ __('email_verification') }}</th>
                                        @endif
                                        @if (userCan('company.update'))
                                            <th>{{ __('profile') }} {{ __('status') }}</th>
                                        @endif
                                        @if (userCan('company.update') || userCan('compnay.delete'))
                                            <th width="12%">
                                                {{ __('action') }}
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($companies as $company)
                                        <tr>
                                            <td>
                                                <a href='{{ route('company.show', $company->id) }}' class="company">
                                                    <img src="{{ $company->logo_url }}" class="img-fluid table-avtar"
                                                        alt="Logo">
                                                    <div>
                                                        <h5>{{ $company->user->name }}
                                                            @if ($company->is_profile_verified)
                                                                <svg style="width: 24px ; height: 24px ; color: green"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            @endif
                                                        </h5>
                                                        <p>{{ $company->user->email }}</p>
                                                    </div>

                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('company.show', $company->id) }}">
                                                    {{ $company->active_jobs }} {{ __('active_jobs') }}
                                                </a>
                                            </td>
                                            <td>
                                                <p class="highlight">{{ $company->organization->name }}</p>
                                                <p class="highlight mb-0"><x-svg.table-country />{{ $company->country }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="highlight mb-0">
                                                    {{ $company->establishment_date ? date('j F, Y', strtotime($company->establishment_date)) : '-' }}
                                                </p>
                                            </td>
                                            @if (userCan('company.update'))
                                                <td tabindex="0">
                                                    <a href="#" class="active-status">

                                                        <div class="form-check-size">
                                                            <div class="form-check form-switch form-check-inline">
                                                                <input
                                                                    class="form-check-input switch-primary check-size success status-switch"
                                                                    data-id="{{ $company->user_id }}"
                                                                    {{ $company->user->status == 1 ? 'checked' : '' }}
                                                                    type="checkbox" role="switch" checked="">
                                                            </div>
                                                        </div>

                                                        {{-- <div class="flex-grow-1">
                                                            <label class="switch">
                                                                <input type="checkbox" data-id="{{ $company->user_id }}"
                                                                    class="success status-switch"
                                                                    {{ $company->user->status == 1 ? 'checked' : '' }}>

                                                                <span class="switch-state"></span>
                                                            </label>
                                                        </div> --}}

                                                        <p style="min-width:70px;"
                                                            class="{{ $company->user->status == 1 ? 'active' : '' }}"
                                                            id="status_{{ $company->user_id }}">
                                                            {{ $company->user->status == 1 ? __('activated') : __('deactivated') }}
                                                        </p>
                                                    </a>


                                                </td>
                                            @endif
                                            @if (userCan('company.update'))
                                                <td tabindex="0">
                                                    <a href="#" class="active-status">


                                                        <div class="form-check-size">
                                                            <div class="form-check form-switch form-check-inline">
                                                                <input
                                                                    class="form-check-input switch-primary check-size success email-verification-switch"
                                                                    data-userid="{{ $company->user_id }}"
                                                                    {{ $company->user->email_verified_at ? 'checked' : '' }}
                                                                    type="checkbox" role="switch" checked="">
                                                            </div>
                                                        </div>


                                                        <p style="min-width:70px"
                                                            class="{{ $company->user->email_verified_at ? 'active' : '' }}"
                                                            id="verification_status_{{ $company->user_id }}">
                                                            {{ $company->user->email_verified_at ? __('verified') : __('unverified') }}
                                                        </p>
                                                    </a>
                                                </td>
                                            @endif

                                            @if (userCan('company.update') || userCan('compnay.delete'))
                                                <td tabindex="0">
                                                    <a href="#" class="active-status">

                                                        <div class="form-check-size mb-1">
                                                            <div class="form-check form-switch form-check-inline">
                                                                <input data-companyid="{{ $company->id }}"
                                                                    class="form-check-input switch-primary check-size success profile-verification-switch"
                                                                    type="checkbox" role="switch"
                                                                    {{ $company->is_profile_verified ? 'checked' : '' }}>
                                                            </div>
                                                        </div>
                                                        <p style="min-width:70px"
                                                            class="{{ $company->is_profile_verified ? 'active' : '' }}"
                                                            id="profile_status_{{ $company->id }}">
                                                            {{ $company->is_profile_verified ? __('verified') : __('unverified') }}
                                                        </p>
                                                    </a>
                                                    <div class="mt-2">
                                                        <a href="{{ route('admin.company.documents', $company) }}">View
                                                            Documents</a>
                                                    </div>
                                                </td>
                                            @endif

                                            @if (userCan('company.update') || userCan('compnay.delete'))
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if (userCan('company.view'))
                                                            <a href="{{ route('company.show', $company->id) }}"
                                                                class="btn ll-btn ll-border-none">
                                                                <i class="txt-secondary fa fa-eye fa-2x"></i>
                                                            </a>
                                                        @endif
                                                        @if (userCan('company.update'))
                                                            <a href="{{ route('company.edit', $company->id) }}"
                                                                class="btn ll-p-0">
                                                                <i class="txt-success fa fa-edit fa-2x"></i>
                                                            </a>
                                                        @endif
                                                        @if (userCan('company.delete'))
                                                            <form action="{{ route('company.destroy', $company->id) }}"
                                                                method="POST" class="d-inline">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button
                                                                    onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                    class="btn ll-p-0">
                                                                    <i class="txt-danger fa fa-trash-o fa-2x"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('.status-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('company.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });

            if (status == 1) {
                $(`#status_${id}`).text("{{ __('activated') }}")
            } else {
                $(`#status_${id}`).text("{{ __('deactivated') }}")
            }
        });
        $('.email-verification-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('userid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('company.verify.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });

            if (status == 1) {
                $(`#verification_status_${id}`).text("{{ __('verified') }}")
            } else {
                $(`#verification_status_${id}`).text("{{ __('unverified') }}")
            }
        });

        $('.profile-verification-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('companyid');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('company.profile.verify.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });

            if (status == 1) {
                $(`profile_status_${id}`).text("{{ __('verified') }}")
            } else {
                $(`profile_status_${id}`).text("{{ __('unverified') }}")
            }
        });
    </script>
@endsection
