<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

     protected $table = 'lemburs';

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'total_jam'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    

    
}
