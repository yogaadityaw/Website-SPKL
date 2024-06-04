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
                        <a class="nav-link" href="{{ route('pt-list') }}"><i
                                class="fas fa-building"></i><span>PT List</span></a>
                        <a class="nav-link" href="{{ route('proyek-list') }}"><i
                                class="fas fa-ship"></i><span>Proyek List</span></a>
                                <a class="nav-link" href="{{ route('bengkel-list') }}"><i
                                        class="fas fa-wrench"></i><span>Bengkel List</span></a>
                        <a class="nav-link" href="{{ route('departemen-list') }}"><i
                                class="fas fa-black-tie"></i><span>Departemen List</span></a>
                        <a class="nav-link" href="{{ route('list-spkl-admin') }}"><i
                                class="fas fa-archive"></i><span>Rekap-SPKL</span></a>
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
                            class="fas fa-user"></i><span>List Pegawai Bengkel</span></a>
{{--                    <a class="nav-link" href="{{ route('create-spkl') }}"><i--}}
{{--                            class="fas fa-archive"></i><span>Create SPKL</span></a>--}}
                    <a class="nav-link" href="{{ route('pengajuan-spkl') }}"><i
                            class="fas fa-archive"></i><span>Pengajuan SPKL</span></a>
{{--                    <a class="nav-link" href="{{ route('detail-spkl') }}"><i--}}
{{--                            class="fas fa-archive"></i><span>Detail SPKL</span></a>--}}

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
                    <a class="nav-link" href="{{ route('pengajuan-spkl-departemen') }}"><i
                            class="fas fa-archive"></i><span>Pengajuan SPKL</span></a>
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
                    <a class="nav-link" href="{{ route('pengajuan-spkl-kemenpro') }}"><i
                            class="fas fa-archive"></i><span>Pengajuan SPKL</span></a>
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
                    {{-- <a href="{{route('dashboard-pegawai')}}" class="nav-link"><i
                            class="fas fa-home"></i><span>Dashboard</span></a> --}}
                    <a class="nav-link" href="{{ route('list-spkl-pegawai') }}"><i
                            class="fas fa-archive"></i><span>Pengajuan SPKL</span></a>
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
