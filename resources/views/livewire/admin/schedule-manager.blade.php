<div>
    <x-slot name="header">
        Manajemen Jadwal Kelas
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <!-- Toolbar -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Jadwal</h2>
            
            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <!-- Filter Hari -->
                <select wire:model.live="filterHari" class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm">
                    <option value="">Semua Hari</option>
                    @foreach($hariList as $h)
                        <option value="{{ $h }}">{{ $h }}</option>
                    @endforeach
                </select>

                <!-- Filter Kelas -->
                <select wire:model.live="filterKelas" class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-md shadow-sm">
                    <option value="">Semua Kelas</option>
                    @foreach($kelasList as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>

                <button wire:click="create" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded transition duration-200 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Jadwal
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari & Jam</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $jadwal->hari }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $jadwal->kelas->nama_kelas }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $jadwal->mapel->nama_mapel }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-xs">
                                        {{ substr($jadwal->tutor->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $jadwal->tutor->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="manageParticipants({{ $jadwal->id }})" class="text-green-600 hover:text-green-900 mr-3" title="Kelola Peserta">
                                    <svg class="w-5 h-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                </button>
                                <a href="{{ route('admin.monitoring.kelas', $jadwal->id) }}" class="text-teal-600 hover:text-teal-900 mr-3" title="Monitor Kelas">
                                    <svg class="w-5 h-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                </a>
                                <button wire:click="edit({{ $jadwal->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                <button wire:click="confirmDelete({{ $jadwal->id }})" class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada jadwal yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $jadwals->links() }}
        </div>
    </div>

    <!-- Modal (Tailwind UI Dialog Pattern) -->
    <div x-data="{ open: @entangle('isModalOpen') }" x-show="open" x-cloak class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <!-- Backdrop -->
        <div x-show="open" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-black/30 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                
                <div x-show="open" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                     @click.away="open = false">
                     
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                            {{ $jadwal_id ? 'Edit Jadwal' : 'Tambah Jadwal' }}
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Kelas Selection -->
                            <div>
                                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select wire:model="kelas_id" id="kelas_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($kelasList as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Mapel Selection -->
                            <div>
                                <label for="mapel_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                                <select wire:model="mapel_id" id="mapel_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                                    <option value="">-- Pilih Mapel --</option>
                                    @foreach($mapelList as $m)
                                        <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                    @endforeach
                                </select>
                                @error('mapel_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tutor Selection -->
                            <div>
                                <label for="tutor_id" class="block text-sm font-medium text-gray-700">Tutor Pengajar</label>
                                <select wire:model="tutor_id" id="tutor_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                                    <option value="">-- Pilih Tutor --</option>
                                    @foreach($tutorList as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                                @error('tutor_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Hari & Jam Grid -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-3 md:col-span-1">
                                    <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                                    <select wire:model="hari" id="hari" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                                        <option value="">Pilih...</option>
                                        @foreach($hariList as $h)
                                            <option value="{{ $h }}">{{ $h }}</option>
                                        @endforeach
                                    </select>
                                    @error('hari') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="col-span-3 md:col-span-1">
                                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                    <input type="time" wire:model="jam_mulai" id="jam_mulai" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                                    @error('jam_mulai') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-3 md:col-span-1">
                                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                    <input type="time" wire:model="jam_selesai" id="jam_selesai" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500">
                                    @error('jam_selesai') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="store" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-teal-600 text-base font-medium text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Jadwal
                        </button>
                        <button wire:click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Manage Participants Modal -->
    <div x-data="{ open: @entangle('isManageModalOpen') }" x-show="open" x-cloak class="relative z-50">
        <div x-show="open" 
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-black/30 backdrop-blur-sm transition-opacity"></div>
        
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="open" @click.away="open = false"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-2xl">
                    
                    <!-- Header -->
                    <div class="bg-gray-100 px-4 py-3 sm:px-6 border-b flex justify-between items-center">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Kelola Peserta - <span class="font-bold text-teal-600">{{ $managingKelasName }}</span>
                        </h3>
                        <button wire:click="closeManageModal" class="text-gray-400 hover:text-gray-500">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="px-4 py-4 sm:px-6 space-y-6">
                        <!-- Add Student Section -->
                        <div class="bg-green-50 p-4 rounded-md border border-green-100">
                            <h4 class="text-sm font-medium text-green-800 mb-2">Tambah Siswa ke Jadwal Ini</h4>
                            <div class="flex gap-2">
                                <div class="flex-grow">
                                    <select wire:model="selectedStudentId" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach($this->availableStudents as $student)
                                            <option value="{{ $student->id }}">
                                                {{ $student->name }} 
                                                @if($student->kelas)
                                                    (Kelas Asal: {{ $student->kelas->nama_kelas }})
                                                @else
                                                    (Belum Punya Kelas)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedStudentId') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <button wire:click="addStudentToClass" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-sm text-sm whitespace-nowrap">
                                    Masukkan
                                </button>
                            </div>
                        </div>

                        <!-- Current Students List -->
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Daftar Siswa di Jadwal Ini ({{ $this->studentsInClass->count() }})</h4>
                            <div class="overflow-x-auto border rounded-lg max-h-64 overflow-y-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50 sticky top-0">
                                        <tr>
                                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($this->studentsInClass as $student)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $student->name }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $student->email }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-right text-sm">
                                                    <button wire:click="removeStudentFromClass({{ $student->id }})" class="text-red-600 hover:text-red-900 font-medium" title="Keluarkan dari kelas">
                                                        Keluarkan
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-3 py-4 text-center text-sm text-gray-500 italic">Belum ada siswa di kelas ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end">
                         <button wire:click="closeManageModal" type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
