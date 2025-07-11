<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_izin',
        'alasan',
        'status',
        'dokumen',
    ];
    protected $table = 'izins';
    protected $primaryKey = 'id';
    
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function absensi()
    {
        return $this->hasOne(Absensi::class, 'izin_id');
    }
}
