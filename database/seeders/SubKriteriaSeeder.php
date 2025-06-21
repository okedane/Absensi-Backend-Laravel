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
            ['kriteria_id' => 1, 'bobot' => 1, 'min_value' => 0, 'max_value' => 12],
            ['kriteria_id' => 1, 'bobot' => 2, 'min_value' => 13, 'max_value' => 15],
            ['kriteria_id' => 1, 'bobot' => 3, 'min_value' => 16, 'max_value' => 19],
            ['kriteria_id' => 1, 'bobot' => 4, 'min_value' => 20, 'max_value' => 31],

            // KETERLAMBATAN (kriteria_id = 2)
            ['kriteria_id' => 2, 'bobot' => 1, 'min_value' => 0, 'max_value' => 15],
            ['kriteria_id' => 2, 'bobot' => 2, 'min_value' => 16, 'max_value' => 60],
            ['kriteria_id' => 2, 'bobot' => 3, 'min_value' => 61, 'max_value' => 120],
            ['kriteria_id' => 2, 'bobot' => 4, 'min_value' => 121, 'max_value' => 5000],

            // LEMBUR (kriteria_id = 3)
            ['kriteria_id' => 3, 'bobot' => 1, 'min_value' => 0, 'max_value' => 0],
            ['kriteria_id' => 3, 'bobot' => 2, 'min_value' => 1, 'max_value' => 5],
            ['kriteria_id' => 3, 'bobot' => 3, 'min_value' => 6, 'max_value' => 10],
            ['kriteria_id' => 3, 'bobot' => 4, 'min_value' => 11, 'max_value' => 100],

            // PELANGGARAN (kriteria_id = 4)
            ['kriteria_id' => 4, 'bobot' => 1, 'min_value' => 0, 'max_value' => 0],
            ['kriteria_id' => 4, 'bobot' => 2, 'min_value' => 1, 'max_value' => 1],
            ['kriteria_id' => 4, 'bobot' => 3, 'min_value' => 2, 'max_value' => 2],
            ['kriteria_id' => 4, 'bobot' => 4, 'min_value' => 3, 'max_value' => 100],

            // MASA KERJA (kriteria_id = 5)
            ['kriteria_id' => 5, 'bobot' => 1, 'min_value' => 1,  'max_value' => 12],
            ['kriteria_id' => 5, 'bobot' => 2, 'min_value' => 13, 'max_value' => 24],
            ['kriteria_id' => 5, 'bobot' => 3, 'min_value' => 25, 'max_value' => 36],
            ['kriteria_id' => 5, 'bobot' => 4, 'min_value' => 37, 'max_value' => 100],
        ]);
    }
}
