<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="VMS">
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
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- Oral Square CSS -->
    <link id="globalsync-css" href="{{ asset('assets/css/globalsync.css ') }}" rel="stylesheet" />
    <link id="globalsync-css" href="{{ asset('assets/css/demo.css ') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/plugins/intl-tel-input/intlTelInput.css') }}" rel="stylesheet" /> --}}



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

    <title>GLOBALSYNC</title>
</head>

<body>
    <section class=" container-lg pb-3">
        <div class="row">
            <div class="container">
                <div class=" text-center ">
                    <a href="/" title="GLOBALSYNC">
                        <img class="w-25 pt-40 pb-20" src="{{ asset($checkLogo ) }}" alt="GLOBALSYNC" />
                    </a>
                </div>
                <!-- CONTENT WRAPPER -->
                <div class="container pt-40">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Visitior Registration</h4>
                                    <hr>
                                    <small>Items marked with an asterisk (*) must be filled out.</small><br>
                                </div>

                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger ">
                                            @foreach ($errors->all() as $error)
                                                <ul>
                                                    <li class="mdi mdi-information-outline "> {{ $error }}</li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endif
                                    {{-- @include('component.alert') --}}
                                    <form method="POST" action="{{ route('user.visitorstore') }}"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class=" container">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">

                                                    {{-- Company Code ID --}}
                                                    <div class="col-md-12 col-lg-12" hidden>
                                                        <div class="mb-3">
                                                            <label for="companyCode" class="form-label">Company
                                                                Code</label>
                                                            <input type="text" class="form-control" id="companyCode"
                                                                aria-describedby="companyCodeHelp" name="companyCode"
                                                                value="{{ $data }}" readonly>
                                                        </div>
                                                    </div>

                                                    {{-- Company Code ID --}}
                                                    <div class="col-md-12 col-lg-12" hidden>
                                                        <div class="mb-3">
                                                            <label for="companyLogo" class="form-label">Company
                                                                Code</label>
                                                            <input type="text" class="form-control" id="companyLogo"
                                                                aria-describedby="companyLogoHelp" name="companyLogo"
                                                                value="{{ $checkLogo }}" readonly>
                                                        </div>
                                                    </div>


                                                    {{-- Visitor ID --}}
                                                    <div class="col-md-12 col-lg-12" hidden>
                                                        <div class="mb-3">
                                                            <label for="visitorID" class="form-label">Visitor ID</label>
                                                            <input type="text" class="form-control" id="visitorID"
                                                                aria-describedby="visitorIDHelp" name="visitorID"
                                                                value="{{ $visitorID }}" readonly>
                                                        </div>
                                                    </div>

                                                    {{-- Name --}}
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Name <span
                                                                    class="required"> *</span></label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                id="name" aria-describedby="nameHelp"
                                                                name="name" value="{{ old('name') }}"
                                                                autocomplete="name">
                                                            @error('name')
                                                                <span class="invalid-feedback form-text" id="nameHelp"
                                                                    role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{--  Email --}}
                                                    <div class="col-md-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email <span
                                                                    class="required"> *</span></label>
                                                            <input type="email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                id="email" aria-describedby="emailHelp"
                                                                name="email" value="{{ old('email') }}"
                                                                autocomplete="email">
                                                            @error('email')
                                                                <span class="invalid-feedback form-text" id="emailHelp"
                                                                    role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{--  Phone --}}
                                                    <div class="col-md-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">Phone <span
                                                                    class="required"> *</span></label><br />
                                                            <input type="tel"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                id="phone" aria-describedby="phoneHelp"
                                                                name="phone" value="{{ old('phone') }}"
                                                                autocomplete="phone" data-intl-tel-input-id="0">
                                                            @error('phone')
                                                                <span class="invalid-feedback form-text" id="phoneHelp"
                                                                    role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- Product Serial Number --}}
                                                    <div class="col-md-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="host" class="form-label">Host / Meeting
                                                                With</label>
                                                            <input type="text"
                                                                class="form-control @error('host') is-invalid @enderror"
                                                                id="host" aria-describedby="hostHelp"
                                                                name="host" value="{{ old('host') }}"
                                                                autocomplete="host">
                                                            @error('host')
                                                                <span class="invalid-feedback form-text" id="hostHelp"
                                                                    role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    {{-- Product Warranty Check --}}
                                                    <div class="col-md-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="purpose" class="form-label">Purpose <span
                                                                    class="required"> *</span></label>
                                                            <select
                                                                class="form-control @error('purpose') is-invalid @enderror"
                                                                id="purpose" aria-describedby="purposeHelp"
                                                                name="purpose">
                                                                {{-- @if (!$user->gender) --}}
                                                                <option value="">Select Purpose</option>
                                                                {{-- @foreach ($explodecompany as $key => $value)
                                                                    <option value="{{ $value }}">
                                                                        {{ $value }}</option>
                                                                @endforeach --}}
                                                                <option value="Meeting">Meeting</option>
                                                                <option value="Interview">Interview</option>
                                                                <option value="Employee">Employee</option>
                                                                <option value="Visitor">Visitor</option>
                                                                <option value="Client">Client</option>
                                                                <option value="Customer">Customer</option>
                                                                <option value="Other">Other</option>
                                                                @error('purpose')
                                                                    <span class="invalid-feedback form-text"
                                                                        id="purposeHelp" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                                {{-- @else --}}
                                                                {{-- @endif --}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    {{-- Address --}}
                                                    <div class="col-md-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="address" class="form-label">Address <span
                                                                    class="required"> *</span></label>
                                                            <input type="text"
                                                                class="form-control @error('address') is-invalid @enderror"
                                                                id="address" aria-describedby="addressHelp"
                                                                name="address" value="{{ old('address') }}">
                                                            @error('address')
                                                                <span class="invalid-feedback form-text" id="addressHelp"
                                                                    role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="pic" class="form-label">Image
                                                                        <span class="required"> *</span></label>
                                                                    <div id="my_camera"></div>
                                                                    <div class="" style="">
                                                                        <div id="results">Your captured image will
                                                                            appear
                                                                            here...
                                                                        </div>
                                                                    </div>
                                                                    <br />
                                                                    <input type="hidden" name="pic"
                                                                        class="image-tag">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Location --}}
                                                    <div class="col-md-6 col-md-6" hidden>
                                                        <div class="mb-3">
                                                            <label for="latitude" class="form-label">latitude <span
                                                                    class="required"> *</span></label>
                                                            <input type="text"
                                                                class="form-control"
                                                                id="latitude" name="latitude">
                                                                <input type="text"
                                                                class="form-control"
                                                                id="longitude" name="longitude">
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary"
                                                    onClick="take_snapshot()">Submit</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content Wrapper -->

            </div>
            <!-- Copyright -->
            <div class="text-center">
                <p style="color: #FFCC05; font-size: 18px; margin-top: -20px;">
                    <a class="text-primary" href="https://globalsync.com.au/" target="_blank">
                        {{-- <img class="pt-5" src="{{ asset('assets/img/logo/logo.png') }}" alt="Globalsync" /> --}}
                        <img class="pt-5" src="{{ asset('assets/img/GSync_Footer.png') }}" alt="Globalsync" />
                    </a>
                </p>
            </div>
            <!-- Copyright -->
        </div>

    </section>

    <!-- Contact Modal -->
    <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-end border-bottom-0">
                    <button type="button" class="btn-close-icon" data-bs-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>

                <div class="modal-body pt-0">
                    <div class="container">
                        <div class="row no-gutters">
                            @if (session('msg'))
                                <div class="alert alert-success" role="alert">
                                    <i class="mdi mdi-alert-circle-outline"></i> {{ session('msg') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


    <!-- globalsync Custom -->
    <script src="{{ asset('assets/js/globalsync.js ') }}"></script>

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
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->

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
</body>

</html>
