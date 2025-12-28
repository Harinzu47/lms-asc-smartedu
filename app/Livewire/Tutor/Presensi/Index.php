<?php

namespace App\Livewire\Tutor\Presensi;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.tutor')]
#[Title('Presensi - ASC SmartEdu')]
class Index extends Component
{
    public function render()
    {
        $jadwals = Jadwal::with(['mapel', 'kelas'])
            ->where('tutor_id', Auth::id())
            ->get();

        return view('livewire.tutor.presensi.index', [
            'jadwals' => $jadwals,
        ]);
    }
}
