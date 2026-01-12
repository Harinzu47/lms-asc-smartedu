<?php

namespace App\Livewire\Student\Tools;

use App\Events\WhiteboardClearEvent;
use App\Events\WhiteboardDrawEvent;
use App\Models\WhiteboardSession;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Papan Tulis - Siswa')]
class Whiteboard extends Component
{
    public ?WhiteboardSession $session = null;
    public string $sessionCode = '';
    public bool $isConnected = false;
    public string $errorMessage = '';

    public function mount($sessionCode = null)
    {
        if ($sessionCode) {
            $this->sessionCode = strtoupper($sessionCode);
            $this->joinSessionDirect();
        }
    }

    /**
     * Join session from URL parameter (no redirect needed)
     */
    protected function joinSessionDirect()
    {
        $session = WhiteboardSession::where('session_code', strtoupper($this->sessionCode))
            ->where('is_active', true)
            ->first();

        if (!$session) {
            $this->errorMessage = 'Sesi tidak ditemukan atau sudah berakhir.';
            return;
        }

        // Check if student is in the same class
        $user = auth()->user();
        if ($user->kelas_id !== $session->jadwal->kelas_id) {
            $this->errorMessage = 'Anda tidak terdaftar di kelas ini.';
            return;
        }

        $this->session = $session;
        $this->isConnected = true;
    }

    /**
     * Join session from form - redirect to URL with session code
     */
    public function joinSession()
    {
        $this->errorMessage = '';

        $session = WhiteboardSession::where('session_code', strtoupper($this->sessionCode))
            ->where('is_active', true)
            ->first();

        if (!$session) {
            $this->errorMessage = 'Sesi tidak ditemukan atau sudah berakhir.';
            return;
        }

        // Check if student is in the same class
        $user = auth()->user();
        if ($user->kelas_id !== $session->jadwal->kelas_id) {
            $this->errorMessage = 'Anda tidak terdaftar di kelas ini.';
            return;
        }

        // Redirect to URL with session code so it persists on refresh
        return $this->redirect(route('student.whiteboard', ['sessionCode' => strtoupper($this->sessionCode)]), navigate: true);
    }

    public function broadcastDraw($drawingData)
    {
        if ($this->session && $this->isConnected) {
            broadcast(new WhiteboardDrawEvent(
                $this->sessionCode,
                auth()->id(),
                auth()->user()->name,
                $drawingData
            ))->toOthers();
        }
    }

    public function broadcastClear()
    {
        if ($this->session && $this->isConnected) {
            broadcast(new WhiteboardClearEvent(
                $this->sessionCode,
                auth()->id(),
                auth()->user()->name
            ))->toOthers();
        }
    }

    public function render()
    {
        return view('livewire.student.tools.whiteboard')
            ->layout('components.layouts.student');
    }
}
