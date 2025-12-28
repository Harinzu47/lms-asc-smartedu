<?php

namespace App\Livewire\Admin\Monitoring;

use App\Models\Jadwal;
use Livewire\Component;
use App\Models\Presensi;

class KelasDetail extends Component
{
    public Jadwal $jadwal;
    public $activeTab = 'materi'; // 'materi', 'tugas', 'diskusi', 'peserta', 'presensi'
    
    // Data for Presensi Modal
    public $selectedPresensiDate = null;
    public $presensiDetail = [];
    public $isPresensiModalOpen = false;

    public function mount(Jadwal $jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    // --- Presensi Audit Logic ---

    public function showPresensiDetail($date)
    {
        $this->selectedPresensiDate = $date;
        
        // Get all students
        $students = $this->jadwal->kelas->siswas;
        
        // Get presence records for this date and schedule
        $presenceRecords = Presensi::where('jadwal_id', $this->jadwal->id)
                                   ->where('tanggal', $date)
                                   ->get()
                                   ->keyBy('siswa_id'); // Use siswa_id to match with Student Users

        $this->presensiDetail = $students->map(function($student) use ($presenceRecords) {
            $record = $presenceRecords->get($student->id);
            return [
                'name' => $student->name,
                'email' => $student->email,
                'status' => $record ? $record->status : 'alpha', // Default to alpha if no record found but date exists
                'waktu' => $record ? $record->created_at->format('H:i') : '-',
            ];
        });

        $this->isPresensiModalOpen = true;
    }

    public function closePresensiModal()
    {
        $this->isPresensiModalOpen = false;
        $this->selectedPresensiDate = null;
        $this->presensiDetail = [];
    }
    
    // --- Tugas Detail Logic ---
    public $selectedTugasId = null;
    public $tugasSubmissionDetail = []; // Will hold student name, status, submission date, file/answer
    public $isTugasModalOpen = false;
    public $selectedTugasTitle = '';

    public function showTugasDetail($tugasId)
    {
        $this->selectedTugasId = $tugasId;
        $tugas = $this->jadwal->tugases()->find($tugasId);
        
        if(!$tugas) return;
        
        $this->selectedTugasTitle = $tugas->judul;
        
        // Get all students in this schedule
        // Important: Use siswas() relation which we just refactored for Many-to-Many
        $students = $this->jadwal->siswas; 

        // Get submissions for this specific task
        $submissions = $tugas->pengumpulanTugas->keyBy('siswa_id');

        $this->tugasSubmissionDetail = $students->map(function($student) use ($submissions) {
            $submission = $submissions->get($student->id);
            return [
                'name' => $student->name,
                'email' => $student->email,
                'status' => $submission ? 'Submit' : 'Belum',
                'submitted_at' => $submission ? $submission->created_at->format('d M Y, H:i') : '-',
                'file_path' => $submission ? $submission->file_jawaban : null, // Corrected column name
                'jawaban' => $submission ? $submission->jawaban : null, 
                'nilai' => $submission ? $submission->nilai : '-', // Pass score (default to -)
            ];
        });

        $this->isTugasModalOpen = true;
    }

    public function closeTugasModal()
    {
        $this->isTugasModalOpen = false;
        $this->selectedTugasId = null;
        $this->tugasSubmissionDetail = [];
    }

    public function render()
    {
        // Stats
        $stats = [
            'total_materi' => $this->jadwal->materis()->count(),
            'total_tugas' => $this->jadwal->tugases()->count(),
            'total_siswa' => $this->jadwal->kelas->siswas()->count(),
            'total_pertemuan' => Presensi::where('jadwal_id', $this->jadwal->id)
                                         ->selectRaw('tanggal as date')
                                         ->groupBy('date')
                                         ->get()
                                         ->count(),
        ];

        // Group Presensi by Date for History Table
        $presensiHistory = Presensi::where('jadwal_id', $this->jadwal->id)
            ->selectRaw('tanggal as date, min(created_at) as created_at')
            ->selectRaw('count(*) as total_input')
            ->selectRaw('sum(case when status = "hadir" then 1 else 0 end) as hadir')
            ->selectRaw('sum(case when status = "sakit" then 1 else 0 end) as sakit')
            ->selectRaw('sum(case when status = "izin" then 1 else 0 end) as izin')
            ->selectRaw('sum(case when status = "alpha" then 1 else 0 end) as alpha')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($item) use ($stats) {
                // Calculate implicit alpha: Total Students - (Hadir + Sakit + Izin + Explicit Alpha)
                // However, Total Input usually means "Recorded Data". 
                // Admin wants to see "Who hasn't attended/been inputs".
                // If we assume standard attendance, Total Input should be Total Class Size.
                // Discrepancy comes when Total Input < Total Class Size.
                
                $totalRecorded = $item->hadir + $item->sakit + $item->izin + $item->alpha;
                $implicitAlpha = max(0, $stats['total_siswa'] - $totalRecorded);
                
                $item->alpha += $implicitAlpha; // Add implicit alpha to explicit alpha count
                
                return $item;
            });

        return view('livewire.admin.monitoring.kelas-detail', [
            'stats' => $stats,
            'presensiHistory' => $presensiHistory,
        ])->layout('components.layouts.admin');
    }
}
