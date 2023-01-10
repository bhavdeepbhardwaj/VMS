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
            height: 980px;
            width: 100%;
            background: url('../assets/img/bg.png') no-repeat center;
            /* background-size: cover; */
        }

        h1 {
            text-align: center;
            color: #000;
        }

        h2 {
            text-align: center;
            color: #000;
        }

        .heading {
            margin-bottom: -70px;
            font-size: 40px;
            text-align: center;
            color: black;
            text-shadow: 0 0 black;
        }

        .img {
            border: 5px solid #000;
            padding: 5px;
            border-radius: 5px;
            background-color: #FFFF;
            /* box-shadow: 0 0 20px 2px #f2da82; */
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row bg" id="converttoPDF">
                        <div class="pt-25 heading">Visitor Management System</div>
                        <div class="container pb-4 pt-5">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <div class="text-center">
                                        <h2>{{ Auth::user()->company_name }}</h2><br />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <div class="text-center">
                                        <h3 class=" text-black">Scan Below to Check-in<a
                                                href="{{ route('user.visitor', Auth::user()->company_name) }}"
                                                target="_blank" class=" text-white text-decoration-underline"><br /><i
                                                    class="mdi mdi-arrow-down-bold-outline mdi-36px"></i><br />Click
                                                Here</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container pb-4 pt-4">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="text-center">
                                        @if (Auth::user()->company_logo != null)
                                            <img src="/{{ Auth::user()->company_logo }}" class="" style="" />
                                        @else
                                            <img src="{{ asset('assets/img/demo-logo.png') }}" class="" style="" />
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <div class="text-center">
                                        @if (Auth::user()->qrCode != null)
                                            <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="img" />
                                        @else
                                            <img src="{{ asset('qr-code/demo-qrCode.png') }}" class="" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <footer style="margin-bottom: -60px;">
                            <div class="text-center">
                                <img src="{{ asset('assets/img/footer.png') }}" alt="" style="width: 500px;">
                            </div>
                        </footer>
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
                margin: -1,
                orientation: 'landscape',

            }).from(element).save(doc_name);
        }
    </script>

@endsection
