<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_karyawan',
        'user_id',
        'jabatan_id',
    ];
    protected $table = 'karyawans';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'karyawan_id');
    }

    public function lemburs()
    {
        return $this->hasMany(Lembur::class, 'karyawan_id');
    }

    public function izins()
    {
        return $this->hasMany(Izin::class, 'karyawan_id');
    }
    public function jadwalKerjas()
    {
        return $this->hasMany(JadwalKerja::class, 'karyawan_id');
    }
    public function lokasiAbsensis()
    {
        return $this->hasManyThrough(
            LokasiAbsensi::class,
            JadwalKerja::class,
            'karyawan_id',
            'id',
            'id',
            'lokasi_id'
        );
    }

     public function penilaians()
    {
        return $this->hasMany(PenilaianKaryawan::class);
    }

}
