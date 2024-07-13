<!-- Sidebar -->
<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <div class="d-flex">
                <img class="img-fluid m-r-5" src="{{ $setting->favicon_image_url }}" width="25%"
                    alt="{{ __('logo') }}" />
                <h3><span class="text-light mt-3">{{ config('app.name') }}</span></h3>

                <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                <div class="toggle-sidebar">
                    <svg class="stroke-icon sidebar-toggle status_toggle middle">
                        <use href="{{asset('backend/assets/svg/icon-sprite.svg#toggle-icon')}}"></use>
                    </svg>
                    <svg class="fill-icon sidebar-toggle status_toggle middle">
                        <use href="{{asset('backend/assets/svg/icon-sprite.svg#fill-toggle-icon')}}"></use>
                    </svg>
                </div>
            </div>
        </div>

        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links mb-2" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img class="img-fluid"
                                src="{{asset('backend/assets/images/logo/logo-icon.png')}}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('admin.dashboard') ? true : false }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home text-light"></i>
                            <span>{{ __('dashboard') }}</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>{{ __('website_settings') }}</h6>
                        </div>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.system') ? true : false }}"
                            href="{{ route('settings.system') }}">
                            <i class="fa fa-hashtag text-light"></i>
                            <span>{{ __('preferences') }}</span></a>
                    </li>

                    @if (userCan('menu-setting.index'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('menu-settings.*') ? true : false }}"
                            href="{{ route('menu-settings.index') }}">
                            <i class="fa fa-navicon text-light"></i>
                            <span>{{ __('menu_settings') }}</span></a>
                    </li>
                    @endif

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.social.login') ? true : false }}"
                            href="{{ route('settings.social.login') }}">
                            <i class="fa fa-facebook-square text-light"></i>
                            <span>{{ __('social_login') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.cookies') ? true : false }}"
                            href="{{ route('settings.cookies') }}">
                            <i class="fa fa-warning text-light"></i>
                            <span>{{ __('cookies_alert') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.seo.*') ? true : false }}"
                            href="{{ route('settings.seo.index') }}">
                            <i class="fa fa-gear text-light"></i>
                            <span>{{ _('seo') }} {{ _('settings') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.pages.*') ? true : false }}"
                            href="{{ route('settings.pages.index') }}">
                            <i class="fa fa-desktop text-light"></i>
                            <span>{{ __('pages') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.custom') ? true : false }}"
                            href="{{ route('settings.custom') }}">
                            <i class="fa fa-wrench text-light"></i>
                            <span>{{ __('custom_css_and_js') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.websitesetting') ? true : false }}"
                            href="{{ route('settings.websitesetting') }}">
                            <i class="fa fa-list text-light"></i>
                            <span>{{ __('cms') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.affiliate.index') ? true : false }}"
                            href="{{ route('settings.affiliate.index') }}">
                            <i class="fa fa-moon-o text-light"></i>
                            <span>{{ __('affiliate') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.email-templates.list') ? true : false }}"
                            href="{{ route('settings.email-templates.list') }}">
                            <i class="fa fa-envelope text-light"></i>
                            <span>{{ __('email_templates') }}</span></a>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6>{{ __('system_settings') }}</h6>
                        </div>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.general') ? true : false }}"
                            href="{{ route('settings.general') }}">
                            <i class="fa fa-cogs text-light">
                            <span>{{ __('general') }}</span></i></a>
                    </li>

                    @if (auth()->user()->can('setting.view') || auth()->user()->can('setting.update'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('languages.*') ? true : false }}"
                            href="{{ route('languages.index') }}">
                            <i class="fa fa-globe text-light"></i>
                            <span>{{ __('language') }}</span></a>
                    </li>
                    @endif

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="javascript:void(0)">
                            <i class="fa fa-map-marker text-light"></i>
                            <span>{{ __('location') }}</span></a>

                        @if (userCan('country.view'))
                        <ul class="sidebar-submenu">
                            <li><a class="{{ Route::is('location.country.country') ? true : false }}"
                                    href="{{ route('location.country.country') }}">{{ __('country') }}</a>
                            </li>
                            <li><a class="{{ Route::is('location.state.state') ? true : false }}"
                                    href="{{ route('location.state.state') }}">{{ __('state') }}</a></li>
                            <li><a class="{{ Route::is('location.city.city') ? true : false }}"
                                    href="{{ route('location.city.city') }}">{{ __('city') }}</a></li>
                        </ul>
                        @endif
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.theme') ? true : false }}"
                            href="{{ route('settings.theme') }}">
                            <i class="fa fa-adjust text-light"></i>
                            <span>{{ __('theme') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.email') ? true : false }}"
                            href="{{ route('settings.email') }}">
                            <i class="fa fa-envelope-o text-light"></i>
                            <span>{{ __('smtp') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('module.currency.*') ? true : false }}"
                            href="{{ route('module.currency.index') }}">
                            <i class="fa fa-dollar text-light"></i>
                            <span>{{ __('currency') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="javascript:void(0)">
                            <i class="fa fa-credit-card text-light"></i>
                            <span>{{ __('payment_gateway') }}</span></a>

                        @if (userCan('country.view'))
                        <ul class="sidebar-submenu">
                            <li><a class="{{ Route::is('settings.payment') ? true : false }}"
                                    href="{{ route('settings.payment') }}"> {{ __('auto_payment') }}</a></li>
                            @endif

                            @if (userCan('map.view'))
                            <li><a class="{{ Route::is('settings.payment.manual') ? true : false }}"
                                    href="{{ route('settings.payment.manual') }}"> {{ __('manual_payment') }}</a></li>
                        </ul>
                        @endif
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.upgrade') ? true : false }}"
                            href="{{ route('settings.upgrade') }}">
                            <i class="fa fa-upload text-light"></i>
                            <span>{{ __('upgrade_guide') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.ad_setting') ? true : false }}"
                            href="{{ route('settings.ad_setting') }}">
                            <span>{{ __('Place listing') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="/log-viewer">
                            <i class="fa fa-cog text-light"></i>
                            <span>Log Viewer</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('settings.systemInfo') ? true : false }}"
                            href="{{ route('settings.systemInfo') }}">
                            <i class="fa fa-info-circle text-light"></i>
                            <span>{{ __('systemInfo') }}</span></a>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav active" href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-chevron-left text-light"></i>
                            <span>{{ __('go_back') }}</span></a>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>

    </div>

</div>

<!-- /.sidebar -->