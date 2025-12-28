<?php

namespace App\Livewire\Admin\Master;

use App\Models\Kelas;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Manajemen Kelas - Admin')]
class KelasManager extends Component
{
    public $nama_kelas;
    public $kelas_id;
    public $isModalOpen = false;

    protected $rules = [
        'nama_kelas' => 'required|string|max:255',
    ];

    public function render()
    {
        $kelasList = Kelas::withCount('siswas')->get();
        return view('livewire.admin.master.kelas-manager', [
            'kelasList' => $kelasList
        ])->layout('components.layouts.admin');
    }

    public function create()
    {
        $this->reset(['nama_kelas', 'kelas_id']);
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['nama_kelas', 'kelas_id']);
    }

    public function store()
    {
        $this->validate();

        Kelas::updateOrCreate(
            ['id' => $this->kelas_id],
            ['nama_kelas' => $this->nama_kelas]
        );

        session()->flash('message', $this->kelas_id ? 'Kelas berhasil diperbarui.' : 'Kelas berhasil ditambahkan.');
        
        $this->closeModal();
        $this->dispatch('swal:modal', [
            'title' => 'Sukses!',
            'text' => $this->kelas_id ? 'Data berhasil diperbarui.' : 'Data berhasil ditambahkan.',
            'icon' => 'success'
        ]);
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $this->kelas_id = $id;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data kelas dan siswa di dalamnya (jika ada) mungkin terpengaruh.',
            'icon' => 'warning',
            'id' => $id,
            'onConfirmed' => 'deleteKelas'
        ]);
    }

    protected $listeners = ['deleteKelas'];

    public function deleteKelas($data)
    {
        Kelas::find($data['id'])->delete();
        $this->dispatch('swal:modal', [
            'title' => 'Terhapus!',
            'text' => 'Data kelas berhasil dihapus.',
            'icon' => 'success'
        ]);
    }
}
