<?php

namespace App\Livewire\Tutor\Tools;

use App\Events\WhiteboardClearEvent;
use App\Events\WhiteboardDrawEvent;
use App\Models\Jadwal;
use App\Models\Materi;
use App\Models\WhiteboardSession;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Papan Tulis Digital - Tutor')]
class Whiteboard extends Component
{
    public Jadwal $jadwal;
    public ?WhiteboardSession $session = null;
    public bool $sessionActive = false;
    public string $sessionCode = '';

    public function mount(Jadwal $jadwal)
    {
        // Verify tutor ownership
        if ($jadwal->tutor_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke kelas ini.');
        }
        $this->jadwal = $jadwal;

        // Check for existing active session
        $existingSession = WhiteboardSession::where('jadwal_id', $jadwal->id)
            ->where('created_by', auth()->id())
            ->where('is_active', true)
            ->first();

        if ($existingSession) {
            $this->session = $existingSession;
            $this->sessionActive = true;
            $this->sessionCode = $existingSession->session_code;
        }
    }

    public function startSession()
    {
        // Create new session
        $this->session = WhiteboardSession::create([
            'jadwal_id' => $this->jadwal->id,
            'created_by' => auth()->id(),
            'is_active' => true,
        ]);

        $this->sessionActive = true;
        $this->sessionCode = $this->session->session_code;

        $this->dispatch('swal:modal', [
            'title' => 'Sesi Dimulai!',
            'text' => 'Kode sesi: ' . $this->sessionCode . '. Bagikan ke siswa untuk bergabung.',
            'icon' => 'success'
        ]);
    }

    public function endSession()
    {
        if ($this->session) {
            $this->session->update(['is_active' => false]);
            $this->session = null;
            $this->sessionActive = false;
            $this->sessionCode = '';

            $this->dispatch('swal:modal', [
                'title' => 'Sesi Berakhir',
                'text' => 'Sesi whiteboard telah ditutup.',
                'icon' => 'info'
            ]);
        }
    }

    public function broadcastDraw($drawingData)
    {
        if ($this->session && $this->sessionActive) {
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
        if ($this->session && $this->sessionActive) {
            broadcast(new WhiteboardClearEvent(
                $this->sessionCode,
                auth()->id(),
                auth()->user()->name
            ))->toOthers();
        }
    }

    public function saveCanvasState($canvasJson)
    {
        if ($this->session) {
            $this->session->update(['canvas_data' => $canvasJson]);
        }
    }

    public function saveWhiteboard($dataUrl)
    {
        // Validate the data URL format
        if (!preg_match('/^data:image\/png;base64,/', $dataUrl)) {
            $this->dispatch('swal:modal', [
                'title' => 'Error!',
                'text' => 'Format gambar tidak valid.',
                'icon' => 'error'
            ]);
            return;
        }

        // Remove the data URL prefix to get pure base64
        $base64Data = preg_replace('/^data:image\/png;base64,/', '', $dataUrl);
        $imageData = base64_decode($base64Data);

        if ($imageData === false) {
            $this->dispatch('swal:modal', [
                'title' => 'Error!',
                'text' => 'Gagal memproses gambar.',
                'icon' => 'error'
            ]);
            return;
        }

        // Generate unique filename
        $timestamp = now()->format('Ymd_His');
        $filename = "whiteboard_{$timestamp}.png";
        $path = "materi/{$filename}";

        // Save the image to storage
        Storage::disk('public')->put($path, $imageData);

        // Create materi record
        $tanggal = now()->format('d M Y');
        Materi::create([
            'jadwal_id' => $this->jadwal->id,
            'judul' => "Catatan Papan Tulis - {$tanggal}",
            'file_path' => $path,
            'deskripsi' => 'Digambar menggunakan Digital Whiteboard',
        ]);

        // Show success notification
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => 'Gambar berhasil disimpan sebagai materi.',
            'icon' => 'success'
        ]);

        // Redirect to KelasDetail with materi tab
        return $this->redirect(route('tutor.kelas.detail', $this->jadwal) . '?tab=materi', navigate: true);
    }

    public function render()
    {
        return view('livewire.tutor.tools.whiteboard')
            ->layout('components.layouts.tutor');
    }
}
