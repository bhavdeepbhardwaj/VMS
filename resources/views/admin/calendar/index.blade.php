@extends('admin.layouts.app')

@section('title')
    @lang('title.visitor')
@stop

@section('css')
    <!-- No Extra plugin used -->
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.css') }}" />

    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

        #calendar .fc-view-container {
            padding: 30px;
            background-color: #fff;
            -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
            box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.2);
        }
    </style>


@endsection

@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="ec-content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
                <div>
                    <h2>Organization Calendar</h2>
                    <p class="breadcrumbs"><span><a href="{{ route('admin.home') }}">Home</a></span>
                        <span><i class="mdi mdi-chevron-right"></i></span>Organization Calendar
                    </p>
                </div>
            </div>
            <div class="row">
                <div id="calendar">
                </div>
            </div>
        </div>
        <!-- End Content -->
    </div>
    <!-- End Content Wrapper -->

    <!-- Contact Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Event title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="title">
                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveBtn" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-contact-detail show" id="modaleditDel" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-end border-bottom-0">

                    <button type="button" class="btn-close-icon" data-bs-dismiss="modal" aria-label="Close">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>

                <div class="modal-body pt-0">
                    <div class="row no-gutters ">
                        <div class="col-md-12 justify-content-between align-items-center">
                            <div class="profile-content-left px-4">
                                <div class="widget-profile px-0 border-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Event title</h5>
                                    <input type="text" class="form-control" id="editTitle" value="">
                                    <span id="titleError" class="text-danger"></span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                        id="edit">Edit</button>
                                    <button type="button" id="del" class="btn btn-danger">Deleted</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    {{-- Customers Overview JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ asset('assets/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>


    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next, today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDays) {
                    $('#bookingModal').modal('toggle');

                    $('#saveBtn').click(function() {
                        var title = $('#title').val();
                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date = moment(end).format('YYYY-MM-DD');

                        $.ajax({
                            url: "{{ route('calendar.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                title,
                                start_date,
                                end_date
                            },
                            success: function(response) {
                                $('#bookingModal').modal('hide')
                                $('#calendar').fullCalendar('renderEvent', {
                                    'title': response.title,
                                    'start': response.start,
                                    'end': response.end,
                                    'color': response.color
                                });
                                swal("Good job!", "Event Created!", "success");
                                window.location.reload();


                            },
                            error: function(error) {
                                if (error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON.errors
                                        .title);
                                }
                            },
                        });
                    });
                },
                editable: true,
                eventDrop: function(event) {
                    var id = event.id;
                    var start_date = moment(event.start).format('YYYY-MM-DD');
                    var end_date = moment(event.end).format('YYYY-MM-DD');

                    $.ajax({
                        url: "{{ route('calendar.update', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        data: {
                            start_date,
                            end_date
                        },
                        success: function(response) {
                            swal("Good job!", "Event Updated!", "success");
                        },
                        error: function(error) {
                            console.log(error)
                        },
                    });
                },
                editable: true,
                eventClick: function(event) {
                    var title = event.title;
                    // alert(title);
                    $('#editTitle').val(title);
                    $('#modaleditDel').modal('toggle');

                    $('#del').click(function() {
                        var id = event.id;
                        $.ajax({
                            url: "{{ route('calendar.destroy', '') }}" + '/' + id,
                            type: "DELETE",
                            dataType: 'json',
                            success: function(response) {
                                $('#modaleditDel').modal('hide')
                                $('#calendar').fullCalendar('removeEvents',
                                    response);
                                swal("Good job!", "Event Deleted!", "success");
                            },
                            error: function(error) {
                                console.log(error)
                            },
                        });
                    });

                    $('#edit').click(function() {
                        var id = event.id;
                        var title = $('#editTitle').val();
                        // alert(title);

                        $.ajax({
                            url: "{{ route('calendar.edit', '') }}" + '/' + id,
                            type: "PUT",
                            dataType: 'json',
                            data: {
                                title,
                                // start_date,
                                // end_date,
                            },
                            success: function(response) {
                                $('#modaleditDel').modal('hide')
                                $('#calendar bhav'+id).addClass('title');

                                window.location.reload();

                                swal("Good job!", "Event edit!", "success");
                            },
                            error: function(error) {
                                console.log(error)
                            },
                        });
                    });



                },
                selectAllow: function(event) {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1,
                        'second').utcOffset(false), 'month');
                },



            });


            $("#bookingModal").on("hidden.bs.modal", function() {
                $('#saveBtn').unbind();
            });

            $('.fc-time').hide();
            $('.fc-event').css('font-size', '16px');
            $('.fc-event').css('background-color', '#ffcc06');
            // $('.fc-bg').css('background-color', '#ffcc06');
            $('.fc-event').css('border-color', '#ffcc06');
            // $('.fc-event').css('width', '20px');
            // $('.fc-event').css('border-radius', '50%');


        });
    </script>


@endsection
