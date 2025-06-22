<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelanggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggarans')->insert([
            [
                'karyawan_id' => 3,
                'tanggal' => '2025-05-02',
                'jenis_pelanggaran' => 'Terlambat',
                'sanksi' => 'Peringatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 3,
                'tanggal' => '2025-06-02',
                'jenis_pelanggaran' => 'Terlambat',
                'sanksi' => 'Peringatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 4,
                'tanggal' => '2025-07-01',
                'jenis_pelanggaran' => 'Tidak Masuk',
                'sanksi' => 'Teguran',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 5,
                'tanggal' => '2025-07-02',
                'jenis_pelanggaran' => 'Terlambat',
                'sanksi' => 'Peringatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data pelanggaran lainnya sesuai kebutuhan
        ]);
    }
}
