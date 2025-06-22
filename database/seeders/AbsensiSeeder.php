<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $startDate = Carbon::create(2025, 5, 1);
        $karyawanIds = [1, 2, 3, 4];
        $shift = 'pagi';
        $jamMasuk = Carbon::createFromTime(7, 0); // 07:00
        $lokasiId = 1;

        // Tentukan hari-hari untuk keterlambatan
        $telatMap = [
            1 => [3, 15],           // karyawan 1 telat 2x, 5 menit
            2 => [10],              // karyawan 2 telat 1x, 10 menit
            3 => [5, 8, 20, 25],    // karyawan 3 telat 4x, 2 menit
            4 => []                 // tidak pernah telat
        ];

        $data = [];

        foreach ($karyawanIds as $karyawanId) {
            for ($i = 0; $i < 30; $i++) {
                $tanggal = $startDate->copy()->addDays($i);
                $hariKe = $i + 1;

                $telatHari = $telatMap[$karyawanId] ?? [];

                $status = 'tepat waktu';
                $jamAbsen = $jamMasuk->copy();
                $keterlambatan = null;

                if (in_array($hariKe, $telatHari)) {
                    $status = 'terlambat';
                    if ($karyawanId == 1) {
                        $jamAbsen->addMinutes(5);
                        $keterlambatan = 5;
                    } elseif ($karyawanId == 2) {
                        $jamAbsen->addMinutes(120);
                        $keterlambatan = 120; // 2 jam
                    } elseif ($karyawanId == 3) {
                        $jamAbsen->addMinutes(2);
                        $keterlambatan = 2;
                    }
                }

                $data[] = [
                    'karyawan_id'    => $karyawanId,
                    'jadwal_kerja_id' => null, // bisa disesuaikan jika ingin di-link
                    'izin_id'        => null,
                    'tanggal'        => $tanggal->toDateString(),
                    'shift'          => $shift,
                    'jam_absen'      => $jamAbsen->toTimeString(),
                    'status'         => $status,
                    'keterlambatan'  => $keterlambatan,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
        }

        DB::table('absensis')->insert($data);
    }
}
