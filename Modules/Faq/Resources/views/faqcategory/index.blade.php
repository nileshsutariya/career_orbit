@extends('backend.layouts.app')

@section('title')
    {{ __('faq_category_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">

                        <div class="float-start">
                            <h4 class="title">{{ __('faq_category_list') }}
                            </h4>
                        </div>
                        <div>
                            <div class="float-end">
                                @if (userCan('faq.create'))
                                    <a href="{{ route('module.faq.category.create') }}" class="btn bg-primary">
                                        <i class="fa fa-plus"></i>&nbsp; {{ __('create') }}
                                    </a>
                                @endif


                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="dt-ext table-responsive theme-scrollbar">

                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>{{ __('icon') }}</th>
                                        <th>{{ __('name') }}</th>
                                        @if (userCan('faq.update') || userCan('faq.delete'))
                                            <th width="10%">{{ __('action') }}</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($faqCategories as $faqCategory)
                                        <tr data-id="{{ $faqCategory->id }}">
                                            <th>{{ $loop->iteration }}</th>
                                            <th><i class="{{ $faqCategory->icon }}"></i></th>
                                            <th>{{ $faqCategory->name }}</th>
                                            @if (userCan('faq.update') || userCan('faq.delete'))
                                                <td class="d-flex align-items-center">
                                                    @if (userCan('faq.update'))
                                                        <div class="handle btn  mt-0"><i class="fa fa-hand-rock-o fa-2x"
                                                                aria-hidden="true"></i>
                                                        </div>
                                                        <a data-bs-toggle="tooltip" data-placement="top"
                                                            title="{{ __('edit') }}"
                                                            href="{{ route('module.faq.category.edit', $faqCategory->id) }}"
                                                            class="btn"><i class="txt-success fa fa-edit fa-2x"></i></a>
                                                    @endif
                                                    @if (userCan('faq.delete'))
                                                        <form
                                                            action="{{ route('module.faq.category.destroy', $faqCategory->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button data-bs-toggle="tooltip" data-placement="top"
                                                                title="{{ __('delete') }}"
                                                                onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                                                class="btn"><i
                                                                    class="txt-danger fa fa-trash-o fa-2x"></i></button>
                                                        </form>
                                                    @endif
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

    </div>
@endsection


@section('script')
    <script src="{{ asset('backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script>
        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                dropOnEmpty: false,
                update: function() {
                    sendTaskOrderToServer('#sortable tr');
                },
                classes: {
                    "ui-sortable": "highlight"
                },
            });
            $("#sortable").disableSelection();

            function sendTaskOrderToServer(selector) {
                var order = [];
                $(selector).each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('module.faq.category.updateOrder') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    }
                });
            }
        });
    </script>
@endsection
