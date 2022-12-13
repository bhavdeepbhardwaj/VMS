<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="GLOBALSYNC | REGISTRATION">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>@yield('title')</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- globalsync CSS -->
    <link id="globalsync-css" rel="stylesheet" href="{{ asset('assets/css/globalsync.css ') }}" />

    <!-- FAVICON -->
    <link href="{{ asset('assets/img/icons/favicon.ico  ') }}" rel="shortcut icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icons/apple-touch-icon.png ') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/icons/favicon-32x32.png ') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/icons/favicon-16x16.png ') }}">
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/icons/safari-pinned-tab.svg" color="#5bbad5 ') }}">


    @yield('css')
</head>

<body class="sign-inup" id="body">

    <!-- CONTENT WRAPPER -->
    @yield('content')
    <!-- End CONTENT WRAPPER -->

    <!-- Javascript -->
    {{-- <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js ') }}"></script> --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js ') }}"></script>
    {{-- <script src="{{ asset('assets/plugins/jquery-zoom/jquery.zoom.min.js ') }}"></script> --}}
    {{-- <script src="{{ asset('assets/plugins/slick/slick.min.js ') }}"></script> --}}

    <!-- globalsync Custom -->
    {{-- <script src="{{ asset('assets/js/globalsync.js ') }}"></script> --}}
    @yield('js')

</body>

</html>
