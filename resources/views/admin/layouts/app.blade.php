<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="GLOBALSYNC">
    <meta name="msapplication-TileColor" content="#ffcc06">
    <meta name="theme-color" content="#ffcc06">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title')</title>

    <!-- GOOGLE FONTS -->

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css ') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/simplebar/simplebar.css ') }}" rel="stylesheet" />

    <!-- globalsync CSS -->
    <link id="globalsync-css" href="{{ asset('assets/css/globalsync.css ') }}" rel="stylesheet" />

    @yield('css')

    <!-- FAVICON -->
    <link href="{{ asset('assets/img/icons/favicon.ico  ') }}" rel="shortcut icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icons/apple-touch-icon.png ') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/icons/favicon-32x32.png ') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/icons/favicon-16x16.png ') }}">
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/icons/safari-pinned-tab.svg" color="#ffcc06 ') }}">


    <style>
        @media (max-width:767px) {
            .hidden-sm-down {
                display: none !important
            }
        }

        @media (min-width:768px) {
            .hidden-md-up {
                display: none !important
            }
        }
    </style>

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

    <!--  WRAPPER  -->
    <div class="wrapper">

        <!-- LEFT MAIN SIDEBAR -->
        @include('admin.layouts.component.sidebar')

        <!--  PAGE WRAPPER -->
        <div class="ec-page-wrapper">

            <!-- Header -->
            @include('admin.layouts.component.header')

            <!-- CONTENT WRAPPER -->
            @yield('content')
            <!-- End Content Wrapper -->

            <!-- Footer -->
            @include('admin.layouts.component.footer')

        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->

    <!-- Common Javascript -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js ') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js ') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/simplebar.min.js ') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-zoom/jquery.zoom.min.js ') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.min.js ') }}"></script>

    <!-- Chart -->
    <script src="{{ asset('assets/plugins/charts/Chart.min.js ') }}"></script>
    <script src="{{ asset('assets/js/chart.js ') }}"></script>

    <!-- Google map chart -->
    <script src="{{ asset('assets/plugins/charts/google-map-loader.js ') }}"></script>
    <script src="{{ asset('assets/plugins/charts/google-map.js ') }}"></script>

    <!-- Date Range Picker -->
    <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js ') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js ') }}"></script>
    <script src="{{ asset('assets/js/date-range.js ') }}"></script>

    <!-- Option Switcher -->
    <script src="{{ asset('assets/plugins/options-sidebar/optionswitcher.js ') }}"></script>

    <!-- globalsync Custom -->
    <script src="{{ asset('assets/js/globalsync.js ') }}"></script>

    @yield('js')

</body>

</html>
