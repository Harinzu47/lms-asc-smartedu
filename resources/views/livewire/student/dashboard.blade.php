<div class="space-y-8">
    
    <!-- Header Title -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
    </div>

    <!-- Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Kelas -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center text-center hover:shadow-md transition">
            <div class="h-12 w-12 rounded-full bg-pink-100 flex items-center justify-center mb-4">
                 <svg class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $totalKelas }}</h3>
            <p class="text-gray-500 text-sm font-medium">Total Kelas</p>
        </div>

        <!-- Kehadiran -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col items-center justify-center text-center hover:shadow-md transition">
            <div class="h-12 w-12 rounded-full bg-teal-100 flex items-center justify-center mb-4">
                 <svg class="h-6 w-6 text-teal-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-800">{{ $attendanceRate }}%</h3>
            <p class="text-gray-500 text-sm font-medium">Tingkat Kehadiran</p>
        </div>

        <!-- Langganan -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-4 hover:shadow-md transition">
             <div class="shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                 <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div class="text-center md:text-left">
                <h4 class="font-bold text-gray-800">Langganan Aktif</h4>
                <p class="text-sm font-bold text-gray-900 mt-1">1 Bulan</p>
                <div class="text-xs text-gray-500 mt-2 space-y-1">
                    <p>Aktif sejak: {{ now()->subDays(2)->translatedFormat('d F Y') }}</p>
                    <p>Berakhir: {{ now()->addDays(28)->translatedFormat('d F Y') }}</p>
                    <p class="text-teal-600 font-medium">Sisa: 28 hari</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Section -->
    <div>
        <h3 class="text-lg font-bold text-gray-800 mb-4">Jadwal Kelas</h3>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-teal-700 px-6 py-4 grid grid-cols-12 gap-4 text-white font-medium text-sm">
                <div class="col-span-2">Jam</div>
                <div class="col-span-6">Mata Pelajaran</div>
                <div class="col-span-2">Ruang</div>
                <div class="col-span-2 text-right">Aksi</div>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($jadwalsToday as $jadwal)
                    <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition">
                         <div class="col-span-2 text-sm text-gray-600 font-medium">
                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                         </div>
                         <div class="col-span-6">
                            <p class="text-sm font-bold text-gray-800">{{ $jadwal->mapel->nama_mapel }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $jadwal->tutor->name ?? 'Tutor' }}</p>
                         </div>
                         <div class="col-span-2 text-sm text-gray-600">
                             Ruang: Online
                         </div>
                         <div class="col-span-2 text-right">
                             <a href="{{ route('student.kelas.detail', $jadwal->id) }}" class="inline-flex items-center text-sm font-medium text-teal-600 hover:text-teal-800 hover:underline">
                                 Masuk Kelas
                             </a>
                         </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <p class="text-gray-500">Tidak ada jadwal kelas hari ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
