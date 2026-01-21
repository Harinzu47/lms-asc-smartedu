<?php

namespace App\Livewire\Tutor;

use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Detail Kelas - Tutor')]
class KelasDetail extends Component
{
    use WithFileUploads;

    public Jadwal $jadwal;

    // --- Tab Materi ---
    public $judul_materi;
    public $file_materi;
    public $deskripsi_materi;

    // --- Tab Tugas ---
    public $judul_tugas;
    public $deskripsi_tugas;
    public $deadline_tugas;
    public $editingTugasId = null;

    // --- Tab Penilaian ---
    public $selectedTugasId;
    public $nilaiInput = []; // array map: siswa_id => nilai

    public function mount(Jadwal $jadwal)
    {
        if ($jadwal->tutor_id !== auth()->id()) {
            abort(403);
        }
        $this->jadwal = $jadwal;
    }

    public function render()
    {
        // Students for Penilaian
        $students = collect();
        if ($this->selectedTugasId) {
            $students = $this->jadwal->kelas->siswas()
                ->with([
                        'pengumpulanTugas' => function ($q) {
                            $q->where('tugas_id', $this->selectedTugasId);
                        }
                    ])
                ->get();

            // Initialize nilaInput buffer
            foreach ($students as $student) {
                if ($student->pengumpulanTugas->isNotEmpty()) {
                    $this->nilaiInput[$student->id] = $student->pengumpulanTugas->first()->nilai;
                }
            }
        }

        return view('livewire.tutor.kelas-detail', [
            'materis' => $this->jadwal->materis()->latest()->get(),
            'tugases' => $this->jadwal->tugases()->latest()->get(),
            'students' => $students
        ])->layout('components.layouts.tutor');
    }

    // --- MATERI LOGIC ---

