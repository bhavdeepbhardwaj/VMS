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


        .img {
            width: 100%;
            /* max-height: 100%; */
        }

        .main_div {
            height: 100vh;
            width: 100%;
            /* border-collapse: collapse; */
        }
        h1 {
            text-align: center;
            /* margin: 0px 0 80px; */
            /* min-height: 80px; */
            color: #000;
        }
        .grid-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .grid-container .item1 {
            width: 50%;
            margin: 50px;
            /* margin-right: 30px; */
            text-align: center;

        }
        .grid-container .item2 {
            width: 50%;
            margin: 50PX;
            /* margin-right: 30px; */
            text-align: center;

        }
        .grid-container .item1 h2,
        .grid-container .item2 h4 {
            text-align: center;
            /* margin: 0px 0 50px; */
            /* min-height: 80px; */
            color: #000;
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
                <div class="col-lg-12">
                    <div class="card card-default">
                        <div class="card-body" id="converttoPDF">
                            <div class="main-wrapper">
                                {{-- <div class="fot">
                                    <div class="" align="center">
                                        <img src="{{ asset('assets/img/GSync_Footer_qr-_code.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="parent">
                                    <h1 class="">{{ Auth::user()->company_name }}</h1>
                                    <div class="child">
                                        <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="img" />
                                    </div>
                                    <div class="" align="center">
                                        <img src="{{ asset('assets/img/GSync_Footer_qr-_code.png') }}" alt="">
                                    </div>
                                </div> --}}
                                <table class="main_div">

                                    <div class="grid-container">
                                        <div class="item1">
                                            <h1 class="">{{ Auth::user()->company_name }}</h1>

                                            <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="img" />

                                        </div>
                                        <div class="item2">
                                            <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="img" />

                                        </div>
                                    </div>
                                    {{-- <tr>
                                        <td valign="top" class=" pt-5">
                                            <h1 class="">{{ Auth::user()->company_name }}</h1>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td valign="center" align="center">
                                            <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="img" />

                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="bottom" class="text-center pb-4">
                                            <img src="{{ asset('assets/img/GSync_Footer_qr-_code.png') }}" alt="" style="width: 200px;">
                                        </td>
                                    </tr> --}}
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
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
                    scale: 4,
                    scrollY: 0,
                    unit: 'mm',
                }

            }).from(element).save(doc_name);
        }
    </script>

@endsection
