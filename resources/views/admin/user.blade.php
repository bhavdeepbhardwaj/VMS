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
                                            <th>Client ID</th>
                                            <th>Admin Name</th>
                                            <th class="">Email</th>
                                            <th class="">Company Number</th>
                                            <th class="">Company Name</th>
                                            <th>Customer Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>
                                                    <a class="text-dark" href="">{{ $user->admin_name }}</a>
                                                </td>
                                                <td class="">{{ $user->email }}</td>
                                                <td class="">{{ $user->company_phone }}</td>
                                                <td class="">{{ $user->company_name }}</td>
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
@endsection

@section('js')
    <!-- Datatables -->
    <script src="{{ asset('assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/datatables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/data-tables/datatables.responsive.min.js') }}"></script>
@endsection
