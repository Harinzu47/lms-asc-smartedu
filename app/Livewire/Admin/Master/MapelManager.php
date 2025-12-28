<?php

namespace App\Livewire\Admin\Master;

use App\Models\MataPelajaran;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Manajemen Mata Pelajaran - Admin')]
class MapelManager extends Component
{
    public $nama_mapel;
    public $mapel_id;
    public $isModalOpen = false;

    protected $rules = [
        'nama_mapel' => 'required|string|max:255',
    ];

    public function render()
    {
        $mapelList = MataPelajaran::orderBy('nama_mapel')->get();
        return view('livewire.admin.master.mapel-manager', [
            'mapelList' => $mapelList
        ])->layout('components.layouts.admin');
    }

    public function create()
    {
        $this->reset(['nama_mapel', 'mapel_id']);
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['nama_mapel', 'mapel_id']);
    }

    public function store()
    {
        $this->validate();

        MataPelajaran::updateOrCreate(
            ['id' => $this->mapel_id],
            ['nama_mapel' => $this->nama_mapel]
        );

        session()->flash('message', $this->mapel_id ? 'Mata Pelajaran berhasil diperbarui.' : 'Mata Pelajaran berhasil ditambahkan.');
        
        $this->closeModal();
        $this->dispatch('swal:modal', [
            'title' => 'Sukses!',
            'text' => $this->mapel_id ? 'Data berhasil diperbarui.' : 'Data berhasil ditambahkan.',
            'icon' => 'success'
        ]);
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $this->mapel_id = $id;
        $this->nama_mapel = $mapel->nama_mapel;
        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('swal:confirm', [
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data jadwal yang terkait mapel ini mungkin terpengaruh.',
            'icon' => 'warning',
            'id' => $id,
            'onConfirmed' => 'deleteMapel'
        ]);
    }

    protected $listeners = ['deleteMapel'];

    public function deleteMapel($data)
    {
        MataPelajaran::find($data['id'])->delete();
        $this->dispatch('swal:modal', [
            'title' => 'Terhapus!',
            'text' => 'Data Mata Pelajaran berhasil dihapus.',
            'icon' => 'success'
        ]);
    }
}
