<!-- Sidebar Container -->
<div class="d-flex flex-column flex-shrink-0 p-3 bg-white" style="width: 250px; min-height: 100vh; box-shadow: 2px 0 5px rgba(0,0,0,0.05);">
    
    <!-- Title / Label -->
    <div class="px-3 mb-4">
        <span class="fs-6 fw-bold text-muted">Menu</span>
    </div>

    <!-- Navigation Links -->
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Dashboard (Active) -->
        <li class="nav-item mb-1">
            <a href="#" class="nav-link active d-flex align-items-center gap-3 fw-bold" 
               style="background-color: transparent; color: #2e7d32;">
                <i class="bi bi-house-door-fill fs-5"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Karyawan -->
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark d-flex align-items-center gap-3 fw-medium">
                <i class="bi bi-people-fill fs-5 text-secondary"></i>
                <span>Karyawan</span>
            </a>
        </li>

        <!-- Gaji -->
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark d-flex align-items-center gap-3 fw-medium">
                <i class="bi bi-cash-stack fs-5 text-secondary"></i>
                <span>Gaji</span>
            </a>
        </li>

        <!-- Cabang -->
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark d-flex align-items-center gap-3 fw-medium">
                <i class="bi bi-building fs-5 text-secondary"></i>
                <span>Cabang</span>
            </a>
        </li>

        <!-- Absensi -->
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark d-flex align-items-center gap-3 fw-medium">
                <i class="bi bi-check-circle-fill fs-5 text-secondary"></i>
                <span>Absensi</span>
            </a>
        </li>

        <!-- Penjualan -->
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark d-flex align-items-center gap-3 fw-medium">
                <i class="bi bi-basket3-fill fs-5 text-secondary"></i>
                <span>Penjualan</span>
            </a>
        </li>

        <!-- Penilaian Kinerja -->
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark d-flex align-items-center gap-3 fw-medium">
                <i class="bi bi-pencil-square fs-5 text-secondary"></i>
                <span>Penilaian Kinerja</span>
            </a>
        </li>
    </ul>

    <!-- Log Out Button -->
    <div class="pt-3 border-top">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link nav-link text-danger d-flex align-items-center gap-3 fw-bold w-100 text-start p-0">
                <div class="bg-danger text-white rounded p-1 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                    <i class="bi bi-box-arrow-right"></i>
                </div>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</div>