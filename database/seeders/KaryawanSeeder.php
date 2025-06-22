<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\lokasiAbsensi;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawans')->insert([
            [
                'nomor_karyawan' => 'KRY001',
                'tanggal_masuk' => '2024-01-10',
                'user_id' => 1,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY002',
                'tanggal_masuk' => '2024-02-15',
                'user_id' => 2,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY003',
                'tanggal_masuk' => '2024-03-20',
                'user_id' => 3,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY004',
                'tanggal_masuk' => '2024-03-20',
                'user_id' => 4,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
