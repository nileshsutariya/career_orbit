@extends('backend.layouts.app')
@section('title')
    {{ $user->name }} {{ __('details') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="float-start">
                            <h4>{{ $candidate->user->name }}'s
                                {{ __('details') }}</h4>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('candidate.edit', $candidate->id) }}">
                                <i class="fa fa-edit fa-2x text-success"></i>
                            </a>
                            <form action="{{ route('candidate.destroy', $candidate->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('{{ __('are_you_sure_you_want_to_delete_this_item') }}');"
                                    class="border-0 bg-transparent">
                                    <i class="fa fa-trash-o fa-2x text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="candidate-logo m-r-20">
                                            <img src="{{ $candidate->photo }}" alt="candidate_profile">
                                        </div>
                                        <div>
                                            <h3>{{ $candidate->user->name }}</h3>
                                            <p>{{ $candidate->user->email }}</p>

                                            @if ($user->socialInfo && $candidate->user->socialInfo->count() > 0)
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($user->socialInfo as $contact)
                                                        <a class="social-media" target="__blank"
                                                            href="{{ $contact->url }}">
                                                            @switch($contact)
                                                                @case($contact->social_media === 'facebook')
                                                                    <x-svg.facebook-icon />
                                                                @break

                                                                @case($contact->social_media === 'twitter')
                                                                    <x-svg.twitter-icon />
                                                                @break

                                                                @case($contact->social_media === 'instagram')
                                                                    <x-svg.instagram-icon />
                                                                @break

                                                                @case($contact->social_media === 'youtube')
                                                                    <x-svg.youtube-icon />
                                                                @break

                                                                @case($contact->social_media === 'linkedin')
                                                                    <x-svg.linkedin-icon />
                                                                @break

                                                                @case($contact->social_media === 'pinterest')
                                                                    <x-svg.pinterest-icon />
                                                                @break

                                                                @case($contact->social_media === 'reddit')
                                                                    <x-svg.reddit-icon />
                                                                @break

                                                                @case($contact->social_media === 'github')
                                                                    <x-svg.github-icon />
                                                                @break

                                                                @case($contact->social_media === 'other')
                                                                    <x-svg.link-icon />
                                                                @break

                                                                @default
                                                            @endswitch
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="d-flex align-items-center" style="gap: 16px;">
                                                <div>
                                                    <a href="javascript:void(0)" class="active-status">
                                                        <div class="form-check form-switch form-check-inline">
                                                            <input class="form-check-input switch-primary check-size"
                                                                type="checkbox" role="switch"
                                                                data-id="{{ $user->id }}"
                                                                {{ $user->status == 1 ? 'checked' : '' }}>
                                                        </div>

                                                        <p class="{{ $user->status == 1 ? 'active' : '' }}"
                                                            id="status_{{ $candidate->user_id }}">
                                                            {{ $user->status == 1 ? __('activated') : __('deactivated') }}
                                                        </p>
                                                    </a>
                                                </div>

                                                <div>
                                                    <a href="javascript:void(0)" class="active-status">

                                                        <div class="form-check form-switch form-check-inline">
                                                            <input class="form-check-input switch-primary check-size"
                                                                type="checkbox" role="switch"
                                                                data-userid="{{ $user->id }}"
                                                                {{ $user->email_verified_at ? 'checked' : '' }}>
                                                        </div>
                                                        <p class="{{ $user->email_verified_at ? 'active' : '' }}"
                                                            id="verification_status_{{ $candidate->user_id }}">
                                                            {{ $user->email_verified_at ? __('verified') : __('unverified') }}
                                                        </p>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card dashboard-3">
                                <div class="card-body pt-0">
                                    <ul class="recent">
                                        <div class="row d-flex border-bottom">
                                            <li class="d-flex align-items-center col-md-4">
                                                <div class="flex-shrink-0 m-r-10"> <x-svg.details-profession /></div>
                                                <div class="flex-grow-1">
                                                    <h5> {{ __('profession') }}</h5>

                                                    <p> <strong>{{ $candidate->profession ? $candidate->profession->name : '-' }} </strong> </p>
                                                </div>

                                            </li>
                                            <li class="d-flex align-items-center col-md-4">
                                                <div class="flex-shrink-0 m-r-10"> <x-svg.details-experience /> </div>
                                                <div class="flex-grow-1">
                                                    <h5> {{ __('experience') }}</h5>
                                                    <p> <strong>{{ $candidate->experience ? $candidate->experience->name : '' }}</strong></p>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center col-md-4">
                                                <div class="flex-shrink-0 m-r-10"> <x-svg.details-package /></div>
                                                <div class="flex-grow-1">
                                                    <h5> {{ __('marital_status') }}</h5>

                                                    <p> <strong>{{ $candidate->marital_status }} </strong> </p>
                                                </div>
                                            </li>
                                        </div>
                                        <div class="row d-flex border-bottom">
                                            <li class="d-flex align-items-center col-md-4">
                                                <div class="flex-shrink-0 m-r-10"> <x-svg.details-education /></div>
                                                <div class="flex-grow-1">
                                                    <h5> {{ __('education') }}</h5>

                                                    <p><strong>{{ $candidate->education ? $candidate->education->name : '' }} </strong> </p>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center col-md-4">
                                                <div class="flex-shrink-0 m-r-10"> <x-svg.details-leyers /></div>
                                                <div class="flex-grow-1">
                                                    <h5> {{ __('gender') }}</h5>

                                                    <p> <strong>{{ ucfirst($candidate->gender) }}</a></strong></p>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center col-md-4">
                                                <div class="flex-shrink-0 m-r-10"> <x-svg.details-calendar-blank /></div>
                                                <div class="flex-grow-1">
                                                    <h5> {{ __('birth_date') }}</h5>

                                                    <p> <strong>{{ date('D, d M Y', strtotime($candidate->birth_date)) }}</strong> </p>
                                                </div>
                                            </li>
                                        </div>
                                        <div class="row d-flex">
                                            <li class="d-flex align-items-center col-md-4">
                                                <div class="flex-shrink-0 m-r-10"><x-svg.details-globe-simple /></div>
                                                <div class="flex-grow-1">
                                                    <h5> {{ __('website') }}</h5>
                                                    <p> <a href="{{ $candidate->website }}">{{ $candidate->website }}</a> </p>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center col-md-4">
                                                @if ($user->contactInfo && $user->contactInfo->phone)
                                                    <div class="flex-shrink-0 m-r-10"> <x-svg.details-phone-call /></div>
                                                    <div class="flex-grow-1">
                                                        <h5> {{ __('phone') }}</h5>

                                                        <p> <a href="tel: {{ $user->contactInfo->phone }}">{{ $user->contactInfo->phone }}</a> </p>
                                                    </div>
                                                @endif
                                            </li>
                                            <li class="d-flex align-items-center col-md-4">
                                                @if ($user->contactInfo && $user->contactInfo->email)
                                                    <div class="flex-shrink-0 m-r-10"> <x-svg.details-envelop /></div>
                                                    <div class="flex-grow-1">
                                                        <h5> {{ __('contact_email') }}</h5>

                                                        <p> <a href="mailto: {{ $user->contactInfo->email }}">{{ $user->contactInfo->email }}</a></p>
                                                    </div>
                                                @endif
                                            </li>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3> {{ __('description') }} </h3>
                                </div>
                                <div class="card-body">
                                    <p> {!! nl2br($candidate->bio) !!} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="mb-2">{{ __('skills') }} </h3>
                                    <p class="flex">
                                        @foreach ($candidate->skills as $skill)
                                            <span class="badge badge-light-success">{{ $skill->name }}</span>
                                        @endforeach
                                    </p>

                                    <h3 class="mb-2">{{ __('languages') }} </h3>
                                    <p class="flex">
                                        @foreach ($candidate->languages as $language)
                                            <span class="badge badge-light-success">{{ $language->name }}</span>
                                        @endforeach
                                    </p>

                                    <h3 class="mb-2">{{ __('location') }} </h3>
                                    <p><strong>{{ $candidate->exact_location ? $candidate->exact_location : $candidate->full_address }}</strong> </p>
                                </div>
                            </div>
                        </div>

                        <x-admin.candidate.card-component title="{{ __('applied_jobs') }}" :jobs="$appliedJobs" link="website.job.apply" />

                        <x-admin.candidate.card-component title="{{ __('bookmark_jobs') }}" :jobs="$bookmarkJobs" link="website.job.bookmark" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('style')
    <!-- >=>Leaflet Map<=< -->
    <x-map.leaflet.map_links />

    @include('map::links')
