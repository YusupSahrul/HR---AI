<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kantor;
use App\Models\Jabatan;
use App\Models\Golongan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class KaryawanController extends Controller
{
    /**
     * Menampilkan daftar karyawan (Maksimal 10 baris per halaman)
     */
    public function index(Request $request)
    {
        // Sinkronisasi golongan otomatis untuk semua karyawan berdasarkan masa kerja saat ini
        $this->sinkronisasiGolonganSemuaKaryawan();

        $query = Karyawan::with([
            'kantor',
            'jabatan',
            'golongan',
        ]);

        if ($request->filled('jabatan')) {
            $query->where('id_jabatan', $request->jabatan);
        }

        if ($request->filled('golongan')) {
            $query->where('id_golongan', $request->golongan);
        }

        // Diubah dari paginate(5) menjadi paginate(10)
        $karyawans = $query
            ->orderBy('nama_karyawan')
            ->paginate(10)
            ->withQueryString();

        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        $golongans = Golongan::orderBy('min_bulan', 'asc')->get();
        $kantors = Kantor::orderBy('nama_kantor')->get();

        return view(
            'admin_pusat.pages.karyawan',
            compact('karyawans', 'jabatans', 'golongans', 'kantors')
        );
    }

    /**
     * Helper Private: Memastikan id_golongan di database selalu up-to-date dengan masa kerja bulan ini
     */
    private function sinkronisasiGolonganSemuaKaryawan(): void
    {
        $semuaGolongan = Golongan::orderBy('min_bulan', 'asc')->get();
        if ($semuaGolongan->isEmpty()) return;

        $karyawans = Karyawan::all();
        foreach ($karyawans as $k) {
            if ($k->tanggal_gabung) {
                $idGolonganBaru = $this->tentukanGolonganOtomatis($k->tanggal_gabung);
                if ($k->id_golongan != $idGolonganBaru) {
                    $k->update(['id_golongan' => $idGolonganBaru]);
                }
            }
        }
    }

    /**
     * Helper Private: Menentukan id_golongan otomatis berdasarkan lama bekerja (dalam BULAN)
     */
    private function tentukanGolonganOtomatis(string $tanggalGabung): int
    {
        $tanggalMasuk = Carbon::parse($tanggalGabung);
        $sekarang = Carbon::now();

        // Jika tanggal gabung di masa depan, set masa kerja = 0 bulan
        $lamaBekerjaBulan = $tanggalMasuk->isFuture() 
            ? 0 
            : $tanggalMasuk->diffInMonths($sekarang);

        // Cari golongan yang rentang min_bulan dan max_bulan-nya mencakup lamaBekerjaBulan
        $golongan = Golongan::where('min_bulan', '<=', $lamaBekerjaBulan)
            ->where('max_bulan', '>', $lamaBekerjaBulan)
            ->first();

        // Fallback jika masa kerja melebihi batas max_bulan tertinggi (ambil golongan paling senior)
        if (!$golongan) {
            $golongan = Golongan::where('min_bulan', '<=', $lamaBekerjaBulan)
                ->orderBy('min_bulan', 'desc')
                ->first();
        }

        // Fallback jika belum mencapai min_bulan terendah (ambil golongan paling awal)
        if (!$golongan) {
            $golongan = Golongan::orderBy('min_bulan', 'asc')->first();
        }

        if (!$golongan) {
            throw ValidationException::withMessages([
                'tanggal_gabung' => 'Data aturan golongan belum tersedia di database.',
            ]);
        }

        return $golongan->id_golongan;
    }

    /**
     * Helper Private: Generate NIK otomatis (Max 16 Karakter)
     */
    private function generateNikOtomatis(string $tanggalGabung, int $idKantor, int $idKaryawan): string
    {
        $tgl = Carbon::parse($tanggalGabung)->format('Ymd');
        $kantor = str_pad($idKantor, 4, '0', STR_PAD_LEFT);
        $karyawan = str_pad($idKaryawan, 4, '0', STR_PAD_LEFT);

        return $tgl . $kantor . $karyawan;
    }

    /**
     * Menyimpan karyawan baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_karyawan'   => ['required', 'string', 'max:30'],
            'id_kantor'       => ['required', 'exists:kantor,id_kantor'],
            'id_jabatan'      => ['required', 'exists:jabatan,id_jabatan'],
            'alamat_karyawan' => ['required', 'string', 'max:255'],
            'status_kerja'    => ['required', 'in:Kontrak,Tetap,Magang,Resign'],
            'no_wa_karyawan'  => ['required', 'string', 'max:13'],
            'status_menikah'  => ['required', 'in:Menikah,Belum_Menikah'],
            'jumlah_anak'     => ['required', 'integer', 'min:0'],
            'tanggal_gabung'  => ['required', 'date'],
            'password'        => ['required', 'string', 'min:6'],
        ]);

        $idGolonganOtomatis = $this->tentukanGolonganOtomatis($validated['tanggal_gabung']);

        DB::transaction(function () use ($validated, $idGolonganOtomatis) {

            $karyawan = Karyawan::create([
                'nama_karyawan'   => $validated['nama_karyawan'],
                'id_kantor'       => $validated['id_kantor'],
                'id_golongan'     => $idGolonganOtomatis,
                'id_jabatan'      => $validated['id_jabatan'],
                'NIK'             => 'TMP-' . rand(1000, 9999),
                'alamat_karyawan' => $validated['alamat_karyawan'],
                'status_kerja'    => $validated['status_kerja'],
                'no_wa_karyawan'  => $validated['no_wa_karyawan'],
                'status_menikah'  => $validated['status_menikah'],
                'jumlah_anak'     => $validated['jumlah_anak'],
                'tanggal_gabung'  => $validated['tanggal_gabung'],
            ]);

            $nikOtomatis = $this->generateNikOtomatis(
                $validated['tanggal_gabung'],
                (int) $validated['id_kantor'],
                (int) $karyawan->id_karyawan
            );

            $karyawan->update([
                'NIK' => $nikOtomatis,
            ]);

            User::create([
                'id_karyawan' => $karyawan->id_karyawan,
                'username'    => $nikOtomatis,
                'email'       => null,
                'password'    => Hash::make($validated['password']),
                'role'        => null,
            ]);
        });

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan dengan NIK dan Golongan otomatis.');
    }

    /**
     * Form edit
     */
    public function edit(Karyawan $karyawan)
    {
        $karyawan->load(['kantor', 'jabatan', 'golongan', 'user']);

        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        $golongans = Golongan::orderBy('nama_level')->get();
        $kantors = Kantor::orderBy('nama_kantor')->get();

        return view(
            'karyawan.edit',
            compact('karyawan', 'jabatans', 'golongans', 'kantors')
        );
    }

    /**
     * Update karyawan
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nama_karyawan'   => ['required', 'string', 'max:30'],
            'id_kantor'       => ['required', 'exists:kantor,id_kantor'],
            'id_jabatan'      => ['required', 'exists:jabatan,id_jabatan'],
            'alamat_karyawan' => ['required', 'string', 'max:255'],
            'status_kerja'    => ['required', 'in:Kontrak,Tetap,Magang,Resign'],
            'no_wa_karyawan'  => ['required', 'string', 'max:13'],
            'status_menikah'  => ['required', 'in:Menikah,Belum_Menikah'],
            'jumlah_anak'     => ['required', 'integer', 'min:0'],
            'tanggal_gabung'  => ['required', 'date'],
            'password'        => ['nullable', 'string', 'min:6'],
        ]);

        $idGolonganOtomatis = $this->tentukanGolonganOtomatis($validated['tanggal_gabung']);
        $nikOtomatis = $this->generateNikOtomatis(
            $validated['tanggal_gabung'],
            (int) $validated['id_kantor'],
            (int) $karyawan->id_karyawan
        );

        DB::transaction(function () use ($validated, $karyawan, $idGolonganOtomatis, $nikOtomatis) {

            $karyawan->update([
                'nama_karyawan'   => $validated['nama_karyawan'],
                'id_kantor'       => $validated['id_kantor'],
                'id_golongan'     => $idGolonganOtomatis,
                'id_jabatan'      => $validated['id_jabatan'],
                'NIK'             => $nikOtomatis,
                'alamat_karyawan' => $validated['alamat_karyawan'],
                'status_kerja'    => $validated['status_kerja'],
                'no_wa_karyawan'  => $validated['no_wa_karyawan'],
                'status_menikah'  => $validated['status_menikah'],
                'jumlah_anak'     => $validated['jumlah_anak'],
                'tanggal_gabung'  => $validated['tanggal_gabung'],
            ]);

            $user = User::where('id_karyawan', $karyawan->id_karyawan)->first();

            if (!$user) {
                $user = new User();
                $user->id_karyawan = $karyawan->id_karyawan;
            }

            $user->username = $nikOtomatis;

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();
        });

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Hapus karyawan
     */
    public function destroy(Karyawan $karyawan)
    {
        DB::transaction(function () use ($karyawan) {
            User::where('id_karyawan', $karyawan->id_karyawan)->delete();
            $karyawan->delete();
        });

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }
}