<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Kelas
        $kelasData = [
            ['nama_kelas' => 'Kelas 10'],
            ['nama_kelas' => 'Kelas 11'],
            ['nama_kelas' => 'Kelas 12'],
        ];

        foreach ($kelasData as $kelas) {
            Kelas::firstOrCreate($kelas);
        }

        // Create Mata Pelajaran
        $mapelData = [
            ['nama_mapel' => 'Matematika'],
            ['nama_mapel' => 'Fisika'],
            ['nama_mapel' => 'Biologi'],
        ];

        foreach ($mapelData as $mapel) {
            MataPelajaran::firstOrCreate($mapel);
        }
    }
}
