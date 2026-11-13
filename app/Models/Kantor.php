<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    protected $table = 'kantor';

    protected $primaryKey = 'id_kantor';

    protected $fillable = [
        'nama_kantor',
        'tipe_kantor',
        'id_perusahaan',
        'id_lokasi',
        'status_aktif',
        'no_telp_kantor',
        'zona_waktu',
        'alamat_kantor',
    ];

    public function karyawans()
    {
        return $this->hasMany(
            Karyawan::class,
            'id_kantor',
            'id_kantor'
        );
    }
}