<div>
    <x-slot name="header">Jadwal Mengajar</x-slot>

    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Jadwal Lengkap</h2>
            <p class="text-gray-500">Berikut adalah jadwal mengajar Anda di semester ini.</p>
        </div>
        <div class="relative w-full md:w-64">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </span>
            <input wire:model.live="search" type="text" class="pl-10 block w-full rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500 bg-white shadow-sm transition" placeholder="Cari mapel atau kelas...">
        </div>
    </div>

    <div class="space-y-8">
        @forelse($groupedJadwals as $hari => $jadwals)
            <div class="bg-white rounded-xl shadow border border-gray-100 overflow-hidden">
                <div class="bg-teal-50 px-6 py-4 border-b border-teal-100 flex items-center">
                    <svg class="w-5 h-5 text-teal-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <h3 class="text-lg font-bold text-teal-800">{{ $hari }}</h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($jadwals as $jadwal)
                        <div class="p-6 hover:bg-gray-50 transition flex flex-col md:flex-row md:items-center justify-between group">
                            <div class="flex items-start md:items-center space-x-4">
                                <div class="px-4 py-2 bg-gray-100 rounded-lg text-center min-w-[100px]">
                                    <span class="block text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</span>
                                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Sampai {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900 group-hover:text-teal-600 transition">{{ $jadwal->mapel->nama_mapel }}</h4>
                                    <div class="flex items-center text-gray-500 text-sm mt-1 space-x-4">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                            {{ $jadwal->kelas->nama_kelas }}
                                        </span>
                                        <!-- Assuming 'ruang' field doesn't exist yet but user asked for "Ruang". I'll omit or use placeholder if not in model. Model Jadwal has no 'ruang'. I'll skip. -->
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 flex items-center">
                                <a href="{{ route('tutor.kelas.detail', $jadwal->id) }}" class="text-sm font-medium text-teal-600 hover:text-teal-800 hover:underline">
                                    Lihat Kelas &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal</h3>
                <p class="mt-1 text-sm text-gray-500">Jadwal mengajar belum tersedia atau tidak ditemukan sesuai pencarian.</p>
            </div>
        @endforelse
    </div>
</div>
