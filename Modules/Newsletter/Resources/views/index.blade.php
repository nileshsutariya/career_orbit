@extends('backend.layouts.app')
@section('title')
    {{ __('email_list') }}
@endsection

@section('content')
    <div class="container-fluid">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                        <div class="pb-3 pb-md-0">
                            <h4 class="title">{{ __('email_list') }}
                            </h4>
                        </div>
                        <div>
                            <div class="d-flex flex-row">

                                @if (userCan('newsletter.sendmail'))
                                    <a href="{{ route('module.newsletter.send_mail') }}" class="btn btn-primary">
                                        <i class="fa fa-paper-plane"></i>&nbsp; {{ __('send_mail') }}
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="dt-ext table-responsive theme-scrollbar">

                        <table class="display" id="export-button">
                            @if ($emails->count() > 0)
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('email') }}</th>
                                        <th>{{ __('subscriptions_date') }}</th>
                                        @if (userCan('newsletter.delete'))
                                            <th>{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                            @endif
                            <tbody>
                                @forelse ($emails as $email)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $email->email }}</td>
                                        <td>{{ date('d M, Y', strtotime($email->created_at)) }}</td>
                                        @if (userCan('newsletter.delete'))
                                            <td>
                                                <form action="{{ route('module.newsletter.delete', $email->id) }}"
                                                    method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button data-toggle="tooltip" data-placement="top"
                                                        title="{{ __('delete_email') }}"
                                                        onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                        class="btn">
                                                        <i class="txt-danger  fa fa-trash fa-2x"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
