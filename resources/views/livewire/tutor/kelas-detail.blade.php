<div x-data="{ tab: 'materi' }">
    <x-slot name="header">
        Detail Kelas
    </x-slot>

    <!-- Header Info Card -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-l-4 border-teal-500 relative overflow-hidden">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center relative z-10">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">{{ $jadwal->mapel->nama_mapel }}</h2>
                <div class="flex items-center mt-3 text-gray-600 gap-3">
                    <span class="bg-teal-100 text-teal-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">{{ $jadwal->kelas->nama_kelas }}</span>
                    <span class="flex items-center text-sm font-medium">
                        <svg class="w-4 h-4 mr-1.5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        {{ $jadwal->hari }}
                    </span>
                    <span class="flex items-center text-sm font-medium">
                        <svg class="w-4 h-4 mr-1.5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                    </span>
                </div>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('tutor.kelas.index') }}" class="text-gray-500 hover:text-teal-600 text-sm font-medium flex items-center transition bg-gray-100 hover:bg-teal-50 px-4 py-2 rounded-lg">
                    &larr; Kembali ke Daftar Kelas
                </a>
            </div>
        </div>
        <!-- Decorative bg pattern -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-teal-50 rounded-full opacity-50 z-0"></div>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex space-x-1 rounded-xl bg-gray-200/80 p-1 mb-8 max-w-lg shadow-inner">
        <button @click="tab = 'materi'" 
                :class="{ 'bg-white shadow text-teal-700 font-bold': tab === 'materi', 'text-gray-600 hover:text-gray-800 hover:bg-gray-200': tab !== 'materi' }"
                class="w-full rounded-lg py-2.5 text-sm leading-5 transition duration-200 focus:outline-none">
            Materi Pelajaran
        </button>
        <button @click="tab = 'tugas'" 
                :class="{ 'bg-white shadow text-teal-700 font-bold': tab === 'tugas', 'text-gray-600 hover:text-gray-800 hover:bg-gray-200': tab !== 'tugas' }"
                class="w-full rounded-lg py-2.5 text-sm leading-5 transition duration-200 focus:outline-none">
            Tugas
        </button>
        <button @click="tab = 'penilaian'" 
                :class="{ 'bg-white shadow text-teal-700 font-bold': tab === 'penilaian', 'text-gray-600 hover:text-gray-800 hover:bg-gray-200': tab !== 'penilaian' }"
                class="w-full rounded-lg py-2.5 text-sm leading-5 transition duration-200 focus:outline-none">
            Penilaian
        </button>
        <button @click="tab = 'diskusi'" 
                :class="{ 'bg-white shadow text-teal-700 font-bold': tab === 'diskusi', 'text-gray-600 hover:text-gray-800 hover:bg-gray-200': tab !== 'diskusi' }"
                class="w-full rounded-lg py-2.5 text-sm leading-5 transition duration-200 focus:outline-none">
            Diskusi
        </button>
        <button @click="tab = 'peserta'" 
                :class="{ 'bg-white shadow text-teal-700 font-bold': tab === 'peserta', 'text-gray-600 hover:text-gray-800 hover:bg-gray-200': tab !== 'peserta' }"
                class="w-full rounded-lg py-2.5 text-sm leading-5 transition duration-200 focus:outline-none">
            Peserta
        </button>
    </div>

    <!-- ===== TAB MATERI ===== -->
    <div x-show="tab === 'materi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Upload Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b pb-4">
                        <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        Upload Materi Baru
                    </h3>
                    
                    <form wire:submit.prevent="saveMateri">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Materi</label>
                                <input type="text" wire:model="judul_materi" class="w-full rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500 bg-gray-50 focus:bg-white transition" placeholder="Contoh: Bab 1">
                                @error('judul_materi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">File (PDF/PPT/DOC)</label>
                                <div x-data="{ isUploading: false, progress: 0 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false"
                                     x-on:livewire-upload-error="isUploading = false; Swal.fire('Gagal', 'File terlalu besar (Max 2MB/10MB config) atau format salah.', 'error')"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                     class="relative group">
                                    
                                    <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-teal-50/50 hover:border-teal-400 transition cursor-pointer bg-gray-50">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-10 w-10 text-gray-400 group-hover:text-teal-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 justify-center">
                                                <label for="file-materi" class="relative cursor-pointer rounded-md font-medium text-teal-600 hover:text-teal-500 focus-within:outline-none">
                                                    <span>Upload a file</span>
                                                    <input id="file-materi" wire:model="file_materi" type="file" class="sr-only">
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">Max 10MB</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Progress -->
                                    <div x-show="isUploading" class="mt-2 w-full bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-teal-600 h-1.5 rounded-full transition-all duration-300" :style="`width: ${progress}%`"></div>
                                    </div>
                                    
                                    @if($file_materi)
                                        <p class="mt-2 text-sm text-teal-600 font-medium truncate flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            {{ $file_materi->getClientOriginalName() }}
                                        </p>
                                    @endif
                                </div>
                                @error('file_materi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                                <textarea wire:model="deskripsi_materi" rows="3" class="w-full rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500 bg-gray-50 focus:bg-white transition"></textarea>
                            </div>

                            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 focus:outline-none ring-teal-500 transition transform hover:-translate-y-0.5" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="saveMateri">Upload Materi</span>
                                <span wire:loading wire:target="saveMateri">Proses Upload...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Materi -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-4">Daftar Materi</h3>
                    
                    @forelse($materis as $materi)
                        <div class="flex items-start p-4 mb-4 bg-white rounded-lg border border-gray-200 hover:border-teal-300 hover:shadow-md transition group">
                            <div class="flex-shrink-0 mr-4">
                                <div class="h-12 w-12 rounded-lg bg-red-100 flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base font-bold text-gray-900 group-hover:text-teal-700 transition">{{ $materi->judul }}</h4>
                                <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $materi->deskripsi }}</p>
                                <p class="text-xs text-gray-400 mt-2">{{ $materi->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="ml-4 flex items-center space-x-2">
                                <button wire:click="downloadMateri({{ $materi->id }})" class="p-2 text-gray-400 hover:text-teal-600 hover:bg-teal-50 rounded-full transition" title="Download">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                </button>
                                <button wire:click="confirmDeleteMateri({{ $materi->id }})" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-full transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <p class="text-gray-500">Belum ada materi yang diupload.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- ===== TAB TUGAS ===== -->
    <div x-show="tab === 'tugas'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Buat Tugas -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-md p-6 sticky top-24 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b pb-4">
                        <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        Buat Tugas Baru
                    </h3>
                    <form wire:submit.prevent="saveTugas">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Tugas</label>
                                <input type="text" wire:model="judul_tugas" class="w-full rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500 bg-gray-50 focus:bg-white transition">
                                @error('judul_tugas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Deadline</label>
                                <input type="datetime-local" wire:model="deadline_tugas" class="w-full rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500 bg-gray-50 focus:bg-white transition">
                                @error('deadline_tugas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi & Instruksi</label>
                                <textarea wire:model="deskripsi_tugas" rows="4" class="w-full rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500 bg-gray-50 focus:bg-white transition"></textarea>
                            </div>

                            <button type="submit" class="w-full py-2.5 px-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                                Buat Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List Tugas -->
            <div class="lg:col-span-2">
                 <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-4">Daftar Tugas Aktif</h3>
                    
                    @forelse($tugases as $tugas)
                        <div class="flex items-center justify-between p-4 mb-4 bg-white rounded-lg border border-gray-200 hover:border-teal-300 hover:shadow-md transition">
                            <div class="flex-1">
                                <div class="flex items-center mb-1">
                                    <h4 class="text-base font-bold text-gray-900 mr-3">{{ $tugas->judul }}</h4>
                                    @php
                                        $isNear = \Carbon\Carbon::parse($tugas->batas_waktu)->diffInHours(now()) < 24 && \Carbon\Carbon::parse($tugas->batas_waktu)->isFuture();
                                        $isPassed = \Carbon\Carbon::parse($tugas->batas_waktu)->isPast();
                                    @endphp
                                    <span class="px-2 py-0.5 rounded text-xs font-semibold {{ $isPassed ? 'bg-red-100 text-red-800' : ($isNear ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800') }}">
                                        {{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y, H:i') }}
                                        {{ $isPassed ? '(Berakhir)' : '' }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-500 line-clamp-1 mb-2">{{ $tugas->deskripsi }}</p>
                                <div class="text-xs text-gray-400">
                                    Mengumpulkan: <span class="font-bold text-gray-700">{{ $tugas->pengumpulanTugas->count() }}</span> Siswa
                                </div>
                            </div>
                            <button wire:click="confirmDeleteTugas({{ $tugas->id }})" class="ml-4 p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full transition">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    @empty
                         <div class="text-center py-10">
                            <p class="text-gray-500">Belum ada tugas yang dibuat.</p>
                        </div>
                    @endforelse
                 </div>
            </div>
        </div>
    </div>

    <!-- ===== TAB PENILAIAN ===== -->
    <div x-show="tab === 'penilaian'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <!-- Filter Tugas -->
            <div class="flex items-center space-x-4 mb-6">
                <label class="font-semibold text-gray-700">Pilih Tugas:</label>
                <select wire:model.live="selectedTugasId" class="border-gray-300 focus:border-teal-500 focus:ring-teal-500 rounded-lg shadow-sm w-64">
                    <option value="">-- Pilih Tugas --</option>
                    @foreach($tugases as $t)
                        <option value="{{ $t->id }}">{{ $t->judul }}</option>
                    @endforeach
                </select>
            </div>

            @if($selectedTugasId)
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">File Jawaban</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-32">Nilai (0-100)</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $currentTugas = $tugases->find($selectedTugasId);
                            @endphp
                            @foreach($students as $student)
                                @php
                                    $submission = $student->pengumpulanTugas->first();
                                    $isSubmitted = $submission != null;
                                    $isLate = $isSubmitted && $submission->created_at > $currentTugas->batas_waktu;
                                @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">{{ $student->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $student->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($isSubmitted)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Sudah Mengumpul
                                            </span>
                                            @if($isLate)
                                                <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Telat
                                                </span>
                                            @endif
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Belum
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($isSubmitted && $submission->file_jawaban)
                                             <!-- Assuming file download link route exists or direct storage link -->
                                             <a href="{{ Storage::url($submission->file_jawaban) }}" target="_blank" class="text-indigo-600 hover:underline flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                                Lihat File
                                             </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($isSubmitted)
                                            {{ $submission->created_at->format('d M H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <input type="number" 
                                               wire:blur="saveNilai({{ $student->id }})" 
                                               wire:model.defer="nilaiInput.{{ $student->id }}"
                                               min="0" max="100"
                                               class="w-20 rounded border-gray-300 focus:ring-teal-500 focus:border-teal-500 text-center text-sm"
                                               placeholder="0">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Pilih Tugas Terlebih Dahulu</h3>
                    <p class="mt-1 text-sm text-gray-500">Pilih tugas diatas untuk melihat daftar pengumpulan dan melakukan penilaian.</p>
                </div>
            @endif
        </div>

    </div>

    <!-- ===== TAB DISKUSI ===== -->
    <div x-show="tab === 'diskusi'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        @livewire('partials.kelas-diskusi', ['jadwal' => $jadwal], key('diskusi-'.$jadwal->id))
    </div>

    <!-- ===== TAB PESERTA ===== -->
    <div x-show="tab === 'peserta'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Daftar Peserta Kelas ({{ $jadwal->kelas->siswas->count() }})
            </h3>

            @if($jadwal->kelas->siswas->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jadwal->kelas->siswas as $siswa)
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-100 hover:shadow-md hover:bg-white transition duration-200">
                            <div class="flex-shrink-0">
                                @if($siswa->profile_photo_path)
                                    <img class="h-12 w-12 rounded-full object-cover border-2 border-white shadow-sm" src="/storage/{{ $siswa->profile_photo_path }}" alt="{{ $siswa->name }}">
                                @else
                                    <div class="h-12 w-12 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-lg border-2 border-white shadow-sm">
                                        {{ substr($siswa->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 overflow-hidden">
                                <h4 class="text-sm font-bold text-gray-900 truncate">{{ $siswa->name }}</h4>
                                <p class="text-xs text-gray-500 truncate">{{ $siswa->email }}</p>
                                <span class="inline-flex mt-1 items-center px-2 py-0.5 rounded textxs font-medium bg-green-100 text-green-800">
                                    Siswa
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada peserta</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada siswa yang terdaftar di kelas ini.</p>
                </div>
            @endif
        </div>
    </div>

</div>
