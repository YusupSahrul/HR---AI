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
    return view('admin_pusat.layouts.app');
});
Route::post('/logout', function (Request $request) {
    Auth::logout();
    
    // Menghapus session agar aman
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    
    // Arahkan kembali ke halaman login
    return redirect('/login');
})->name('logout');
Route::view('/login', 'auth.login')->name('login');
Route::get('ambilfile', [HelloWorldController::class, 'ambilFile']);
Route::post('kirim-pesan', [HelloWorldController::class, 'kirimPesan']);


