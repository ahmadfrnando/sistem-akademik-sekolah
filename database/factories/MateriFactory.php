<?php

namespace Database\Factories;

use App\Models\Guru;
use App\Models\GuruKelas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materi>
 */
class MateriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $guru = GuruKelas::findOrFail(1);
        return [
            'mapel_id' => $guru->mapel_id,
            'nama_materi' => $guru->mapel->nama_mapel . ' Lanjutan',
            'deskripsi' => fake()->paragraph(2),
            'guru_id' => $guru->guru_id,
            'kelas_id' => 1,
            'file_materi' => 'example/test.pdf',
            'tanggal_deadline' => now()->addWeek(),
        ];
    }
}
