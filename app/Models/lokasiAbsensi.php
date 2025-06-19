<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiAbsensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lokasi',
        'latitude',
        'longitude',
        'radius_meter',
    ];
    protected $table = 'lokasi_absensis';
    protected $primaryKey = 'id';

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'lokasi_absensi_id');
    }
    public function jadwalKerjas()
    {
        return $this->hasMany(JadwalKerja::class, 'lokasi_id');
    }
}
