<div>
    <x-slot name="header">
        Monitoring Kelas
    </x-slot>

    <!-- Header Info & Stats -->
    <div class="mb-8 grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Info Kelas Card -->
        <div class="lg:col-span-1 bg-white rounded-xl shadow p-6 border-l-4 border-teal-500">
            <h2 class="text-xl font-bold text-gray-800">{{ $jadwal->mapel->nama_mapel }}</h2>
            <div class="mt-2 space-y-1 text-sm text-gray-600">
                <p><span class="font-semibold text-gray-900">Kelas:</span> {{ $jadwal->kelas->nama_kelas }}</p>
                <p><span class="font-semibold text-gray-900">Hari:</span> {{ $jadwal->hari }}, {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</p>
                <div class="flex items-center pt-2 mt-2 border-t">
                     <span class="font-semibold text-gray-900 mr-2">Tutor:</span>
                     <span class="bg-teal-100 text-teal-800 text-xs px-2 py-0.5 rounded-full font-bold">{{ $jadwal->tutor->name }}</span>
                </div>
            </div>
            <div class="mt-4">
                 <a href="{{ route('admin.schedule') }}" class="text-sm text-gray-500 hover:text-teal-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="lg:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Keaktifan -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Keaktifan Tutor</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_materi'] + $stats['total_tugas'] }}</h3>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-full text-blue-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">{{ $stats['total_materi'] }} Materi, {{ $stats['total_tugas'] }} Tugas</p>
            </div>

            <!-- Card 2: Total Pertemuan -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
                 <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pertemuan</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_pertemuan'] }}</h3>
                    </div>
                    <div class="p-3 bg-green-100 rounded-full text-green-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">Berdasarkan data presensi</p>
            </div>

            <!-- Card 3: Total Siswa -->
            <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
                 <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_siswa'] }}</h3>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-full text-purple-600">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                </div>
                 <p class="text-xs text-gray-500 mt-2">Siswa terdaftar aktif</p>
            </div>
        </div>
    </div>

    <!-- Main Content & Tabs -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden min-h-[500px]">
        <!-- Tabs Header -->
        <div class="bg-gray-50 border-b border-gray-200">
            <nav class="flex -mb-px">
                @foreach(['materi', 'tugas', 'diskusi', 'peserta', 'presensi'] as $tab)
                    <button wire:click="setTab('{{ $tab }}')"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition focus:outline-none {{ $activeTab === $tab ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        {{ ucfirst($tab) }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Tab Contents -->
        <div class="p-6">
            
            <!-- Tab Materi -->
            @if($activeTab === 'materi')
                <div>
                     <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Materi</h3>
                     @forelse($jadwal->materis as $materi)
                        <div class="flex items-center justify-between p-4 mb-3 bg-gray-50 rounded-lg border border-gray-100">
                             <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-red-100 flex items-center justify-center text-red-500 mr-4">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $materi->judul }}</h4>
                                    <p class="text-xs text-gray-500">{{ $materi->created_at->format('d M Y, H:i') }}</p>
                                </div>
                             </div>
                             <!-- Action (Download logic if needed, usually direct link to storage) -->
                             @if($materi->file_path)
                                <a href="{{ Storage::url($materi->file_path) }}" target="_blank" class="px-3 py-1 bg-white border border-gray-300 rounded text-sm text-gray-600 hover:bg-gray-50">Download</a>
                             @endif
                        </div>
                     @empty
                        <p class="text-gray-500 italic">Belum ada materi.</p>
                     @endforelse
                </div>
            @endif

            <!-- Tab Tugas -->
            @if($activeTab === 'tugas')
                 <div>
                     <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Tugas</h3>
                     @forelse($jadwal->tugases as $tugas)
                        <div class="p-4 mb-3 bg-gray-50 rounded-lg border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $tugas->judul }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $tugas->deskripsi }}</p>
                                    <div class="mt-2 text-xs text-gray-500">
                                        Deadline: <span class="{{ $tugas->batas_waktu < now() ? 'text-red-500' : 'text-green-600' }}">{{ \Carbon\Carbon::parse($tugas->batas_waktu)->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <button wire:click="showTugasDetail({{ $tugas->id }})" class="text-sm text-teal-600 hover:text-teal-800 font-medium underline">
                                            Lihat Detail Pengumpulan
                                        </button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="block text-2xl font-bold text-teal-600">{{ $tugas->pengumpulanTugas->count() }}</span>
                                    <span class="text-xs text-gray-500">Dikumpulkan</span>
                                </div>
                            </div>
                        </div>
                     @empty
                        <p class="text-gray-500 italic">Belum ada tugas.</p>
                     @endforelse
                </div>
            @endif

            <!-- Tab Diskusi -->
            @if($activeTab === 'diskusi')
                <div>
                     @livewire('partials.kelas-diskusi', ['jadwal' => $jadwal], key('diskusi-admin-'.$jadwal->id))
                </div>
            @endif

            <!-- Tab Peserta -->
            @if($activeTab === 'peserta')
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($jadwal->siswas as $siswa)
                        <div class="flex items-center p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold border-2 border-white shadow-sm">
                                {{ substr($siswa->name, 0, 1) }}
                            </div>
                            <div class="ml-3 overflow-hidden">
                                <h4 class="text-sm font-bold text-gray-900 truncate">{{ $siswa->name }}</h4>
                                <p class="text-xs text-gray-500 truncate">{{ $siswa->email }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($jadwal->siswas->count() === 0)
                    <p class="text-gray-500 italic">Belum ada peserta.</p>
                @endif
            @endif

            <!-- Tab Presensi (Audit) -->
            @if($activeTab === 'presensi')
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Presensi (Audit)</h3>
                    
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Hadir</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Sakit</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Izin</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Alpha</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($presensiHistory as $history)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($history->date)->translatedFormat('l, d F Y') }}
                                            <div class="text-xs text-gray-400 font-normal mt-0.5">Input: {{ \Carbon\Carbon::parse($history->created_at)->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">{{ $history->hadir }}</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">{{ $history->sakit }}</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">{{ $history->izin }}</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">{{ $history->alpha }}</span></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button wire:click="showPresensiDetail('{{ $history->date }}')" class="text-teal-600 hover:text-teal-900 font-semibold hover:underline">Lihat Detail</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 italic">Belum ada data presensi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- Modal Detail Tugas -->
    @if($isTugasModalOpen)
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <div class="fixed inset-0 bg-black/30 backdrop-blur-sm transition-opacity" aria-hidden="true" wire:click="closeTugasModal"></div>

                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-2xl">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                             <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">
                                    Detail Pengumpulan: <span class="text-teal-600">{{ $selectedTugasTitle }}</span>
                                </h3>
                                <div class="mt-4 max-h-96 overflow-y-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50 sticky top-0">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Dikumpulkan</th>
                                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Nilai</th>
                                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Jawaban</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($tugasSubmissionDetail as $detail)
                                                <tr>
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $detail['name'] }}</td>
                                                    <td class="px-4 py-4 whitespace-nowrap">
                                                        @if($detail['status'] == 'Submit')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Sudah Mengumpulkan</span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Belum Mengumpulkan</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">{{ $detail['submitted_at'] }}</td>
                                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">
                                                        {{ $detail['nilai'] ?? '-' }}
                                                    </td>
                                                    <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        @if($detail['file_path'])
                                                            <a href="{{ Storage::url($detail['file_path']) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 hover:underline">
                                                                Lihat File
                                                            </a>
                                                        @elseif($detail['status'] == 'Submit')
                                                             <span class="text-gray-400 italic">Tidak ada file</span>
                                                        @else
                                                            <span class="text-gray-300">-</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" wire:click="closeTugasModal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

        </div>
    </div>

    <!-- Modal Detail Presensi -->
    @if($isPresensiModalOpen)
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/10 backdrop-blur-sm transition-opacity" aria-hidden="true" wire:click="closePresensiModal"></div>

                <!-- Modal Panel -->
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                             <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Detail Presensi : {{ \Carbon\Carbon::parse($selectedPresensiDate)->translatedFormat('d F Y') }}
                                </h3>
                                <div class="mt-4 max-h-96 overflow-y-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($presensiDetail as $detail)
                                                <tr>
                                                    <td class="px-4 py-2 text-sm text-gray-900">{{ $detail['name'] }}</td>
                                                    <td class="px-4 py-2 whitespace-nowrap">
                                                        @php $status = strtolower($detail['status']); @endphp
                                                        @if($status == 'hadir')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Hadir</span>
                                                        @elseif($status == 'sakit')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Sakit</span>
                                                        @elseif($status == 'izin')
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Izin</span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Alpha</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $detail['waktu'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" wire:click="closePresensiModal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
