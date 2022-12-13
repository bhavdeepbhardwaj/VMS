@extends('layouts.app')

@section('title')
    @lang('title.reset_password')
@stop

@section('content')

    <!-- CONTENT WRAPPER -->
    <div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-12">
                {{-- <div class="card"> --}}
                <div class="">
                    <div class="">
                        <div class="ec-brand">
                            <a href="/" title="GLOBALSYNC">
                                <img class="ec-brand-icon" src="{{ asset('assets/img/logo/logo.png ') }}" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-5">

                        @if (session('status'))
                            <div class="alert alert-success">
                                <i class="ti-info-alt"></i> {{ session('status') }}
                            </div>
                        @endif

                        <h4 class="text-dark mb-5">Forgot Password</h4>
                        <div class="text-dark mb-5">Please enter your GLOBALSYNC account email to reset password</div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 ">
                                    <input type="email" class="form-select1 @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email') }}" autocomplete="email" autofocus
                                        placeholder="Email Address">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Send Password Reset
                                        Link</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End CONTENT WRAPPER -->

@endsection

@section('js')
    <script>
        function myFunction() {
            var x = document.getElementById("current_password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction1() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction2() {
            var x = document.getElementById("password_confirmation");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endsection
