@extends('admin.layouts.app')

@section('title')
    @lang('title.admin_user')
@stop

@section('css')
    <!-- No Extra plugin used -->
    <link href="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/plugins/data-tables/responsive.datatables.min.css') }}" rel='stylesheet'>
@endsection

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
                <div>
                    <h2>All Client</h2>
                    <p class="breadcrumbs"><span><a href="{{ route('admin.home') }}">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>All Client
                    </p>
                </div>
                {{-- <a href="{{ route('all-customers') }}" class="btn btn-primary">Export File</a> --}}
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="responsive-data-table" class="table nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Customer ID</th>
                                            <th>Admin Name</th>
                                            <th class="">Email</th>
                                            <th class="">Company Number</th>
                                            <th class="">Company Name</th>
                                            <th class="">Company Address</th>
                                            <th>Customer Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $user)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>
                                                    {{-- <a class="text-dark" href="">{{ $user->admin_name }}</a> --}}
                                                    <a href="javascript:0" data-bs-toggle="modal" class="view-detail"
                                                        onClick="popupfunctioncall('{{ $user->company_phone }}');">{{ $user->admin_name }}
                                                    </a>
                                                </td>
                                                <td class="">{{ $user->email }}</td>
                                                <td class="">{{ $user->company_phone }}</td>
                                                <td class="">{{ $user->company_name }}</td>
                                                <td class="">
                                                    @if ($user->address != null)
                                                        {{ $user->address }}
                                                    @else
                                                        N/A
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($user->role == 1)
                                                        <span class="badge badge-success">Admin</span>
                                                    @elseif($user->role == 2)
                                                        <span class="badge badge-info">Customer</span>
                                                    @elseif ($user->role == 0)
                                                        <span class="badge bg-primary">Demo</span>
                                                    @endif
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
                    <div class="row">
                        <div class=" text-center">
                            @if ($user != null)
                                <a href="/" title="{{ Auth::user()->company_name }}">
                                    <img class="pt-5 w-25" id="logo" src=""
                                        alt="{{ Auth::user()->company_name }}" />
                                </a>
                                <br />
                            @else
                                <img class="pt-5 w-25" src="{{ asset('assets/img/logo/logo.png') }}"
                                    alt="{{ Auth::user()->company_name }}">
                            @endif
                        </div>

                        <div class="col-lg-6 col-xl-6 pt-sm-0 pt-lg-3 pt-xl-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Admin Name</td>
                                        <td id="adminName"></td>
                                    </tr>
                                    <tr>
                                        <td>Company Name</td>
                                        <td id="companyName"></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td id="email"></td>
                                    </tr>
                                    <tr>
                                        <td>Company Phone</td>
                                        <td id="companyPhone"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6 col-xl-6 pt-sm-0 pt-lg-3 pt-xl-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Address</td>
                                        <td id="address"></td>
                                    </tr>
                                    <tr>
                                        <td>Postcode</td>
                                        <td id="postcode"></td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td id="state"></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td id="country"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    {{-- Pop Modal --}}
    <script type="text/javascript">
        function popupfunctioncall(company_phone) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                // data:{('company_phone' => company_phone)},
                url: '/Admin/popUpUserRegistration/',
                data: {
                    'company_phone': company_phone
                },
                global: false,
                async: true,

                success: function(result) {
                    $('#modal-contact').modal('show');
                    // alert(result);
                    $('#email').html(result.email);
                    $('#adminName').html(result.admin_name);
                    $('#companyPhone').text(result.company_phone);
                    $('#companyName').text(result.company_name);
                    $('#address').text(result.address);
                    $('#postcode').text(result.postcode);
                    $('#country').text(result.country);
                    $('#state').text(result.state);
                    $('#logo').attr('src', ('../' + result.company_logo));
                    var obj = JSON.parse(JSON.stringify(result));
                    // $('#visitorID').val(obj.phone);

                },

            });

        }
    </script>
@endsection
