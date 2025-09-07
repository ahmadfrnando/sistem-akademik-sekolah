<?php

namespace Database\Factories;

use App\Models\Materi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TanggapanMateri>
 */
class TanggapanMateriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $materi = Materi::findOrFail(1);
        return [
            'materi_id' => $materi->id,
            'tanggapan' => 'Bahasa indonesia adalah bahasa yang paling penting. dan menjadi bahasa persatuan yang paling penting di dinegeri.',
            'file' => 'example/test.pdf',
            'siswa_id' => 1,
            'guru_id' => $materi->guru_id,
            'kelas_id' => $materi->kelas_id
        ];
    }
}
