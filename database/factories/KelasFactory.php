<?php

namespace Database\Factories;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tingkat = fake()->randomElement(['10', '11', '12']);
        $jurusan = fake()->randomElement(['IPA', 'IPS']);
        $nomor = fake()->numberBetween(1, 3);

        return [
            'nama_kelas' => "{$tingkat} {$jurusan} {$nomor}",
        ];
    }
}
