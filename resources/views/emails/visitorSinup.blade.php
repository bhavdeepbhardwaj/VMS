<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>GLOBALSYNC</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <link href="https://visitor.globalsync.com.au/assets/css/mail.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
            height: 250px;
            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>


</head>

<body>
    <table class="body" style="background: #F7F7F7; width:100%;" data-made-with-foundation>
        <tbody>
            <tr>
                <td class="float-center" align="center" valign="top">
                    <center>
                        <table align="center" class="container float-center"
                            style="width: 600px !important; min-width: 600px !important; max-width: 600px !important; margin: 0 auto; padding: 0; background: #ffffff;"
                            width="600">
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- Header -->
                                        <table class="row">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="https://globalsync.com.au/wp-content/uploads/2022/12/header.gif"
                                                            alt="GLOBALSYNC">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Text Section -->
                                        <table class="row" style="background: #ffffff; color:#000000;">
                                            <tbody>
                                                <tr>
                                                    <td class="colpad" style="padding: 30px 35px;">
                                                        <p><strong>Dear {{ $users->admin_name }},</strong></p>
                                                        <p>Thank You for opting for our Visitor Management System designed to safeguard your workplace security by managing visitors in the most efficient way. We understand and appreciate your trust in our product, and are committed to striving for excellence with every step we take. </p>
                                                        <p>Here is your <a
                                                            href="{{ route('user.visitor', strtoupper($users->company_name)) }}"
                                                            target="_blank">link </a>and the Qr Code
                                                    </p>
                                                    <br/>

                                                        <div class="" style="">
                                                            <div style="">
                                                                <img src="{{ asset('qr-code/' . $users->qrCode) }}" />
                                                                {{-- <img src="{{ $message->embed(public_path('qr-code/' . $users->qrCode)) }}"> --}}
                                                            </div>
                                                        </div>
                                                        <br/>
                                                        <p style="padding-top: 20px;">For any query or information, Email us at <a
                                                            href="mailto:sales@globalsync.com.au" >sales@globalsync.com.au</a>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>





                                        <table class="row" style="background: #ffffff; color:#000000;">
                                            <tbody>
                                                <tr>
                                                    <td class="colpad" style="padding: 30px 35px;">
                                                        <p style="" class=""><strong>Follow us on social
                                                                media:</strong></p>
                                                        <div class="">
                                                            <a href="https://www.linkedin.com/company/global-sync/"
                                                                target="_blank"><img
                                                                    src="https://globalsync.com.au/wp-content/uploads/2022/12/LinkedIn.png"
                                                                    width="80"></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="https://www.facebook.com/GlobalSync1"
                                                                target="_blank"><img
                                                                    src="https://globalsync.com.au/wp-content/uploads/2022/12/Facebook.png"
                                                                    style="" width="80"></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="https://www.youtube.com/@globalsync"
                                                                target="_blank"><img
                                                                    src="https://globalsync.com.au/wp-content/uploads/2022/12/YouTube.png"
                                                                    style="" width="80"></a>
                                                        </div>
                                                        <p class=""><strong>Let us synchronise with your
                                                                business!</strong></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- Footer -->
                                        <table class="row">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="https://globalsync.com.au/wp-content/uploads/2022/12/footer-1.gif"
                                                            alt="GLOBALSYNC">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
