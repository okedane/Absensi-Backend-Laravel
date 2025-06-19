<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'karyawan_id',
        'jadwal_kerja_id',
        'tanggal',
        'shift',
        'jam_absen',
        'status',
        'keterlambatan',
        'izin_id',
    ];
    protected $table = 'absensis';
    protected $primaryKey = 'id';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
    public function lokasiAbsensi()
    {
        return $this->belongsTo(LokasiAbsensi::class, 'lokasi_absensi_id');
    }
    public function jadwalKerja()
    {
        return $this->belongsTo(JadwalKerja::class, 'jadwal_kerja_id');
    }
     public function izin()
    {
        return $this->belongsTo(Izin::class, 'izin_id');
    }
}
