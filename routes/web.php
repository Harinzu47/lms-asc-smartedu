<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', App\Livewire\Home::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin & Tutor Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth'])->group(function () { // Add admin middleware check in production
    Route::get('/', function () {
        return view('admin.dashboard'); // Ensure this view exists, or use a component
    })->name('admin.dashboard');

    // Livewire Components
    Route::get('/users', App\Livewire\Admin\UserManagement::class)->name('admin.users');
    Route::get('/schedule', App\Livewire\Admin\ScheduleManager::class)->name('admin.schedule');
    Route::get('/master/kelas', App\Livewire\Admin\Master\KelasManager::class)->name('admin.master.kelas');
    Route::get('/master/mapel', App\Livewire\Admin\Master\MapelManager::class)->name('admin.master.mapel');
    Route::get('/monitoring/{jadwal}', App\Livewire\Admin\Monitoring\KelasDetail::class)->name('admin.monitoring.kelas');
});

// Tutor Routes
Route::middleware(['auth'])->prefix('tutor')->group(function () {
    Route::get('/dashboard', App\Livewire\Tutor\Dashboard::class)->name('tutor.dashboard');
    Route::get('/profile', App\Livewire\Tutor\Profile::class)->name('tutor.profile');
    Route::get('/kelas', App\Livewire\Tutor\Kelas\Index::class)->name('tutor.kelas.index');
    Route::get('/kelas/{jadwal}', App\Livewire\Tutor\KelasDetail::class)->name('tutor.kelas.detail');
    Route::get('/kelas/{jadwal}/whiteboard', App\Livewire\Tutor\Tools\Whiteboard::class)->name('tutor.whiteboard');
    Route::get('/jadwal', App\Livewire\Tutor\Jadwal\Index::class)->name('tutor.jadwal');
    Route::get('/presensi', App\Livewire\Tutor\Presensi\Index::class)->name('tutor.presensi.index');
    Route::get('/presensi/{jadwal}/riwayat', App\Livewire\Tutor\Presensi\Riwayat::class)->name('tutor.presensi.riwayat');
    Route::get('/presensi/{jadwal}/input', App\Livewire\Tutor\Presensi\Create::class)->name('tutor.presensi.create');
});

Route::middleware(['auth'])->prefix('student')->group(function () {
    Route::get('/dashboard', App\Livewire\Student\Dashboard::class)->name('student.dashboard');
    Route::get('/profile', App\Livewire\Student\Profile::class)->name('student.profile');
    Route::get('/kelas', App\Livewire\Student\Kelas\Index::class)->name('student.kelas.index');
    Route::get('/kelas/{jadwal}', App\Livewire\Student\KelasDetail::class)->name('student.kelas.detail');
    Route::get('/pembayaran', App\Livewire\Student\Pembayaran::class)->name('student.pembayaran');
    Route::get('/whiteboard/{sessionCode?}', App\Livewire\Student\Tools\Whiteboard::class)->name('student.whiteboard');
});

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});
