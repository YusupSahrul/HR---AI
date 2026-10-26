<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Layout Utama menggunakan Flexbox -->
    <div class="d-flex" style="min-height: 100vh;">

        <!-- 1. Sidebar di Kiri -->
        <div>
            @include('admin_pusat.include.sidebar')
        </div>

        <!-- 2. Area Kanan (Topbar + Konten Utama) -->
        <div class="flex-grow-1 d-flex flex-column">

            <!-- Topbar di Atas -->
            @include('admin_pusat.include.topbar')

            <!-- Konten Utama (Tempat card, grafik, dll.) -->
            <main class="p-4">
                @yield('content')
            </main>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>