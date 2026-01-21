<?php

namespace App\Livewire\Admin;

use App\Enums\UserRole;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Manajemen Jadwal - Admin')]
class ScheduleManager extends Component
{
    use WithPagination;

    // Filters
    public $filterKelas = '';
    public $filterHari = '';

    // Modal Properties
    public $jadwal_id;
    public $kelas_id, $mapel_id, $tutor_id, $hari, $jam_mulai, $jam_selesai;
    public $isModalOpen = false;

    // Derived Lists
    public $kelasList = [];
    public $mapelList = [];
    public $tutorList = [];
    public $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    public function mount()
    {
        $this->authorizeAdmin();
        $this->kelasList = Kelas::all();
        $this->mapelList = MataPelajaran::all();
        $this->tutorList = User::where('role', UserRole::TUTOR->value)->get();
    }

    /**
     * Security check: Ensure current user is admin
     */
    private function authorizeAdmin(): void
    {
        if (auth()->user()->role !== UserRole::ADMIN) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function render()
    {
        $jadwals = Jadwal::query()
            ->with(['kelas', 'mapel', 'tutor'])
            ->when($this->filterKelas, fn($q) => $q->where('kelas_id', $this->filterKelas))
            ->when($this->filterHari, fn($q) => $q->where('hari', $this->filterHari))
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->paginate(10);

        return view('livewire.admin.schedule-manager', [
            'jadwals' => $jadwals
        ])->layout('components.layouts.admin');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->reset(['jadwal_id', 'kelas_id', 'mapel_id', 'tutor_id', 'hari', 'jam_mulai', 'jam_selesai']);
    }

    public function store()
    {
        $this->authorizeAdmin();

        $this->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mata_pelajarans,id',
            'tutor_id' => 'required|exists:users,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Anti-Bentrok Logic
        if ($this->checkOverlap($this->tutor_id, $this->hari, $this->jam_mulai, $this->jam_selesai, 'tutor_id')) {
            $tutorName = User::find($this->tutor_id)->name;
            $this->addError('tutor_id', "Gagal: Tutor $tutorName sudah mengajar di kelas lain pada jam tersebut.");
            return;
        }

        if ($this->checkOverlap($this->kelas_id, $this->hari, $this->jam_mulai, $this->jam_selesai, 'kelas_id')) {
            $kelasName = Kelas::find($this->kelas_id)->nama_kelas;
            $this->addError('kelas_id', "Gagal: Kelas $kelasName sudah memiliki jadwal mapel lain pada jam tersebut.");
            return;
        }

        Jadwal::updateOrCreate(['id' => $this->jadwal_id], [
            'kelas_id' => $this->kelas_id,
            'mapel_id' => $this->mapel_id,
            'tutor_id' => $this->tutor_id,
            'hari' => $this->hari,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
        ]);

        session()->flash('message', $this->jadwal_id ? 'Jadwal berhasil diperbarui.' : 'Jadwal berhasil ditambahkan.');

        $this->closeModal();
        $this->dispatch('swal:modal', [
            'title' => 'Sukses!',
            'text' => 'Data jadwal berhasil disimpan.',
            'icon' => 'success'
        ]);
    }

    protected function checkOverlap($entityId, $hari, $start, $end, $field)
    {
        return Jadwal::where('hari', $hari)
            ->where($field, $entityId)
            ->where('id', '!=', $this->jadwal_id) // Exclude current if edit
            ->where(function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
                    // Logic: Overlap if (StartA < EndB) AND (EndA > StartB)
                    $q->where('jam_mulai', '<', $end)
                        ->where('jam_selesai', '>', $start);
                });
            })
            ->exists();
    }

    public function edit($id)
    {
        $this->authorizeAdmin();
        $jadwal = Jadwal::findOrFail($id);
        $this->jadwal_id = $id;
        $this->kelas_id = $jadwal->kelas_id;
        $this->mapel_id = $jadwal->mapel_id;
        $this->tutor_id = $jadwal->tutor_id;
        $this->hari = $jadwal->hari;
        // Format time properly for HTML time input (H:i)
        $this->jam_mulai = \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i');
        $this->jam_selesai = \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i');

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Hapus Jadwal?',
            'text' => 'Data jadwal ini akan dihapus permanen.',
            'icon' => 'warning',
            'id' => $id,
            'onConfirmed' => 'deleteJadwal'
        ]);
    }

    protected $listeners = ['deleteJadwal'];

    public function deleteJadwal($data)
    {
        $this->authorizeAdmin();
        Jadwal::find($data['id'])->delete();
        $this->dispatch('swal:modal', [
            'title' => 'Terhapus!',
            'text' => 'Jadwal berhasil dihapus.',
            'icon' => 'success'
        ]);
    }
    // Participants Management Properties
    public $managingJadwalId;
    public $managingKelasId;
    public $managingKelasName;
    public $selectedStudentId;
    public $isManageModalOpen = false;

    public function manageParticipants($jadwalId)
    {
        $jadwal = Jadwal::with('kelas')->findOrFail($jadwalId);
        $this->managingJadwalId = $jadwal->id;
        $this->managingKelasId = $jadwal->kelas_id;
        $this->managingKelasName = $jadwal->kelas->nama_kelas;
        $this->isManageModalOpen = true;
    }

    public function closeManageModal()
    {
        $this->isManageModalOpen = false;
        $this->reset(['managingJadwalId', 'managingKelasId', 'managingKelasName', 'selectedStudentId']);
    }

    public function getStudentsInClassProperty()
    {
        if (!$this->managingJadwalId)
            return collect();
        $jadwal = Jadwal::find($this->managingJadwalId);
        return $jadwal ? $jadwal->siswas()->orderBy('name')->get() : collect();
    }

    public function getAvailableStudentsProperty()
    {
        // Get all students NOT in the current schedule
        return User::where('role', UserRole::SISWA->value)
            ->whereDoesntHave('jadwalSiswas', function ($query) {
                $query->where('jadwal_id', $this->managingJadwalId);
            })
            ->with('kelas') // Eager load to show current class info text if applicable
            ->orderBy('name')
            ->get();
    }

    public function addStudentToClass()
    {
        $this->authorizeAdmin();

        $this->validate([
            'selectedStudentId' => 'required|exists:users,id',
        ]);

        $student = User::find($this->selectedStudentId);
        $jadwal = Jadwal::find($this->managingJadwalId);

        if ($student->role !== UserRole::SISWA) {
            $this->addError('selectedStudentId', 'User yang dipilih bukan siswa.');
            return;
        }

        // Attach student to schedule
        $jadwal->siswas()->syncWithoutDetaching([$student->id]);

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => 'Siswa berhasil ditambahkan ke jadwal ini.',
            'icon' => 'success'
        ]);

        $this->reset('selectedStudentId');
    }

    public function removeStudentFromClass($studentId)
    {
        $this->authorizeAdmin();
        $jadwal = Jadwal::find($this->managingJadwalId);

        if ($jadwal) {
            $jadwal->siswas()->detach($studentId);

            $this->dispatch('swal:modal', [
                'title' => 'Berhasil!',
                'text' => 'Siswa dikeluarkan dari jadwal ini.',
                'icon' => 'success'
            ]);
        }
    }
}
