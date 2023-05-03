@extends('layouts.app')

@section('title')
    @lang('title.register')
@stop

@section('css')

    <style>
        .vid {
            border: 5px solid #000;
            padding: 5px;
            box-shadow: 0 0 20px 2px #ffcc05;
            width: -webkit-fill-available;
        }
    </style>

@endsection

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="container d-flex align-items-center justify-content-center form-height pt-24px pb-24px">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-6">
                {{-- <div class="card"> --}}
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <div class=" align-content-center justify-content-sm-center text-center pt-2">
                            <h1 class="p-24px text-black" style="text-shadow: 5px 0px 5px #ffcc05;">Our Visitor Management System Walk-through Tour</h1>
                            <div href="/" title="GLOBALSYNC" class="text-center">
                                <iframe width="560" height="400"
                                    src="https://www.youtube.com/embed/gxZ5lzvyPog" title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen class="vid"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-6">
                        <div class=" align-content-center justify-content-sm-center text-center pt-4">
                            <a href="/" title="GLOBALSYNC" class=" text-center">
                                <img class="" src="{{ asset('assets/img/logo/logo.png ') }}" style=""
                                    alt="GLOBALSYNC" />
                            </a>
                        </div>

                        <div class="card-body">
                            @include('component.alert')
                            <h4 class="text-dark mb-5">SIGN UP NOW</h4>
                            <div class="text-dark mb-5">Access Smart & Safe Visitor Management System</div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text" class="form-select1 @error('admin_name') is-invalid @enderror"
                                            id="admin_name" name="admin_name" placeholder="Admin Name"
                                            value="{{ old('admin_name') }}" autocomplete="admin_name" autofocus>
                                        @error('admin_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="text"
                                            class="form-select1 @error('company_name') is-invalid @enderror"
                                            id="company_name" name="company_name" placeholder="Company Name"
                                            value="{{ old('company_name') }}" autocomplete="company_name" autofocus oninput="this.value = this.value.toUpperCase()">
                                        @error('company_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="email" class="form-select1 @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                            autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <input type="tel"
                                            class="form-select1 @error('company_phone') is-invalid @enderror"
                                            id="company_phone" name="company_phone" placeholder="Phone Number"
                                            value="{{ old('company_phone') }}" autocomplete="company_phone">
                                        @error('company_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 " style="margin-bottom: 0px!important">
                                        <input type="password" class="form-select1 @error('password') is-invalid @enderror"
                                            id="password" placeholder="Password" name="password"
                                            autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-check mt-3">
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" class="form-check-input" onclick="myFunction()">
                                                Show Password
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-6 ">
                                        <input id="password_confirmation" type="password"
                                            class="form-select1 @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Confirm Password"
                                            autocomplete="new-password">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-inline-block ">
                                            <input class="form-check-input" type="checkbox" name="remember" required
                                                id="remember" {{ old('remember') ? 'checked' : '' }} />&nbsp;&nbsp; I
                                            I have read the <a href="{{ route('privacyPolicy') }}" target="_blank">Privacy
                                                Policy</a> & accept the teams and Conditions
                                        </div>


                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary btn-block mb-4 mt-2">Register With Us</button>

                                {{-- <p class="sign-upp">Already have an account?
                                    <a class="text-blue" href="{{ route('login') }}">Log In</a>
                                </p> --}}
                            </form>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <!-- End CONTENT WRAPPER -->
@endsection

@section('js')
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction1() {
            var x = document.getElementById("password_confirmation");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
