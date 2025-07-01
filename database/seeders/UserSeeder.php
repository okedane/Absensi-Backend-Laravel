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
            //Koki
            [
                'name' => 'Amin',
                'email' => 'amin@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toni',
                'email' => 'toni@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rian',
                'email' => 'rian@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beny',
                'email' => 'beny@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fiyan',
                'email' => 'fiyan@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hamli',
                'email' => 'hamli@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iyat',
                'email' => 'iyat@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Noval',
                'email' => 'noval@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //administrasi
            [
                'name' => 'Ima',
                'email' => 'ima@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rosi',
                'email' => 'rosi@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sofi',
                'email' => 'sofi@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arini',
                'email' => 'arini@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //waiters
            [
                'name' => 'Fauzih',
                'email' => 'fauzih@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Irul',
                'email' => 'irul@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hery',
                'email' => 'hery@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AYIK/FERDY',
                'email' => 'ayikferdy@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agus',
                'email' => 'agus@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Barista

            [
                'name' => 'Eko',
                'email' => 'eko@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Inong',
                'email' => 'inong@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tari',
                'email' => 'tari@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi',
                'email' => 'andi@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Security
            [
                'name' => 'Yongki',
                'email' => 'yongki@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Danil',
                'email' => 'danil@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arik',
                'email' => 'arik@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            //Kurir
            [
                'name' => 'Fatimah',
                'email' => 'fatimah@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Irwan',
                'email' => 'irwan@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diye',
                'email' => 'diye@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],


            //admin
            [
                'name' => 'admin',
                'email' => 'romadani.code@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

         
    }
}
