<nav class="sb-topnav bg--primary navbar navbar-expand navbar-dark border-end">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ url('admin_pusat') }}">
        <img
            class="navbar-brand__logo"
            src="{{ asset('assets/LOGOHRIS.svg') }}"
            alt="Gadjihan" />
    </a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 border border-2 rounded-3 custom-toggle-btn" id="sidebarToggle" href="#!">
        <i class="fas fa-bars text-white"></i>
    </button>

    <!-- Informasi Cabang & Tanggal (Menggantikan form kosong) -->
    <div class="d-none d-md-flex ms-auto align-items-center text-white me-3">

        <!-- Bungkus bagian cabang ini dengan class="dropdown" -->
        <div class="dropdown me-3">
            <a href="#" class="text-white text-decoration-none small fw-medium dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                PT Maju Jaya (Bandung)
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#!">Bandung (Pusat)</a></li>
                <li><a class="dropdown-item" href="#!">Cabang Lain</a></li>
            </ul>
        </div>
    </div>

    <!-- Navbar User Dropdown-->
    <ul class="navbar-nav ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-circle-user fa-2x"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#!">Settings</a></li>
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>