<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="msapplication-TileColor" content="#ffcc05">
    <meta name="theme-color" content="#ffcc05">
    <!-- FAVICON -->
    <link href="{{ asset('assets/img/icons/favicon.ico  ') }}" rel="shortcut icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icons/apple-touch-icon.png ') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/icons/favicon-32x32.png ') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/icons/favicon-16x16.png ') }}">
    {{-- <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}"> --}}
    <link rel="mask-icon" href="{{ asset('assets/img/icons/safari-pinned-tab.svg" color="#ffcc05 ') }}">
    <title>GLOBALSYNC</title>

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('assets/visitor/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <link id="globalsync-css" href="{{ asset('assets/css/globalsync.css ') }}" rel="stylesheet" />
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}">
    <link rel="stylesheet" href="{{ asset('assets/visitor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />

    <!-- Main css -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

        body {
            font-family: 'Lato', sans-serif;
        }

        .hidden {
            display: none;
        }

        .form-section {
            display: none;
        }

        .form-section.current {
            display: inline;
        }

        .parsley-errors-list {
            color: red;
            font-size: 16px !important;
        }

        .nav-link {
            display: block;
            padding: 0;
            color: #88aaf3;
            text-decoration: none;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        }

        /* .error {
    color: red;
    } */
    </style>

</head>

<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <div class="signup-desc">
                    <div class="signup-desc-content">
                        @if ($checkLogo != null)
                            <img class="" src="{{ asset($checkLogo) }}" alt="{{ $data }}"
                                style="width: 250px;" />
                        @else
                            <img class="" src="{{ asset('assets/img/logo/demo.png') }}"
                                alt="{{ $data }}" style="width: 250px;" />
                        @endif
                        <p class="title">Welcome To {{ $data }}</p>
                        <p class="desc">Please enter your details to check-in.</p>
                        <img src="{{ asset('assets/visitor/images/signup-img.png') }}"
                            style="width: 300px; height: 285px; margin-left: -50px;" alt="" class="signup-img">
                        <img class="" src="{{ asset('assets/img/GSync_Footer.png') }}" alt="Globalsync"
                            style="" />
                    </div>
                </div>
                <div class="signup-form-conent">
                    <div class="nav nav-fill my-8">
                        <label class="nav-link shadow-sm step0   border ml-2 ">&nbsp;</label>
                        <label class="nav-link shadow-sm step1   border ml-2 "></label>
                    </div>

                    <form method="POST" action="{{ route('user.visitorstore') }}" class="signup-form"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="hidden">
                            {{-- Company Code ID --}}
                            <input type="text" id="companyCode" name="companyCode" value="{{ $data }}"
                                readonly>
                            {{-- Company Logo --}}
                            <input type="text" id="companyLogo" name="companyLogo" value="{{ $checkLogo }}"
                                readonly>
                            {{-- Visitor ID --}}
                            <input type="text" id="visitorID" name="visitorID" value="{{ $visitorID }}" readonly>
                            {{-- Latitude | Longitude --}}
                            <input type="text" name="latitude" id="latitude" />
                            <input type="text" name="longitude" id="longitude" />
                        </div>


                        <div class="form-section">
                            <div class="row">
                                <div class=" col-md-6 col-lg-6 col-sm-12">
                                    {{-- Name --}}

                                    <label for="name" style="font-size: 22px;">Name:</label>
                                    <input type="text" class="form-control mb-3" name="name" required>
                                </div>
                                <div class=" col-md-6 col-lg-6 col-sm-12">
                                    {{-- Email --}}
                                    <label for="email" style="font-size: 22px;">E-mail:</label>
                                    <input type="email" class="form-control mb-3" name="email" required>
                                </div>
                                <div class=" col-md-6 col-lg-6 col-sm-12">
                                    {{-- Phone --}}
                                    <label for="phone" style="font-size: 22px;">Phone:</label>
                                    <input type="tel" class="form-control mb-3" name="phone" required>
                                </div>
                                <div class=" col-md-6 col-lg-6 col-sm-12">
                                    {{-- Host / Meeting --}}
                                    <label for="host" style="font-size: 22px;">Host / Meeting:</label>
                                    <input type="text" name="host" id="host" class="form-control mb-3"
                                        required />
                                </div>
                            </div>




                        </div>

                        <div class="form-section">
                            <div class="row">

                                <div class=" col-md-6 col-lg-6">
                                    {{-- Purpose --}}
                                    <label for="purpose" style="font-size: 22px;">Purpose:</label>
                                    <select name="purpose" id="purpose" class="form-control" required>
                                        <option value="">Select Purpose</option>
                                        <option value="Meeting">Meeting</option>
                                        <option value="Interview">Interview</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Visitor">Visitor</option>
                                        <option value="Client">Client</option>
                                        <option value="Customer">Customer</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div class=" col-md-6 col-lg-6">
                                    {{-- Address --}}
                                    <label for="" style="font-size: 22px;">Address:</label>
                                    <input type="text" name="address" class="form-control mb-3" required />
                                </div>

                                <div class=" col-md-6 col-lg-6">
                                    {{-- pic --}}
                                    <label for="pic" id="" style="font-size: 22px;">Image:</label>
                                    <input type="hidden" name="pic" id="pic" class="image-tag"
                                        required />
                                    <div id="my_camera"></div>
                                    <div id="results" style=""></div>
                                    {{-- <a href="javascript:0" class="btn btn-primary"
                                        onClick="take_snapshot()">Click</a> --}}

                                </div>

                            </div>
                        </div>


                        <div class="form-navigation mt-3">
                            <button type="button" class="previous btn btn-primary float-left">&lt; Previous</button>
                            <button type="button" class="next btn btn-primary float-right">Next &gt;</button>
                            <button type="submit" class="btn btn-primary float-right"
                                onClick="take_snapshot()">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('assets/visitor/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" referrerpolicy="no-referrer">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script>
        Webcam.set({
            width: 240,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 100,
            flip_horiz: false,
            constraints: {
                video: true,
                facingMode: "user"
            }
        });
        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                // console.log(data_uri)
                document.getElementById('results').innerHTML = '<img src="' +
                    data_uri + '"/>';
                $("#my_camera").hide();
            });
        }
    </script>
    <script>
        var div = document.getElementById("location");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                document.innerHTML = "The Browser Does not Support Geolocation";
                alert(document.innerHTML);
            }
        }

        function showPosition(position) {
            $("#latitude").val(position.coords.latitude);
            $("#longitude").val(position.coords.longitude);
            // div.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
        }

        function showError(error) {
            if (error.PERMISSION_DENIED) {
                document.innerHTML = "The User have denied the request for Geolocation.";
                alert(document.innerHTML);
            }
        }
        getLocation();
    </script>
    <script>
        $(function() {
            var $sections = $('.form-section');

            function navigateTo(index) {
                $sections.removeClass('current').eq(index).addClass('current');
                $('.form-navigation .previous').toggle(index > 0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [Type=submit]').toggle(atTheEnd);
                const step = document.querySelector('.step' + index);
                step.style.backgroundColor = "#fecc05";
                step.style.color = "white";
            }

            function curIndex() {
                return $sections.index($sections.filter('.current'));
            }
            $('.form-navigation .previous').click(function() {
                navigateTo(curIndex() - 1);
            });
            $('.form-navigation .next').click(function() {
                $('.signup-form').parsley().whenValidate({
                    group: 'block-' + curIndex()
                }).done(function() {
                    navigateTo(curIndex() + 1);
                });
            });
            $sections.each(function(index, section) {
                $(section).find(':input').attr('data-parsley-group', 'block-' + index);
            });
            navigateTo(0);
        });
    </script>
    <!-- Page -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsSHA/2.0.2/sha.js"></script>
    <script>
        function mySubmit(obj) {
            var pwdObj = document.getElementById('pwd');
            var hashObj = new jsSHA("SHA-512", "TEXT", {
                numRounds: 1
                // alert(hashObj);
            });
            hashObj.update(pwdObj.value);
            var hash = hashObj.getHash("HEX");
            pwdObj.value = hash;
        }
    </script>
    <script>
        $.getJSON('http://ip-api.com/json', function(data) {
            console.log(JSON.stringify(data, null, 2));
        });
    </script>
</body>

</html>
