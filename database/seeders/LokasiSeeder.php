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
        // , 1
        \App\Models\lokasiAbsensi::create([
            'nama_lokasi' => 'Melita Kitchen',
            'latitude' => 	-7.0153782301165295,
            'longitude' => 	13.86680369129698,
            'radius_meter' => 50,
        ]);

        \App\Models\lokasiAbsensi::create([
            'nama_lokasi' => 'Uniba Madura',
            'latitude' => -7.008417435154697,
            'longitude' => 113.84515525976013,
            'radius_meter' => 150,
            // , 
        ]);

        \App\Models\lokasiAbsensi::create([
            'nama_lokasi' => 'Home',
            'latitude' => -6.909443307898965,
            'longitude' => 113.7627519121986,
            'radius_meter' => 200,
        ]);


        // -7.005894624100063, 113.84565112837005
        \App\Models\lokasiAbsensi::create([
            'nama_lokasi' => 'Masjid',
            'latitude' => -7.005894624100063,
            'longitude' => 113.84565112837005,
            'radius_meter' => 200,
        ]);
    }
}
