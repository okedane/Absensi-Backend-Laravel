<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Satu',
                'email' => 'karyawan1@example.com',
                'password' => bcrypt('password'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Dua',
                'email' => 'karyawan2@example.com',
                'password' => bcrypt('password'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // \Illuminate\Support\Facades\DB::table('karyawans')->insert([
        //     [
        //         'nomor_karyawan' => 'KRY001',
        //         'foto' => null,
        //         'tanggal_masuk' => now()->toDateString(),
        //         'user_id' => 2,
        //         'jabatan_id' => 1, // Pastikan jabatan_id 1 sudah ada di tabel jabatans
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
    }
}
