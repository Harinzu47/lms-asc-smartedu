<?php

namespace App\Livewire\Tutor\Presensi;

use App\Models\Jadwal;
use App\Models\Presensi;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.tutor')]
#[Title('Riwayat Presensi - ASC SmartEdu')]
class Riwayat extends Component
{
    public Jadwal $jadwal;

    public function mount(Jadwal $jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function render()
    {
        // Fetch presensi grouped by tanggal
        $riwayat = Presensi::where('jadwal_id', $this->jadwal->id)
            ->orderBy('tanggal', 'desc')
            ->get()
            ->groupBy('tanggal')
            ->map(function ($items, $tanggal) {
                return [
                    'tanggal' => $tanggal,
                    'created_at' => $items->first()->created_at, // Ambil waktu input pertama
                    'hadir' => $items->where('status', 'Hadir')->count(),
                    'sakit' => $items->where('status', 'Sakit')->count(),
                    'izin' => $items->where('status', 'Izin')->count(),
                    'alpha' => $items->where('status', 'Alpha')->count(),
                ];
            });

        return view('livewire.tutor.presensi.riwayat', [
            'riwayat' => $riwayat,
        ]);
    }
}
