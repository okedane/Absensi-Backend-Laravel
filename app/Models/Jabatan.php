<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_jabatan',
    ];
    protected $table = 'jabatans';
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
