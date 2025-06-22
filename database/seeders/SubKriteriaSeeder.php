<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_kriterias')->insert([
            ['kriteria_id' => 1, 'nama' => 'Buruk',  'bobot' => 1, 'min_value' => 0, 'max_value' => 1],
            ['kriteria_id' => 1, 'nama' => 'Cukup', 'bobot' => 2, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 1, 'nama' => 'Baik', 'bobot' => 3, 'min_value' => 3, 'max_value' => 3],
            ['kriteria_id' => 1, 'nama' => 'Sangat Baik', 'bobot' => 4, 'min_value' => 4, 'max_value' => 4],

            // KETERLAMBATAN (kriteria_id = 2)
            ['kriteria_id' => 2, 'nama' => '<= 15 menit', 'bobot' => 1, 'min_value' => 0, 'max_value' => 15],
            ['kriteria_id' => 2, 'nama' => '16 - 60 menit', 'bobot' => 2, 'min_value' => 16, 'max_value' => 60],
            ['kriteria_id' => 2, 'nama' => '61- 120 menit', 'bobot' => 3, 'min_value' => 61, 'max_value' => 120],
            ['kriteria_id' => 2, 'nama' => '>120 menit', 'bobot' => 4, 'min_value' => 121, 'max_value' => 5000],

            // LEMBUR (kriteria_id = 3)
            ['kriteria_id' => 3, 'nama' => '0 jam ', 'bobot' => 1, 'min_value' => 0, 'max_value' => 0],
            ['kriteria_id' => 3, 'nama' => '1-5 jam', 'bobot' => 2, 'min_value' => 1, 'max_value' => 5],
            ['kriteria_id' => 3, 'nama' => '6-10 jam', 'bobot' => 3, 'min_value' => 6, 'max_value' => 10],
            ['kriteria_id' => 3, 'nama' => '>10jam', 'bobot' => 4, 'min_value' => 11, 'max_value' => 100],

            // PELANGGARAN (kriteria_id = 4)
            ['kriteria_id' => 4,  'nama' => '0 pelanggran',  'bobot' => 1, 'min_value' => 0, 'max_value' => 0],
            ['kriteria_id' => 4,  'nama' => '1 pelanggran ',  'bobot' => 2, 'min_value' => 1, 'max_value' => 1],
            ['kriteria_id' => 4,  'nama' => '2 pelanggran ',  'bobot' => 3, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 4,  'nama' => '>=3 pelanggran ',  'bobot' => 4, 'min_value' => 3, 'max_value' => 100],

            // MASA KERJA (kriteria_id = 5)
            ['kriteria_id' => 5,  'nama' => '1-12 bulan ',  'bobot' => 1, 'min_value' => 1,  'max_value' => 12],
            ['kriteria_id' => 5,  'nama' => '13-24 bulan',  'bobot' => 2, 'min_value' => 13, 'max_value' => 24],
            ['kriteria_id' => 5,  'nama' => '25-36 bulan',  'bobot' => 3, 'min_value' => 25, 'max_value' => 36],
            ['kriteria_id' => 5,  'nama' => '>=37 bulan ',  'bobot' => 4, 'min_value' => 37, 'max_value' => 100],
        ]);
    }
}
