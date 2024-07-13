<!-- Page Sidebar Start-->
<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <div class="d-flex">
                <img class="img-fluid m-r-5" src="{{ $setting->favicon_image_url }}" width="25%"
                    alt="{{ __('logo') }}" />
                <h3><span class="text-light mt-3">{{ config('app.name') }}</span></h3>
                {{-- <img class="img-fluid" src="{{asset('/assets/images/logo/mplogo.png')}}" alt=""> --}}
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
                    <li class="back-btn"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid"
                                src="{{ asset('backend/assets/images/logo/logo-icon.png') }}" alt=""></a>
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
                        <a class="sidebar-link sidebar-title link-nav {{ Route::is('admin.dashboard') ? 'active' : 'nav' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home text-light"></i>
                            <span>Dashboard </span></a>
                    </li>

                    @if (userCan('order.view'))
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan">ORDER </h6>
                        </div>
                    </li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('order.index') }}">
                            <i class="fa fa-money text-light"></i>
                            <span>Order</span></a>
                    </li>
                    @endif

                    @if (userCan('company.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('company.index') }}">
                            <i class="fa fa-building text-light"></i>
                            <span>Company</span></a>
                    </li>
                    @endif

                    @if (userCan('candidate.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('candidate.index') }}">
                           <i class="fa fa-user text-light"></i>
                            <span>Candidate</span></a>
                    </li>
                    @endif

                    @if (userCan('job.view') ||
                    userCan('job_category.view') ||
                    userCan('job_role.view') ||
                    userCan('plan.view') ||
                    userCan('industry_types.view') ||
                    userCan('professions.view'))
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan">{{ __('manage_jobs') }} </h6>
                        </div>
                    </li>
                    @endif

                    @if (userCan('job.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('job.index') }}">
                            <i class="fa fa-briefcase text-light"></i>
                            <span> {{ __('jobs') }}</span></a>

                    </li>
                    @endif

                    @if (userCan('job.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('applied.jobs') }}">
                           <i class="fa fa-check-circle text-light"></i>
                            <span> {{ __('applied_jobs') }} </span></a>
                    </li>
                    @endif

                    @if (userCan('job_category.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href=" {{ route('jobCategory.index') }}">
                            <i class="fa fa-th text-light"></i>
                            <span>Job Category </span></a></li>
                    @endif

                    @if (userCan('job_role.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('jobRole.index') }}">
                           <i class="fa fa-mortar-board text-light" ></i>
                            <span>Job Role </span></a></li>
                    @endif

                    @if (Module::collections()->has('Plan') && userCan('plan.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('module.plan.index') }}">
                            <i class="fa fa-credit-card-alt text-light"></i>
                            <span>Price Plan </span></a></li>
                    @endif

                    @if (userCan('industry_types.view') || userCan('professions.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="javascript:void(0)">
                            <i class="fa fa-cogs text-light"></i>
                            <span class="lan"> {{ __('attributes') }}</span></a>
                        <ul class="sidebar-submenu">
                            @if (userCan('industry_types.view'))
                            <li><a href="{{ route('industryType.index') }}">{{ __('industry_type') }} </a>
                            </li>
                            @endif

                            @if (userCan('professions.view'))
                            <li><a href="{{ route('profession.index') }}"> {{ __('professions') }}</a></li>
                            @endif

                            @if (userCan('skills.view'))
                            <li><a href="{{ route('skill.index') }}"> {{ __('skills') }}</a></li>
                            @endif

                            @if (userCan('tags.view'))
                            <li><a href="{{ route('tags.index') }}"> {{ __('tags') }} </a></li>
                            @endif

                            @if (userCan('benefits.view'))
                            <li><a href="{{ route('benefit.index') }}"> {{ __('benefits') }}</a></li>
                            @endif

                            @if (userCan('candidate-language.view'))
                            <li><a href="{{ route('admin.candidate.language.index') }}">
                                    {{ __('language') }}
                                </a></li>
                            @endif

                            <li><a href="{{ route('organizationType.index') }}"> {{ __('organization_type') }}
                                </a>
                            </li>
                            <li><a href="{{ route('salaryType.index') }}"> {{ __('salary_type') }}</a></li>
                            <li><a href="{{ route('education.index') }}"> {{ __('education') }} </a></li>
                            <li><a href="{{ route('experience.index') }}"> {{ __('experience') }} </a></li>
                            <li><a href="{{ route('teamSize.index') }}"> {{ __('team_size') }}</a></li>
                            <li><a href="{{ route('jobType.index') }}"> {{ __('job_type') }}</a></li>
                        </ul>
                    </li>
                    @endif

                    @if (userCan('post.view') ||
                    userCan('country.view') ||
                    userCan('state.view') ||
                    userCan('city.view') ||
                    userCan('newsletter.view') ||
                    userCan('newsletter.sendmail') ||
                    userCan('contact.view') ||
                    userCan('testimonial.view') ||
                    userCan('admin.view'))
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan">OTHERS </h6>
                        </div>
                    </li>
                    @endif

                    @if (Module::collections()->has('Blog'))
                    @if (userCan('post.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('module.blog.index') }}">
                            <i class="fa fa-bullhorn text-light"></i>
                            <span> {{ __('blog') }} </span></a>
                    </li>
                    @endif
                    @endif
                    @if (Module::collections()->has('Location'))
                    @if (userCan('post.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('module.country.index') }}">
                            <i class="fa fa-map-marker text-light"></i>
                            <span> {{ __('country') }} </span></a></li>
                    @endif
                    @endif
                    @if (Module::collections()->has('Newsletter'))
                    @if (userCan('newsletter.view') || userCan('newsletter.sendmail'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title"
                            href="javascript:void(0)">
                            <i class="fa fa-envelope text-light"></i>
                            <span> {{ __('newsletter') }}</span></a>
                        <ul class="sidebar-submenu">

                            @if (userCan('newsletter.view'))
                            <li><a href="{{ route('module.newsletter.index') }}"></i>
                                    {{ __('email_list') }}</a>
                            @endif

                            @if (userCan('newsletter.sendmail'))
                            <li><a href="{{ route('module.newsletter.send_mail') }}"></i>
                                    {{ __('send_mail') }}</a>
                            @endif

                        </ul>
                    </li>
                    @endif
                    @endif

                    @if (Module::collections()->has('Testimonial') && userCan('testimonial.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('module.testimonial.index') }}">
                            <i class="fa fa-star text-light"></i>
                            <span> {{ __('testimonial') }} </span></a>
                    </li>
                    @endif

                    @if (userCan('faq.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('module.faq.index') }}">
                            <i class="fa fa-question-circle text-light"></i>
                            <span> {{ __('faq') }} </span></a>
                    </li>
                    @endif

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{route('user.index')}}">
                            <i class="fa fa-users text-light"></i>
                            <span>User Role Manage </span></a></li>

                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="/">
                            <i class="fa fa-globe text-light"></i>
                            <span> Visit Website </span></a>
                    </li>
                    @if (userCan('setting.view'))
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('settings.general') }}">
                            <i class="fa fa-gear text-light"></i>
                            <span>Settings </span></a>
                    </li>
                    @endif
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                           <i class="fa fa-sign-out text-light"></i>
                            <span>Log Out </span></a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->

<!-- footer start-->