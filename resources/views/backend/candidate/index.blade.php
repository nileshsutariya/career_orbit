@extends('backend.layouts.app')

@section('title')
    {{ __('candidate_list') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ __('candidate_list') }}</h3>
                        <div>
                            <div class="btn-group">
                                <a href="#" class="btn bg-primary">
                                    <i class="fa fa-download"></i> Export
                                </a>
                                <button type="button" class="btn bg-primary dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('candidate.export', 'csv') }}">CSV</a>
                                    <a class="dropdown-item" href="{{ route('candidate.export', 'pdf') }}">PDF</a>
                                    <a class="dropdown-item" href="{{ route('candidate.export', 'xlsx') }}">Excel</a>
                                </div>
                            </div>

                            @if (userCan('candidate.create'))
                                <a href="{{ route('candidate.create') }}" class="btn bg-primary"><i
                                        class="fa fa-plus "></i>
                                    {{ __('create') }}
                                </a>
                            @endif
                            @if (request('keyword') || request('ev_status') || request('sort_by'))
                                <a href="{{ route('candidate.index') }}" class="btn bg-danger"><i
                                        class="fa fa-times"></i>&nbsp;
                                    {{ __('clear') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Filter --}}
                <form id="formSubmit" action="{{ route('candidate.index') }}" method="GET" onchange="this.submit();">
                    <div class="card-body row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <label>{{ __('search') }}</label>
                            <input name="keyword" type="text" placeholder="{{ __('search') }}" class="form-control"
                                value="{{ request('keyword') }}">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <label>{{ __('email_verification') }}</label>
                            <select name="ev_status" class="form-control select2 w-100-p">
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
                        <div class="col-lg-4 col-md-6 col-12">
                            <label>{{ __('sort_by') }}</label>
                            <select name="sort_by" class="form-control select2 w-100-p">
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

                {{-- Table --}}
                <div class="card-body dt-ext table-responsive theme-scrollbar">
                    <table class="table" id="export-button" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('candidate') }}</th>
                                <th>{{ __('role') }}/{{ __('position') }}</th>
                                <th>{{ __('applied_jobs') }}</th>
                                @if (userCan('candidate.update'))
                                    <th width="10%">{{ __('account') }} {{ __('status') }}</th>
                                @endif
                                @if (userCan('candidate.update'))
                                    <th>{{ __('email_verification') }}</th>
                                @endif
                                <th>{{ __('joined_date') }}</th>
                                @if (userCan('candidate.update') || userCan('candidate.delete'))
                                    <th width="12%">{{ __('action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($candidates->count() > 0)
                                @foreach ($candidates as $candidate)
                                    <tr>
                                        <td tabindex="0">
                                            <a href="{{ route('candidate.show', $candidate->id) }}" class="company d-flex gap-1">
                                                <img src="{{ $candidate->photo }}" class="img-fluid table-avtar"
                                                    alt="image">
                                                <div>
                                                    <h5>{{ $candidate->user->name }}</h5>
                                                    <p>{{ $candidate->user->email }}</p>
                                                </div>
                                            </a>
                                        </td>
                                        <td tabindex="0">
                                            <p class="job-role">{{ $candidate->jobRole->name ?? '' }}</p>
                                        </td>
                                        <td tabindex="0">
                                            {{ $candidate->applied_jobs_count }} {{ __('applied_jobs') }}
                                        </td>
                                        @if (userCan('candidate.update'))
                                            <td tabindex="0">
                                                <a href="javascript:void(0)" class="active-status d-flex gap-1">

                                                    <div class="form-check-size">
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input
                                                                class="form-check-input switch-primary check-size success status-switch change-active-status"
                                                                data-id="{{ $candidate->user_id }}"
                                                                {{ $candidate->user->status == 1 ? 'checked' : '' }}
                                                                type="checkbox" role="switch" checked="">
                                                        </div>
                                                    </div>

                                                    <p class="{{ $candidate->user->status == 1 ? 'active' : '' }}"
                                                        id="status_{{ $candidate->user_id }}">
                                                        {{ $candidate->user->status == 1 ? __('activated') : __('deactivated') }}
                                                    </p>
                                                </a>
                                            </td>
                                        @endif
                                        @if (userCan('candidate.update'))
                                            <td tabindex="0">
                                                <a href="javascript:void(0)" class="active-status d-flex gap-1">

                                                    <div class="form-check-size">
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input
                                                                class="form-check-input switch-primary check-size success email-verification-switch"
                                                                data-userid="{{ $candidate->user_id }}"
                                                                {{ $candidate->user->email_verified_at ? 'checked' : '' }}
                                                                type="checkbox" role="switch" checked="">
                                                        </div>
                                                    </div>

                                                    <p class="{{ $candidate->user->email_verified_at ? 'active' : '' }}"
                                                        id="verification_status_{{ $candidate->user_id }}">
                                                        {{ $candidate->user->email_verified_at ? __('verified') : __('unverified') }}
                                                    </p>
                                                </a>
                                            </td>
                                        @endif
                                        <td tabindex="0">
                                            {{ Carbon\Carbon::parse($candidate->created_at)->format('d M, Y') }}
                                        </td>
                                        @if (userCan('candidate.update') || userCan('candidate.delete'))
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if (userCan('candidate.view'))
                                                        <a href="{{ route('candidate.show', $candidate->id) }}"
                                                            class="btn ll-btn ll-border-none">
                                                            <i class="fa fa-eye fa-2x txt-secondary"></i>

                                                        </a>
                                                    @endif
                                                    @if (userCan('candidate.update'))
                                                        <a href="{{ route('candidate.edit', $candidate->id) }}"
                                                            class="btn ll-p-0">
                                                            <i class="fa fa-edit fa-2x txt-success"></i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('candidate.delete'))
                                                        <form action="{{ route('candidate.destroy', $candidate->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');" class="btn ll-p-0">
                                                                <i class="fa fa-trash-o fa-2x txt-danger"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                            @endif
                        </tbody>
                    </table>
                    @if ($candidates->count())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $candidates->onEachSide(1)->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    
    <script>
        $('.status-switch').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('candidate.status.change') }}',
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
    </script>
    <script>
        $(document).ready(function() {
            validate();
            $('#title').keyup(validate);
        });

        function validate() {
            if ($('#title')?.val()?.length > 0) {
                $('#crossB').removeClass('d-none');
            } else {
                $('#crossB').addClass('d-none');
            }
        }

        $('#formSubmit').on('change', function() {
            $(this).submit();
        });

        function RemoveFilter(id) {
            $('#' + id).val('');
            $('#formSubmit').submit();
        }
    </script>
@endsection
