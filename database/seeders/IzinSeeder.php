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
            'karyawan_id'=> 9,
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-01-15',
            'jenis_izin'=> 'cuti',
            'alasan' => 'Cuti Lahiran',
            'status' => 'disetujui',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
