<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            @if (Auth::user()->role_id == 1)
                <a href="{{ route('beranda') }}">Petugas Puskesmas</a>
            @else
                <a href="{{ route('beranda') }}">Puskesmas Pembantu</a>
            @endif
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('beranda') }}">PP</a>
        </div>
        <ul class="sidebar-menu">
            @if (Auth::user()->role_id == 1)
                <li class="menu-header">Dashboard</li>
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Pustu</li>
                <li class="{{ Request::is('usersData') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('usersData') }}"><i class="fa fa-users"></i> <span>Data Akun
                            Pustu</span></a>
                </li>
                <li class="menu-header">Laporan Pustu</li>
                <li class="{{ Request::is('blank') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('blank') }}"><i class="fa fa-file-text"></i> <span>Data Laporan
                            Pustu</span></a>
                </li>
                <li class="menu-header">Setting</li>
                <li class="{{ Request::is('blank') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('blank') }}"><i class="fa fa-cog"></i> <span>Setting
                            Akun</span></a>
                </li>
                <li class="menu-header">Website Setting</li>
                <li class="{{ Request::is('blank') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('blank') }}"><i class="fa fa-globe"></i> <span>Beranda
                            Page</span></a>
                    <a class="nav-link" href="{{ route('blank') }}"><i class="fa fa-info"></i> <span>Tentang
                            Kami</span></a>
                    <a class="nav-link" href="{{ route('blank') }}"><i class="fa fa-phone"></i> <span>Kontak</span></a>
                </li>
            @else
                <li class="menu-header">Dashboard</li>
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Data Pustu</li>
                <li class="{{ Request::is('keluargaBerencana') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('keluargaBerencana') }}"><i class="fa fa-users"></i>
                        <span>Keluarga
                            Berencana</span></a>
                </li>
                <li class="{{ Request::is('imunisasi') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('imunisasi') }}"><i class="fa fa-heartbeat"></i>
                        <span>Imunisasi</span></a>
                </li>
                <li class="{{ Request::is('ibuHamil') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('ibuHamil') }}"><i class="fa fa-stethoscope"></i> <span>Ibu
                            Hamil</span></a>
                </li>
                <li class="{{ Request::is('penyakit') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('penyakit') }}"><i class="fa fa-medkit"></i>
                        <span>Penyakit</span></a>
                </li>
                <li class="menu-header">Laporan Pustu</li>
                <li class="{{ Request::is('blank') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('blank') }}"><i class="fa fa-file-text"></i> <span>Rekap Laporan
                            Pustu</span></a>
                </li>
            @endif
            <div class="hide-sidebar-mini mb-4 p-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </ul>
    </aside>
</div>
