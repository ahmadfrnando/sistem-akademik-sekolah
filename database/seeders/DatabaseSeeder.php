<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guru;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('123'),
            'role_id' => 1
        ]);

        $this->call([
            SiswaSeeder::class,
            GuruSeeder::class,
            GuruKelasSeeder::class,
            MateriSeeder::class,
            TanggapanMateriSeeder::class
        ]);
    }
}
