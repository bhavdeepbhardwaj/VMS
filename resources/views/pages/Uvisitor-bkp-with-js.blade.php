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
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/icons/safari-pinned-tab.svg" color="#ffcc05 ') }}">
    <title>GLOBALSYNC</title>

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('assets/visitor/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <style>
        .hidden {
            display: none;
        }

        /* .error {
            color: red;
        } */
    </style>
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}">
    <link rel="stylesheet" href="{{ asset('assets/visitor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />

</head>

<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <div class="signup-desc">
                    <div class="signup-desc-content">
                        <img class="" src="{{ asset($checkLogo) }}" alt="{{ $data }}"
                            style="width: 250px;" />
                        <p class="title">Sign up now to try undraw 30 days for free</p>
                        <p class="desc">
                            MIT licensed illustrations for every project you can imagine and create
                        </p>
                        <img src="{{ asset('assets/visitor/images/signup-img.png') }}"
                            style="width: 387px; height: 285px" alt="" class="signup-img">
                        <img class="" src="{{ asset('assets/img/GSync_Footer.png') }}" alt="Globalsync"
                            style="padding-top: 100px;" />
                    </div>
                </div>
                <div class="signup-form-conent">
                    <div class="alert" id="suc_msg"></div>
                    <form method="POST" id="signup-form" action="{{ route('user.visitorstore') }}" class="signup-form"
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
                            <input type="text" name="latitude" id="latitude" required />
                            <input type="text" name="longitude" id="longitude" required />
                        </div>
                        {{-- Name --}}
                        <h3></h3>
                        <fieldset>
                            <span class="step-current">Step 1 / 8</span>
                            <div class="form-group">
                                <input type="text" name="name" id="name" required />
                                <label for="name">Your Name</label>
                            </div>
                        </fieldset>

                        {{-- Email --}}
                        <h3></h3>
                        <fieldset>
                            <span class="step-current">Step 2 / 8</span>
                            <div class="form-group">
                                <input type="text" name="email" id="email" required />
                                <label for="email">Your Email</label>
                            </div>
                        </fieldset>

                        {{-- Phone --}}
                        <h3></h3>
                        <fieldset>
                            <span class="step-current">Step 3 / 8</span>
                            <div class="form-group">
                                <input type="text" name="phone" id="Phone" required />
                                <label for="Phone">Your Phone</label>
                            </div>
                        </fieldset>

                        {{-- Host / Meeting --}}
                        <h3></h3>
                        <fieldset>
                            <span class="step-current">Step 4 / 8</span>
                            <div class="form-group">
                                <input type="text" name="host" id="host" required />
                                <label for="host">Host / Meeting</label>
                            </div>
                        </fieldset>

                        {{-- Purpose --}}
                        <h3></h3>
                        <fieldset>
                            <span class="step-current">Step 5 / 8</span>
                            <div class="form-group">
                                <label for="purpose" id="selectlabel">Purpose</label>
                                <div class="form-row" style="margin-bottom: 26px;">
                                    <div class="form-holder">
                                        <select name="purpose" id="purpose" class="form-control">
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
                                </div>
                            </div>
                        </fieldset>

                        {{-- Address --}}
                        <h3></h3>
                        <fieldset>
                            <span class="step-current">Step 6 / 8</span>
                            <div class="form-group">
                                <input type="text" name="address" id="address" required />
                                <label for="address">Address</label>
                            </div>
                        </fieldset>

                        {{-- pic --}}
                        <h3></h3>
                        <fieldset>
                            <span class="step-current">Step 7 / 8</span>
                            <div class="form-group">
                                <input type="hidden" name="pic" id="pic" class="image-tag" />
                                <div id="my_camera"></div>
                                <div id="results"></div>
                                <label for="pic" id="selectlabel">Image</label>
                            </div>
                            <a href="javascript:0" class="btn btn-primary" onClick="take_snapshot()">Submit</a>
                        </fieldset>

                        {{-- Latitude | Longitude --}}



                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('assets/visitor/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/visitor/vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/visitor/vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/visitor/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/visitor/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <script>
        Webcam.set({
            width: 250,
            height: 250,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                console.log(data_uri)
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
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
        // function check(){
        //     const myname = $('#name').val();
        //     alert(myname);
        // }
    </script>
</body>

</html>
