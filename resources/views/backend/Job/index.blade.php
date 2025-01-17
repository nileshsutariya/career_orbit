@extends('backend.layouts.app')
@section('title')
    {{ __('job_list') }}
@endsection
@section('content')
    @php
        $userr = auth()->user();
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('job_list') }}</h3>
                        <div class="d-flex flex-column flex-md-row">
                            <a href="{{ route('admin.job.edited.index') }}" class="btn mx-md-1 my-1 my-md-0 bg-secondary"><i
                                    class="fa fa-hourglass-start"></i>
                                {{ __('pending_edited_jobs') }}
                                <span class="badge badge-danger right">
                                    {{ $edited_jobs }}
                                </span>
                            </a>
                            <a href="{{ route('job.create') }}" class="btn mx-md-1 my-1 my-md-0 bg-primary"><i
                                    class="fa fa-plus mr-1"></i>
                                {{ __('create') }}
                            </a>
                            <button data-bs-toggle="modal" data-bs-target="#bulk_import_modal"
                                class="btn mx-md-1 my-1 my-md-0 bg-info"><i class="fa fa-plus mr-1"></i>
                                {{ __('bulk_import') }}
                            </button>

                            @if (request('title') ||
                                    request('job_category') ||
                                    request('job_type') ||
                                    request('experience') ||
                                    request('sort_by') ||
                                    request('filter_by'))
                                <a href="{{ route('job.index') }}" class="btn bg-danger"><i class="fa fa-times"></i>
                                    &nbsp;{{ __('clear') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Filter --}}
                <form id="formSubmit" action="{{ route('job.index') }}" method="GET" onchange="this.submit();">
                    <div class="card-body row">
                        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
                            <label>{{ __('search') }}</label>
                            <input name="title" type="text" placeholder="{{ __('search') }}" class="form-control"
                                value="{{ request('title') }}">
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
                            <label>{{ __('job_category') }}</label>
                            <select name="job_category" class="form-control select2">
                                <option value="">
                                    {{ __('all') }}
                                </option>
                                @foreach ($job_categories as $job_category)
                                    <option {{ request('job_category') == $job_category->id ? 'selected' : '' }}
                                        value="{{ $job_category->id }}">
                                        {{ $job_category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
                            <label>{{ __('job_type') }}</label>
                            <select name="job_type" class="form-control select2">
                                <option value="">
                                    {{ __('all') }}
                                </option>
                                @foreach ($job_types as $job_type)
                                    <option {{ request('job_type') == $job_type->slug ? 'selected' : '' }}
                                        value="{{ $job_type->slug }}">
                                        {{ $job_type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
                            <label>{{ __('experience') }}</label>
                            <select name="experience" class="form-control select2">
                                <option value="">
                                    {{ __('all') }}
                                </option>
                                @foreach ($experiences as $experience)
                                    <option {{ request('experience') == $experience->slug ? 'selected' : '' }}
                                        value="{{ $experience->slug }}">
                                        {{ $experience->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
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
                        <div class="col-xl-2 col-lg-4 col-md-6 col-12">
                            <label>{{ __('filter_by') }}</label>
                            <select name="filter_by" class="form-control select2">
                                <option {{ request('filter_by') ? '' : 'selected' }} value="">
                                    {{ __('all') }}
                                </option>
                                <option {{ request('filter_by') == 'active' ? 'selected' : '' }} value="active">
                                    {{ __('publish') }}
                                </option>
                                <option {{ request('filter_by') == 'pending' ? 'selected' : '' }} value="pending">
                                    {{ __('pending') }}
                                </option>
                                <option {{ request('filter_by') == 'expired' ? 'selected' : '' }} value="expired">
                                    {{ __('expired') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </form>
              
                    @include('backend.layouts.partials.message')
                    <div class="row">
                        <div class="col-sm-12 py-2" style="padding-left: 32px;">
                            <label class="d-inline-flex align-items-center gap-2">
                                <input type="checkbox" id="select-all" class="mr-2">
                                <span>{{ __('select_all') }}</span>
                            </label>
                            <button id="delete-selected" class="btn btn-danger ml-3">{{ __('selected_delete') }}</button>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-12 card-body dt-ext table-responsive theme-scrollbar text-nowrap">
                            <table class="table" id="export-button">
                                <thead>
                                    <tr>
                                        <th width="2%"></th>
                                        <th width="5%">{{ __('job') }}</th>
                                        <th width="10%">{{ __('category') }}/{{ __('role') }}</th>
                                        <th width="10%">{{ __('salary') }}</th>
                                        <th width="10%">{{ __('deadline') }}</th>
                                        <th width="10%">{{ __('status') }}</th>
                                        @if (userCan('job.update') || userCan('job.delete'))
                                            <th width="10%">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($jobs->count() > 0)
                                        @foreach ($jobs as $job)
                                            <tr>
                                                <td tabindex="0">
                                                    <input type="checkbox" class="job-checkbox"
                                                        value="{{ $job->id }}">
                                                </td>
                                                <td>
                                                    <a href="{{ route('job.show', $job->id) }}" class="company d-flex gap-1">
                                                        @if ($job->company)
                                                            <img src="{{ asset($job->company->logo_url) }}"
                                                                class="img-fluid table-avtar" alt="image">
                                                        @else
                                                            <x-svg.briefcase-logo />
                                                        @endif
                                                        <div>
                                                            <h5>{{ $job->title }}</h5>
                                                            <p>

                                                                <span>{{ $job->company && $job->company->user ? $job->company->user->name : $job->company_name }}</span>
                                                                <span>·</span>
                                                                <span>{{ $job->job_type->name ?? '' }}</span>
                                                                @if ($job->is_remote)
                                                                    <span>·</span>
                                                                    <span>{{ __('remote') }}</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td tabindex="0">
                                                    <div class="category d-flex gap-1">
                                                        <x-svg.table-layer />
                                                        <div>
                                                            <h5>{{ $job->category->name }}</h5>
                                                            <p>{{ $job->role->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td tabindex="0">
                                                    <div class="category d-flex gap-1">
                                                        <x-svg.table-money />
                                                        <div>
                                                            @if ($job->salary_mode == 'range')
                                                                <h5 class='bold'>
                                                                    {{ getFormattedNumber($job->min_salary) }} -
                                                                    {{ getFormattedNumber($job->max_salary) }}
                                                                    {{ currentCurrencyCode() }}</h5>
                                                            @else
                                                                <h5 class="bold">{{ $job->custom_salary }}</h5>
                                                            @endif
                                                            <p>{{ $job->salary_type->name }} </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td tabindex="0">
                                                    @php
                                                        $dateTime = new DateTime();
                                                        $formattedDateTime = $dateTime->format('Y-m-d');
                                                    @endphp
                                                    @if ($job->deadline <= $formattedDateTime)
                                                        {{ date('j F, Y', strtotime($job->deadline)) }}
                                                        <p class=" text-danger mt-2">
                                                            <small>{{ __('deadline_expired') }}</small>
                                                        </p>
                                                    @else
                                                        {{ date('j F, Y', strtotime($job->deadline)) }}
                                                    @endif
                                                </td>
                                                @if (userCan('job.update'))
                                                    <td tabindex="0">
                                                        <div class="d-flex">
                                                            @if ($job->status == 'pending')
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST"
                                                                    id="job_status_pending_form_{{ $job->id }}">
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input
                                                                            onclick="$('#job_status_pending_form_{{ $job->id }}').submit()"
                                                                            type="radio"
                                                                            id="status_input_pending_{{ $job->id }}"
                                                                            name="status"
                                                                            class="plan_type_selection custom-control-input"
                                                                            value="pending"
                                                                            {{ $job->status == 'pending' ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="status_input_pending_{{ $job->id }}">{{ __('pending') }}</label>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                            @if ($job->status == 'active' || $job->status == 'pending')
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST"
                                                                    id="job_status_publish_form_{{ $job->id }}">
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input
                                                                            onclick="$('#job_status_publish_form_{{ $job->id }}').submit()"
                                                                            type="radio"
                                                                            id="status_input_publish_{{ $job->id }}"
                                                                            name="status"
                                                                            class="plan_type_selection custom-control-input"
                                                                            value="active"
                                                                            {{ $job->status == 'active' ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="status_input_publish_{{ $job->id }}">{{ __('publish') }}</label>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                            @if ($job->status == 'active' || $job->status == 'expired')
                                                                <form
                                                                    action="{{ route('admin.job.status.change', $job->id) }}"
                                                                    method="POST"
                                                                    id="job_status_unpublish_form_{{ $job->id }}">
                                                                    <div
                                                                        class="custom-control custom-radio custom-control-inline">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input disabled
                                                                            onclick="$('#job_status_unpublish_form_{{ $job->id }}').submit()"
                                                                            type="radio"
                                                                            id="status_input_unpublish_{{ $job->id }}"
                                                                            name="status"
                                                                            class="plan_type_selection custom-control-input expired_radio"
                                                                            value="expired"
                                                                            {{ $job->status == 'expired' ? 'checked' : '' }}>
                                                                        <label
                                                                            @if ($job->status == 'expired') class="custom-control-label
                                                                                expired_radio" @else class="custom-control-label " @endif
                                                                            data-bs-toggle="tooltip"
                                                                            title="{{ __('expired_status_depend_on_deadline') }}"
                                                                            for="status_input_unpublish_{{ $job->id }}">{{ __('expired') }}</label>
                                                                    </div>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a data-bs-toggle="tooltip" data-placement="top"
                                                        title="{{ __('details') }}"
                                                        href="{{ route('job.show', $job->id) }}"
                                                        class="btn ll-btn ll-border-none"><i class="fa fa-eye fa-2x txt-secondary"></i>
                                                        
                                                    </a>
                                                    <a data-bs-toggle="tooltip" data-placement="top"
                                                        title="{{ __('clone') }}"
                                                        href="{{ route('admin.job.clone', $job->slug) }}"
                                                        class="btn ll-mr-4 ll-p-0">
                                                        <i class="fa fa-clone fa-2x"></i>
                                                    </a>

                                                    <a target="_blank" data-bs-toggle="tooltip" data-placement="top"
                                                        title="{{ __('view_frontend') }}"
                                                        href="{{ route('website.job.details', $job->slug) }}"
                                                        class="btn ll-mr-4 ll-p-0">
                                                        <i class="fa fa-link fa-2x txt-info"></i>
                                                    </a>
                                                    @if (userCan('job.update'))
                                                        <a data-bs-toggle="tooltip" data-placement="top"
                                                            title="{{ __('edit') }}"
                                                            href="{{ route('job.edit', $job->id) }}"
                                                            class="btn ll-mr-4 ll-p-0">
                                                            <i class="fa fa-edit fa-2x txt-success"></i>
                                                        </a>
                                                    @endif
                                                    @if (userCan('job.delete'))
                                                        <form action="{{ route('job.destroy', $job->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-bs-toggle="tooltip" data-placement="top"
                                                                title="{{ __('delete') }}"
                                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                class="btn ll-p-0">
                                                                <i class="fa fa-trash-o fa-2x text-danger"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($jobs->total() > $jobs->perPage())
                        <div class="mt-3 d-flex justify-content-center">
                            {{ $jobs->links() }}
                        </div>
                    @endif
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="bulk_import_modal" tabindex="-1" role="dialog"
        aria-labelledby="bulk_import_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('bulk_import') }}</h5>

                </div>
                <form action="{{ route('admin.job.bulk.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning" role="alert">
                            Before importing, please download the example file and match the fields structure. If any field
                            data is missing, the system will generate it
                        </div>
                        <div class="d-grid mb-2">
                            <label for="experience">{{ __('example_file') }}</label> <br>
                            <a href="/backend/dummy/job_example.xlsx" target="_blank" class="btn btn-primary ">
                                <i class="fa fa-download"></i>
                                {{ __('download') }} {{ __('example_file') }}
                            </a>
                        </div>
                       
                        <div class="mb-2">
                            <label for="company_id">{{ __('company') }}</label> <br>
                            <select required name="company"
                                class="form-control select2 @error('company') is-invalid @enderror" id="experience">
                                <option value=""> {{ __('select') }} {{ __('company') }}</option>
                                @foreach ($companies as $company)
                                    <option {{ $company->id == old('company') ? 'selected' : '' }}
                                        value="{{ $company->id }}"> {{ $company->user->name ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="experience">{{ __('choose_file') }}</label> <br>
                            <input type="file" class="form-control dropify" name="import_file"
                                data-allowed-file-extensions='["csv", "xlsx","xls"]' accept=".csv,.xlsx,.xls"
                                data-max-file-size="3M">
                            @error('import_file')
                                <span class="invalid-feedback d-block" role="alert">{{ __($message) }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
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

        function RemoveFilter(id) {
            $('#' + id).val('');
            $('#formSubmit').submit();
        }
    </script>

    <script>
        // Add this script in your HTML file or separate JS file
        $(document).ready(function() {
            // Add this script in your HTML file or separate JS file
            $(document).ready(function() {
                // Select all checkboxes
                $('#select-all').click(function(event) {
                    if (this.checked) {
                        $('.job-checkbox').each(function() {
                            this.checked = true;
                        });
                    } else {
                        $('.job-checkbox').each(function() {
                            this.checked = false;
                        });
                    }
                });

                // Handle delete selected button click
                $('#delete-selected').click(function() {
                    var selectedJobs = [];
                    $('.job-checkbox:checked').each(function() {
                        selectedJobs.push($(this).val());
                    });

                    function showSuccessMessage(message) {
                        toastr.success(message);
                    }
                    // AJAX request to delete selected jobs
                    $.ajax({
                        url: '{{ route('jobs.deleteSelected') }}',
                        data: {
                            ids: selectedJobs
                        },
                        success: function(response) {

                            showSuccessMessage('Job deleted successfully');
                            window.location.reload()
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });

        });
    </script>
@endsection

@section('style')
    <style>
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

        /* Style  radio button */
        .expired_radio::after {
            content: "";
            display: inline-block;
            border-radius: 50%;
            margin-right: 8px;
            background-color: red;
        }
    </style>
@endsection
