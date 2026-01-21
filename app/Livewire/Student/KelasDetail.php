<?php

namespace App\Livewire\Student;

use App\Models\Jadwal;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Ruang Kelas - Student')]
class KelasDetail extends Component
{
    use WithFileUploads;

    public $jadwal;
    public $activeTab = 'materi';

    // Upload Props
    public $file_tugas;
    public $selectedTugasId;

    public function mount(Jadwal $jadwal)
    {
        // Security: Ensure student is enrolled in this jadwal (via pivot table)
        $isEnrolled = $jadwal->siswas()->where('user_id', Auth::id())->exists();

        if (!$isEnrolled) {
            abort(403, 'Anda tidak terdaftar di jadwal kelas ini.');
        }
        $this->jadwal = $jadwal;
    }

    public function updatedFileTugas()
    {
        $this->validate([
            'file_tugas' => 'required|file|mimes:pdf,doc,docx,zip,jpg,png|max:10240', // 10MB
        ]);

        // Auto submit logic or just validation? Prefer explicit submit button.
    }

    public function submitTugas($tugasId)
    {
        // Security: Verify student is enrolled in this jadwal
        $isEnrolled = $this->jadwal->siswas()->where('user_id', Auth::id())->exists();
        if (!$isEnrolled) {
            abort(403, 'Unauthorized action.');
        }

        $this->selectedTugasId = $tugasId;

        $this->validate([
            'file_tugas' => 'required|file|mimes:pdf,doc,docx,zip,jpg,png|max:10240',
        ]);

        $tugas = Tugas::find($tugasId);
        if (!$tugas)
            return;

        // Verify tugas belongs to this jadwal
        if ($tugas->jadwal_id !== $this->jadwal->id) {
            abort(403, 'Tugas tidak valid.');
        }

        // Check deadline
        if (now()->greaterThan($tugas->batas_waktu)) {
            $this->addError('file_tugas', 'Maaf, waktu pengumpulan sudah habis.');
            return;
        }

        // Use hashName for secure random filename
        $path = $this->file_tugas->storeAs(
            'tugas-uploads',
            $this->file_tugas->hashName(),
            'public'
        );

        PengumpulanTugas::updateOrCreate(
            ['tugas_id' => $tugasId, 'siswa_id' => Auth::id()],
            [
                'file_jawaban' => $path,
                'tanggal_dikumpul' => now(),
            ]
        );

        $this->reset('file_tugas', 'selectedTugasId');
        $this->dispatch('swal:modal', ['title' => 'Berhasil!', 'text' => 'Tugas berhasil dikumpulkan.', 'icon' => 'success']);
    }

    public function downloadMateri($path)
    {
        return Storage::download($path);
    }

    public function downloadMateriLink($path)
    {
        // Use a direct route or Storage::url if public
        return Storage::url($path);
    }

    public function render()
    {
        // Eager load relationships
        return view('livewire.student.kelas-detail', [
            'materis' => $this->jadwal->materis()->latest()->get(),
            'tugases' => $this->jadwal->tugases()->latest()->get(),
            // Pre-fetch submissions for this student? Or do it in Blade loop?
            // Better to fetch here to avoid N+1 in view if possible, key by tugas_id
            'submissions' => PengumpulanTugas::where('siswa_id', Auth::id())
                ->whereIn('tugas_id', $this->jadwal->tugases->pluck('id'))
                ->get()
                ->keyBy('tugas_id')
        ])->layout('components.layouts.student');
    }
}
