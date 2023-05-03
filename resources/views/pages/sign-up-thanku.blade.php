<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Globalsync">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- FAVICON -->
    <link href="{{ asset('assets/img/icons/favicon.ico  ') }}" rel="shortcut icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icons/apple-touch-icon.png ') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/icons/favicon-32x32.png ') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/icons/favicon-16x16.png ') }}">
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/icons/safari-pinned-tab.svg" color="#5bbad5 ') }}">

    <!-- Bootstrap CSS -->
    <link id="globalsync-css" href="{{ asset('assets/css/demo.css ') }}" rel="stylesheet" />
    <link id="globalsync-css" rel="stylesheet" href="{{ asset('assets/css/globalsync.css ') }}" />


    <style>
        li {
            text-align: justify;
        }

        .required {
            color: rgb(255, 1, 1);
        }
    </style>

    <title>GLOBALSYNC THANK YOU</title>
</head>

<body>
    <section class=" container-lg pb-3">
        <div class="row">
            <div class="container">
                <!-- CONTENT WRAPPER -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class=" text-center">
                            <a href="/"><img class="pt-5" src="{{ asset('assets/img/logo/logo.png') }}"
                                    alt="Globalsync" /></a>
                        </div>
                        <div class="card-body pt-5">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{-- <i class="mdi mdi-check-circle-outline"></i> {{ session('status') }} --}}
                                    <i class="mdi mdi-check-circle-outline"></i> {!! Session::get('status') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- End Content Wrapper -->
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->

</body>

</html>
