<?php

namespace App\Livewire\Partials;

use App\Models\Comment;
use App\Models\Discussion;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class KelasDiskusi extends Component
{
    public Jadwal $jadwal;
    public $judulBaru;
    public $kontenBaru;
    public $komentarBaru = []; // [discussion_id => 'konten']

    public function mount(Jadwal $jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function createPost()
    {
        $this->validate([
            'judulBaru' => 'required|string|max:255',
            'kontenBaru' => 'required|string',
        ]);

        Discussion::create([
            'jadwal_id' => $this->jadwal->id,
            'user_id' => Auth::id(),
            'judul' => $this->judulBaru,
            'konten' => $this->kontenBaru,
        ]);

        $this->reset(['judulBaru', 'kontenBaru']);
        $this->dispatch('swal:modal', ['title'=>'Berhasil!', 'text'=>'Diskusi berhasil diposting.', 'icon'=>'success']);
    }

    public function toggleLike($discussionId)
    {
        $discussion = Discussion::findOrFail($discussionId);
        $user = Auth::user();

        if ($discussion->isLikedBy($user)) {
            $discussion->likes()->detach($user->id);
        } else {
            $discussion->likes()->attach($user->id);
        }
    }

    public function postComment($discussionId)
    {
        $this->validate([
            "komentarBaru.{$discussionId}" => 'required|string',
        ]);

        Comment::create([
            'discussion_id' => $discussionId,
            'user_id' => Auth::id(),
            'konten' => $this->komentarBaru[$discussionId],
        ]);

        $this->komentarBaru[$discussionId] = ''; // Reset input
    }

    public function render()
    {
        $discussions = Discussion::with(['author', 'comments.author', 'likes', 'jadwal.mapel'])
            ->whereHas('jadwal', function($q) {
                $q->where('kelas_id', $this->jadwal->kelas_id)
                  ->where('mapel_id', $this->jadwal->mapel_id);
            })
            ->latest()
            ->get();

        return view('livewire.partials.kelas-diskusi', [
            'discussions' => $discussions
        ]);
    }
}
