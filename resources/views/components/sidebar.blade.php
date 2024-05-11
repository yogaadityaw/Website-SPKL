{{-- untuk mengambil session role id dari AuthController --}}


{{-- pengecekan untuk pembagian view sidebar --}}

{{-- tampilan sidebar berdasarkan role id 1 (Admin) --}}
@if (auth()->user()->role_id == 1)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">SPKL-PAL</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Ubah role</li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard-admin') }}"><i
                            class="fas fa-home"></i><span>Dashboard</span>
                        <a class="nav-link" href="{{ route('change-role') }}"><i
                                class="fas fa-user"></i><span>Ubah Role</span></a>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
@endif


{{-- side bar untuk user role kedua Kepala Bengkel --}}
@if (auth()->user()->role_id == 2)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">SPKL-PAL</a>
            </div>
            <ul class="sidebar-menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard-kabeng') }}"><i
                            class="fas fa-home"></i><span>Dashboard</span></a>
                    <a class="nav-link" href="{{ route('pegawai-bengkel') }}"><i
                            class="fas fa-user"></i><span>List Pegawai</span></a>
                    <a class="nav-link" href="{{ route('create-spkl') }}"><i
                            class="fas fa-archive"></i><span>Detail SPKL</span></a>
                    <a class="nav-link" href="{{ route('pengajuan-spkl') }}"><i
                            class="fas fa-archive"></i><span>Pengajuan SPKL</span></a>

            </ul>
        </aside>
    </div>
@endif

@if (auth()->user()->role_id == 3)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">SPKL-PAL</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{route('dashboard-departemen')}}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
            </ul>
        </aside>
    </div>
@endif

@if (auth()->user()->role_id == 4)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">SPKL-PAL</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{route('dashboard-kemenpro')}}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
            </ul>
        </aside>
    </div>
@endif

@if (auth()->user()->role_id == 5)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">SPKL-PAL</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{route('dashboard-pegawai')}}" class="nav-link"><i
                            class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
            </ul>
        </aside>
    </div>
@endif


{{-- tampilan sidebar berdasarkan role id 1 (Kabengkel) --}}
@if (auth()->user()->role_id == 6)
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="#">SPKL-PAL</a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                <li class="nav-item">
                    <a href="{{route('dashboard-user')}}" class="nav-link"><i
                            class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
            </ul>
        </aside>
    </div>
@endif