    public function saveMateri()
    {
        // Security: Ensure tutor owns this jadwal
        if ($this->jadwal->tutor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $this->validate([
            'judul_materi' => 'required|string|max:255',
            'file_materi' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
            'deskripsi_materi' => 'nullable|string',
        ]);

        // Use hashName for secure random filename
        $path = $this->file_materi->storeAs(
            'materi',
            $this->file_materi->hashName(),
            'public'
        );

        Materi::create([
            'jadwal_id' => $this->jadwal->id,
            'judul' => $this->judul_materi,
            'file_path' => $path,
            'deskripsi' => $this->deskripsi_materi,
        ]);

        $this->reset(['judul_materi', 'file_materi', 'deskripsi_materi']);
        $this->dispatch('swal:modal', ['title' => 'Berhasil!', 'text' => 'Materi berhasil diupload.', 'icon' => 'success']);
    }

    public function confirmDeleteMateri($id)
    {
        $this->dispatch('swal:confirm', ['title' => 'Hapus Materi?', 'text' => 'File akan dihapus permanen.', 'icon' => 'warning', 'id' => $id, 'onConfirmed' => 'deleteMateri']);
    }

    protected $listeners = ['deleteMateri', 'deleteTugas'];

    public function deleteMateri($data)
    {
        $materi = Materi::findOrFail($data['id']);
        if ($materi->jadwal->tutor_id !== auth()->id())
            abort(403);
        if (Storage::disk('public')->exists($materi->file_path))
            Storage::disk('public')->delete($materi->file_path);
        $materi->delete();
        $this->dispatch('swal:modal', ['title' => 'Terhapus!', 'text' => 'Materi berhasil dihapus.', 'icon' => 'success']);
    }

    public function downloadMateri($id)
    {
        $materi = Materi::findOrFail($id);
        if ($materi->jadwal->tutor_id !== auth()->id())
            abort(403);
        return Storage::disk('public')->download($materi->file_path, $materi->judul . '.' . pathinfo($materi->file_path, PATHINFO_EXTENSION));
    }

    // --- TUGAS LOGIC ---

    public function saveTugas()
    {
        // Security: Ensure tutor owns this jadwal
        if ($this->jadwal->tutor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $rules = [
            'judul_tugas' => 'required|string|max:255',
            'deskripsi_tugas' => 'nullable|string',
        ];

        // For new tugas, deadline must be in the future
        // For editing, allow keeping the same deadline or setting a new future date
        if ($this->editingTugasId) {
            $rules['deadline_tugas'] = 'required|date';
        } else {
            $rules['deadline_tugas'] = 'required|date|after:now';
        }

        $this->validate($rules);

        if ($this->editingTugasId) {
            // Update existing tugas
            $tugas = Tugas::findOrFail($this->editingTugasId);
            if ($tugas->jadwal->tutor_id !== auth()->id())
                abort(403);

            $tugas->update([
                'judul' => $this->judul_tugas,
                'deskripsi' => $this->deskripsi_tugas,
                'batas_waktu' => $this->deadline_tugas,
            ]);

            $this->reset(['judul_tugas', 'deskripsi_tugas', 'deadline_tugas', 'editingTugasId']);
            $this->dispatch('swal:modal', ['title' => 'Berhasil!', 'text' => 'Tugas berhasil diperbarui.', 'icon' => 'success']);
        } else {
            // Create new tugas
            Tugas::create([
                'jadwal_id' => $this->jadwal->id,
                'judul' => $this->judul_tugas,
                'deskripsi' => $this->deskripsi_tugas,
                'batas_waktu' => $this->deadline_tugas,
            ]);

            $this->reset(['judul_tugas', 'deskripsi_tugas', 'deadline_tugas']);
            $this->dispatch('swal:modal', ['title' => 'Berhasil!', 'text' => 'Tugas berhasil dibuat.', 'icon' => 'success']);
        }
    }

    public function editTugas($id)
    {
        $tugas = Tugas::findOrFail($id);
        if ($tugas->jadwal->tutor_id !== auth()->id())
            abort(403);

        $this->editingTugasId = $tugas->id;
        $this->judul_tugas = $tugas->judul;
        $this->deskripsi_tugas = $tugas->deskripsi;
        $this->deadline_tugas = \Carbon\Carbon::parse($tugas->batas_waktu)->format('Y-m-d\TH:i');
    }

    public function cancelEditTugas()
    {
        $this->reset(['judul_tugas', 'deskripsi_tugas', 'deadline_tugas', 'editingTugasId']);
    }

    public function confirmDeleteTugas($id)
    {
        $this->dispatch('swal:confirm', ['title' => 'Hapus Tugas?', 'text' => 'Data tugas dan pengumpulan siswa akan dihapus.', 'icon' => 'warning', 'id' => $id, 'onConfirmed' => 'deleteTugas']);
    }

    public function deleteTugas($data)
    {
        $tugas = Tugas::findOrFail($data['id']);
        if ($tugas->jadwal->tutor_id !== auth()->id())
            abort(403);
        $tugas->delete();
        $this->dispatch('swal:modal', ['title' => 'Terhapus!', 'text' => 'Tugas berhasil dihapus.', 'icon' => 'success']);
    }

    // --- PENILAIAN LOGIC ---

    public function saveNilai($siswaId)
    {
        // Security: Ensure tutor owns this jadwal
        if ($this->jadwal->tutor_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!isset($this->nilaiInput[$siswaId]))
            return;
        $nilai = $this->nilaiInput[$siswaId];

        // Validate inside logic to handle individual field
        if ($nilai < 0 || $nilai > 100) {
            $this->dispatch('swal:modal', ['title' => 'Error', 'text' => 'Nilai harus 0-100.', 'icon' => 'error']);
            return;
        }

        // Find or Create Pengumpulan
        // Note: Usually students create pengumpulan. If tutor grades, it implies submission exists OR tutor can grade regardless?
        // Logic: "Tabel Penilaian: Muncul setelah tugas dipilih... Kolom Nama Siswa... Input Nilai".
        // If student hasn't submitted, can tutor grade? Usually yes (manual assignment).
        // I'll assume we update existing or create new if not exists (e.g. offline submission).

        // Cek apakah siswa sudah mengumpulkan tugas
        $pengumpulan = PengumpulanTugas::where('tugas_id', $this->selectedTugasId)
            ->where('siswa_id', $siswaId)
            ->first();

        if (!$pengumpulan) {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal!',
                'text' => 'Siswa belum mengumpulkan tugas. Tidak dapat memberi nilai.',
                'icon' => 'error'
            ]);
            // Reset input nilai di tampilan agar sesuai kondisi asli
            unset($this->nilaiInput[$siswaId]);
            return;
        }

        $pengumpulan->nilai = $nilai;
        $pengumpulan->save();

        // Optional: Show simplified success toast/notification
        // $this->dispatch('notify', 'Nilai tersimpan');

        // Flash message toast might be better than modal for table input
        // I will just ignore success modal for speed typing, or show toast. 
        // User asked for "otomatis tersimpan saat diketik (gunakan wire:model.blur)".
    }
}
