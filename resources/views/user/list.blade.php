@extends('user.layouts.app')

@section('title')
    @lang('title.list')
@stop

@section('css')
    <!-- No Extra plugin used -->
    <link href="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />

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

            </div>
            <div class="row">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <form action="{{ route('datefilterVisitor') }}" method="GET">
                                {{ csrf_field() }}
                                <div class="input-group mb-3">
                                    <input type="date" required
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date">
                                    @error('start_date')
                                        <span class="alert alert-danger" id="start_dateHelp" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="date" required id="dateID"
                                        class="form-control @error('end_date') is-invalid @enderror" name="end_date">
                                    @error('end_date')
                                        <span class="alert alert-danger" id="end_dateHelp" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button class="btn btn-primary" type="submit">GET</button>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <a href="{{ route('exportAllVisitorRegistration') }}" class="btn btn-primary">Export
                                        File</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="row align-content-center justify-content-sm-center text-center">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    @include('component.alert')
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Host / Meeting With</th>
                                            <th>Check In | Out</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($guest as $cr)
                                            <tr>
                                                <td class="">
                                                    @if ($cr->pic != null)
                                                        <img src="{{ '../Visitor/' . $cr->pic }}" class="rounded-circle"
                                                            width="50" height="50" alt="Global"><br />
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $cr->name }}</td>
                                                <td>{{ $cr->phone }}</td>
                                                <td>
                                                    @if ($cr->host != null)
                                                        {{ $cr->host }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- {{ date('jS \of F Y h:i:s A', strtotime($cr->created_at)) }} <br />
                                                    @if (date('jS \of F Y h:i:s A', strtotime($cr->created_at)) == date('jS \of F Y h:i:s A', strtotime($cr->updated_at)))
                                                        <button class="btn btn-primary profile-button" id="checkOut"
                                                            type="submit" onClick="checkOut('{{ $cr->id }}');"
                                                            style="padding: 0px 36px;">
                                                            <i class="mdi mdi-account-check mdi-18px"></i></button>
                                                    @else
                                                        {{ date('jS \of F Y h:i:s A', strtotime($cr->updated_at)) }}
                                                    @endif --}}
                                                    {{ date('jS \of F Y h:i:s A', strtotime($cr->created_at)) }} <br />
                                                    @if ($cr->updated_at == null)
                                                        <button class="btn btn-primary profile-button" id="checkOut"
                                                            type="submit" onClick="checkOut('{{ $cr->id }}');"
                                                            style="padding: 0px 36px;">
                                                            <i class="mdi mdi-account-check mdi-18px"></i></button>
                                                    @else
                                                        {{ date('jS \of F Y h:i:s A', strtotime($cr->updated_at)) }}
                                                    @endif
                                                </td>
                                                <td><a href="javascript:0" data-bs-toggle="modal" class="view-detail"
                                                        onClick="popupfunctioncall('{{ $cr->visitorID }}');"><i
                                                            class="mdi mdi-account-details mdi-36px"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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

    <!-- Contact Modal -->
    <div class="modal fade" id="modal-contact" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-end border-bottom-0">
                    <button type="button" class="btn-close-icon" data-bs-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                <div class="card-body" id="converttoPDF">
                    <div class="card bg-white profile-content">

                        <div class="row">
                            <div class=" text-center">
                                <a href="/" title="{{ Auth::user()->company_name }}">
                                    @if (Auth::user()->company_logo != '')
                                        @foreach (explode(',', Auth::user()->company_logo) as $ref)
                                            <img class="pt-5 w-25" src="../{{ Auth::user()->company_logo }}"
                                                alt="{{ Auth::user()->company_logo }}" />
                                        @endforeach
                                    @else
                                        <img class="pt-5 w-25" src="{{ asset('assets/img/logo/demo.png ') }}"
                                            alt="{{ Auth::user()->company_name }}" />
                                    @endif
                                </a>
                            </div>

                            <div class="col-lg-4 col-xl-3">
                                <div class="profile-content-left profile-left-spacing">
                                    <div class="text-center widget-profile px-0 border-0">
                                        <div class="ec-vendor-main-img">
                                            <div class="avatar-upload">
                                                <div class="avatar-preview ec-preview">
                                                    <div class="imagePreview ec-div-preview">
                                                        @if ($guest != null)
                                                            <img class="ec-image-preview" id="pic" src=""
                                                                alt="{{ Auth::user()->company_name }}"
                                                                style="width: 100%; padding-bottom: 20px;">
                                                            <br />
                                                        @else
                                                            <img class="ec-image-preview"
                                                                src="{{ asset('assets/img/user/user.png') }}"
                                                                alt="{{ Auth::user()->company_name }}"
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

                                        <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="p-3 py-5">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4 class="text-right">Visitor Info</h4>
                                                </div>

                                                <div class="row mt-2">

                                                    <div class="col-md-12">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <td>ID </td>
                                                                    <td id="visitorID"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Name </td>
                                                                    <td id="full_name"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email</td>
                                                                    <td id="email"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Phone </td>
                                                                    <td id="phone"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Host / Meeting With</td>
                                                                    <td id="host"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Purpose </td>
                                                                    <td id="purpose"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Address </td>
                                                                    <td id="address"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
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
        </div>
    </div>

@endsection

@section('js')
    <!-- Datatables -->
    <script src="{{ asset('assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/datatables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>


    {{-- Customers Overview JS --}}
    <script src="{{ asset('assets/js/html2pdf.js ') }}"></script>

    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
    </script>
    <script>
        function popupfunctioncall(visitorID) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                // data:{('visitorID' => visitorID)},
                url: '/Visitor/popUpVisitiorRegistration/',
                data: {
                    'visitorID': visitorID
                },
                global: false,
                async: true,

                success: function(result) {
                    $('#modal-contact').modal('show');
                    $('#email').html(result.email);
                    $('#visitorID').html(result.visitorID);
                    $('#full_name').html(result.name);
                    $('#phone').text(result.phone);
                    $('#host').text(result.host);
                    $('#purpose').text(result.purpose);
                    $('#pic').attr('src', result.pic);
                    $('#address').text(result.address);

                    // var obj = jQuery.parseJSON(result);
                    var obj = JSON.parse(JSON.stringify(result));
                    $('#visitorID').val(obj.visitorID);

                },

            });
            // alert("visitorID = " + visitorID);
        }
    </script>
    <script>
        //Display Only Date till today //
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1; // getMonth() is zero-based
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#dateID').attr('max', maxDate);
    </script>

    <script>
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
                    window.location.reload();

                    // $('#checkOut').hide();
                    // window.location.href = '/Thank-you';
                },
                error: function(error) {
                    console.log(error)
                },

            });
        }
    </script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                cache_clear()
            }, 20000);
        });

        function cache_clear() {
            window.location.reload(true);
            // window.location.reload(); use this if you do not remove cache
        }
    </script>
@endsection
