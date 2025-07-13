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
            // Koki
            [
                'nomor_karyawan' => 'KRY001',
                'user_id' => 1,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY002',
                'user_id' => 2,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY003',
                'user_id' => 3,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY004',
                'user_id' => 4,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY005',
                'user_id' => 5,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY006',
                'user_id' => 6,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY007',
                'user_id' => 7,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY008',
                'user_id' => 8,
                'jabatan_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Administrasi
            [
                'nomor_karyawan' => 'KRY009',
                'user_id' => 9,
                'jabatan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY010',
                'user_id' => 10,
                'jabatan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY011',
                'user_id' => 11,
                'jabatan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY012',
                'user_id' => 12,
                'jabatan_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Waiters
            [
                'nomor_karyawan' => 'KRY013',
                'user_id' => 13,
                'jabatan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY014',
                'user_id' => 14,
                'jabatan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY015',
                'user_id' => 15,
                'jabatan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY016',
                'user_id' => 16,
                'jabatan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY017',
                'user_id' => 17,
                'jabatan_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Barista
            [
                'nomor_karyawan' => 'KRY018',
                'user_id' => 18,
                'jabatan_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY019',
                'user_id' => 19,
                'jabatan_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY020',
                'user_id' => 20,
                'jabatan_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY021',
                'user_id' => 21,
                'jabatan_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Security
            [
                'nomor_karyawan' => 'KRY022',
                'user_id' => 22,
                'jabatan_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY023',
                'user_id' => 23,
                'jabatan_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY024',
                'user_id' => 24,
                'jabatan_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kurir
            [
                'nomor_karyawan' => 'KRY025',
                'user_id' => 25,
                'jabatan_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY026',
                'user_id' => 26,
                'jabatan_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_karyawan' => 'KRY027',
                'user_id' => 27,
                'jabatan_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
