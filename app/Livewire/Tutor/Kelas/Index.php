<?php

namespace App\Livewire\Tutor\Kelas;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Daftar Kelas - Tutor')]
class Index extends Component
{
    public function render()
    {
        // Get schedules for the tutor
        $jadwals = Jadwal::with(['kelas', 'mapel'])
            ->where('tutor_id', Auth::id())
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('livewire.tutor.kelas.index', [
            'jadwals' => $jadwals
        ])->layout('components.layouts.tutor');
    }
}
