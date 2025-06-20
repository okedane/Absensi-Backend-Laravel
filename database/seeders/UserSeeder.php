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
                'email' => 'admin@gmai.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Satu',
                'email' => 'karyawan1@gmai.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karyawan Dua',
                'email' => 'karyawan2@gmai.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

         
    }
}
