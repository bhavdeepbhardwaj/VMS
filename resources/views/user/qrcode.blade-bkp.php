@extends('user.layouts.app')

@section('title')
    @lang('title.list')
@stop

@section('css')
    <!-- No Extra plugin used -->
    <link href="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>

    <style>

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
                            <div class="row">
                                <div class=" col-md-6 col-lg-6 text-center">
                                    <p>Here is you link and your Qr Code <a
                                            href="{{ route('user.visitor', Auth::user()->company_name) }}"
                                            target="_blank"><i
                                                class="mdi mdi-arrow-top-right-bold-outline mdi-36px"></i></a></p><br />
                                    @if (Auth::user()->qrCode != null)
                                        {{-- {!! Auth::user()->qrCode !!} --}}
                                        <img src="{{ '../qr-code/' . Auth::user()->qrCode }}" class="w-50" />
                                    @else
                                        <img src="{{ asset('qr-code/demo-qrCode.png') }}" class="w-50" />
                                    @endif
                                </div>
                                <div class=" col-md-6 col-lg-6 ">
                                    <div class=" pt-80">
                                        @if (Auth::user()->company_logo != null)
                                            <img src="/{{ Auth::user()->company_logo }}"
                                                alt="{{ Auth::user()->company_name }}" class="w-75" />
                                        @else
                                            <img src="{{ asset('assets/img/logo/demo.png') }}" class="w-" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Copyright -->
                            <div class="text-center">
                                <p style="color: #FFCC05; font-size: 18px; margin-top: -20px;">
                                    <a class="text-primary" href="https://globalsync.com.au/" target="_blank">
                        {{-- <img class="pt-5" src="{{ asset('assets/img/logo/logo.png') }}" alt="Globalsync" /> --}}
                        <img class="pt-5" src="{{ asset('assets/img/GSync_Footer.png') }}"
                            alt="Globalsync" />
                    </a>
                                </p>
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
