<?php

namespace App\Livewire\Tutor;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Dashboard Tutor - SmartEdu')]
class Dashboard extends Component
{
    use WithPagination;

    public function render()
    {
        $user = Auth::user();
        
        // Map English day to Indonesian day for filtering
        $dayMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];
        
        $todayEnglish = Carbon::now()->format('l');
        $todayIndo = $dayMap[$todayEnglish] ?? null;

        $jadwalsToday = Jadwal::with(['kelas', 'mapel'])
            ->where('tutor_id', $user->id)
            ->where('hari', $todayIndo)
            ->orderBy('jam_mulai')
            ->get();

        $allClasses = Jadwal::with(['kelas', 'mapel'])
            ->where('tutor_id', $user->id)
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->paginate(10);

        return view('livewire.tutor.dashboard', [
            'jadwalsToday' => $jadwalsToday,
            'allClasses' => $allClasses
        ])->layout('components.layouts.tutor');
    }
}
