<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\lokasiAbsensi::create([
            'nama_lokasi' => 'Restoran A',
            'latitude' => 	-7.01540960,
            'longitude' => 	113.86420820,
            'radius_meter' => 50,
        ]);

        \App\Models\lokasiAbsensi::create([
            'nama_lokasi' => 'Restoran B',
            'latitude' => -7.01540960,
            'longitude' => 113.86420820,
            'radius_meter' => 150,
        ]);

        \App\Models\lokasiAbsensi::create([
            'nama_lokasi' => 'Restoran C',
            'latitude' => -6.202000,
            'longitude' => 106.818000,
            'radius_meter' => 200,
        ]);
    }
}
