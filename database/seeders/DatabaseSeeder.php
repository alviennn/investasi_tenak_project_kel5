<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ternak;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $jenisList = ['ayam', 'sapi', 'kambing', 'bebek', 'ikan'];
        // $statusList = ['active', 'inactive', 'pending'];
        // $lokasiList = ['Desa Sukamaju', 'Kampung Ciledug', 'Kecamatan Bayongbong', 'Desa Margahayu', 'Dusun Karang'];

        // for ($i = 1; $i <= 15; $i++) {
        //     Ternak::create([
        //         'id_petani' => rand(1, 3), // Pastikan ada user dengan id 1-3
        //         'nama' => ucfirst(fake()->word()) . ' ' . ucfirst($jenisList[array_rand($jenisList)]),
        //         'jenis' => $jenisList[array_rand($jenisList)],
        //         'status' => $statusList[array_rand($statusList)],
        //         'lokasi' => $lokasiList[array_rand($lokasiList)],
        //         'deskripsi' => fake()->sentence(10),
        //     ]);
        // }
        // Menambahkan pengguna admin menggunakan factory
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        // Menambahkan pengguna investor menggunakan factory
        User::factory()->create([
            'name' => 'Investor User',
            'email' => 'investor@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'role' => 'investor',
        ]);

        // Menambahkan pengguna petani menggunakan factory
        User::factory()->create([
            'name' => 'Petani User',
            'email' => 'petani@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'role' => 'petani',
        ]);

        
    }
}