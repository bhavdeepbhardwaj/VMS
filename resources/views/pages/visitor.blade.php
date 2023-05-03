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
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- globalsync CSS -->
    <link id="globalsync-css" href="{{ asset('assets/css/globalsync.css ') }}" rel="stylesheet" />
    <link id="globalsync-css" href="{{ asset('assets/css/demo.css ') }}" rel="stylesheet" />



    <style>
        li {
            text-align: justify;
        }

        .required {
            color: rgb(255, 1, 1);
        }

        #sheet-container {
            width: 250px;
            height: 200px;
            border: 1px solid black;
        }
    </style>
    {{-- <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style> --}}

    <title>Globalsync</title>
</head>

<body>
    <section class=" container-lg pb-3">
        <div class="row">
            <div class="container">

                <div class=" text-center ">
                    <a href="/" title="Globalsync">
                        <img class=" pt-40 pb-40" src="{{ asset('assets/img/logo/logo.png') }}" alt="Globalsync" />
                    </a>
                </div>
                <!-- CONTENT WRAPPER -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Visitor Registration</h4>
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
                                    <form method="POST" action="{{ route('visitor.store') }}"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class=" container">
                                            <div class="col-12 col-md-12 col-lg-12">
                                                <div class="row">

                                                    {{-- Visitor ID --}}
                                                    <div class="col-md-12 col-lg-12">
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
                                                            <label for="email" class="form-label">Email</label>
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
                                                                    class="required"> *</span></label>
                                                            <input type="tel"
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                id="phone" aria-describedby="phoneHelp"
                                                                name="phone" value="{{ old('phone') }}"
                                                                autocomplete="phone">
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
                                                                <option value="Meeting">Meeting</option>
                                                                <option value="Interview">Interview</option>
                                                                <option value="Employee">Employee</option>
                                                                <option value="Visitor">Visitor</option>
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

                                                    {{-- Images --}}
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

                                                    {{-- Signature --}}
                                                    <div class="col-md-6 col-md-6">
                                                        <div class="mb-3">
                                                            <label for="signature" class="form-label" style="padding-bottom: 40px!important">E Signature<span
                                                                    class="required"> *</span></label>
                                                            <div id="sheet-container">
                                                                <canvas id="sheet" width="250"
                                                                    height="200"></canvas>
                                                            </div><br/>
                                                            <input type="button" class="btn btn-default btn-sm"
                                                                id="saveSign" value="Add Signature">&nbsp;
                                                            <button class="btn btn-danger btn-sm"
                                                                id="clearSignature">Clear Signature</button>
                                                            <!--Add signature here -->
                                                            <div id="signature"></div>
                                                            @error('signature')
                                                                <span class="invalid-feedback form-text" id="signatureHelp"
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
                                                                    {{-- <input type=button value="Take Snapshot"
                                                                        onClick="take_snapshot()"> --}}
                                                                    <input type="hidden" name="pic"
                                                                        class="image-tag">
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-6">
                                                                <div class="" style="padding-top: 15px;">
                                                                    <div id="results">Your captured image will appear
                                                                        here...
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="text-center">
                                                {{-- <button type="submit" class="btn btn-primary view-detail"
                                                    onClick="take_snapshot()" data-bs-toggle="modal"
                                                    data-bs-target="#modal-contact">Submit</button> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.js"></script>
    <!-- globalsync Custom -->
    <script src="{{ asset('assets/js/globalsync.js ') }}"></script>

    <script>
        Webcam.set({
            width: 250,
            height: 250,
            image_format: 'jpeg',
            jpeg_quality: 90,
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
        var canvas = new fabric.Canvas('sheet');
        canvas.isDrawingMode = true;
        canvas.freeDrawingBrush.width = 1;
        canvas.freeDrawingBrush.color = "#ff0000";
        $('#saveSign').click(function(e) {
            e.preventDefault();
            var canvas = document.getElementById("sheet");
            var dataUrl = canvas.toDataURL("image/png"); //
            var saveButton = $(this).val();
            if (saveButton == "Add Signature") {
                //alert(dataUrl); check if canvas is empty
                var blank = isCanvasBlank(canvas);
                if (blank) {
                    alert('Signature can\'t be empty');
                    return false;
                }
                //Pass signature to the form.
                var signature = document.getElementById('signature');
                signature.innerHTML = '<input type="hidden" name="signature" value="' + dataUrl + '">';
                $(this).val('Remove Signature'); //Update button text
            } else if (saveButton == "Remove Signature") {
                var signature = document.getElementById('signature');
                signature.innerHTML = '';
                $(this).val("Add Signature");
            }
        });
        //Clear signature
        $('#clearSignature').click(function(e) {
            e.preventDefault();
            canvas.clear();
        });
        //Check if canvass is empty
        function isCanvasBlank(canvas) {
            var blank = document.createElement('canvas');
            blank.width = canvas.width;
            blank.height = canvas.height;
            return canvas.toDataURL() == blank.toDataURL();
        }
    </script>
</body>

</html>
