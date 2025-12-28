<?php

namespace App\Livewire\Auth;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Login - ASC SmartEdu')]
class Login extends Component
{
    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required|min:6')]
    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('Email atau password yang Anda masukkan salah.'),
            ]);
        }

        session()->regenerate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if user is active
        if (!$user->status_aktif) {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => __('Akun Anda belum diaktifkan oleh Admin.'),
            ]);
        }

        // Redirect based on role
        if ($user->hasRole(UserRole::ADMIN)) {
            $this->redirect(route('admin.dashboard'), navigate: true);
        } elseif ($user->hasRole(UserRole::TUTOR)) {
            $this->redirect(route('tutor.dashboard'), navigate: true);
        } else {
            $this->redirect(route('student.dashboard'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
