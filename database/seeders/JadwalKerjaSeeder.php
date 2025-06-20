<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_kerjas')->insert([
            [
                "Karyawan_id"       => 2,
                "lokasi_id"         => 1,
                "tanggal"           => now()->toDateString(),
                "shift"             => "pagi",
                "jam_masuk"         => "11:15",
                "jam_keluar"        => "15:00"
            ]
        ]);
    }
}   
