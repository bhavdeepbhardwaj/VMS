@extends('user.layouts.app')

@section('title')
    @lang('title.profile')
@stop

@section('content')
    <!-- CONTENT WRAPPER -->
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <form method="POST" action="{{ route('profilesave') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="ec-vendor-main-img">
                            <div class="avatar-upload">
                                <div class="avatar-preview ec-preview">
                                    <div class="imagePreview ec-div-preview">
                                        @if (Auth::user()->company_logo != '')
                                            <img class="ec-image-preview" src="{{ '/'. Auth::user()->company_logo }}"
                                                alt="{{ Auth::user()->company_logo }}" style="width: 50%; padding-bottom: 20px;">
                                            <br />
                                        @else
                                            <img class="ec-image-preview" src="{{ asset('assets/img/logo/demo.png') }}"
                                                alt="{{ Auth::user()->company_logo }}" style="width: 50%; padding-bottom: 20px;">
                                        @endif

                                    </div>
                                    <small>Logo Size requirement: 200 x 80 px</small>
                                </div>
                                <div class="avatar-edit">
                                    <input type="file" hidden id="imageUpload"
                                        class="ec-image-upload @error('company_logo') is-invalid @enderror" name="company_logo[]" value="{{ '/'. Auth::user()->company_logo }}">
                                        {{-- <input type="file" hidden name="company_logo" value="{{ '/'. Auth::user()->company_logo }}"> --}}
                                    @error('company_logo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <label for="imageUpload">
                                        <img src="/assets/img/icons/edit.svg" class="svg_img header_svg"
                                            alt="{{ Auth::user()->company_name }}">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <span class="font-weight-bold"><strong>
                                <h5>{{ Auth::user()->company_name }}</h5>
                            </strong></span><span class="text-black-50"><strong>
                                <h4>{{ Auth::user()->email }}</h4>
                            </strong></span><span>
                        </span>
                </div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    @include('component.alert')
                    <div class="row mt-2">
                        <input type="hidden" class="form-select1" value="{{ Auth::user()->id }}" name="user_id">
                        <input type="hidden" class="form-select1" value="1" name="approve">
                        <div class="col-md-6"><label class="labels">Admin Name</label>
                            <input type="text" class="form-select1 "  placeholder="Admin Name"
                                value="{{ Auth::user()->admin_name }}" name="admin_name">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Company Name</label>
                            <input type="text" class="form-select1 @error('company_name') is-invalid @enderror"
                                value="{{ Auth::user()->company_name }}" disabled placeholder="Company Name" >
                            @error('company_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Company Number</label>
                            <input type="text" class="form-select1 @error('company_phone') is-invalid @enderror"
                                placeholder="Company number" value="{{ Auth::user()->company_phone }}" name="company_phone">
                            @error('company_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12  mt-3">
                            <label class="labels">Email ID</label>
                            <input type="text" disabled class="form-select1" placeholder="Enter email"
                                value="{{ Auth::user()->email }}" name="email">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="labels">Address</label>
                            <input type="text" class="form-select1 @error('address') is-invalid @enderror"
                                placeholder="Enter address" value="{{ Auth::user()->address }}" name="address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6  mt-3">
                            <label class="labels">Postcode</label>
                            <input type="text" class="form-select1 @error('postcode') is-invalid @enderror"
                                placeholder="Postcode" value="{{ Auth::user()->postcode }}" name="postcode">
                            @error('postcode')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="labels">Country</label>
                            <input type="text" class="form-select1 @error('country') is-invalid @enderror"
                                placeholder="Country" value="{{ Auth::user()->country }}" name="country">
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="labels">State/Region</label>
                            <input type="text" class="form-select1 @error('state') is-invalid @enderror"
                                value="{{ Auth::user()->state }}" placeholder="State" name="state">
                            @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                            Profile</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Wrapper -->
@endsection


@section('js')
    <script>
        /*======== Image Change on Upload ========*/
        $("body").on("change", ".ec-image-upload", function(e) {

            var lkthislk = $(this);

            if (this.files && this.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {

                    var ec_image_preview = lkthislk.parent().parent().children('.ec-preview').find(
                        '.ec-image-preview').attr('src', e.target.result);

                    ec_image_preview.hide();
                    ec_image_preview.fadeIn(650);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection
