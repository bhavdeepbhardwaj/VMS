<!-- LEFT MAIN SIDEBAR -->
<div class="ec-left-sidebar ec-bg-sidebar">
    <div id="sidebar" class="sidebar ec-sidebar-footer">

        {{-- <div class="m-3">
            <a href="/" title="GLOBALSYNC">
                <img class="" src="{{ asset('assets/img/logo/logo.png ') }}" alt="" />
            </a>
        </div>

        <div class="ec-brand">
            <a href="/" title="GLOBALSYNC">
                <img class="ec-brand-icon" src="{{ asset('assets/img/logo/logo.png ') }}" alt="" />
                <span class="ec-brand-name text-truncate">NOVITA</span>
            </a>
        </div> --}}

        <div class="ec-brand">
            <a href="/" title="{{ Auth::user()->company_name }}">
                @if (Auth::user()->company_logo != '')
                    @foreach (explode(',', Auth::user()->company_logo) as $ref)
                        <img class="ec-brand-name text-truncate" src="{{ '/' . $ref }}" alt="{{ $ref }}" style="    width: 150px;
                        padding-top: 50px;
                        height: 150px;
                        padding-bottom: 50px;" />
                    @endforeach
                @else
                    <img class="ec-brand-name text-truncate" src="{{ asset('assets/img/logo/demo.png ') }}"
                        alt="{{ Auth::user()->company_name }}" style="width: 150px;" />
                @endif
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="ec-navigation" data-simplebar>
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard -->
                {{-- <li class="active">
                    <a class="sidenav-item-link" href="{{ route('home')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <hr>
                </li> --}}

                {{--  <li class="">
                    <a class="sidenav-item-link" href="{{ route('profile') }}">
                        <i class="mdi mdi-account"></i>
                        <span class="nav-text">My Profile</span>
                    </a>
                </li>  --}}

                <!-- Visitor Registration -->
                <li class="">
                    <a class="sidenav-item-link" href="{{ route('user.list') }}">
                        <i class="mdi mdi-account-card-details"></i>
                        <span class="nav-text">Visitor Registration</span>
                    </a>
                    <hr>
                </li>

                <!-- Visitor QR Code -->
                 <li class="hidden-sm-down">
                    <a class="sidenav-item-link" href="{{ route('user.qrcode') }}">
                        <i class="mdi mdi-qrcode-scan"></i>
                        <span class="nav-text">QR Code</span>
                    </a>
                </li>


                {{-- <li>
                    <a class="sidenav-item-link" href="{{ route('change-password') }}">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">change Password</span>
                    </a>
                </li> --}}

                <!-- Products -->
                {{-- <li>
                    <a class="sidenav-item-link" href="{{ route('my-product') }}">
                        <i class="mdi mdi-palette-advanced"></i>
                        <span class="nav-text">My Product</span>
                    </a>
                </li> --}}

                <!-- warranty registration -->
                {{-- <li>
                    <a class="sidenav-item-link" href="{{ route('product-registration') }}">
                        <i class="mdi mdi-security"></i>
                        <span class="nav-text">Product Registration</span>
                    </a>
                </li> --}}

                <!-- warranty Extend -->
                {{-- <li>
                    <a class="sidenav-item-link" href="{{ route('product-extend')}}">
                        <i class="mdi mdi-security"></i>
                        <span class="nav-text">Product Extend</span>
                    </a>
                </li> --}}

                <!-- warranty registration -->
                {{-- <li>
                    <a class="sidenav-item-link" href="{{ route('complaintRegistration') }}">
                        <i class="mdi mdi-pencil-box-outline"></i>
                        <span class="nav-text">Complaint Registration</span>
                    </a>
                </li> --}}

                <!-- Contact US -->
                {{-- <li>
                    <a class="sidenav-item-link" href="https://www.GLOBALSYNC-GLOBAL.com/contact-us" target="_blank">
                        <i class="mdi mdi-contacts"></i>
                        <span class="nav-text">Contact US</span>
                    </a>
                </li> --}}

                {{-- <li>
                    <a class="sidenav-item-link" href="{{ route('contactus')}}" >
                        <i class="mdi mdi-contacts"></i>
                        <span class="nav-text">Contact US</span>
                    </a>
                </li> --}}

                <!-- Products -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-palette-advanced"></i>
                        <span class="nav-text">Products</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="products" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="">
                                    <span class="nav-text">Add Product</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="">
                                    <span class="nav-text">List Product</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <!-- Category -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-dns-outline"></i>
                        <span class="nav-text">Categories</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="categorys" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="">
                                    <span class="nav-text">Main Category</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="">
                                    <span class="nav-text">Sub Category</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <!-- Vendors -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-account-group-outline"></i>
                        <span class="nav-text">Vendors</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="vendor-card.html">
                                    <span class="nav-text">Vendor Grid</span>
                                </a>
                            </li>

                            <li class="">
                                <a class="sidenav-item-link" href="vendor-list.html">
                                    <span class="nav-text">Vendor List</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="vendor-profile.html">
                                    <span class="nav-text">Vendors Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <!-- Users -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">Users</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="users" data-parent="#sidebar-menu">
                            <li>
                                <a class="sidenav-item-link" href="user-card.html">
                                    <span class="nav-text">User Grid</span>
                                </a>
                            </li>

                            <li class="">
                                <a class="sidenav-item-link" href="user-list.html">
                                    <span class="nav-text">User List</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="user-profile.html">
                                    <span class="nav-text">Users Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                </li> --}}

                <!-- Orders -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-cart"></i>
                        <span class="nav-text">Orders</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="orders" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="new-order.html">
                                    <span class="nav-text">New Order</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="order-history.html">
                                    <span class="nav-text">Order History</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="order-detail.html">
                                    <span class="nav-text">Order Detail</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="invoice.html">
                                    <span class="nav-text">Invoice</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <!-- Reviews -->
                {{-- <li>
                    <a class="sidenav-item-link" href="review-list.html">
                        <i class="mdi mdi-star-half"></i>
                        <span class="nav-text">Reviews</span>
                    </a>
                </li> --}}

                <!-- Brands -->
                {{-- <li>
                    <a class="sidenav-item-link" href="brand-list.html">
                        <i class="mdi mdi-tag-faces"></i>
                        <span class="nav-text">Brands</span>
                    </a>
                    <hr>
                </li> --}}

                <!-- Authentication -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-login"></i>
                        <span class="nav-text">Authentication</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="authentication" data-parent="#sidebar-menu">
                            <li class="">
                                <a href="sign-in.html">
                                    <span class="nav-text">Sign In</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="sign-up.html">
                                    <span class="nav-text">Sign Up</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <!-- Icons -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-diamond-stone"></i>
                        <span class="nav-text">Icons</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="icons" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="material-icon.html">
                                    <span class="nav-text">Material Icon</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="font-awsome-icons.html">
                                    <span class="nav-text">Font Awsome Icon</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="flag-icon.html">
                                    <span class="nav-text">Flag Icon</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <!-- Other Pages -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-image-filter-none"></i>
                        <span class="nav-text">Other Pages</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="otherpages" data-parent="#sidebar-menu">
                            <li class="has-sub">
                                <a href="404.html">404 Page</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
