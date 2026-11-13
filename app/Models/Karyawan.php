<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Karyawan extends Model
{
    protected $table = 'karyawan';

    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'nama_karyawan',
        'id_kantor',
        'id_golongan',
        'id_jabatan',
        'NIK',
        'alamat_karyawan',
        'status_kerja',
        'no_wa_karyawan',
        'status_menikah',
        'jumlah_anak',
        'tanggal_gabung',
        'vektor_wajah',
        'foto_ref_wajah',
    ];

    protected $casts = [
        'tanggal_gabung' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Kantor
    |--------------------------------------------------------------------------
    */

    public function kantor(): BelongsTo
    {
        return $this->belongsTo(
            Kantor::class,
            'id_kantor',
            'id_kantor'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Jabatan
    |--------------------------------------------------------------------------
    */

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(
            Jabatan::class,
            'id_jabatan',
            'id_jabatan'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke Golongan Karyawan
    |--------------------------------------------------------------------------
    */

    public function Golongan(): BelongsTo
    {
        return $this->belongsTo(
            Golongan::class,
            'id_golongan',
            'id_golongan'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi ke User
    |--------------------------------------------------------------------------
    */

    public function user(): HasOne
    {
        return $this->hasOne(
            User::class,
            'id_karyawan',
            'id_karyawan'
        );
    }
}