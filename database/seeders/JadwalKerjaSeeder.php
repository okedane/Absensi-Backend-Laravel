<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalKerja;

class JadwalKerjaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $shiftOptions = ['pagi', 'malam'];
        $shiftIndex = 0;

        // (Cheft)

        //Amin
        $liburAmin = [2, 9, 16, 23, 30]; // Hari liburAmin (tanggal)

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburAmin)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 1,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Toni
        $liburToni = [6, 24, 29];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburToni)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 2,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Rian
        $liburRian = [7, 14];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburRian)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 3,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Beni
        $liburBeni = [2, 9, 19, 28];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburBeni)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 4,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Fiyan
        $liburFiyan = [7, 14, 21, 28];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburFiyan)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 5,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Hamli
        $liburHamli = [1, 8, 15, 22, 29];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburHamli)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 6,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //iyat
        $liburIyat = [1, 8, 15, 22];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburIyat)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 7,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //noval 
        $liburNoval = [6, 13, 21, 27];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburNoval)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 8,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }
        // Administrasi
        // Ima
        $liburIma = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15, 21, 28];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburIma)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 9,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //rosy
        for ($day = 1; $day <= 31; $day++) {
            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 10,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //sofi
        $liburSofi = [6, 13, 27];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburSofi)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 11,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Arini
        $liburArini = [1, 9, 16, 23, 30];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburArini)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 12,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Fauzi
        $liburFauzi = [2, 9, 17, 24];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburFauzi)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 13,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        // Irul
        $liburIrul = [3, 12, 23, 30];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburIrul)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 14,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Heri
        $liburHeri = [6, 13, 20, 27];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburHeri)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 15,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Ayik
        $liburAyik = [7, 14, 21, 28];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburAyik)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 16,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }
        //Agus
        $liburAgus = [1, 8, 15, 22, 29];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburAgus)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 17,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        // Eko
        $liburEko = [2, 9, 16, 23, 30];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburEko)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 18,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //inong
        $liburInong = [6, 13, 20, 27];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburInong)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 19,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        // Tari
        $liburtari = [7, 14, 21, 28];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburtari)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 20,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Andi 
        $liburAndi = [1, 8, 15, 22, 29];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburAndi)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 21,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Security

        //Yongki
        $liburYongki = [6, 17, 24, 31];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburYongki)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 22,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        // danil
        $liburDanil = [1, 8, 15, 22, 29];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburDanil)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 23,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Arik
        $liburArik = [10, 13, 20, 27];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburArik)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 24,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Fatimah
        $liburFatimah = [2, 9, 16, 23, 30];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburFatimah)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 25,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        //Irwan
        $liburIrwan = [2, 9, 16, 23, 30];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburIrwan)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 26,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }


        //Diyen
        $liburDiyen = [6, 13, 20, 27];

        for ($day = 1; $day <= 31; $day++) {
            if (in_array($day, $liburDiyen)) {
                continue;
            }

            $tanggal = sprintf('2025-01-%02d', $day);
            $shift = $shiftOptions[$shiftIndex % 2];

            $data[] = [
                'karyawan_id' => 27,
                'lokasi_id' => 1,
                'tanggal' => $tanggal,
                'shift' => $shift,
                'jam_masuk' => $shift == 'pagi' ? '07:00:00' : '15:00:00',
                'jam_keluar' => $shift == 'pagi' ? '15:00:00' : '23:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $shiftIndex++;
        }

        JadwalKerja::insert($data);
    }
}
