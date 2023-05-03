@extends('layouts.app')

@section('title')
    @lang('title.welcome')
@stop

@section('css')
    <style>
        .form-check-input:checked {
            background-color: #ffcc06;
            border-color: #ffcc06;
        }

        a {
            color: #ffcc06;
        }

        .btn.btn-primary {
            color: #fff;
            background-color: #ffcc06;
            border-color: #ffcc06;
        }

        .btn-primary1 {
            color: #ffcc06;
            background-color: #fff;
            border-color: #fff;
        }

        .btn-primary1:hover {
            color: #fff;
            background-color: #ffcc06;
            border-color: #fff;
        }

        .btn.btn-primary:hover {
            color: #ffcc06;
            background-color: #fff;
            border-color: #ffcc06;
        }

        .login-panel {
            color: #fff;
            background-color: #ffcc06;
            /* background: url('/assets/img/bg_welcome_background.jpg') 100% / cover no-repeat; */
            min-height: 600px;
            /* padding-top: 50px; */
        }

        .mt-2,
        .my-2 {
            margin-top: 40px !important;
        }

        .textColor {
            color: #662d91;
        }

        @media (max-width:767px) {
            .hidden-sm-down {
                display: none !important
            }
        }

        @media (min-width:768px) {
            .hidden-md-up {
                display: none !important
            }
        }

        .vid {
            border: 5px solid #000;
            padding: 5px;
            box-shadow: 0 0 20px 2px #ffcc05;
            width: -webkit-fill-available;
            border-radius: 3px;
        }
    </style>
@endsection

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="container">

        <div class="row ">
            <div class="col-lg-6 col-xl-6 login-panel my-lg-9 pt-50">
                {{-- <img src="/assets/img/bg_welcome_background.jpg"> --}}
                <h1 class="pl-3 pb-4 text-capitalize text-center pr-4" style="text-shadow: 2px 0px 5px #0101013b;">Visitor
                    Management System</h1>

                <h3 class="pl-3 text-capitalize" style="text-shadow: 2px 0px 5px #0101013b;">Call Support</h3>
                <div class="pl-3 font-size-40" style="text-shadow: 2px 0px 5px #0101013b;"><i
                        class="mdi mdi-cellphone-basic mdi-18px"></i> <a href="tel:+911204215944" class=" text-white"
                        style="text-shadow: 2px 0px 5px #0101013b;">+91 1204215944</a>&nbsp;&nbsp;<strong
                        style="border-left:2px solid #fff;"></strong>&nbsp;&nbsp;Mon - Sat : 10:00
                    AM To 06:00 PM</div>
                <h3 class="pl-3 pt-4 text-capitalize" style="text-shadow: 2px 0px 5px #0101013b;">Email Support</h3>
                <div class="pl-3 font-size-40" style="text-shadow: 2px 0px 5px #0101013b;"><i
                        class="mdi mdi-email-outline mdi-18px"></i>
                    <a href="mailto:contact@globalsync.com.au"
                        class="text-white">contact@globalsync.com.au</a>&nbsp;&nbsp;<strong
                        style="border-left:2px solid #fff;"></strong>&nbsp;&nbsp;Dedicated
                    Support Team
                </div>
                @if (!Auth::check())
                    <div href="/" title="GLOBALSYNC" class="pt-3 pl-3">
                        <iframe width="560" height="300" src="https://www.youtube.com/embed/gxZ5lzvyPog"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen class="vid"></iframe>
                    </div>
                @else
                @endif

            </div>

            <div class="col-lg-1 col-xl-1 pt-25" style="padding-left: 80px!important;padding-top: 50px;">
                <div style="border-left:2px solid #ffcc06;height:665px" class="hidden-sm-down"></div>
            </div>

            <div class="col-lg-5 col-xl-5 my-lg-9">
                @auth
                    {{-- // user logged in --}}

                    <div class=" align-content-center justify-content-sm-center text-center pt-4">
                        <a href="/" title="GLOBALSYNC" class=" text-center">
                            <img class=" m-2" src="{{ asset('assets/img/logo/logo.png ') }}" style="padding-top: 120px"
                                alt="GLOBALSYNC" />
                        </a>
                    </div>
                    <h2 class=" my-2 text-center text-capitalize p-3" style="color:#ffcc06">Member Already Logged-In</h2>
                    <div class=" text-center m-1 font-size-16 pb-3" style="padding-top: 25px;">Back to Dashboard.</div>
                    <div class="align-content-center justify-content-sm-center text-center p-lg-9">

                        @if (Auth::user()->role == 1)
                            <a href="{{ route('admin.home') }}" class="btn btn-primary">{{ Auth::user()->company_name }}
                                Dashboard</a>
                        @elseif (Auth::user()->role == 2)
                            @if (is_null(Auth()->user()->approve))
                                {{-- <a href="{{ route('thankYou') }}" class="btn btn-primary">{{ Auth::user()->company_name }} --}}
                                <a href="{{ route('profile') }}" class="btn btn-primary">{{ Auth::user()->company_name }}
                                    Dashboard</a>
                            @else
                                <a href="{{ route('user.list') }}" class="btn btn-primary">{{ Auth::user()->company_name }}
                                    Dashboard</a>
                            @endif
                            {{-- <a href="{{ route('thankYou') }}" class="btn btn-primary">{{ Auth::user()->company_name }} Dashboard</a> --}}
                        @elseif (Auth::user()->role == 0)
                            <a href="{{ route('demo.index') }}" class="btn btn-primary">{{ Auth::user()->company_name }}
                                Dashboard</a>
                        @endif

                    </div>
                @else
                    {{-- // not logged in --}}
                    <div class=" align-content-center justify-content-sm-center text-center pt-2">
                        <div class="text-center pb-1 pl-2" style="color:#ffcc06;padding-top: 50px;font-size: 35px;"></div>
                        <a href="/" title="GLOBALSYNC" class=" text-center">
                            <img class=" m-2" src="{{ asset('assets/img/logo/logo.png') }}" style="padding-top: 40px"
                                alt="GLOBALSYNC" />
                        </a>
                    </div>
                    <h2 class="text-center p-5" style="color:#ffcc06">Welcome Back</h2>
                    <div class=" text-center m-1 font-size-16" style="">
                        <h4>Login To Manage VMS</h4>
                    </div>
                    <div class="align-content-center justify-content-sm-center text-center p-5">

                        @include('component.alert')

                        <form method="POST" action="{{ route('login') }}">
                            {!! csrf_field() !!}

                            <div class="row">
                                <div class="form-group col-md-12 mb-4">
                                    <input type="email" class="form-select1 @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" autocomplete="email"
                                        autofocus placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12 ">
                                    <input type="password" class="form-select1 @error('password') is-invalid @enderror"
                                        id="current_password" name="password" autocomplete="current-password"
                                        placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex  justify-content-between">
                                        <div class="d-inline-block mr-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            Remember me
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" class="form-check-input" onclick="myFunction()"
                                                    id="current_password">
                                                Show Password
                                            </label>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary m-2">Log In</button>
                            <a href="{{ route('register') }}" class="btn btn-primary m-2">Sign Up</a>
                            <p class=" text-center pt-3">
                                @if (Route::has('password.request'))
                                    <a class="text-blue text-center" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </p>
                        </form>
                    </div>
                @endauth

            </div>
        </div>
    </div>
    <!-- End Content Wrapper -->
    <!-- End CONTENT WRAPPER -->
@endsection

@section('js')
    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("current_password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

@endsection
