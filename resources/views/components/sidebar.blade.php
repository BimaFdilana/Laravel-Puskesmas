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
                <li class="menu-header">Home</li>
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="menu-header">Akun</li>
                <li class="{{ Request::is('usersData') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('usersData') }}"><i class="fa fa-users"></i> <span>Data Akun
                            Pustu</span></a>
                </li>
                <li class="menu-header">Laporan Pustu</li>
                <li class="{{ Request::is('laporan/pustu*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan.pustu.index') }}"><i class="fas fa-file-alt"></i>
                        <span>Laporan per Pustu</span>
                    </a>
                </li>

                <li class="menu-header">Website Setting</li>
                <li class="{{ Request::is('beranda*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.beranda.edit') }}"><i class="fa fa-globe"></i>
                        <span>Kelola Beranda</span></a>
                </li>
                <li class="{{ Request::is('services*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('services.index') }}"><i class="fa fa-server"></i>
                        <span>Kelola Layanan</span></a>
                </li>
                <li class="menu-header">Informasi Kontak</li>
                <li class="{{ Request::is('admin/contact*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.contact.edit') }}"><i class="fa fa-address-book"></i>
                        <span>Kelola Kontak</span></a>
                </li>
                <li class="menu-header">Interaksi</li>
                <li class="{{ Request::is('admin/messages*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.messages.index') }}"><i class="fa fa-envelope"></i>
                        <span>Pesan Masuk</span></a>
                </li>
                <li class="menu-header">Setting</li>
                <li class="{{ Request::is('setting-akun*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.account.setting') }}"><i class="fa fa-cog"></i>
                        <span>Setting
                            Akun</span></a>
                </li>
            @else
                <li class="menu-header">Home</li>
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}"><i class="fa fa-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="{{ Request::is('posyandu*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('posyandu.index') }}"><i class="fa fa-hospital"></i>
                        <span>Posyandu</span></a>
                </li>
                <li class="menu-header">Data Pustu</li>
                <li class="{{ Request::is('peserta-kb*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('peserta-kb.index') }}"><i
                            class="fa fa-american-sign-language-interpreting"></i>
                        <span>Keluarga Berencana</span>
                    </a>
                </li>
                <li class="menu-header">Imunisasi</li>
                <li class="{{ Request::is('imunisasi-bayi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('imunisasi-bayi.index') }}"><i class="fa fa-heartbeat"></i>
                        <span>Imunisasi Bayi</span></a>
                </li>
                <li class="{{ Request::is('imunisasi-wus-bumil*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('imunisasi-wus-bumil.index') }}"><i class="fa fa-user-md"></i>
                        <span>Imunisasi WUS & Bumil</span></a>
                </li>
                <li class="menu-header">Ibu Hamil</li>
                <li class="{{ Request::is('anc') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('anc.index') }}"><i class="fa fa-wheelchair"></i> <span>Ibu
                            Hamil</span></a>
                </li>
                <li class="menu-header">Penyakit</li>
                <li class="{{ Request::is('surveilans-penyakit*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('surveilans-penyakit.index') }}"><i class="fa fa-bug"></i>
                        <span>Surveilans Penyakit</span>
                    </a>
                </li>
                <li class="menu-header">Laporan Pustu</li>
                <li class="{{ Request::is('laporan/anc*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan.anc.index') }}"><i class="fas fa-female"></i>
                        <span>Laporan Ibu Hamil</span>
                    </a>
                </li>
                <li class="{{ Request::is('laporan/imunisasi*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan.imunisasi.index') }}"><i class="fa fa-print"></i>
                        <span>Laporan Imunisasi</span>
                    </a>
                </li>
                <li class="{{ Request::is('laporan/kb*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan.kb.index') }}"><i class="fas fa-pills"></i>
                        <span>Laporan KB</span>
                    </a>
                </li>
                <li class="{{ Request::is('laporan/surveilans*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('laporan.surveilans.index') }}"><i class="fas fa-chart-bar"></i>
                        <span>Laporan Surveilans</span>
                    </a>
                </li>
            @endif
            <div class="hide-sidebar-mini mb-4 p-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg btn-block btn-icon-split">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
            </div>
        </ul>
    </aside>
</div>
