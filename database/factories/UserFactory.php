<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake('id_ID')->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => UserRole::SISWA,
            'nomor_telepon' => fake('id_ID')->phoneNumber(),
            'alamat' => fake('id_ID')->address(),
            'status_aktif' => false,
            'bukti_pembayaran' => null,
            'kelas_id' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Set user role as Admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::ADMIN,
            'status_aktif' => true,
        ]);
    }

    /**
     * Set user role as Tutor.
     */
    public function tutor(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::TUTOR,
            'status_aktif' => true,
        ]);
    }

    /**
     * Set user role as Siswa.
     */
    public function siswa(): static
    {
        return $this->state(fn (array $attributes): array => [
            'role' => UserRole::SISWA,
            'status_aktif' => false,
        ]);
    }

    /**
     * Set user as active (verified).
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status_aktif' => true,
        ]);
    }
}

