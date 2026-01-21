<?php

namespace App\Livewire\Student;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Profile Saya - Student')]
class Profile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $nomor_telepon;
    public $alamat;
    public $photo;
    public $existingPhoto;

    // Password change
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nomor_telepon = $user->nomor_telepon;
        $this->alamat = $user->alamat;
        $this->existingPhoto = $user->profile_photo_path;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'mimes:jpg,jpeg,png|max:1024', // 1MB Max, strict MIME
        ]);
    }

    public function saveProfile()
    {
        $this->validate([
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();

        if ($this->photo) {
            if ($user->profile_photo_path) {
                Storage::delete($user->profile_photo_path);
            }
            // Use hashName for secure random filename
            $path = $this->photo->storeAs(
                'profile-photos',
                $this->photo->hashName(),
                'public'
            );
            $user->profile_photo_path = $path;
        }

        $user->nomor_telepon = $this->nomor_telepon;
        $user->alamat = $this->alamat;
        $user->save();

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => 'Profil berhasil diperbarui.',
            'icon' => 'success'
        ]);
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->forceFill([
            'password' => Hash::make($this->new_password),
        ])->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => 'Password berhasil diubah.',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.student.profile')->layout('components.layouts.student');
    }
}
