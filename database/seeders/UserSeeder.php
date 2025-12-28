<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get kelas for siswa assignment
        $kelasList = Kelas::all();

        // Create Admin
        User::firstOrCreate(
            ['email' => 'admin@asc.com'],
            [
                'name' => 'Administrator',
                'password' => 'password',
                'role' => UserRole::ADMIN,
                'status_aktif' => true,
                'nomor_telepon' => '081234567890',
            ]
        );

        // Create Main Tutor
        User::firstOrCreate(
            ['email' => 'tutor@asc.com'],
            [
                'name' => 'Tutor Utama',
                'password' => 'password',
                'role' => UserRole::TUTOR,
                'status_aktif' => true,
                'nomor_telepon' => '081234567891',
            ]
        );

        // Create Main Siswa
        User::firstOrCreate(
            ['email' => 'siswa@asc.com'],
            [
                'name' => 'Siswa Utama',
                'password' => 'password',
                'role' => UserRole::SISWA,
                'status_aktif' => true,
                'kelas_id' => $kelasList->first()?->id,
                'nomor_telepon' => '081234567892',
            ]
        );

        // Create 2 Additional Tutors using Factory
        User::factory()
            ->count(2)
            ->tutor()
            ->create();

        // Create 10 Additional Siswa using Factory
        User::factory()
            ->count(10)
            ->siswa()
            ->active()
            ->sequence(fn ($sequence) => [
                'kelas_id' => $kelasList->count() > 0
                    ? $kelasList->random()->id
                    : null,
            ])
            ->create();
    }
}
