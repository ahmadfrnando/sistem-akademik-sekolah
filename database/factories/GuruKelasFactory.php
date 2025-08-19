<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuruKelas>
 */
class GuruKelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guru_id' => 1,
            'kelas_id' => 1,
            'mapel_id' => 1,
            'nama_kelas' => 'VII-1'
        ];
    }
}
