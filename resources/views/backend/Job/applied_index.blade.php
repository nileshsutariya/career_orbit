@extends('backend.layouts.app')
@section('title')
    {{ __('applied_jobs') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="d-flex justify-content-between flex-sm-row flex-column">
                            <div class="pb-3 pb-md-0">
                                <h4 class="title">{{ __('applied_jobs') }}
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('backend.layouts.partials.message')
                        <div class="dt-ext table-responsive theme-scrollbar">

                            <table class="table" id="export-button">
                                <thead>
                                    <tr>
                                        <th width="10%">{{ __('candidate') }}</th>
                                        <th width="10%">{{ __('company') }}</th>
                                        <th width="10%">{{ __('job') }}</th>
                                        <th width="10%">{{ __('cover_latter') }}</th>
                                        @if (userCan('job.update') || userCan('job.delete'))
                                            <th width="10%">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($applied_jobs->count() > 0)
                                        @foreach ($applied_jobs as $job)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('candidate.show', $job->appliedcandidate->id) }}"
                                                        class="company">
                                                        @if ($job->appliedcandidate->user->name)
                                                            <img class="img-fluid table-avtar"
                                                                src="{{ asset($job->appliedcandidate->photo) }}"
                                                                alt="image">
                                                        @else
                                                            <x-svg.briefcase-logo />
                                                        @endif
                                                        <div>
                                                            <p>
                                                                <span>{{ $job->appliedcandidate && $job->appliedcandidate->user ? $job->appliedcandidate->user->name : ' ' }}</span>
                                                            </p>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('company.show', $job->job->company->id) }}"
                                                        class="company">
                                                        @if ($job->job->company)
                                                            <img class="img-fluid table-avtar"
                                                                src="{{ asset($job->job->company->logo_url) }}"
                                                                alt="image">
                                                        @else
                                                            <x-svg.briefcase-logo />
                                                        @endif
                                                        <div>
                                                            <p>
                                                                <span>{{ $job->job->company && $job->job->company->user ? $job->job->company->user->name : $job->job->company_name }}</span>
                                                            </p>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('job.show', $job->job->id) }}" class="company">
                                                        <p>{{ $job->job->title }}</p>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('job.show', $job->id) }}" class="company">
                                                        <p>{{ $job->cover_letter }}</p>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('details') }}"
                                                        href="{{ route('applied.job.show', $job->id) }}"
                                                        class="btn ll-btn ll-border-none">{{ __('view_details') }}

                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                       
                                    @endif

                                </tbody>
                               
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
