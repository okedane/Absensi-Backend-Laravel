<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['kode', 'nama', 'sifat', 'bobot'];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function penilaianKaryawans()
    {
        return $this->hasMany(PenilaianKaryawan::class);
    }
}
