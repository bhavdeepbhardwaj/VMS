<!-- LEFT MAIN SIDEBAR -->
<div class="ec-left-sidebar ec-bg-sidebar">
    <div id="sidebar" class="sidebar ec-sidebar-footer">

        {{-- <div class="m-3">
            <a href="" title="AVITA GLOBAL">
                <img class="" src="{{ asset('assets/img/logo/AVITA-dash-logo.png ') }}" alt="" />
            </a>
        </div> --}}

        <div class="ec-brand">
            <a href="/" title="GLOBALSYNC">
                <img class="ec-brand-name text-truncate" src="{{ asset('assets/img/logo/dash-logo.png ') }}"
                    alt="GLOBALSYNC" />
            </a>
        </div>

        {{-- <div class="ec-brand">
            <a href="/" title="Ekka">
                <img class="ec-brand-icon" src="{{ asset('assets/img/logo/AVITA-dash-logo.png ') }}" alt="" />
                <span class="ec-brand-name text-truncate">AVITA</span>
            </a>
        </div> --}}

        <!-- begin sidebar scrollbar -->
        <div class="ec-navigation" data-simplebar>
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard -->
                <li class="">
                    <a class="sidenav-item-link" href="{{ route('admin.home') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <hr>
                </li>

                <!-- Client -->
                <li>
                    <a class="sidenav-item-link" href="{{ route('user') }}">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">All Client</span>
                    </a>
                </li>

                <!-- Visitor Registration -->
                <li class="">
                    <a class="sidenav-item-link" href="{{ route('admin.visitor') }}">
                        <i class="mdi mdi-account-card-details"></i>
                        <span class="nav-text">Visitor Registration</span>
                    </a>
                    <hr>
                </li>

                {{-- Calendar --}}
                <li class="">
                    <a class="sidenav-item-link" href="{{ route('calendar.index') }}">
                        <i class="mdi mdi-calendar"></i>
                        <span class="nav-text">Calendar</span>
                    </a>
                    <hr>
                </li>


            </ul>
        </div>
    </div>
</div>
