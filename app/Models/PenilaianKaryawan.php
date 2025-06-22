<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKaryawan extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_id', 'kriteria_id', 'bulan', 'tahun', 'nilai'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
