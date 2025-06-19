<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IzinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('izins')->insert([
            'karyawan_id'=> 1,
            'tanggal_mulai' => '2025-11-01',
            'tanggal_selesai' => '2025-12-01',
            'jenis_izin'=> 'sakit',
            'alasan' => 'Saya sakit tenggorokan',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
