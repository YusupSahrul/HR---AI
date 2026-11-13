<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    protected $table = 'golongan';

    protected $primaryKey = 'id_golongan';

    protected $fillable = [
        'nama_level',
        'min_bulan',
        'max_bulan',
    ];

    public function karyawans()
    {
        return $this->hasMany(
            Karyawan::class,
            'id_histori'
        );
    }
}