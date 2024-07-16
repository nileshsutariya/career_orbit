<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Mofi admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Mofi admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') - {{ config('app.name') }} </title>
    @include('backend.layouts.partials.styles')
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader loader-1">
            <div class="loader-outter"></div>
            <div class="loader-inner"></div>
            <div class="loader-inner-1"></div>
        </div>
    </div>
    @php
        $user = auth()->user();
    @endphp


    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-header row">
            <div class="header-logo-wrapper col-auto">
                <div class="logo-wrapper"><a href="{{ route('admin.dashboard') }}"><img class="img-fluid for-light"
                            src="{{ $setting->favicon_image_url }}" alt="{{ __('logo') }}" /></a>
                </div>
            </div>
            <div class="col-4 col-xl-4 page-title">
                <h4 class="f-w-700">Default dashboard</h4>
                <nav>

                    <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
                        {{-- <li class="breadcrumb-item"><a id="nav_collapse" class="nav-link" data-widget="pushmenu"
                                href="#" role="button"> <i class="fa fa-bars"></i> </a></li> --}}
                        <li class="breadcrumb-item f-w-400"><a href="{{ url('/') }}"> <i
                                    class="fa fa-globe"></i></a>
                        </li>
                        <li class="breadcrumb-item f-w-400 active"><a href="{{ route('app.optimize-clear') }}"> <i
                                    class="icofont icofont-brush"></i></a></li>
                    </ol>
                </nav>
            </div>
            <!-- Page Header Start-->
            <div class="header-wrapper col m-0">


                @include('backend.layouts.partials.top-right-nav')

            </div>
            <!-- Page Header Ends  -->
        </div>
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->

            @if (request()->is('admin/settings/*'))
                @include('backend.layouts.partials.setting-sidebar')
            @else
                @include('backend.layouts.partials.default-sidebar')
            @endif


            <!-- Page Sidebar Ends-->


            <div class="page-body">
                <!-- Container-fluid starts-->
                @yield('breadcrumbs')
                @yield('content')
                <!-- Container-fluid Ends-->
            </div>

            @include('backend.layouts.partials.footer')
        </div>
    </div>
    @include('backend.layouts.partials.scripts')

    <script>
        Validate();

        $('#search').keyup(Validate);

        function Validate() {
            $('#searchIcon').addClass('d-none');
            $('#searchRemove').removeClass('d-none');
        }

        function RemoveHistory() {
            location.reload();
        }

        $('#search').keyup(function() {

            $('#searchcontainer').addClass('sidebar-search-open');

            $.ajax({
                url: "{{ route('admin.search') }}",
                type: "POST",
                data: {
                    data: $('#search').val(),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {

                    $('#result').html('');
                    if (result.pages.length > 0) {

                        $.each(result.pages, function(key, page) {
                            $('#result').append('<a href="' + page.url +
                                '" class="list-group-item p-2"><div class="search-title">' +
                                page.page_title + '</div></a>');
                        });

                    } else {

                        $('#result').html(
                            '<span class="list-group-item"><div class="search-title text-center p-1"><strong>No Page</strong></div><div class="search-path"></div></span>'
                        )
                    }
                }
            });
        });
    </script>

    @if ($setting->pwa_enable)
        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker) {
                navigator.serviceWorker.register("/sw.js").then(function(reg) {
                    console.log("Service worker has been registered for scope: " + reg);
                });
            }

            let deferredPrompt;
            window.addEventListener('beforeinstallprompt', (e) => {
                $('#installApp').removeClass('d-none');
                deferredPrompt = e;
            });

            const installApp = document.getElementById('installApp');
            installApp.addEventListener('click', async () => {
                if (deferredPrompt !== null) {
                    deferredPrompt.prompt();
                    const {
                        outcome
                    } = await deferredPrompt.userChoice;
                    if (outcome === 'accepted') {
                        deferredPrompt = null;
                    }
                }
            });
        </script>
    @endif


</body>

</html>
