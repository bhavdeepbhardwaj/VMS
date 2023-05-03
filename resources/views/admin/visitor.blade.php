@extends('admin.layouts.app')

@section('title')
    @lang('title.visitor')
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
                <div class=" float-right">
                    <a href="javascript:0" data-bs-toggle="modal" data-bs-target="#modal-contact-export"
                        class="btn btn-primary view-detail">Export
                        File</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6 pb-4">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form method="get" action="{{ route('admin.visitor') }}">
                                    {{-- {{ csrf_field() }} --}}
                                    <div class="row align-content-center justify-content-sm-center text-center">
                                        <div class="col-lg-3 col-md-4 col-sm-12">
                                            <label for="companyVisitor" class="form-label">Company Visitor <span
                                                    class="required">
                                                    *</span></label>
                                            <select class="form-control" id="companyVisitor"
                                                aria-describedby="companyVisitorHelp" name="companyVisitor" required>
                                                <option value="">Select Client Company</option>
                                                @foreach ($checkCompany as $company)
                                                    <option value="{{ $company->company_name }}"
                                                        @if ($companyselect == $company->company_name) selected @endif>
                                                        {{ $company->company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" col-lg-3 col-md-4 col-sm-12">
                                            <label for="companyVisitor" class="form-label">Start Date</label>
                                            <input type="date" id="" class="form-control" name="start_date">
                                        </div>
                                        <div class=" col-lg-3 col-md-4 col-sm-12">
                                            <label for="companyVisitor" class="form-label">End Date</label>
                                            <input type="date" id="dateID" class="form-control" name="end_date">
                                        </div>
                                    </div>

                                    <div class="align-content-center justify-content-sm-center text-center pt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-6">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="row align-content-center justify-content-sm-center text-center">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    @include('component.alert')
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table nowrap success" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Host / Meeting With</th>
                                            {{-- <th>Check In</th> --}}
                                            <th>Check In | Out</th>
                                            <th>Purpose</th>
                                            <th>Address</th>
                                            <th>Map</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($guest as $cr)
                                            {{-- {{ dd($guest->all())}} --}}
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
                                                {{-- <td></td> --}}
                                                <td>
                                                    {{-- {{ date('jS \of F Y h:i:s A', strtotime($cr->created_at)) }} <br /> --}}
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
                                               <button class="btn btn-primary" type="submit" onClick="checkOut('{{ $cr->id }}');"
                                                            style="padding: 0px 36px;">
                                                            <i class="mdi mdi-account-check mdi-18px"></i></button>
                                                    @else
                                                        {{ date('jS \of F Y h:i:s A', strtotime($cr->updated_at)) }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cr->purpose != null)
                                                        {{ $cr->purpose }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cr->address != null)
                                                        {{ $cr->address }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cr->latitude != null)
                                                        <a href="https://maps.google.com/?q={{ $cr->latitude }},{{ $cr->longitude }}"
                                                            target="_blank" class="">
                                                            <i class="mdi mdi-map-marker mdi-36px"></i>
                                                        </a>
                                                        {{-- <a href="javascript:0" class="btn btn-success" data-toggle="modal"
                                                            data-target="#modal-contact-map"
                                                            onclick="myMap({{ $cr->latitude }},{{ $cr->longitude }});">
                                                            Map
                                                        </a> --}}
                                                        <!-- this will pass coords as parameter to map function -->
                                                    @else
                                                        N/A
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
                                {{-- {{ dd($guest->companyLogo);}} --}}
                                @if ($guest != null)
                                    <a href="/">
                                        <img class="pt-5 w-25" id="logo" src=""
                                            alt="" />
                                    </a>
                                    <br />
                                @else
                                    <img class="pt-5 w-25" src="{{ asset('assets/img/logo/logo.png') }}"
                                        alt="">
                                @endif
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

    <!-- Export Modal -->
    <div class="modal fade" id="modal-contact-export" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-end border-bottom-0">
                    <button type="button" class="btn-close-icon" data-bs-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    {{-- <div class="card profile-content"> --}}
                    <div class="row align-content-center justify-content-sm-center text-center">
                        {{-- <div class="col-lg-12 col-xl-12 col-md-12"> --}}
                        <h2 class="pb-4" style="color: #ffd01c;">Export Visitor Reports</h2>
                        <form method="Post" action="{{ route('admin.exportVisitor') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <label for="companyVisitor" class="form-label">Company Visitor <span
                                            class="required">
                                            *</span></label>
                                    <select class="form-control" id="companyVisitor"
                                        aria-describedby="companyVisitorHelp" name="companyVisitor">
                                        <option value="">Default All Company</option>
                                        @foreach ($checkCompany as $company)
                                            <option value="{{ $company->company_name }}"
                                                @if ($companyselect == $company->company_name) selected @endif>
                                                {{ $company->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <label for="companyVisitor" class="form-label">Start Date</label>
                                    <input type="date" id="" class="form-control" name="start_date">
                                </div>
                                <div class=" col-lg-4 col-md-4 col-sm-12">
                                    <label for="companyVisitor" class="form-label">End Date</label>
                                    <input type="date" id="dateIDpop" class="form-control" name="end_date">
                                </div>
                            </div>

                            <div class="align-content-center justify-content-sm-center text-center pt-3">
                                <button type="submit" class="btn btn-primary button" id="">Download</button>
                            </div>
                        </form>
                        {{-- </div> --}}
                    </div>
                    {{-- </div> --}}
                </div>

            </div>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="modal-contact-map" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-end border-bottom-0">
                    <button type="button" class="btn-close-icon" data-bs-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                <div class="card-body">
                    {{-- <div class="card profile-content"> --}}
                    <div class="row align-content-center justify-content-sm-center text-center">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                        </div>
                    </div>
                    {{-- </div> --}}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDLvXbMJeffWEpUT5XTib18jiZVkprAVI" sync></script> --}}
    {{-- https://maps.googleapis.com/maps/api/geocode/json?latlng=28.6300158,77.3651258&key=AIzaSyBDLvXbMJeffWEpUT5XTib18jiZVkprAVI --}}

    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>


    {{-- Customers Overview JS --}}
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.js ') }}"></script>
    {{-- Pop Modal --}}
    <script type="text/javascript">
        function popupfunctioncall(visitorID) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                // data:{('visitorID' => visitorID)},
                url: '/Admin/popUpVisitorRegistration/',
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
                    // $('#pic').attr('src', result.pic);
                    $('#pic').attr('src', ('../Visitor/' + result.pic));
                    $('#address').text(result.address);
                    $('#logo').attr('src', ('../' + result.companyLogo));
                    var obj = JSON.parse(JSON.stringify(result));
                    $('#visitorID').val(obj.visitorID);
                },
            });
        }
    </script>

    {{-- PDF Download --}}
    <script type="text/javascript">
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
    <script type="text/javascript">
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
    <script type="text/javascript">
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
        $('#dateIDpop').attr('max', maxDate);
    </script>

    <script type="text/javascript">
        function myMap(currentLat, currentLng) { //getting values by reference
            $('#modal-contact-map').modal('show');
            var myLatLng = {
                lat: currentLat, //set current lat value to map
                lng: currentLng //set current long value to map
            };
            var mapProp = {
                center: myLatLng,
                zoom: 15,
                gestureHandling: 'greedy'
            };
            var map = new google.maps.Map(document.getElementById("map"), mapProp);
            map.setTilt(50);
            placeMarker(map, myLatLng);
        }
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

    <script type="text/javascript">
        $(document).on('click', '.button', function() {
            $('#modal-contact-export').hide();
               swal("Good job!", "Export Visitor Reports", "success").then(function() {
                location.reload();
            });      });
    </script>


@endsection
