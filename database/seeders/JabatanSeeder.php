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
        $jabatanList = [
            'Chef',
            'Administrasi',
            'Waiters',
            'Barista',
            'Security',
            'Kurir',
        ];

        foreach ($jabatanList as $namaJabatan) {
            \App\Models\Jabatan::create([
                'nama_jabatan' => $namaJabatan,
            ]);
        }
    }
}
