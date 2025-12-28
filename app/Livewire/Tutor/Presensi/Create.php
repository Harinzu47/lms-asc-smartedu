<?php

namespace App\Livewire\Tutor\Presensi;

use App\Models\Jadwal;
use App\Models\Presensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.tutor')]
#[Title('Input Presensi - ASC SmartEdu')]
class Create extends Component
{
    public Jadwal $jadwal;
    #[Url]
    public string $tanggal;
    public ?string $catatan = null;
    public array $attendanceData = []; // [user_id => status]
    public bool $isEditing = false;

    public function mount(Jadwal $jadwal)
    {
        $this->jadwal = $jadwal;
        $this->tanggal = request('date', Carbon::today()->format('Y-m-d'));

        // Load students
        $students = $this->jadwal->kelas->siswas;

        // Initialize attendance data (default: Hadir or Load from DB)
        $this->loadAttendanceData();

        // If data empty after load, default to Hadir
        foreach ($students as $student) {
            if (!isset($this->attendanceData[$student->id])) {
                $this->attendanceData[$student->id] = 'Hadir';
            }
        }
    }

    public function updatedTanggal($value)
    {
        $this->loadAttendanceData();
    }

    protected function loadAttendanceData()
    {
        $existing = Presensi::where('jadwal_id', $this->jadwal->id)
            ->whereDate('tanggal', $this->tanggal)
            ->get();
        
        if ($existing->isNotEmpty()) {
             $this->isEditing = true;
             foreach ($existing as $p) {
                 $this->attendanceData[$p->siswa_id] = $p->status;
             }
             $this->catatan = $existing->first()->catatan ?? null;
        } else {
            $this->isEditing = false;
            // Reset if no data for this date
            $this->attendanceData = []; 
            $this->catatan = null;
            // Re-fill default 'Hadir' for all students
            foreach ($this->jadwal->kelas->siswas as $student) {
                $this->attendanceData[$student->id] = 'Hadir';
            }
        }
    }

    public function delete()
    {
        if (!$this->isEditing) {
            return;
        }

        Presensi::where('jadwal_id', $this->jadwal->id)
            ->whereDate('tanggal', $this->tanggal)
            ->delete();

        session()->flash('success', 'Data presensi tanggal ' . $this->tanggal . ' berhasil dihapus.');
        
        $this->redirect(route('tutor.presensi.riwayat', $this->jadwal), navigate: true);
    }

    public function save()
    {
        $this->validate([
            'tanggal' => 'required|date',
            'attendanceData' => 'required|array',
            'attendanceData.*' => 'required|in:Hadir,Sakit,Izin,Alpha',
        ]);

        DB::transaction(function () {
            foreach ($this->attendanceData as $studentId => $status) {
                Presensi::updateOrCreate(
                    [
                        'jadwal_id' => $this->jadwal->id,
                        'siswa_id' => $studentId,
                        'tanggal' => $this->tanggal,
                    ],
                    [
                        'status' => $status,
                        'catatan' => $this->catatan,
                    ]
                );
            }
        });

        session()->flash('success', 'Data presensi berhasil disimpan.');
        
        $this->redirect(route('tutor.presensi.riwayat', $this->jadwal), navigate: true);
    }

    public function render()
    {
        return view('livewire.tutor.presensi.create', [
            'students' => $this->jadwal->kelas->siswas,
        ]);
    }
}
