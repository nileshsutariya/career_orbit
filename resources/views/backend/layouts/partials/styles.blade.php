@yield('style')
{{-- <link rel="stylesheet" href="{{ asset('backend') }}/plugins/dropify/css/dropify.min.css"> --}}
<link rel="icon" href="{{ $setting->favicon_image_url }}" type="image/x-icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/font-awesome.css') }}">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/icofont.css') }}">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/themify.css') }}">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/flag-icon.css') }}">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/feather-icon.css') }}">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/slick.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/slick-theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/scrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/datatables.css') }}">

<link rel="stylesheet" type="text/css"
    href="{{ asset('backend/assets/css/vendors/date-range-picker/flatpickr.min.css') }}">

<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/bootstrap.css') }}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">
<link id="color" rel="stylesheet" href="{{ asset('backend/assets/css/color-1.css') }}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/responsive.css') }}">


<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/owlcarousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/rating.css') }}">


<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/dropzone.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/filepond.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('backend/assets/css/vendors/filepond-plugin-image-preview.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/leaflet.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/summernote.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/intltelinput.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/tagify.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- For PWA Theme Color as it is Frontend Start  -->
@php
    $sessionPrimaryColor = session('primaryColor');
    $primaryColor = $sessionPrimaryColor ? $sessionPrimaryColor : $setting->frontend_primary_color;
@endphp

<!-- For PWA Theme Color as it is Frontend End  -->

<!-- PWA Meta Theme color and link Start  -->
@if ($setting->pwa_enable)
    <meta name="theme-color" content="{{ $primaryColor }}" />
    <link rel="apple-touch-icon" href="{{ $setting->favicon_image_url }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
@endif
<!-- PWA Meta Theme color and link End -->

<style>
    :root {
        --sidebar-bg-color: {{ $setting->sidebar_color }} !important;
        --sidebar-txt-color: {{ $setting->sidebar_txt_color }} !important;
        --top-nav-bg-color: {{ $setting->nav_color }} !important;
        --top-nav-txt-color: {{ $setting->nav_txt_color }} !important;
        --main-color: {{ $setting->main_color }} !important;
        --accent-color: {{ $setting->accent_color }} !important;

        /* For PWA Theme Color as it is Frontend  */
        --primary-500: {{ $primaryColor }} !important;
    }
</style>
<style>
    .text-red {
        color: red;
    }
</style>
