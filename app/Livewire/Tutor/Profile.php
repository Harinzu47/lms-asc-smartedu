<?php

namespace App\Livewire\Tutor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Ubah Profile - Tutor')]
class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $jenis_kelamin;
    public $nomor_telepon;
    public $alamat;
    public $password; // For password change link, likely separate or modal, but prompt says "Link Ganti password". I won't implement logic unless asked.
    
    public $photo;
    public $existingPhoto;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->jenis_kelamin = $user->jenis_kelamin ?? 'Laki-laki'; // Default or from DB
        $this->nomor_telepon = $user->nomor_telepon;
        $this->alamat = $user->alamat;
        $this->existingPhoto = $user->profile_photo_path;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function save()
    {
        $this->validate([
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'photo' => 'nullable|image|max:1024',
        ]);

        $user = Auth::user();

        if ($this->photo) {
            // Delete old photo if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $path = $this->photo->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->nomor_telepon = $this->nomor_telepon;
        $user->alamat = $this->alamat;
        $user->save();

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => 'Profile berhasil diperbarui.',
            'icon' => 'success'
        ]);
        
        // Refresh component state
        $this->existingPhoto = $user->profile_photo_path;
        $this->photo = null;
    }

    public function render()
    {
        return view('livewire.tutor.profile')->layout('components.layouts.tutor');
    }
}
