<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Test',
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Kasir',
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Waiter',
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Chef',
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Security',
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Admin',
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Barista',
        ]);
        \App\Models\Jabatan::create([
            'nama_jabatan' => 'Kurir',
        ]);
    }
}
