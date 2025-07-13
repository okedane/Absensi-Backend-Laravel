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
            [ //1
                'name' => 'Amin',
                'email' => 'amin@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //2
                'name' => 'Toni',
                'email' => 'toni@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //3
                'name' => 'Rian',
                'email' => 'rian@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //4
                'name' => 'Beny',
                'email' => 'beny@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //5
                'name' => 'Fiyan',
                'email' => 'fiyan@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //6
                'name' => 'Hamli',
                'email' => 'hamli@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //7
                'name' => 'iyat',
                'email' => 'iyat@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //8
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
            [ //9
                'name' => 'Ima',
                'email' => 'ima@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //10
                'name' => 'Rosi',
                'email' => 'rosi@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //11
                'name' => 'Sofi',
                'email' => 'sofi@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ //12
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
            [ // 13
                'name' => 'Fauzih',
                'email' => 'fauzih@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 14
                'name' => 'Irul',
                'email' => 'irul@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 15
                'name' => 'Hery',
                'email' => 'hery@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 16
                'name' => 'AYIK/FERDY',
                'email' => 'ayikferdy@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 17
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

            [ // 18
                'name' => 'Eko',
                'email' => 'eko@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 19
                'name' => 'Inong',
                'email' => 'inong@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 20
                'name' => 'Tari',
                'email' => 'tari@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 21
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
            [ // 22
                'name' => 'Yongki',
                'email' => 'yongki@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 23
                'name' => 'Danil',
                'email' => 'danil@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 24
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
            [ // 25
                'name' => 'Fatimah',
                'email' => 'fatimah@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 26
                'name' => 'Irwan',
                'email' => 'irwan@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ // 27
                'name' => 'Diye',
                'email' => 'diye@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'karyawan',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // admin
            [ //28
                'name' => 'admin1',
                'email' => 'romadani.code@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // admin

    }
}
