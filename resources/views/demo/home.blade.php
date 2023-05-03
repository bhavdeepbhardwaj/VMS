@extends('demo.layouts.app')

@section('title')
    @lang('title.demo_home')
@stop

@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <!-- Top Statistics -->
            <div class="row">
                <div class="col-xl-6 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-1">
                        <div class="card-body">
                            <h2 class="mb-1">{{ $users }}</h2>
                            <p>Total Customers</p>
                            <span class="mdi mdi-account-group"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 p-b-15 lbl-card">
                    <div class="card card-mini dash-card card-2">
                        <div class="card-body">
                            <h2 class="mb-1">{{ $visitor }}</h2>
                            <p>Total visitor Registration</p>
                            <span class=" mdi mdi-account-card-details"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-xl-6 col-md-12 p-b-15">
                    <!-- Sales Graph -->
                    <div id="user-acquisition" class="card card-default">
                        <div class="card-header">
                            <h2>Visitor Registration</h2>
                        </div>
                        <div class="card-body">
                            {{-- <div id="container"></div> --}}
                            <canvas id="myAreaChartVisitor" style="height:350px;"></canvas>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at @php  echo date('F j, Y', time() ) @endphp</div>
                    </div>
                </div>

                <div class="col-xl-6 col-md-12 p-b-15">
                    <!-- Doughnut Chart -->
                    <div class="card card-default">
                        <div class="card-header justify-content-center">
                            <h2>Customers Overview</h2>
                        </div>
                        <div class="card-body">
                            <div id="piechart" style="height:350px;"></div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at @php  echo date('F j, Y', time() ) @endphp</div>
                    </div>
                </div>

            </div>
        </div>
        <!-- End Content -->
    </div>
    <!-- End Content Wrapper -->

@endsection

@section('js')

    <script src="{{ asset('assets/js/chart-dashboard.js ') }}"></script>

    {{-- Warranty Registration && Warranty Extend JS --}}

    <script src="{{ asset('assets/js/create-charts.js ') }}"></script>

    {{-- Customers Overview JS --}}

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Month Name', 'Registered User Count'],

                @php
                    $user = \App\Models\User::select(DB::raw('COUNT(*) as count'), DB::raw('MONTHNAME(created_at) as month_name'))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy('month_name')
                        ->orderBy('count')
                        ->get();

                    foreach ($user as $d) {
                        echo "['" . $d->month_name . "', " . $d->count . '],';
                    }
                @endphp
            ]);

            var options = {
                // title: 'Users Detail',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>

@endsection
