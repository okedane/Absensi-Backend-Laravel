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
            'tanggal_masuk' => '2024-01-10',
            'user_id' => 1,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY002',
            'tanggal_masuk' => '2024-01-11',
            'user_id' => 2,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY003',
            'tanggal_masuk' => '2024-01-12',
            'user_id' => 3,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY004',
            'tanggal_masuk' => '2024-01-13',
            'user_id' => 4,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY005',
            'tanggal_masuk' => '2024-01-14',
            'user_id' => 5,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY006',
            'tanggal_masuk' => '2024-01-15',
            'user_id' => 6,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY007',
            'tanggal_masuk' => '2024-01-16',
            'user_id' => 7,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY008',
            'tanggal_masuk' => '2024-01-17',
            'user_id' => 8,
            'jabatan_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ],

            // Administrasi
            [
            'nomor_karyawan' => 'KRY009',
            'tanggal_masuk' => '2024-02-01',
            'user_id' => 9,
            'jabatan_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY010',
            'tanggal_masuk' => '2024-02-02',
            'user_id' => 10,
            'jabatan_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY011',
            'tanggal_masuk' => '2024-02-03',
            'user_id' => 11,
            'jabatan_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY012',
            'tanggal_masuk' => '2024-02-04',
            'user_id' => 12,
            'jabatan_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            ],

            // Waiters
            [
            'nomor_karyawan' => 'KRY013',
            'tanggal_masuk' => '2024-03-01',
            'user_id' => 13,
            'jabatan_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY014',
            'tanggal_masuk' => '2024-03-02',
            'user_id' => 14,
            'jabatan_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY015',
            'tanggal_masuk' => '2024-03-03',
            'user_id' => 15,
            'jabatan_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY016',
            'tanggal_masuk' => '2024-03-04',
            'user_id' => 16,
            'jabatan_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY017',
            'tanggal_masuk' => '2024-03-05',
            'user_id' => 17,
            'jabatan_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
            ],

            // Barista
            [
            'nomor_karyawan' => 'KRY018',
            'tanggal_masuk' => '2024-04-01',
            'user_id' => 18,
            'jabatan_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY019',
            'tanggal_masuk' => '2024-04-02',
            'user_id' => 19,
            'jabatan_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY020',
            'tanggal_masuk' => '2024-04-03',
            'user_id' => 20,
            'jabatan_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY021',
            'tanggal_masuk' => '2024-04-04',
            'user_id' => 21,
            'jabatan_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
            ],

            // Security
            [
            'nomor_karyawan' => 'KRY022',
            'tanggal_masuk' => '2024-05-01',
            'user_id' => 22,
            'jabatan_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY023',
            'tanggal_masuk' => '2024-05-02',
            'user_id' => 23,
            'jabatan_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY024',
            'tanggal_masuk' => '2024-05-03',
            'user_id' => 24,
            'jabatan_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
            ],

            // Kurir
            [
            'nomor_karyawan' => 'KRY025',
            'tanggal_masuk' => '2024-06-01',
            'user_id' => 25,
            'jabatan_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY026',
            'tanggal_masuk' => '2024-06-02',
            'user_id' => 26,
            'jabatan_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'nomor_karyawan' => 'KRY027',
            'tanggal_masuk' => '2024-06-03',
            'user_id' => 27,
            'jabatan_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
            ],

            // Admin
            // [
            // 'nomor_karyawan' => 'KRY028',
            // 'tanggal_masuk' => '2024-07-01',
            // 'user_id' => 28,
            // 'jabatan_id' => 7,
            // 'created_at' => now(),
            // 'updated_at' => now(),
            // ],
        ]);
        
    }
}
