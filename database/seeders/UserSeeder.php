<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'user@perumahan.com',
                'name' => 'Perumahan',
                'nip' => '197706052008031001',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'user',
                'id_bidang' => 1, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'user@pertanahan.com',
                'name' => 'Pertanahan',
                'nip' => '198312162010012021',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'user',
                'id_bidang' => 2, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'user@kawasanpermukiman.com',
                'name' => 'Kawasan Permukiman',
                'nip' => '198503242009042002',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'user',
                'id_bidang' => 3, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'user@umumdanaparatur.com',
                'name' => 'Seketariat',
                'nip' => '196802141988032005',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'user',
                'id_bidang' => 4, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'user@keuangan.com',
                'name' => 'Admin',
                'nip' => '000000000000000000',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'admin',
                'id_bidang' => 5, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'user@sekretaris.com',
                'name' => 'Subag Renja Monev dan Keuangan',
                'nip' => '198606212009032003',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'user',
                'id_bidang' => 6, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'user@umpar.com',
                'name' => 'Subag Umum Aparatur dan Aset',
                'nip' => '199411182020122015',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'user',
                'id_bidang' => 7, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'email' => 'user@kepaladinas.com',
                'name' => 'Kepala Dinas',
                'nip' => '196910241998031007',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => 'user',
                'id_bidang' => 8, // ID bidang terkait
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
