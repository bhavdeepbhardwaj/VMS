<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Globalsync">
    <meta name="msapplication-TileColor" content="#ffcc06">
    <meta name="theme-color" content="#ffcc06">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
    {{-- <link id="globalsync-css" href="{{ asset('assets/css/demo.css ') }}" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />




    <style>
        li {
            text-align: justify;
        }

        .required {
            color: rgb(255, 1, 1);
        }
        .card-body {
            padding: 0px
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
                <!-- CONTENT WRAPPER -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-12 col-lg-12">
                            <div class="card">
                                <div class="card-body" id="converttoPDF">
                                    @include('component.alert')
                                    <div class="card bg-white profile-content">

                                        <div class="row">
                                            <div class=" text-center">
                                                @if ($getdata->companyLogo != null)
                                                    <a href="/" title="Globalsync">
                                                        <img class="pt-5"
                                                            src="{{ asset('/' . $getdata->companyLogo) }}"
                                                            alt="{{ $getdata->companyCode }}" style="width: 250px;" />
                                                    </a>
                                                    <br />
                                                @else
                                                    <a href="/" title="Globalsync">
                                                        <img class="pt-5"
                                                            src="{{ asset('assets/img/logo/demo.png') }}"
                                                            alt="Globalsync" style="width: 250px;" />
                                                    </a>
                                                @endif

                                            </div>

                                            <div class="col-lg-4 col-xl-3">
                                                <div class="profile-content-left profile-left-spacing">
                                                    <div class="text-center widget-profile px-0 border-0">
                                                        <div class="ec-vendor-main-img">
                                                            <div class="avatar-upload">
                                                                <div class="avatar-preview ec-preview">
                                                                    <div class="imagePreview ec-div-preview">
                                                                        @if ($getdata != null)
                                                                            <img class="ec-image-preview"
                                                                                src="{{ asset('Visitor/' . $getdata->pic) }}"
                                                                                alt="{{ $getdata->pic }}"
                                                                                style="width: 150px; padding-bottom: 20px;">
                                                                            <br />
                                                                        @else
                                                                            <img class="ec-image-preview"
                                                                                src="{{ asset('assets/img/user/user.png') }}"
                                                                                alt=""
                                                                                style="width: 50%; padding-bottom: 20px;">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-8 col-xl-9">
                                                <div class="profile-content-right profile-right-spacing ">
                                                    <div class="tab-content px-3 px-xl-5" id="myTabContent">

                                                        <div class="tab-pane fade show active" id="profile"
                                                            role="tabpanel" aria-labelledby="profile-tab">
                                                            <div class="p-3 py-5">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-3">
                                                                    <h4 class="text-right">Visitor Info</h4>
                                                                </div>

                                                                <div class="row mt-2">

                                                                    <div class="col-md-12">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>Name </td>
                                                                                    <td class="full_name">
                                                                                        {{ $getdata->name }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Email</td>
                                                                                    <td>{{ $getdata->email }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Phone </td>
                                                                                    <td>{{ $getdata->phone }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Host / Meeting With</td>
                                                                                    <td>{{ $getdata->host }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Purpose </td>
                                                                                    <td>{{ $getdata->purpose }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Address </td>
                                                                                    <td>{{ $getdata->address }}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <input type="hidden" class="form-select1"
                                                                        value="{{ $getdata->id }}" name="user_id">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 mb-3 text-center">
                                    <button class="btn btn-primary profile-button" type="submit"
                                        onclick="generatePDF();">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-file-download" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                            </path>
                                            <path d="M12 17v-6"></path>
                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5">
                                            </path>
                                        </svg>
                                        Download
                                        PDF</button>
                                    &NonBreakingSpace;&NonBreakingSpace;
                                    <button class="btn btn-primary profile-button" id="checkOut" type="submit"
                                        onClick="checkOut('{{ $getdata->id }}');">
                                        <i class="mdi mdi-account-check mdi-18px"></i>
                                        Check Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content Wrapper -->

            </div>
        </div>

    </section>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>


    <!-- globalsync Custom -->
    <script src="{{ asset('assets/js/globalsync.js ') }}"></script>
    <script src="{{ asset('assets/js/html2pdf.js ') }}"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script>
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

        function checkOut(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                dataType: 'json',
                url: '/chechOutVisitior/' + id,
                data: {
                    'id': id
                },
                global: false,
                async: true,
                success: function(result) {
                    swal("Thank You", "Check Out", "success");
                    $('#checkOut').hide();
                    window.location.href = '/Thank-you';
                },
                error: function(error) {
                    console.log(error)
                },

            });
        }
    </script>

</body>

</html>
