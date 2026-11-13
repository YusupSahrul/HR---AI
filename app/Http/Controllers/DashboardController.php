<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung jumlah seluruh karyawan di tabel 'karyawan'
        $totalKaryawan = DB::table('karyawan')->count();

        // Mengirimkan variabel $totalKaryawan ke view dashboard
        return view('admin_pusat.pages.dashboard', compact('totalKaryawan'));
    }
}
