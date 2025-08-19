<?php

namespace Database\Seeders;

use App\Models\TanggapanMateri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanggapanMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TanggapanMateri::factory(1)->create();
    }
}
