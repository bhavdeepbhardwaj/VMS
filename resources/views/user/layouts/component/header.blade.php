<!-- Header -->
<header class="ec-main-header" id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle"></button>
        @if (Auth::user()->company_logo != '')
            @foreach (explode(',', Auth::user()->company_logo) as $ref)
                <img class="ec-brand-name text-truncate hidden-md-up" src="{{ '/' . $ref }}"
                    alt="{{ $ref }}" style="width: 150px; height: 50px;" />
            @endforeach
        @else
            <img class="ec-brand-name text-truncate hidden-md-up" src="{{ asset('assets/img/logo/demo.png') }}"
                alt="{{ Auth::user()->company_name }}" style="width: 150px; " />
        @endif

        <!-- search form -->
        <div class="search-form d-lg-inline-block">
            <div class="input-group">
                <input type="hidden" name="query" id="search-input" class="form-control" placeholder="search.."
                    autofocus autocomplete="off" />
            </div>
            <div id="search-results-container">
                <ul id="search-results"></ul>
            </div>
        </div>

        <!-- navbar right -->
        <div class="navbar-right ">
            <ul class="nav navbar-nav">
                <!-- User Account -->
                <li class="dropdown user-menu">
                    <button class="dropdown-toggle nav-link ec-drop" data-bs-toggle="dropdown" aria-expanded="false">
                        {{-- @if (Auth::user()->company_logo != '')
                            @foreach (explode(',', Auth::user()->company_logo) as $ref)
                                <img src="{{ '/' . $ref }}" class="user-image" alt="{{ $ref }}">
                            @endforeach
                        @else
                            <img class="user-image" src="{{ asset('assets/img/user/user.png ') }}" alt="{{ Auth::user()->company_name }}">
                        @endif --}}
                        <img class="user-image" src="{{ asset('assets/img/user/user.png ') }}"
                            alt="{{ Auth::user()->company_name }}">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right ec-dropdown-menu">
                        <!-- User image -->
                        <li class="dropdown-header">
                            <img src="{{ asset('assets/img/user/user.png ') }}" class="img-circle"
                                alt="{{ Auth::user()->company_name }}">
                            <div class="d-inline-block">
                                {{ Auth::user()->company_name }} <small class="pt-1">{{ Auth::user()->email }}</small>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('profile') }}">
                                <i class="mdi mdi-account"></i> My Profile
                            </a>
                        </li>
                        <li class="dropdown-footer">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i
                                    class="mdi mdi-logout"></i> {{ __('Logout') }} </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
