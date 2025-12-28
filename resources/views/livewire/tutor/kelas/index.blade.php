<div>
    <x-slot name="header">
        Daftar Kelas Saya
    </x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Kelas yang Diampu</h2>
        <p class="text-gray-500">Pilih kelas untuk mengelola materi, tugas, dan penilaian.</p>
    </div>

    @if($jadwals->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jadwals as $jadwal)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">
                    <div class="p-6 flex-1">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                                {{ $jadwal->hari }}
                            </span>
                            <span class="text-xs text-gray-500 font-medium">
                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-1 line-clamp-2" title="{{ $jadwal->mapel->nama_mapel }}">
                            {{ $jadwal->mapel->nama_mapel }}
                        </h3>
                        
                        <p class="text-gray-500 font-medium text-sm flex items-center mt-2">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            {{ $jadwal->kelas->nama_kelas }}
                        </p>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        <a href="{{ route('tutor.kelas.detail', $jadwal->id) }}" class="block w-full text-center bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Lihat Kelas
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada kelas</h3>
            <p class="mt-1 text-sm text-gray-500">Anda belum memiliki jadwal kelas yang aktif.</p>
        </div>
    @endif
</div>
