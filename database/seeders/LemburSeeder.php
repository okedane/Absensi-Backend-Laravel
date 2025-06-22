<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LemburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lemburs')->insert([
            [
                'karyawan_id' => 1,
                'tanggal' => '2025-05-01',
                'jam_mulai' => '17:00:00',
                'jam_selesai' => '19:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 2,
                'tanggal' => '2025-05-02',
                'jam_mulai' => '00:00:00',
                'jam_selesai' => '10:00:00',
                'total_jam' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 3,
                'tanggal' => '2025-05-02',
                'jam_mulai' => '00:00:00',
                'jam_selesai' => '05:00:00',
                'total_jam' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'karyawan_id' => 3,
                'tanggal' => '2025-05-03',
                'jam_mulai' => '00:00:00',
                'jam_selesai' => '01:00:00',
                'total_jam' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Tambahkan data lembur lainnya sesuai kebutuhan
        ]);
    }
}
