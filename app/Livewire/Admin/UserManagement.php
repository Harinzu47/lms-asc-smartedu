<?php

namespace App\Livewire\Admin;

use App\Enums\UserRole;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('User Management - Admin')]
class UserManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $filterRole = '';
    public $filterKelas = ''; // Add Filter by Class

    // Modal Properties
    public $user_id;
    public $name, $email, $password, $role, $nomor_telepon, $alamat, $status_aktif, $kelas_id;
    public $isModalOpen = false;
    public $isVerificationModalOpen = false;
    public $verification_photo;

    // Derived properties for UI
    public $roles = [];
    public $kelasList = [];

    public function mount()
    {
        // Security: Ensure only admin can access
        $this->authorizeAdmin();
        $this->roles = UserRole::cases();
        $this->kelasList = Kelas::all();
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
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterRole, function ($query) {
                $query->where('role', $this->filterRole);
            })
            ->when($this->filterKelas, function ($query) {
                $query->where('kelas_id', $this->filterKelas);
            })
            ->with('kelas') // Eager load kelas
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.user-management', [
            'users' => $users
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
        $this->reset(['user_id', 'name', 'email', 'password', 'role', 'nomor_telepon', 'alamat', 'status_aktif', 'kelas_id']);
        $this->status_aktif = true;
        $this->role = UserRole::SISWA->value;
    }

    public function store()
    {
        $this->authorizeAdmin();

        // Dynamic validation
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required',
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'status_aktif' => 'boolean',
        ];

        // Password required only on create
        if (!$this->user_id) {
            $rules['password'] = 'required|min:6';
        }

        // Kelas required if Siswa (Can be nullable depending on business logic, user asked for it to be fillable)
        if ($this->role === UserRole::SISWA->value) {
            // Allow nullable, but if filled must exist. Or admin wants to assign later? 
            // Request: "Jika role === 'siswa', maka kelas_id boleh diisi". Assuming nullable is fine.
            $rules['kelas_id'] = 'nullable|exists:kelas,id';
        } else {
            // Force null for non-students
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'nomor_telepon' => $this->nomor_telepon,
            'alamat' => $this->alamat,
            'status_aktif' => $this->status_aktif ?? false,
            'kelas_id' => ($this->role === UserRole::SISWA->value) ? ($this->kelas_id ?: null) : null,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->user_id], $data);

        session()->flash('message', $this->user_id ? 'User berhasil diperbarui.' : 'User berhasil dibuat.');

        $this->closeModal();
        $this->dispatch('swal:modal', [
            'title' => 'Sukses!',
            'text' => 'Data user berhasil disimpan.',
            'icon' => 'success'
        ]);
    }

    public function edit($id)
    {
        $this->authorizeAdmin();
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role->value;
        $this->nomor_telepon = $user->nomor_telepon;
        $this->alamat = $user->alamat;
        $this->status_aktif = $user->status_aktif;
        $this->kelas_id = $user->kelas_id;

        $this->openModal();
    }

    // ... existing toggleStatus ...
    public function toggleStatus($id)
    {
        $this->authorizeAdmin();
        $user = User::find($id);
        $user->status_aktif = !$user->status_aktif;
        $user->save();

        $this->dispatch('swal:modal', [
            'title' => $user->status_aktif ? 'Aktif!' : 'Non-Aktif!',
            'text' => 'Status user berhasil diubah.',
            'icon' => 'success'
        ]);
    }

    public function confirmResetPassword($id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Reset Password?',
            'text' => 'Password akan diubah menjadi "password".',
            'icon' => 'warning',
            'id' => $id,
            'onConfirmed' => 'resetPassword'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Hapus User?',
            'text' => 'Data user ini akan dihapus permanen.',
            'icon' => 'warning',
            'id' => $id,
            'onConfirmed' => 'deleteUser'
        ]);
    }

    protected $listeners = ['deleteUser', 'resetPassword'];

    public function deleteUser($data)
    {
        $this->authorizeAdmin();
        User::find($data['id'])->delete();
        $this->dispatch('swal:modal', [
            'title' => 'Terhapus!',
            'text' => 'User berhasil dihapus.',
            'icon' => 'success'
        ]);
    }

    public function resetPassword($data)
    {
        $this->authorizeAdmin();
        $user = User::find($data['id']);
        $user->password = Hash::make('password');
        $user->save();

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => 'Password berhasil direset menjadi "password".',
            'icon' => 'success'
        ]);
    }

    // Reset pagination when search changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterRole()
    {
        $this->resetPage();
    }

    public function updatedFilterKelas()
    {
        $this->resetPage();
    }

    // Verification Logic
    public function openVerification($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->verification_photo = $user->bukti_pembayaran;
        $this->isVerificationModalOpen = true;
    }

    public function closeVerificationModal()
    {
        $this->isVerificationModalOpen = false;
        $this->reset(['user_id', 'verification_photo', 'name']);
    }

    public function approvePayment()
    {
        $this->authorizeAdmin();
        $user = User::find($this->user_id);
        $user->status_aktif = true;
        // Optional: Maybe assign default class if logic exists
        $user->save();

        $this->closeVerificationModal();
        $this->dispatch('swal:modal', [
            'title' => 'Akun Diaktifkan!',
            'text' => 'Pembayaran diterima dan akun telah aktif.',
            'icon' => 'success'
        ]);
    }

    public function rejectPayment()
    {
        $this->authorizeAdmin();
        $user = User::find($this->user_id);
        if ($user->bukti_pembayaran) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->bukti_pembayaran);
        }
        $user->delete();

        $this->closeVerificationModal();
        $this->dispatch('swal:modal', [
            'title' => 'Ditolak!',
            'text' => 'Pendaftaran user telah ditolak dan data dihapus.',
            'icon' => 'warning'
        ]);
    }
}
