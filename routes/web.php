<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HelloWorldController}; // Wajib ditambahkan agar tidak error
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('landingpage');
});
Route::get('/admin_pusat', function () {
    return view('admin_pusat.pages.dashboard');
});
Route::get('/karyawan_pusat', function () {
    return view('admin_pusat.pages.karyawan');
});
Route::get('/gaji_pusat', function () {
    return view('admin_pusat.pages.gaji');
});
Route::get('/cabang_pusat', function () {
    return view('admin_pusat.pages.cabang');
});
Route::get('/absensi_pusat', function () {
    return view('admin_pusat.pages.absensi');
});
Route::get('/penjualan_pusat', function () {
    return view('admin_pusat.pages.penjualan');
});
Route::get('/penilaian_pusat', function () {
    return view('admin_pusat.pages.penilaian');
});
Route::get('/masukan_pusat', function () {
    return view('admin_pusat.pages.masukan');
});
Route::post('/logout', function (Request $request) {
    Auth::logout();
    
    // Menghapus session agar aman
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    // Arahkan kembali ke halaman login
    return redirect('/login');
})->name('logout');
// 1. Untuk menampilkan halaman/form login (menggunakan GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// 2. Untuk memproses data ketika form login disubmit (menggunakan POST)
Route::post('/login', function (\Illuminate\Http\Request $request) {
    // Tulis logika autentikasi / login di sini
    // Contoh sementara (bisa disesuaikan dengan controller Anda nanti):
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin_pusat');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
});
Route::get('ambilfile', [HelloWorldController::class, 'ambilFile']);
Route::post('kirim-pesan', [HelloWorldController::class, 'kirimPesan']);


