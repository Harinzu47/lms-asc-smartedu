<?php

namespace App\Livewire\Student;

use App\Models\Jadwal;
use App\Models\Presensi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard - Student')]
class Dashboard extends Component
{
    public function render()
    {
        Carbon::setLocale('id');
        $user = Auth::user();

        // 1. Widgets Logic
        // Total Mapel (Kelas count isn't accurate if 1 class has many mapels)
        // If user is in a 'Kelas (Group)', we count Jadwal schedules (unique mapels)
        $totalKelas = 0;
        if ($user->kelas_id) {
             $totalKelas = Jadwal::where('kelas_id', $user->kelas_id)
                ->distinct('mapel_id')
                ->count('mapel_id');
        }

        // Attendance Rate
        $totalSessions = Presensi::where('siswa_id', $user->id)->count();
        $presentSessions = Presensi::where('siswa_id', $user->id)->where('status', 'Hadir')->count();
        $attendanceRate = $totalSessions > 0 ? round(($presentSessions / $totalSessions) * 100) : 0; // Default 0 or 100?

        // 2. Schedule Logic (Today)
        $todayName = Carbon::now()->translatedFormat('l'); // Senin, Selasa...
        $jadwalsToday = collect();
        if ($user->kelas_id) {
            $jadwalsToday = Jadwal::with(['mapel', 'tutor'])
                ->where('kelas_id', $user->kelas_id)
                ->where('hari', $todayName)
                ->orderBy('jam_mulai')
                ->get();
        }

        return view('livewire.student.dashboard', [
            'totalKelas' => $totalKelas,
            'attendanceRate' => $attendanceRate,
            'jadwalsToday' => $jadwalsToday
        ])->layout('components.layouts.student');
    }
}
