@extends('user.layouts.app')

@section('title')
    @lang('title.list')
@stop

@section('css')
    <!-- No Extra plugin used -->
    <link href="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>

    <style>
        .main-box {
            position: relative;
            width: 100%;
            height: 100%;
            /* border: 3px solid red; */
        }

        .box-1 {
            background-color: #fdcd0a;
            height: 50vh;

        }

        .box-2 {
            background-color: #2b2a29;
            height: 50vh;

        }

        .half-circle {
            position: absolute;
            left: 0%;
            top: 30%;
            height: 40vh;
            width: 100%;
            border-radius: 100%;
            background-color: #FFF;
            overflow: hidden;
        }

        .qr-code {
            position: absolute;
            top: 40%;
            left: 25%;
            border: 5px solid #000;
            padding: 5px;
            border-radius: 2px;
            background-color: #fff;
            box-shadow: 0 0 20px 2px #f2da82;
        }

        .comp-logo {
            position: absolute;
            top: 40%;
            left: 55%;
        }

        .sometext {
            position: absolute;
            top: 16%;
            left: 18%;
        }

        .sometext>p {
            font-size: 35px;
        }

        .footer-logo {
            position: absolute;
            /* bottom: -90%; */
            top: 95%;
            right: 40px;
        }

        .card-body {
            height: 100vh;
        }

        @media (max-width:641px) {
            .comp-logo {
                display: none;
            }

            .footer-logo {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }
        }
    </style>
@endsection

@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
                <div>
                    <h2>Visitor Registration</h2>
                    <p class="breadcrumbs"><span><a href="{{ route('admin.home') }}">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Visitor Registration
                    </p>
                </div>
                <div class=" float-right">
                    <button class="btn btn-primary profile-button" type="submit" onclick="generatePDF();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                            </path>
                            <path d="M12 17v-6"></path>
                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5">
                            </path>
                        </svg>
                        Download
                        PDF</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body" id="converttoPDF">
                            <div class="main-box">
                                <div class="box-1"></div>
                                <div class="half-circle"></div>
                                <div class="box-2"></div>
                                <div class="qr-code">
                                    @if (Auth::user()->qrCode != null)
                                        <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="w-15" />
                                    @else
                                        <img src="{{ asset('qr-code/demo-qrCode.png') }}" class="w-15" />
                                    @endif

                                </div>
                                <div class="comp-logo">
                                    <img src="http://127.0.0.1:8000/05-01-2023-Visitor/GEE-Christmas-Logo.png"
                                        class="w-15" />
                                </div>
                                <div class="sometext">
                                    <p id="">Here is you link and your Qr Code <a
                                            href="{{ route('user.visitor', Auth::user()->company_name) }}" target="_blank"
                                            style="color: #fff"><i
                                                class="mdi mdi-arrow-top-right-bold-outline mdi-36px"></i></a>
                                    </p>
                                </div>
                                <div class="footer-logo">
                                    <img src="http://127.0.0.1:8000/assets/img/GSync_Footer_qr-_code.png" class="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- <div class=" col-lg-12">
                    <div class="main-box">
                        <div class="box-1"></div>
                        <div class="half-circle"></div>
                        <div class="box-2"></div>
                        <div class="qr-code">
                            <img src="http://127.0.0.1:8000/qr-code/img-1672903325.svg" class="w-15" />
                        </div>
                        <div class="comp-logo">
                            <img src="http://127.0.0.1:8000/05-01-2023-Visitor/GEE-Christmas-Logo.png" class="w-15" />
                        </div>
                        <div class="sometext">
                            <p id="">Here is you link and your Qr Code <a href="sdf" target="_blank"
                                    style="color: #fff"><i class="mdi mdi-arrow-top-right-bold-outline mdi-36px"></i></a>
                            </p>
                        </div>
                        <div class="footer-logo">
                            <img src="http://127.0.0.1:8000/assets/img/GSync_Footer_qr-_code.png" class="" />
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- End Content -->
    </div>
    <!-- End Content Wrapper -->

@endsection

@section('js')
    <!-- Datatables -->
    <script src="{{ asset('assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/datatables.responsive.min.js') }}"></script>

    {{-- Customers Overview JS --}}
    <script src="{{ asset('assets/js/html2pdf.js ') }}"></script>

    <script>
        function generatePDF() {
            var doc_name = "QR-Code.pdf";
            var element = document.getElementById('converttoPDF');
            html2pdf().set({
                html2canvas: {
                    scale: 8,
                    scrollY: 0
                }
            }).from(element).save(doc_name);
        }
    </script>

@endsection
