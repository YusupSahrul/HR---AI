@extends('admin_pusat.layouts.app')

@section('content')
@vite('resources/css/karyawan_admin_pusat.css')
<div class="karyawan-page">

    {{-- ALERT SUCCESS --}}

    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ALERT ERROR --}}

    @if($errors->any())

        <div class="alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         DAFTAR KARYAWAN
    ====================================================== --}}

    <div class="karyawan-card">

        <div class="green-header">

            <h2>
                Daftar Karyawan
            </h2>


            <form
                action="{{ route('karyawan.index') }}"
                method="GET"
                class="filter-area"
            >

                {{-- FILTER JABATAN --}}

                <select
                    name="jabatan"
                    onchange="this.form.submit()"
                >

                    <option value="">
                        Semua Jabatan
                    </option>

                    @foreach($jabatans as $jabatan)

                        <option
                            value="{{ $jabatan->id_jabatan }}"
                            {{ request('jabatan') == $jabatan->id_jabatan ? 'selected' : '' }}
                        >
                            {{ $jabatan->nama_jabatan }}
                        </option>

                    @endforeach

                </select>


                {{-- FILTER LEVEL / GOLONGAN --}}

                <select
                    name="golongan"
                    onchange="this.form.submit()"
                >

                    <option value="">
                        Semua Golongan
                    </option>

                    @foreach($golongans as $golongan)

                        <option
                            value="{{ $golongan->id_golongan }}"
                            {{ request('golongan') == $golongan->id_golongan ? 'selected' : '' }}
                        >
                            {{ $golongan->nama_level }}
                        </option>

                    @endforeach

                </select>

            </form>

        </div>


        {{-- TABLE --}}

        <div class="table-wrapper">

            <table class="employee-table">

                <thead>

                    <tr>

                        <th>
                            Nama Karyawan
                        </th>

                        <th>
                            Alamat Karyawan
                        </th>

                        <th>
                            Status Pernikahan
                        </th>

                        <th>
                            Tanggal Gabung
                        </th>

                        <th>
                            Jumlah Anak
                        </th>

                        <th>
                            Jabatan
                        </th>

                        <th>
                            Golongan
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($karyawans as $karyawan)

                        <tr>

                            {{-- NAMA --}}

                            <td>

                                <a
                                    href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}"
                                    class="employee-name"
                                >

                                    {{ $karyawan->nama_karyawan }}

                                </a>

                                <span class="employee-id">

                                    NIK:
                                    {{ $karyawan->NIK }}

                                </span>

                            </td>


                            {{-- ALAMAT --}}

                            <td>

                                {{ $karyawan->alamat_karyawan }}

                            </td>


                            {{-- STATUS --}}

                            <td>

                                {{ str_replace(
                                    '_',
                                    ' ',
                                    $karyawan->status_menikah
                                ) }}

                            </td>


                            {{-- TANGGAL --}}

                            <td>

                                {{ $karyawan->tanggal_gabung
                                    ->format('d-m-Y') }}

                            </td>


                            {{-- ANAK --}}

                            <td>

                                {{ $karyawan->jumlah_anak }}

                            </td>


                            {{-- JABATAN --}}

                            <td>

                                {{ $karyawan->jabatan->nama_jabatan
                                    ?? '-' }}

                            </td>


                            {{-- GOLONGAN --}}

                            <td>

                                {{ $karyawan->golongan->nama_level
                                    ?? '-' }}

                            </td>


                            {{-- ACTION --}}

                            <td>

                                <div class="action">

                                    <a
                                        href="{{ route(
                                            'karyawan.edit',
                                            $karyawan->id_karyawan
                                        ) }}"
                                        class="btn-edit"
                                    >
                                        Edit
                                    </a>


                                    <form
                                        action="{{ route(
                                            'karyawan.destroy',
                                            $karyawan->id_karyawan
                                        ) }}"
                                        method="POST"
                                        onsubmit="
                                            return confirm(
                                                'Yakin ingin menghapus karyawan ini?'
                                            )
                                        "
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-delete"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                style="text-align:center;"
                            >

                                Belum ada data karyawan.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($karyawans->hasPages())
            <div class="pagination-area" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding: 10px 0;">
                
                {{-- Info Halaman --}}
                <div style="font-size: 14px; color: #555;">
                    Menampilkan {{ $karyawans->firstItem() }} - {{ $karyawans->lastItem() }} dari {{ $karyawans->total() }} karyawan
                </div>

                {{-- Tombol Navigasi --}}
                <div style="display: flex; gap: 10px;">
                    {{-- Tombol Sebelumnya --}}
                    @if ($karyawans->onFirstPage())
                        <span class="btn-disabled" style="padding: 8px 16px; background: #e0e0e0; color: #888; border-radius: 6px; cursor: not-allowed; font-size: 14px;">
                            &laquo; Sebelumnya
                        </span>
                    @else
                        <a href="{{ $karyawans->previousPageUrl() }}" class="btn-save" style="padding: 8px 16px; text-decoration: none; border-radius: 6px; font-size: 14px;">
                            &laquo; Sebelumnya
                        </a>
                    @endif

                    {{-- Tombol Berikutnya --}}
                    @if ($karyawans->hasMorePages())
                        <a href="{{ $karyawans->nextPageUrl() }}" class="btn-save" style="padding: 8px 16px; text-decoration: none; border-radius: 6px; font-size: 14px;">
                            Berikutnya &raquo;
                        </a>
                    @else
                        <span class="btn-disabled" style="padding: 8px 16px; background: #e0e0e0; color: #888; border-radius: 6px; cursor: not-allowed; font-size: 14px;">
                            Berikutnya &raquo;
                        </span>
                    @endif
                </div>

            </div>
        @endif

    </div>


    {{-- =====================================================
         TAMBAH KARYAWAN
    ====================================================== --}}

    <div class="karyawan-card">

        <div class="form-header">

            <h2>
                Tambah Karyawan Baru
            </h2>

        </div>


        <div class="form-body">

            <form
                action="{{ route('karyawan.store') }}"
                method="POST"
            >

                @csrf


                <div class="form-grid">


                    {{-- NAMA --}}

                    <div class="form-group">

                        <label>
                            Nama Karyawan
                        </label>

                        <input
                            type="text"
                            name="nama_karyawan"
                            class="form-control"
                            value="{{ old('nama_karyawan') }}"
                            required
                        >

                    </div>


                    {{-- TANGGAL GABUNG --}}

                    <div class="form-group">

                        <label>
                            Tanggal Gabung
                        </label>

                        <input
                            type="date"
                            name="tanggal_gabung"
                            class="form-control"
                            value="{{ old('tanggal_gabung') }}"
                            required
                        >

                    </div>

                    {{-- PENEMPATAN --}}

                    <div class="form-group">

                        <label>
                            Penempatan Tugas
                        </label>

                        <select
                            name="id_kantor"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Pilih Kantor
                            </option>

                            @foreach($kantors as $kantor)

                                <option
                                    value="{{ $kantor->id_kantor }}"
                                    {{ old('id_kantor') == $kantor->id_kantor ? 'selected' : '' }}
                                >

                                    {{ $kantor->nama_kantor }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- JABATAN --}}

                    <div class="form-group">

                        <label>
                            Jabatan Karyawan
                        </label>

                        <select
                            name="id_jabatan"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Pilih Jabatan
                            </option>

                            @foreach($jabatans as $jabatan)

                                <option
                                    value="{{ $jabatan->id_jabatan }}"
                                    {{ old('id_jabatan') == $jabatan->id_jabatan ? 'selected' : '' }}
                                >

                                    {{ $jabatan->nama_jabatan }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- STATUS PERNIKAHAN --}}

                    <div class="form-group">

                        <label>
                            Status Pernikahan
                        </label>

                        <select
                            name="status_menikah"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Pilih Status
                            </option>

                            <option
                                value="Belum_Menikah"
                                {{ old('status_menikah') == 'Belum_Menikah' ? 'selected' : '' }}
                            >
                                Belum Menikah
                            </option>

                            <option
                                value="Menikah"
                                {{ old('status_menikah') == 'Menikah' ? 'selected' : '' }}
                            >
                                Menikah
                            </option>

                        </select>

                    </div>


                    {{-- JUMLAH ANAK --}}

                    <div class="form-group">

                        <label>
                            Jumlah Anak
                        </label>

                        <input
                            type="number"
                            name="jumlah_anak"
                            class="form-control"
                            min="0"
                            value="{{ old('jumlah_anak', 0) }}"
                            required
                        >

                    </div>


                    {{-- PASSWORD --}}

                    <div class="form-group">

                        <label>
                            Password Akun
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required
                        >

                    </div>


                    {{-- STATUS KERJA --}}

                    <div class="form-group">

                        <label>
                            Status Kerja
                        </label>

                        <select
                            name="status_kerja"
                            class="form-control"
                            required
                        >

                            <option value="">
                                Pilih Status
                            </option>

                            <option value="Tetap">
                                Tetap
                            </option>

                            <option value="Kontrak">
                                Kontrak
                            </option>

                            <option value="Magang">
                                Magang
                            </option>

                            <option value="Resign">
                                Resign
                            </option>

                        </select>

                    </div>


                    {{-- NOMOR WA --}}

                    <div class="form-group">

                        <label>
                            No. WhatsApp
                        </label>

                        <input
                            type="text"
                            name="no_wa_karyawan"
                            class="form-control"
                            value="{{ old('no_wa_karyawan') }}"
                            maxlength="13"
                            required
                        >

                    </div>

                    {{-- ALAMAT --}}

                    <div class="form-group">

                        <label>
                            Alamat Karyawan
                        </label>

                        <textarea
                            name="alamat_karyawan"
                            class="form-control"
                            required
                        >{{ old('alamat_karyawan') }}</textarea>

                    </div>

                </div>


                <div class="button-area">

                    <button
                        type="submit"
                        class="btn-save"
                    >
                        Simpan
                    </button>

                    <button
                        type="reset"
                        class="btn-cancel"
                    >
                        Batal
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
@endsection