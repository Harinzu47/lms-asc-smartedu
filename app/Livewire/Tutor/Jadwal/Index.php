<?php

namespace App\Livewire\Tutor\Jadwal;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Jadwal Mengajar - Tutor')]
class Index extends Component
{
    public $search = '';

    public function render()
    {
        $jadwals = Jadwal::with(['kelas', 'mapel'])
            ->where('tutor_id', Auth::id())
            ->when($this->search, function($q) {
                $q->whereHas('mapel', fn($query) => $query->where('nama_mapel', 'like', '%'.$this->search.'%'))
                  ->orWhereHas('kelas', fn($query) => $query->where('nama_kelas', 'like', '%'.$this->search.'%'));
            })
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        return view('livewire.tutor.jadwal.index', [
            'groupedJadwals' => $jadwals
        ])->layout('components.layouts.tutor');
    }
}
