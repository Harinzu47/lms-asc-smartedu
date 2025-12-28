<?php

namespace App\Livewire\Student\Kelas;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Kelas Saya - Student')]
class Index extends Component
{
    public $search = '';

    public function render()
    {
        $user = Auth::user();
        
        $jadwals = collect();
        
        if ($user->kelas_id) {
            $jadwals = Jadwal::with(['mapel', 'tutor'])
                ->where('kelas_id', $user->kelas_id)
                ->when($this->search, function($q) {
                    $q->whereHas('mapel', fn($query) => $query->where('nama_mapel', 'like', '%'.$this->search.'%'))
                      ->orWhereHas('tutor', fn($query) => $query->where('name', 'like', '%'.$this->search.'%'));
                })
                ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                ->orderBy('jam_mulai')
                ->get()
                ->groupBy('hari');
        }

        return view('livewire.student.kelas.index', [
            'groupedJadwals' => $jadwals
        ])->layout('components.layouts.student');
    }
}
