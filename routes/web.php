<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HelloWorldController}; // Wajib ditambahkan agar tidak error

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
Route::get('ambilfile', [HelloWorldController::class, 'ambilFile']);
Route::post('kirim-pesan', [HelloWorldController::class, 'kirimPesan']);
