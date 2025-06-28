<nav class="pcoded-navbar">
    <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
    <div class="pcoded-inner-navbar main-menu">
        <div class="">
            <div class="main-menu-header">
                <img class="img-80 img-radius" src="/admin/assets/images/image-login.png" alt="User-Profile-Image">
                <div class="user-details">
                    <span id="more-details">{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></span>
                </div>
            </div>

            <div class="main-menu-content">
                <ul>
                    <li class="more-details">
                       
                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ti-layout-sidebar-left"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>


                    </li>
                </ul>
            </div>
        </div>

        <div class="p-15 p-b-0">
            <form class="form-material">
                <div class="form-group form-primary">
                    <input type="text" name="footer-email" class="form-control" required="">
                    <span class="form-bar"></span>
                    <label class="float-label"><i class="fa fa-search m-r-10"></i>Search Friend</label>
                </div>
            </form>
        </div>

        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            @php
                $componentsActive =
                    request()->is('destinasis*') ||
                    request()->is('pakets*') ||
                    request()->is('detail_pakets*') ||
                    request()->is('transportasis*') ||
                    request()->is('bookings*') ||
                    request()->is('pembayarans*') ||
                    request()->is('ulasans*');
            @endphp
            <li class="pcoded-hasmenu {{ $componentsActive ? 'pcoded-trigger active' : '' }}">
                <a href="#" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Components</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    @can('destinasi-list')
                        <li class="{{ request()->routeIs('destinasis.index') ? 'active' : '' }}">
                            <a href="{{ route('destinasis.index') }}" class="waves-effect waves-dark">Destinasi</a>
                        </li>
                    @endcan

                    @can('paket-list')
                        <li class="{{ request()->routeIs('pakets.index') ? 'active' : '' }}">
                            <a href="{{ route('pakets.index') }}" class="waves-effect waves-dark">Paket</a>
                        </li>
                    @endcan

                    @can('detail_paket-list')
                        <li class="{{ request()->routeIs('detail_pakets.index') ? 'active' : '' }}">
                            <a href="{{ route('detail_pakets.index') }}" class="waves-effect waves-dark">Detail Paket</a>
                        </li>
                    @endcan

                    @can('transportasi-list')
                        <li class="{{ request()->routeIs('transportasis.index') ? 'active' : '' }}">
                            <a href="{{ route('transportasis.index') }}" class="waves-effect waves-dark">Transportasi</a>
                        </li>
                    @endcan

                    @can('hotel-list')
                        <li class="{{ request()->routeIs('hotels.index') ? 'active' : '' }}">
                            <a href="{{ route('hotels.index') }}" class="waves-effect waves-dark">Hotel</a>
                        </li>
                    @endcan

                    @can('booking-list')
                        <li class="{{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                            <a href="{{ route('bookings.index') }}" class="waves-effect waves-dark">Booking</a>
                        </li>
                    @endcan

                    @can('pembayaran-list')
                        <li class="{{ request()->routeIs('pembayarans.index') ? 'active' : '' }}">
                            <a href="{{ route('pembayarans.index') }}" class="waves-effect waves-dark">Pembayaran</a>
                        </li>
                    @endcan

                    @can('ulasan-list')
                        <li class="{{ request()->routeIs('ulasans.index') ? 'active' : '' }}">
                            <a href="{{ route('ulasans.index') }}" class="waves-effect waves-dark">Ulasan</a>
                        </li>
                    @endcan

                    @can('pengguna-list')
                        <li class="{{ request()->routeIs('penggunas.index') ? 'active' : '' }}">
                            <a href="{{ route('penggunas.index') }}" class="waves-effect waves-dark">Pengguna</a>
                        </li>
                    @endcan

                    @can('role-list')
                        <li class="{{ request()->routeIs('roles.index') ? 'active' : '' }}">
                            <a href="{{ route('roles.index') }}" class="waves-effect waves-dark">Role</a>
                        </li>
                    @endcan
                </ul>
            </li>
        </ul>

        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ request()->is('chart*') ? 'active' : '' }}">
                <a href="chart.html" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext">Statistik Pemesanan</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>
            <li class="{{ request()->is('map-google*') ? 'active' : '' }}">
                <a href="map-google.html" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layers"></i><b>FC</b></span>
                    <span class="pcoded-mtext">Maps Destinasi</span>
                    <span class="pcoded-mcaret"></span>
                </a>
            </li>

            {{-- @php
                $pagesActive = request()->is('auth-*') || request()->is('sample-page');
            @endphp
            <li class="pcoded-hasmenu {{ $pagesActive ? 'pcoded-trigger active' : '' }}">
                <a href="javascript:void(0)" class="waves-effect waves-dark">
                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                    <span class="pcoded-mtext">Pages</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="{{ request()->is('auth-normal-sign-in') ? 'active' : '' }}">
                        <a href="auth-normal-sign-in.html" class="waves-effect waves-dark">Login</a>
                    </li>
                    <li class="{{ request()->is('auth-sign-up') ? 'active' : '' }}">
                        <a href="auth-sign-up.html" class="waves-effect waves-dark">Register</a>
                    </li>
                    <li class="{{ request()->is('sample-page') ? 'active' : '' }}">
                        <a href="sample-page.html" class="waves-effect waves-dark">Sample Page</a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</nav>
