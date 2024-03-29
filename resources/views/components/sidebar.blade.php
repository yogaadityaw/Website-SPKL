{{-- untuk mengambil session role id dari AuthController --}}



{{-- pengecekan untuk pembagian view sidebar --}}

{{-- tampilan sidebar berdasarkan role id 1 (Kabengkel) --}}
@if (auth()->user()->role_id == 1)
    {{-- <li class="menu-header">PELER</li>
    <li class="nav-item dropdown {{ $type_menu === 'PELER' ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>PELER</span></a>
        <ul class="dropdown-menu">
            <li class='{{ Request::is('PELER-general-PELER') ? 'active' : '' }}'>
                <a class="nav-link" href="{{ url('PELER-general-PELER') }}">General PELER</a>
            </li>
        </ul>
    </li> --}}

    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a>SPKL-PAL</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboards_user">SPKL</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown {{ $type_menu === 'PELER' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li> --}}

                        <li>
                            <a class="nav-link" href="{{ route('change-role') }}">Rubah Role</a>
                        </li>
                    </ul>
                </li>
@endif

@if (auth()->user()->role_id == 2)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a>SPKL-PAL</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboards_user">SPKL</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown {{ $type_menu === 'PELER' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li> --}}
                        <li>
                            <a class="nav-link" href="{{ route('create-spkl') }}">Tambah Baru SPKL</a>
                        </li>

                    </ul>
                </li>
@endif

@if (auth()->user()->role_id == 3)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a>SPKL-PAL</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboards_user">SPKL</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown {{ $type_menu === 'PELER' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                    <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                </li> --}}
                    </ul>
                </li>
@endif

@if (auth()->user()->role_id == 4)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a>SPKL-PAL</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboards_user">SPKL</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown {{ $type_menu === 'PELER' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li> --}}
                    </ul>
                </li>
@endif

@if (auth()->user()->role_id == 5)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a>SPKL-PAL</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboards_user">SPKL</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown {{ $type_menu === 'PELER' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li> --}}
                    </ul>
                </li>
@endif


{{-- tampilan sidebar berdasarkan role id 1 (Kabengkel) --}}
@if (auth()->user()->role_id == 6)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a>SPKL-PAL</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="dashboards_user">SPKL</a>
            </div>
            <ul class="sidebar-menu">

                <li class="menu-header">Dashboard</li>
                <li class="nav-item dropdown {{ $type_menu === 'PELER' ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i
                            class="fas fa-fire"></i><span>Dashboard</span></a>
                    <ul class="dropdown-menu">
                        {{-- <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li> --}}
                    </ul>
                </li>
@endif
</aside>
</div>
