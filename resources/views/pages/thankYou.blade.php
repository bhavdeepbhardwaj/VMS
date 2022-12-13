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

    <style>
        li {
            text-align: justify;
        }

        .required {
            color: rgb(255, 1, 1);
        }
    </style>
    {{-- <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style> --}}

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
                            <img class="pt-5" src="{{ asset('assets/img/logo/logo.png') }}" alt="Globalsync" />
                        </div>

                        <div class="justify-content-between align-items-center mb-3" style="margin-top: 100px!important">
                            <h4>Dear Customer,</h4>
                            <p>We are working on your dashboard as per your requirement.</p>
                            <p>You will shortly receive all details from us and confirmation to login and access
                                dashboard.</p>
                        </div>
                    </div>
                </div>
                <!-- End Content Wrapper -->
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->

    <!-- globalsync Custom -->
    {{-- <script src="{{ asset('assets/js/globalsync.js ') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/html2pdf.js ') }}"></script> --}}
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    {{-- <script>
        function generatePDF() {
            var doc_name = "Visitor.pdf";
            var element = document.getElementById('converttoPDF');
            html2pdf().set({
                html2canvas: {
                    scale: 4,
                    scrollY: 0
                }
            }).from(element).save(doc_name);
        }
    </script> --}}

</body>

</html>
