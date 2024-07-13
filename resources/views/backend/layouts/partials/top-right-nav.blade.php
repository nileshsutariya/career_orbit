@php
$user = auth()->user();
$languages = loadLanguage();
$current_language = currentLanguage() ? currentLanguage() : loadDefaultLanguage();
@endphp



<div class="row">
    <div class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
        <ul class="nav-menus">

            <li class="onhover-dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="flag-icon {{ $current_language?->icon }}"></i>
                    <span class="text-uppercase">{{ $current_language->code }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    @foreach ($languages as $lang)
                    <a class="dropdown-item {{ $current_language->code === $lang->code ? 'active' : '' }}"
                        href="{{ route('changeLanguage', $lang->code) }}">
                        {{ $lang->name }}
                    </a>
                    @endforeach
                </div>
            </li>

            <li class="onhover-dropdown">
                <div class="notification-box">
                    <svg>
                        <use href="{{ asset('backend/assets/svg/icon-sprite.svg#notification') }}"></use>
                    </svg><span class="badge rounded-pill badge-primary">
                        @php
                        $adminUnNotificationsCount = adminUnNotifications();
                        @endphp
                        @if ($adminUnNotificationsCount != 0)
                        <span class="badge badge-warning navbar-badge" id="unNotifications">
                            {{ $adminUnNotificationsCount }}
                        </span>
                        @endif
                    </span>
                </div>
                <div class="onhover-show-div notification-dropdown">
                    <h5 class="f-18 f-w-600 mb-0 dropdown-title">Notitications </h5>
                    <ul class="notification-box">
                        <li class="d-flex">

                            @php
                            $adminNotifications = adminNotifications();
                            @endphp
                            @if ($adminNotifications->count() > 0)
                            @foreach ($adminNotifications as $notification)
                            <div class="dropdown-divider"></div>
                            <a href="{{ $notification->data ? $notification->data['url'] : '' }}"
                                class="dropdown-item word-break">
                                <p>
                                    @if ($notification->type == 'App\Notifications\Admin\NewJobAvailableNotification')
                                    <i class="fas fa-briefcase"></i>
                                    @elseif ($notification->type ==
                                    'App\Notifications\Admin\NewPlanPurchaseNotification')
                                    <i class="fas fa-credit-card"></i>
                                    @elseif ($notification->type ==
                                    'App\Notifications\Admin\NewUserRegisteredNotification')
                                    <i class="fas fa-user"></i>
                                    @endif
                                    &nbsp;
                                    {{ $notification->data ? $notification->data['title'] : '-' }}
                                </p>
                                <span class="float-right text-muted text-sm">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </a>
                            @endforeach
                            @else
                            <span class="d-flex justify-content-center mb-2 p-2 text-sm">
                                {{ __('no_notification') }}
                            </span>
                            @endif
                            @if ($adminNotifications->count() > 6)
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('admin.all.notification') }}" class="dropdown-item dropdown-footer">{{
                                __('see_all_notifications') }}
                            </a>
                            @endif

                        </li>

                    </ul>
                </div>
            </li>

            <li>
                <div class="mode">
                    <svg>
                        <use href="{{ asset('backend/assets/svg/icon-sprite.svg#moon') }}"></use>
                    </svg>
                </div>
            </li>


            <li class="profile-nav onhover-dropdown px-0 py-0">
                <div class="d-flex profile-media align-items-center"><img class="img-30"
                        src="{{ asset($user->image_url) }}" alt="">
                    <div class="flex-grow-1"><span>{{ $user->name }}</span>
                        <p class="mb-0 font-outfit">
                            @foreach (auth()->user()->getRoleNames() as $role)
                            (<span>{{ ucwords($role) }}</span>)
                            @endforeach
                            <i class="fa fa-angle-down"></i>
                        </p>
                    </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                    <li><a href="{{ route('profile') }}"><i data-feather="user"></i><span>Profile</span></a></li>
                    <li><a href="javascript:void(0)"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i
                                data-feather="log-out"> </i><span>Log Out</span></a></li>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none invisible">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
    </div>

</div>