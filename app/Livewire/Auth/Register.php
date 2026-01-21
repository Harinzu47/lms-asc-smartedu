<?php

namespace App\Livewire\Auth;

use App\Enums\UserRole;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.guest')]
#[Title('Daftar - ASC SmartEdu')]
class Register extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:255')]
    public string $name = '';

    #[Rule('required|string|max:500')]
    public string $alamat = '';

    #[Rule('required|string|max:20')]
    public string $nomor_telepon = '';

    #[Rule('required|in:L,P')]
    public string $jenis_kelamin = '';

    #[Rule('required|email|unique:users,email')]
    public string $email = '';

    #[Rule('required|min:8')]
    public string $password = '';

    #[Rule('nullable|exists:kelas,id')]
    public ?int $kelas_id = null;

    #[Rule('required|mimes:jpg,jpeg,png|max:2048')]
    public $bukti_pembayaran = null;

    public function register(): void
    {
        $this->validate();

        // Use DB transaction to ensure data integrity
        // If file upload succeeds but user create fails, the entire operation will rollback
        $user = DB::transaction(function () {
            $buktiPath = null;
            if ($this->bukti_pembayaran) {
                // Use hashName for secure random filename
                $buktiPath = $this->bukti_pembayaran->storeAs(
                    'payments',
                    $this->bukti_pembayaran->hashName(),
                    'public'
                );
            }

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'role' => UserRole::SISWA,
                'nomor_telepon' => $this->nomor_telepon,
                'alamat' => $this->alamat,
                'status_aktif' => false, // Perlu verifikasi admin
                'bukti_pembayaran' => $buktiPath,
                'kelas_id' => $this->kelas_id,
            ]);

            return $user;
        });

        event(new Registered($user));

        session()->flash('success', 'Pendaftaran berhasil! Silakan tunggu Admin memverifikasi pembayaran Anda untuk mengaktifkan akun.');

        $this->redirect(route('login'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register', [
            'kelasList' => Kelas::all(),
        ]);
    }
}
