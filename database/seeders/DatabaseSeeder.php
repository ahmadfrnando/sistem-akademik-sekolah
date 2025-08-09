<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        \App\Models\User::factory()->create([
            'name' => 'Siswa',
            'username' => 'siswa',
            'password' => Hash::make('123'),
            'role_id' => 3
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Guru',
            'username' => 'guru',
            'password' => Hash::make('123'),
            'role_id' => 2
        ]);
    }
}
