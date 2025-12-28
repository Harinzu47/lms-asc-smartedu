<div>
    <x-slot name="header">Kelas Saya</x-slot>

    <!-- Search & Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Mata Pelajaran</h2>
            <p class="text-gray-500">Berikut adalah semua kelas dan mata pelajaran yang Anda ikuti.</p>
        </div>
        <div class="w-full md:w-72">
            <input wire:model.live="search" type="text" class="w-full rounded-lg border-gray-300 focus:ring-teal-500 focus:border-teal-500 shadow-sm" placeholder="Cari mapel atau guru...">
        </div>
    </div>

    <div class="space-y-8">
        @if(auth()->user()->kelas_id)
            @forelse($groupedJadwals as $hari => $jadwals)
                <div>
                    <div class="flex items-center mb-4">
                        <span class="w-2 h-8 bg-teal-500 rounded-full mr-3"></span>
                        <h3 class="text-xl font-bold text-gray-800">{{ $hari }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($jadwals as $jadwal)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition group overflow-hidden flex flex-col">
                                <div class="p-6 flex-1">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="h-12 w-12 rounded-lg bg-teal-50 flex items-center justify-center text-teal-600">
                                             <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg>
                                        </div>
                                        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                        </span>
                                    </div>
                                    
                                    <h4 class="font-bold text-lg text-gray-900 mb-1 group-hover:text-teal-600 transition">{{ $jadwal->mapel->nama_mapel }}</h4>
                                    <p class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        {{ $jadwal->tutor->name ?? 'Belum ada tutor' }}
                                    </p>
                                </div>
                                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                                    <a href="{{ route('student.kelas.detail', $jadwal->id) }}" class="block w-full text-center bg-white border border-gray-300 text-gray-700 font-bold py-2 rounded-lg hover:bg-teal-600 hover:text-white hover:border-teal-600 transition">
                                        Masuk Kelas
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-xl shadow border border-gray-100">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak ada kelas ditemukan</h3>
                    <p class="mt-1 text-gray-500">Jadwal kelas belum tersedia untuk pencarian ini.</p>
                </div>
            @endforelse
        @else
             <div class="text-center py-12 bg-white rounded-xl shadow border border-gray-100">
                <div class="h-16 w-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <h3 class="mt-2 text-xl font-bold text-gray-900">Anda belum terdaftar di kelas!</h3>
                <p class="mt-1 text-gray-500">Silakan hubungi Admin untuk dimasukkan ke dalam kelas agar jadwal muncul.</p>
            </div>
        @endif
    </div>
</div>
