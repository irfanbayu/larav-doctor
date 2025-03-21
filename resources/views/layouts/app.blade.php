<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

    <head>
        @include('includes.backsite.meta')

        <title>@yield('title') | MeetDoctor Backoffice</title>

        <link rel="apple-touch-icon" href="{{ asset("/asset/frontsite/app-assets/images/ico/apple-icon-120.png") }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset("/asset/frontsite/app-assets/images/ico/favicon.ico") }}">
        <link href="{{ url("https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700") }}" rel="stylesheet">
        <!-- Include Fancybox CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
        <!-- Include Fancybox JS -->
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
        @stack('before-styles')

            @include('includes.backsite.style')

        @stack('after-styles')

    </head>

    <body class="vertical-layout vertical-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">

        @include('sweetalert::alert')

        @include('components.backsite.header')
        @include('components.backsite.menu')
            @yield('content')
        @include('components.backsite.footer')

        @stack('before-script')
            @include('includes.backsite.script')
        @stack('after-script')

    </body>
</html>
