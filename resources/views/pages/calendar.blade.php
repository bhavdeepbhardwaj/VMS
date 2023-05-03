<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Organization Calendar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- FAVICON -->
    <link href="{{ asset('assets/img/icons/favicon.ico  ') }}" rel="shortcut icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icons/apple-touch-icon.png ') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/icons/favicon-32x32.png ') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/icons/favicon-16x16.png ') }}">
    <link rel="manifest" href="{{ asset('assets/img/icons/site.webmanifest ') }}">
    <link rel="mask-icon" href="{{ asset('assets/img/icons/safari-pinned-tab.svg" color="#ffcc06 ') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

        .fc-time {
            display: none;
        }

        #calendar .fc-view-container {
            padding: 30px;
            background-color: #fff;
            -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 text-center pt-4">
                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="GLOBALSYNC" />
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div id="calendar" class=" p-4"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <img src="{{ asset('assets/img/GSync_Footer.png') }}" alt="GLOBALSYNC" />
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            var booking = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking
            })
            $('.fc-time').hide();
            $('.fc-title').css('font-size', '14px');

        });
    </script>
</body>

</html>
