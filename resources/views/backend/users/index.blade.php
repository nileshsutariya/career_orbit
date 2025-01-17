@extends('backend.layouts.app')
@section('title')
{{ __('users_list') }}
@endsection

@section('content')
@php
$userr = auth()->user();
@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title line-height-36">{{ __('users_list') }}</h3>
                        <div class="d-flex align-items center">
                            <a href="{{ route('role.index') }}" class="btn btn-outline-secondary  m-r-5">
                                <i class="fa fa-lock mr-1"></i>
                                {{ __('all_roles') }}
                            </a>
                            <a href="{{ route('user.create') }}" class="btn bg-primary">
                                <i class="fa fa-plus mr-1"></i> &nbsp;
                                {{ __('create') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body dt-ext table-responsive theme-scrollbar">
                    <table class="table" id="export-button">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('email') }}</th>
                                <th>{{ __('roles') }}</th>
                                @if ($userr->can('admin.edit') || $userr->can('admin.delete'))
                                <th width="10%">{{ __('action') }}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody >
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                    <span class="badge badge-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="d-flex">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn ll-p-0">
                                        <i class="fa fa-edit text-success fa-2x"></i>
                                    </a>

                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                        class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm(__('are_you_sure_want_to_delete_this_item'));"
                                            class="btn ll-p-0">
                                            <i class="fa fa-trash-o fa-2x text-danger"></i>
                                        </button>
                                    </form>
                                    </div>

                                </td>
                            </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection