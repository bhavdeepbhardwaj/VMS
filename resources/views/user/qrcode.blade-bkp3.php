@extends('user.layouts.app')

@section('title')
    @lang('title.list')
@stop

@section('css')
    <!-- No Extra plugin used -->
    <link href="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>

    <style>
        .main-wrapper {
            height: 100vh;
            width: 100%;
            background: url('http://127.0.0.1:8000/assets/img/bg.png') no-repeat center;
            background-size: cover;
        }

        .main-wrapper .page-content {
            max-width: 1000px;
            margin: 0 auto;
            height: calc(100% - 100px);
        }

        .page-content .grid-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .grid-container .item {
            width: 45%;
            margin: 30px;
        }

        .grid-container .item .box {
            width: 100%;
            height: 100%;
            border: 4px solid #000;
            box-shadow: 0 0 20px 2px #f2da82;
        }
        /* .grid-container .item  {
            width: 100%;
            height: 400px;
            border: 4px solid #000;
        } */

        .grid-container .item .box img {
            width: 100%;
            max-height: 100%;
        }

        .grid-container .item h2,
        .grid-container .item h4 {
            text-align: center;
            margin: 0px 0 50px;
            /* min-height: 80px; */
        }

        .fot {
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .fot img {
            height: 60px;
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
                            {{-- <div class="main-box">
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
                            </div> --}}
                            <div class="main-wrapper">
                                <div class="page-content">
                                    <div class="grid-container">
                                        <div class="item">
                                            <h2 class="">{{ Auth::user()->company_name }}</h2>
                                            {{-- <h4>{{ Auth::user()->company_name }}</h4> --}}
                                            <div class="box" style="border:none;">
                                                @if (Auth::user()->company_logo != null)
                                                    <img src="/{{ Auth::user()->company_logo }}" class="" style="padding-top: 100px;" />
                                                @else
                                                    <img src="{{ asset('assets/img/demo-logo.png') }}" class="" style="padding-top: " />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="item">
                                            <h2>Scan Below to Check-in</h2>
                                            <div class="box" style="padding: 5px;">
                                                @if (Auth::user()->qrCode != null)
                                                    <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="" />
                                                @else
                                                    <img src="{{ asset('qr-code/demo-qrCode.png') }}" class="" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fot">
                                    <img src="http://127.0.0.1:8000/assets/img/GSync_Footer_qr-_code.png" alt="">
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