@endsection

@section('script')
    {{-- Leaflet  --}}
    <script src="{{ asset('backend/assets/js/dashboard/dashboard_2.js') }}"></script>
    <script src="{{ asset('frontend') }}/assets/js/axios.min.js"></script>
    <x-map.leaflet.map_scripts />
    <script>
        var oldlat = {!! $candidate->lat ? $candidate->lat : $setting->default_lat !!};
        var oldlng = {!! $candidate->long ? $candidate->long : $setting->default_long !!};

        // Map preview
        var element = document.getElementById('leaflet-map');

        // Height has to be set. You can do this in CSS too.
        element.style = 'height:300px;';

        // Create Leaflet map on map element.
        var leaflet_map = L.map(element);

        // Add OSM tile layer to the Leaflet map.
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leaflet_map);

        // Target's GPS coordinates.
        var target = L.latLng(oldlat, oldlng);

        // Set map's center to target with zoom 14.
        const zoom = 14;
        leaflet_map.setView(target, zoom);

        // Place a marker on the same location.
        L.marker(target).addTo(leaflet_map);
    </script>

    <!-- ================ google map ============== -->
    <x-website.map.google-map-check />

    <script>
        function initMap() {
            var token = "{{ $setting->google_map_key }}";

            var oldlat = {!! $candidate->lat ? $candidate->lat : $setting->default_lat !!};
            var oldlng = {!! $candidate->long ? $candidate->long : $setting->default_long !!};

            const map = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 7,
                center: {
                    lat: oldlat,
                    lng: oldlng
                },
            });

            const image =
                "https://gisgeography.com/wp-content/uploads/2018/01/map-marker-3-116x200.png";
            const beachMarker = new google.maps.Marker({

                draggable: false,
                position: {
                    lat: oldlat,
                    lng: oldlng
                },
                map,
                // icon: image
            });
        }
        window.initMap = initMap;
    </script>

    <script>
        @php
            $link1 = 'https://maps.googleapis.com/maps/api/js?key=';
            $link2 = $setting->google_map_key;
            $Link3 = '&callback=initMap&libraries=places,geometry';
            $scr = $link1 . $link2 . $Link3;
        @endphp;
    </script>
    
    <script src="{{ $scr }}" async defer></script>
    <!-- ================ google map ============== -->
@endsection
