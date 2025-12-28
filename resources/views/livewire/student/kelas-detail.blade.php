<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $jadwal->mapel->nama_mapel }}
                </h2>
                <p class="text-sm text-gray-500">{{ $jadwal->kelas->nama_kelas }} &bull; {{ $jadwal->tutor->name }}</p>
            </div>
             <a href="{{ route('student.dashboard') }}" class="text-sm text-teal-600 hover:underline">&larr; Kembali ke Dashboard</a>
        </div>
    </x-slot>

    <!-- Tabs Header -->
    <div class="bg-white border-b border-gray-200 mt-6 rounded-t-xl overflow-hidden shadow-sm">
        <nav class="flex -mb-px">
            <button wire:click="$set('activeTab', 'materi')" 
                    class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition focus:outline-none {{ $activeTab === 'materi' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Materi Pelajaran
            </button>
            <button wire:click="$set('activeTab', 'tugas')" 
                    class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition focus:outline-none {{ $activeTab === 'tugas' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Tugas & Pengumpulan
            </button>
            <button wire:click="$set('activeTab', 'diskusi')" 
                    class="w-1/3 py-4 px-1 text-center border-b-2 font-medium text-sm transition focus:outline-none {{ $activeTab === 'diskusi' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Forum Diskusi
            </button>
        </nav>
    </div>

    <!-- Tab Contents -->
    <div class="mt-6">
        
        <!-- Materi Tab -->
        @if ($activeTab === 'materi')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($materis as $materi)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition p-5 flex flex-col items-start border-l-4 border-teal-500">
                         <div class="flex items-start justify-between w-full mb-3">
                            <div class="p-2 bg-teal-50 rounded-lg text-teal-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                         </div>
                         <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight">{{ $materi->judul }}</h3>
                         <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $materi->deskripsi }}</p>
                         
                         <div class="mt-auto w-full pt-4 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xs text-gray-400 font-medium">{{ $materi->created_at->format('d M Y') }}</span>
                            <button wire:click="downloadMateri({{ $materi->id }})" class="text-sm font-semibold text-teal-600 hover:text-teal-800 flex items-center transition">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                Download
                            </button>
                         </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-xl border border-gray-200 border-dashed">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada materi</h3>
                        <p class="mt-1 text-sm text-gray-500">Tutor belum mengupload materi pelajaran.</p>
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Tugas Tab -->
        @if ($activeTab === 'tugas')
            <div class="space-y-6">
                <!-- List Tugas -->
                 @forelse($tugases as $tugas)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h3 class="text-lg font-bold text-gray-800">{{ $tugas->judul }}</h3>
                                        @php
                                            $isNear = \Carbon\Carbon::parse($tugas->batas_waktu)->diffInHours(now()) < 24 && \Carbon\Carbon::parse($tugas->batas_waktu)->isFuture();
                                            $isPassed = \Carbon\Carbon::parse($tugas->batas_waktu)->isPast();
                                        @endphp
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $isPassed ? 'bg-red-100 text-red-800' : ($isNear ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800') }}">
                                            Deadline: {{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y, H:i') }}
                                        </span>
                                    </div>
                                    <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $tugas->deskripsi }}</p>
                                    
                                    <!-- Status Pengumpulan -->
                                    @php
                                        $mySubmission = $submissions->get($tugas->id);
                                    @endphp

                                    @if($mySubmission)
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-3 inline-flex flex-col gap-1 w-full md:w-auto">
                                            <div class="flex items-center text-green-700 font-semibold text-sm">
                                                <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                Sudah Dikumpulkan
                                            </div>
                                            <span class="text-xs text-green-600">Dikirim pada: {{ $mySubmission->created_at->format('d M Y H:i') }}</span>
                                            @if($mySubmission->nilai !== null)
                                                <span class="text-sm font-bold text-green-800 mt-1">Nilai: {{ $mySubmission->nilai }} / 100</span>
                                            @else
                                                <span class="text-xs text-gray-500 italic mt-1">Belum dinilai</span>
                                            @endif
                                        </div>
                                    @else
                                        <!-- Form Upload -->
                                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                            <h4 class="text-sm font-bold text-gray-700 mb-3">Kumpulkan Jawaban</h4>
                                            
                                            @if($isPassed)
                                                <div class="text-red-600 text-sm font-medium flex items-center">
                                                    <svg class="w-5 h-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                    Maaf, batas waktu pengumpulan sudah berakhir.
                                                </div>
                                            @else
                                                <form wire:submit.prevent="submitTugas({{ $tugas->id }})" class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                                                    <div class="flex-1 w-full">
                                                        <input type="file" wire:model="file_tugas" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition border border-gray-300 rounded-lg px-2 py-1 bg-white">
                                                         @error('file_tugas') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                                    </div>
                                                    <button type="submit" class="px-4 py-2 bg-teal-600 text-white text-sm font-semibold rounded-lg hover:bg-teal-700 transition shadow-sm w-full sm:w-auto" wire:loading.attr="disabled">
                                                        <span wire:loading.remove wire:target="submitTugas, file_tugas">Kirim</span>
                                                        <span wire:loading wire:target="submitTugas, file_tugas">Proses...</span>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-xl border border-gray-200 border-dashed">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada tugas aktif</h3>
                        <p class="mt-1 text-sm text-gray-500">Saat ini belum ada tugas yang perlu dikerjakan.</p>
                    </div>
                @endforelse
            </div>
        @endif

        <!-- Diskusi Tab -->
        @if ($activeTab === 'diskusi')
            <div>
                @livewire('partials.kelas-diskusi', ['jadwal' => $jadwal], key('diskusi-student-'.$jadwal->id))
            </div>
        @endif

    </div>
</div>
