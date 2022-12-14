<!DOCTYPE html>
<html lang="en">

<head>
    <title itemprop="name">500 page error</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="{{ asset('assets/img/AVITA-logo.ico  ') }}" rel="shortcut icon" />
</head>

<style type="text/css">
    .clearfix:before,
    .clearfix:after {
        display: table;

        content: ' ';
    }

    .clearfix:after {
        clear: both;
    }

    body {
        background: #f0f0f0 !important;
    }

    .page-404 .outer {
        position: absolute;
        top: 0;

        display: table;

        width: 100%;
        height: 100%;
    }

    .page-404 .outer .middle {
        display: table-cell;

        vertical-align: middle;
    }

    .page-404 .outer .middle .inner {
        width: 300px;
        margin-right: auto;
        margin-left: auto;
    }

    .page-404 .outer .middle .inner .inner-circle {
        height: 300px;

        border-radius: 50%;
        background-color: #ffffff;
    }

    .page-404 .outer .middle .inner .inner-circle:hover i {
        color: #ffcc06 !important;
        background-color: #f5f5f5;
        box-shadow: 0 0 0 15px #ffcc06;
    }

    .page-404 .outer .middle .inner .inner-circle:hover span {
        color: #ffcc06;
    }

    .page-404 .outer .middle .inner .inner-circle i {
        font-size: 5em;
        line-height: 1em;

        float: right;

        width: 1.6em;
        height: 1.6em;
        margin-top: -.7em;
        margin-right: -.5em;
        padding: 20px;

        -webkit-transition: all .4s;
        transition: all .4s;
        text-align: center;

        color: #f5f5f5 !important;
        border-radius: 50%;
        background-color: #ffcc06;
        box-shadow: 0 0 0 15px #f0f0f0;
    }

    .page-404 .outer .middle .inner .inner-circle span {
        font-size: 11em;
        font-weight: 700;
        line-height: 1.2em;

        display: block;

        -webkit-transition: all .4s;
        transition: all .4s;
        text-align: center;

        color: #e0e0e0;
    }

    .page-404 .outer .middle .inner .inner-status {
        font-size: 20px;

        display: block;

        margin-top: 20px;
        margin-bottom: 5px;

        text-align: center;

        color: #ffcc06;
    }

    .page-404 .outer .middle .inner .inner-detail {
        line-height: 1.4em;

        display: block;

        margin-bottom: 10px;

        text-align: center;

        color: #999999;
    }

    .btn.btn-primary {
        color: #ffffff;
        background-color: #ffcc06;
    }

    .btn.btn-primary:hover,
    .btn.btn-outline-primary:hover {
        color: #ffcc06;
        background-color: #ffffff;
        border-color: #ffcc06;
    }

</style>

<body>
    <div id="snippetContent">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <div class="page-404">
            <div class="outer">
                <div class="middle">
                    <div class="inner">
                        <div class="inner-circle"><i class="fa fa-cogs"></i><span>500</span></div> <span
                            class="inner-status">Opps! Internal Server Error!</span> <span
                            class="inner-detail">Unfortunately we're having trouble loading the page you are looking
                            for. Please come back in a while.</span>
                    </div>
                    {{-- <div class="inner">
                        <div class="inner-circle"><i class="fa fa-cogs"></i><span>500</span></div> <span
                            class="inner-status">Opps! Something Went Wrong!</span> <span
                            class="inner-detail">Unfortunately, we're unable to register your product at this time.
                            Please go back and check the serial number and model no.</span>
                    </div> --}}
                </div>
            </div>
        </div>
        <script type="text/javascript"></script>
    </div>
</body>

</html>
