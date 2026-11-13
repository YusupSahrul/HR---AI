<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $primaryKey = 'id_jabatan';

    protected $fillable = [
        'id_histori',
        'nama_jabatan',
        'kategori_penilaian',
        'nominal_tunjangan',
    ];

    public function karyawans()
    {
        return $this->hasMany(
            Karyawan::class,
            'id_jabatan',
            'id_jabatan'
        );
    }
}