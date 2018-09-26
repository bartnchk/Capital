<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">

    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Microsoft Tiles -->
    <meta name="msapplication-config" content="browserconfig.xml">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    @yield('meta_title')
    @yield('meta_description')
    @yield('meta_keywords')


    <!-- Styles -->
    <link href="{{ asset('css/chosen.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.min.css') }}" rel="stylesheet">
    {{--@yield('styles')--}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Exo+2:600,700&amp;subset=cyrillic" rel="stylesheet">

    {{--<link rel="stylesheet" href="css/main.min.css">--}}
</head>
<body>
@include('site.includes.preloader')
<!--[if lte IE 11]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<div class="mainWrapper">

    <div class="contentWrapper">
        @include('site.layouts.header')

        <!-- Start of page code insertion here -->
        @yield('content')
        <!-- End of page code insertion here -->

        <div class="relative scrollTopContainer">
            <div id="scrollTopButton" class="icomoon standard-arrow-icon navigateIcon up"></div>
        </div>

    </div>

    @include('site.includes.action_subscribe_popup_form')

    @include('site.includes.action_subscribe_popup_success')

    @include('site.includes.news_subscribe_popup_success')

    @include('site.includes.search_popup')

    @include('site.includes.callback_popup_success')

    @include('site.includes.callback_popup_form')

    @include('site.includes.notification_popup')


    @include('site.layouts.footer')
</div>
<!--________SCRIPTS______-->

<script type="text/javascript" src="{{ asset('js/site/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/infobox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/chosen.jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/index.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/popups.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site/jquery.colorbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/site.js') }}"></script>

@yield('scripts')
</body>
</html>
