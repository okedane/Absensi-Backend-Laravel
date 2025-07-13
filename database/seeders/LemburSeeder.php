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
            // Cheft Januari
            // Amin 
            [
                'karyawan_id' => 1,
                'tanggal' => '2025-03-01',
                'jam_mulai' => '21:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 1,
                'tanggal' => '2025-01-07',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 1,
                'tanggal' => '2025-01-14',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 1,
                'tanggal' => '2025-01-20',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '15:00:00',
                'total_jam' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 1,
                'tanggal' => '2025-05-23',
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '10:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 1,
                'tanggal' => '2025-01-30',
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '13:00:00',
                'total_jam' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'karyawan_id' => 1,
                'tanggal' => '2025-02-01',
                'jam_mulai' => '15:00:00',
                'jam_selesai' => '17:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
             [
                'karyawan_id' => 1,
                'tanggal' => '2025-02-04',
                'jam_mulai' => '05:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //Toni
            [
                'karyawan_id' => 2,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '21:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 2,
                'tanggal' => '2025-02-07',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 2,
                'tanggal' => '2025-02-07',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 2,
                'tanggal' => '2025-02-20',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 2,
                'tanggal' => '2025-02-23',
                'jam_mulai' => '05:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 2,
                'tanggal' => '2025-02-28',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],



            //Rian
            [
                'karyawan_id' => 3,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '23:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'karyawan_id' => 3,
                'tanggal' => '2025-02-20',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 3,
                'tanggal' => '2025-02-20',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ---------------------------------------
            //Beni
            [
                'karyawan_id' => 4,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '23:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 4,
                'tanggal' => '2025-01-14',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'karyawan_id' => 4,
                'tanggal' => '2025-02-07',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 4,
                'tanggal' => '2025-02-07',
                'jam_mulai' => '05:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 4,
                'tanggal' => '2025-02-07',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 4,
                'tanggal' => '2025-02-07',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            

            // -----------------------------------
            // Fiyanan
            [
                'karyawan_id' => 5,
                'tanggal' => '2025-01-18',
                'jam_mulai' => '05:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //  [
            //     'karyawan_id' => 5,
            //     'tanggal' => '2025-01-19',
            //     'jam_mulai' => '05:00:00',
            //     'jam_selesai' => '07:00:00',
            //     'total_jam' => 3,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],

             [
                'karyawan_id' => 5,
                'tanggal' => '2025-02-11',
                'jam_mulai' => '03:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            

            // Handi
            [
                'karyawan_id' => 6,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '23:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'karyawan_id' => 6,
                'tanggal' => '2025-01-07',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 6,
                'tanggal' => '2025-01-14',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 6,
                'tanggal' => '2025-02-04',
                'jam_mulai' => '05:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 6,
                'tanggal' => '2025-02-11',
                'jam_mulai' => '03:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 6,
                'tanggal' => '2025-02-03',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // --------------------------------------

            // Iyath
            [
                'karyawan_id' => 7,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 7,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '05:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // --------------------------------------------------
            // Noval
            //  [
            //     'karyawan_id' => 8,
            //     'tanggal' => '2025-01-03',
            //     'jam_mulai' => '23:00:00',
            //     'jam_selesai' => '00:00:00',
            //     'total_jam' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],

            // [
            //     'karyawan_id' => 8,
            //     'tanggal' => '2025-01-07',
            //     'jam_mulai' => '04:00:00',
            //     'jam_selesai' => '07:00:00',
            //     'total_jam' => 3,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'karyawan_id' => 8,
            //     'tanggal' => '2025-01-14',
            //     'jam_mulai' => '04:00:00',
            //     'jam_selesai' => '07:00:00',
            //     'total_jam' => 3,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],

            
            //  [
            //     'karyawan_id' => 8,
            //     'tanggal' => '2025-02-03',
            //     'jam_mulai' => '06:00:00',
            //     'jam_selesai' => '07:00:00',
            //     'total_jam' => 1,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'karyawan_id' => 8,
            //     'tanggal' => '2025-02-11',
            //     'jam_mulai' => '03:00:00',
            //     'jam_selesai' => '07:00:00',
            //     'total_jam' => 5,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'karyawan_id' => 8,
                'tanggal' => '2025-02-16',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 8,
                'tanggal' => '2025-02-21',
                'jam_mulai' => '04:00:00',
                'jam_selesai' => '07:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            // -------------------------------------

            // -----------------------------------

             [ //10 Rossy
                'karyawan_id' => 10,
                'tanggal' => '2025-02-21',
                'jam_mulai' => '01:00:00',
                'jam_selesai' => '11:00:00',
                'total_jam' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ], 

            //Adminstrasi
            [
                'karyawan_id' => 10,
                'tanggal' => '2025-01-02',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '21:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 10,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '23:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 10,
                'tanggal' => '2025-01-10',
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '15:00:00',
                'total_jam' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //Arini
            [
                'karyawan_id' => 12,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // //19 Inong
            // [
            //     'karyawan_id' => 19,
            //     'tanggal' => '2025-01-03',
            //     'jam_mulai' => '23:00:00',
            //     'jam_selesai' => '00:00:00',
            //     'total_jam' => 3,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],

            // [ // Eko 18
            //     'karyawan_id' => 18,
            //     'tanggal' => '2025-01-03',
            //     'jam_mulai' => '09:00:00',
            //     'jam_selesai' => '14:00:00',
            //     'total_jam' => 6,
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],


            //22  yongki
            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-01',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-01',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-08',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-10',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-13',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-15',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-20',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 22,
                'tanggal' => '2025-01-22',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

             [
                'karyawan_id' => 22,
                'tanggal' => '2025-02-22',
                'jam_mulai' => '01:00:00',
                'jam_selesai' => '12:00:00',
                'total_jam' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // daniel
            [
                'karyawan_id' => 23,
                'tanggal' => '2025-01-01',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 23,
                'tanggal' => '2025-01-03',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 23,
                'tanggal' => '2025-01-08',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            [
                'karyawan_id' => 23,
                'tanggal' => '2025-01-16',
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '12:00:00',
                'total_jam' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'karyawan_id' => 23,
                'tanggal' => '2025-02-08',
                'jam_mulai' => '01:00:00',
                'jam_selesai' => '12:00:00',
                'total_jam' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Arik
            [
                'karyawan_id' => 24,
                'tanggal' => '2025-01-01',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 24,
                'tanggal' => '2025-01-01',
                'jam_mulai' => '22:00:00',
                'jam_selesai' => '00:00:00',
                'total_jam' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 24,
                'tanggal' => '2025-01-08',
                'jam_mulai' => '19:00:00',
                'jam_selesai' => '22:00:00',
                'total_jam' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'karyawan_id' => 24,
                'tanggal' => '2025-02-08',
                'jam_mulai' => '01:00:00',
                'jam_selesai' => '12:00:00',
                'total_jam' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // Tambahkan data lembur lainnya sesuai kebutuhan
        ]);
    }
}
