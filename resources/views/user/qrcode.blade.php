@extends('user.layouts.app')

@section('title')
    @lang('title.list')
@stop

@section('css')
    <!-- No Extra plugin used -->
    <link href="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>

    <style>
        .bg {
            background-color: #FFCC05;
            background-size: cover;
            -webkit-background-size: cover;
            width: 100%;
            height: 270px;
            overflow: hidden;
            position: relative;
            /*below show how it works*/

        }

        .bg::after {
            content: "";
            width: 200%;
            height: 0;
            padding-top: 70%;
            border-radius: 144%;
            background: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translateX(-42%);
        }

        .bgf {
            background-color: #000;
            background-size: cover;
            -webkit-background-size: cover;
            width: 100%;
            height: 270px;
            overflow: hidden;
            position: relative;
            /*below show how it works*/

        }

        .bgf::after {
            content: "";
            width: 103%;
            padding-top: 80px;
            margin-left: -20px;
            padding-bottom: 123px;
            height: 0;
            border-radius: 30%;
            background: #fff;
            position: absolute;
            top: -107px;
            transform: rotate(-3deg);
            /* left: 0px; */
            /* right: 637px; */
            /* /* transform: translateY(-92%); */
        }

        #sometext {
            position: absolute;
            z-index: 1;

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
                            <div class="bg"></div>
                            <div class="bgf"></div>
                            <!-- Copyright -->
                            <div class="text-center" style="position: absolute; z-index: 1;">
                                <p id="sometext">Here is you link and your Qr Code <a
                                        href="{{ route('user.visitor', Auth::user()->company_name) }}" target="_blank"><i
                                            class="mdi mdi-arrow-top-right-bold-outline mdi-36px"></i></a></p>
                                @if (Auth::user()->qrCode != null)
                                    {{-- {!! Auth::user()->qrCode !!} --}}
                                    <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="w-50" />
                                @else
                                    <img src="{{ asset('qr-code/demo-qrCode.png') }}" class="w-50" />
                                @endif
                            </div>
                            <!-- Copyright -->
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
                    scrollY: 0
                }
            }).from(element).save(doc_name);
        }
    </script>

@endsection
