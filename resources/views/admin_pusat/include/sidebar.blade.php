<nav class="sb-sidenav bg--white accordion sb-sidenav-dark border-end mt-5" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <!-- Menu Core -->

            <a class="nav-link {{ request()->is('admin_pusat') ? 'active' : '' }}" href="{{ url('admin_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-house"></i></div>
                Dashboard
            </a>

            <a class="nav-link {{ request()->is('karyawan_pusat') ? 'active' : '' }}" href="{{ url('karyawan_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-users"></i></div>
                Karyawan
            </a>

            <a class="nav-link {{ request()->is('gaji_pusat') ? 'active' : '' }}" href="{{ url('gaji_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                Gaji
            </a>

            <a class="nav-link {{ request()->is('cabang_pusat') ? 'active' : '' }}" href="{{ url('cabang_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-building"></i></div>
                Cabang
            </a>

            <a class="nav-link {{ request()->is('absensi_pusat') ? 'active' : '' }}" href="{{ url('absensi_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-square-check"></i></div>
                Absensi
            </a>

            <a class="nav-link {{ request()->is('penjualan_pusat') ? 'active' : '' }}" href="{{ url('penjualan_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-basket-shopping"></i></div>
                Penjualan
            </a>

            <a class="nav-link {{ request()->is('penilaian_pusat') ? 'active' : '' }}" href="{{ url('penilaian_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-ranking-star"></i></div>
                Penilaian Kinerja
            </a>

            <a class="nav-link {{ request()->is('masukan_pusat') ? 'active' : '' }}" href="{{ url('masukan_pusat') }}">
                <div class="sb-nav-link-icon color--primary"><i class="fa-solid fa-message"></i></div>
                Masukan
            </a>

            <hr class="sidebar-divider my-0" />

            <a class="nav-link text-danger logout-link" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <div class="sb-nav-link-icon text-danger"><i class="fa-solid fa-right-from-bracket"></i></div>
                <strong class="text-danger">Log Out</strong>
            </a>

            <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>