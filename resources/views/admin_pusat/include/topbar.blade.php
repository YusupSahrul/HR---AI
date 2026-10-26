<!-- Topbar Container -->
<nav class="navbar navbar-expand bg-primary px-4 py-2 shadow-sm" style="border-bottom: 1px solid #eaeaea;">
    <div class="container-fluid p-0">

        <!-- Tombol Menu / Hamburger (untuk toggle sidebar nantinya) -->
        <button class="btn btn-light border-0 d-flex align-items-center justify-content-center rounded-3 p-0" type="button" style="width: 40px; height: 40px; background-color: #f8f9fa;">
            <i class="bi bi-list fs-4 text-secondary"></i>
        </button>

        <!-- Bagian Kanan (Info Perusahaan, Tanggal, dan Profil) -->
        <ul class="navbar-nav ms-auto align-items-center gap-4">

            <!-- Nama Perusahaan / Cabang dengan Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark text1 fs-6 d-flex align-items-center gap-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    PT Abcdefg (Cabang)
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Pusat (Bandung)</a></li>
                    <li><a class="dropdown-item" href="#">Cabang Tasikmalaya</a></li>
                </ul>
            </li>

            <!-- Tanggal -->
            <li class="nav-item text-secondary fs-6 text1">
                <span>Jan 1, 2021</span>
            </li>

            <!-- Profil Pengguna -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Foto Profil (bisa diganti asset gambar atau inisial) -->
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&h=100&fit=crop&crop=faces" alt="Profile" class="rounded-circle" width="36" height="36" style="object-fit: cover;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                    <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Log Out</button>
                        </form>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</nav>