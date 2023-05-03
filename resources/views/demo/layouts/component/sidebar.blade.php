<!-- LEFT MAIN SIDEBAR -->
<div class="ec-left-sidebar ec-bg-sidebar">
    <div id="sidebar" class="sidebar ec-sidebar-footer">

        <div class="ec-brand">
            <a href="/" title="Globalsync">
                <img class="ec-brand-name text-truncate" src="{{ asset('assets/img/logo/logo.png ') }}"
                    alt="Globalsync" />
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="ec-navigation" data-simplebar>
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard -->
                {{--  <li class="">
                    <a class="sidenav-item-link" href="{{ route('demo.home') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <hr>
                </li>  --}}

                <!-- Visitor Registration -->
                <li class="">
                    <a class="sidenav-item-link" href="{{ route('demo.index') }}">
                        <i class="mdi mdi-account-card-details"></i>
                        <span class="nav-text">Visitor Registration</span>
                    </a>
                    <hr>
                </li>

            </ul>
        </div>
    </div>
</div>
