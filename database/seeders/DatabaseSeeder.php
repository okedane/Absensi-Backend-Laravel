<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            JabatanSeeder::class,
            ProfileSeeder::class,
            KaryawanSeeder::class,
            LokasiSeeder::class,
            IzinSeeder::class,
            JadwalKerjaSeeder::class,
            LemburSeeder::class,
            KriteriaSeeder::class,
            SubKriteriaSeeder::class,
            AbsensiSeeder::class,
        ]);
    }
}
