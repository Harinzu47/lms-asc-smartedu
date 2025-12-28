<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Tutors
        $tutors = User::where('role', UserRole::TUTOR)->get();

        if ($tutors->isEmpty()) {
            return;
        }

        // Get Kelas and Mapel
        $kelasList = Kelas::all();
        $mapelList = MataPelajaran::all();

        if ($kelasList->isEmpty() || $mapelList->isEmpty()) {
            return;
        }

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        // Create sample jadwals
        $jadwalData = [
            // Jadwal untuk Kelas 10
            [
                'tutor_id' => $tutors->first()->id,
                'mapel_id' => $mapelList->where('nama_mapel', 'Matematika')->first()?->id ?? $mapelList->first()->id,
                'kelas_id' => $kelasList->where('nama_kelas', 'Kelas 10')->first()?->id ?? $kelasList->first()->id,
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:30',
            ],
            [
                'tutor_id' => $tutors->first()->id,
                'mapel_id' => $mapelList->where('nama_mapel', 'Fisika')->first()?->id ?? $mapelList->skip(1)->first()?->id ?? $mapelList->first()->id,
                'kelas_id' => $kelasList->where('nama_kelas', 'Kelas 10')->first()?->id ?? $kelasList->first()->id,
                'hari' => 'Selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:30',
            ],
            // Jadwal untuk Kelas 11
            [
                'tutor_id' => $tutors->count() > 1 ? $tutors->skip(1)->first()->id : $tutors->first()->id,
                'mapel_id' => $mapelList->where('nama_mapel', 'Biologi')->first()?->id ?? $mapelList->last()->id,
                'kelas_id' => $kelasList->where('nama_kelas', 'Kelas 11')->first()?->id ?? $kelasList->skip(1)->first()?->id ?? $kelasList->first()->id,
                'hari' => 'Rabu',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:30',
            ],
            [
                'tutor_id' => $tutors->count() > 1 ? $tutors->skip(1)->first()->id : $tutors->first()->id,
                'mapel_id' => $mapelList->where('nama_mapel', 'Matematika')->first()?->id ?? $mapelList->first()->id,
                'kelas_id' => $kelasList->where('nama_kelas', 'Kelas 11')->first()?->id ?? $kelasList->skip(1)->first()?->id ?? $kelasList->first()->id,
                'hari' => 'Kamis',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:30',
            ],
            // Jadwal untuk Kelas 12
            [
                'tutor_id' => $tutors->first()->id,
                'mapel_id' => $mapelList->where('nama_mapel', 'Fisika')->first()?->id ?? $mapelList->skip(1)->first()?->id ?? $mapelList->first()->id,
                'kelas_id' => $kelasList->where('nama_kelas', 'Kelas 12')->first()?->id ?? $kelasList->last()->id,
                'hari' => 'Jumat',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:30',
            ],
        ];

        foreach ($jadwalData as $jadwal) {
            Jadwal::firstOrCreate(
                [
                    'tutor_id' => $jadwal['tutor_id'],
                    'kelas_id' => $jadwal['kelas_id'],
                    'hari' => $jadwal['hari'],
                    'jam_mulai' => $jadwal['jam_mulai'],
                ],
                $jadwal
            );
        }
    }
}
