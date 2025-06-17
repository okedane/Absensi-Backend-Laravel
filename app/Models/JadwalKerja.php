<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKerja extends Model
{
    use HasFactory;
    protected $fillable = [
        'hari',
        'jam_masuk',
        'jam_keluar',
        'karyawan_id',
        'lokasi_id',
        'shift'
    ];
    protected $table = 'jadwal_kerjas';
    protected $primaryKey = 'id';

    public function karyawan() {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function lokasi() {
        return $this->belongsTo(LokasiAbsensi::class, 'lokasi_id');
    }
}
