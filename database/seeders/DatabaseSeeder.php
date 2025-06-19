<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            KaryawanSeeder::class,
            LokasiSeeder::class,
            IzinSeeder::class,
            // JadwalKerjaSeeder::class,
            // AbsensiSeeder::class,
        ]);
    }
}
