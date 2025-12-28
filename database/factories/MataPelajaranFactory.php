<?php

namespace Database\Factories;

use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MataPelajaran>
 */
class MataPelajaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mapels = [
            'Matematika',
            'Fisika',
            'Kimia',
            'Biologi',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Sejarah',
            'Geografi',
            'Ekonomi',
            'Sosiologi',
        ];

        return [
            'nama_mapel' => fake()->unique()->randomElement($mapels),
        ];
    }
}
