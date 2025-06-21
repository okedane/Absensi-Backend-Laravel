<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $karyawanIds = [1, 2, 3, 4]; // ID dari user_id di seeder karyawan
        $shift = 'pagi';
        $jamMasuk = '07:00';
        $jamKeluar = '15:00';
        $lokasiId = 1;

        $jadwalData = [];
        $startDate = Carbon::create(2025, 5, 1);

        foreach ($karyawanIds as $karyawanId) {
            for ($i = 0; $i < 31; $i++) {
                $jadwalData[] = [
                    'karyawan_id' => $karyawanId,
                    'lokasi_id' => $lokasiId,
                    'tanggal' => $startDate->copy()->addDays($i)->toDateString(),
                    'shift' => $shift,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('jadwal_kerjas')->insert($jadwalData);
    }
}
