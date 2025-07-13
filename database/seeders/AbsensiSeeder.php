<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\JadwalKerja;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        // Mapping keterlambatan per karyawan berdasarkan tanggal
        $keterlambatanHarian = [
            1 => [ //Amin
                '2025-01-05' => 40,
                '2025-01-12' => 45,
                '2025-01-20' => 40,
                '2025-01-03' => 20,


                '2025-02-04' => 20,
                '2025-02-06' => 20,
            ],
            2 => [ // Toni
                '2025-01-08' => 17,
                '2025-02-05' => 50,
                '2025-02-12' => 55,
                '2025-02-20' => 50,
            ],
            3 => [ // Rian
                '2025-01-08' => 10,


                '2025-02-01' => 5,
                '2025-02-20' => 15,
                '2025-02-21' => 3,
            ],

            4 => [ // Beni
                '2025-01-08' => 10,
                '2025-01-11' => 5,
                '2025-01-10' => 5,

                '2025-02-02' => 100,
                '2025-02-19' => 20,
            ],
            5 => [ // Fiyan
                '2025-01-08' => 10,

                '2025-02-05' => 50,
                '2025-02-10' => 55,
                '2025-02-20' => 50,
            ],
            6 => [ // Hamli
                '2025-01-08' => 10,
                '2025-01-09' => 30,
                '2025-01-10' => 40,
                

                '2025-02-05' => 50,
                '2025-02-10' => 55,
                '2025-02-20' => 50,
            ],
            7 => [ //iyat
                '2025-01-25' => 10,
            ],
            8 => [ // Noval
                '2025-01-30' => 20,

                '2025-02-04' => 15,
                '2025-02-12' => 30,
                '2025-02-15' => 100,
                '2025-02-21' => 20,
            ],



            // Ima
            9 => [
                '2025-01-30' => 20,

                '2025-02-06' => 30,
                '2025-02-14' => 30,
            ],
            11 => [ // sofi
                '2025-01-05' => 30,
                '2025-01-15' => 30,

                '2025-02-01' => 15,
                '2025-02-15' => 13,
            ],

            12 => [ //Arini
                '2025-01-04' => 15,
                '2025-01-12' => 30,
                '2025-01-15' => 100,
                '2025-01-21' => 20,
            ],
            13 => [ // fauziyah 
                '2025-01-01' => 15,
                '2025-01-10' => 13,

                '2025-01-01' => 15,
                '2025-01-10' => 13,

            ],
             

            15 => [ //heri
                '2025-01-02' => 40,
                '2025-01-10' => 45,
                '2025-01-18' => 45,
            ],

            16 => [ // Ayik
                '2025-01-01' => 02,
                '2025-01-02' => 15,

                '2025-02-01' => 02,
                '2025-02-02' => 15,
            ],

            17 => [ // Agus
                '2025-01-03' => 40,
                '2025-01-13' => 45,
                '2025-01-25' => 45,
            ], 
            18 => [ // Eko 30+5+15+12
                '2025-01-03' => 30,
                '2025-01-05' => 5,
                '2025-01-24' => 15,
                '2025-01-25' => 12,
            ], 
            19 => [ // Inong 
                '2025-01-03' => 16,
                '2025-01-04' => 16,

                '2025-02-03' => 16,
                '2025-02-04' => 16,
            ],
            20 => [  //Tari 3+12+2+16+20+11
                 '2025-01-01' => 3,
                 '2025-01-04' => 12,
                 '2025-01-11' => 2,
                 '2025-01-13' => 16,
                 '2025-01-15' => 20,
                 '2025-01-25' => 11,
            ],
            21  => [ // AnDI 
                //  '2025-01-09' => 3,
                //  '2025-01-14' => 12,
                //  '2025-01-18' => 2,
                //  '2025-01-19' => 16,
                //  '2025-01-20' => 20,
                //  '2025-01-25' => 11,
            ],
            22  => [ // yongki 
                
            ],
            23 => [ // damil

                '2025-01-14' => 12,
                '2025-01-16' => 12,

                '2025-02-14' => 12,
                '2025-02-16' => 12,

            ],
            24 => [ // Arik
                
                
            ],
             25 => [ //Fatima

                
            ],
            26 => [ // irwan

            ],

            27 => [ // Diyen

            ]

            




            // Tambahkan karyawan dan tanggal keterlambatan lainnya...
        ];

        // Ambil seluruh jadwal kerja di tahun 2025 bulan 1 dan 2
        $jadwals = JadwalKerja::whereYear('tanggal', 2025)
            ->whereIn(DB::raw('MONTH(tanggal)'), [1, 2])
            ->get()
            ->groupBy('karyawan_id');

        foreach ($jadwals as $karyawanId => $listJadwal) {
            foreach ($listJadwal as $jadwal) {
                $tanggal = $jadwal->tanggal;
                $jamMasuk = Carbon::parse($jadwal->jam_masuk);

                // Ambil delay jika ada di mapping keterlambatan
                $delay = $keterlambatanHarian[$karyawanId][$tanggal] ?? null;

                if ($delay) {
                    $jamAbsen = $jamMasuk->copy()->addMinutes($delay);
                    $status = 'terlambat';
                    $keterlambatan = $delay;
                } else {
                    $jamAbsen = $jamMasuk;
                    $status = 'tepat waktu';
                    $keterlambatan = null;
                }

                $data[] = [
                    'karyawan_id' => $karyawanId,
                    'jadwal_kerja_id' => $jadwal->id,
                    'izin_id' => null,
                    'tanggal' => $tanggal,
                    'shift' => $jadwal->shift,
                    'jam_absen' => $jamAbsen->format('H:i:s'),
                    'status' => $status,
                    'keterlambatan' => $keterlambatan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Masukkan data absensi
        Absensi::insert($data);
    }
}
