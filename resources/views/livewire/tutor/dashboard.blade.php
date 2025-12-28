<div>
    <x-slot name="header">
        Dashboard Tutor
    </x-slot>

    <!-- Welcome Section -->
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-gray-800">Halo, {{ auth()->user()->name }}! 👋</h3>
        <p class="text-gray-600 mt-2">Selamat mengajar, berikut adalah jadwal Anda hari ini.</p>
    </div>

    <!-- Jadwal Hari Ini Section -->
    <div class="mb-10">
        <h4 class="text-lg font-bold text-gray-700 mb-4 border-l-4 border-teal-500 pl-3">Jadwal Mengajar Hari Ini</h4>
        
        @if($jadwalsToday->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jadwalsToday as $jadwal)
                    <div class="bg-gradient-to-br from-teal-500 to-teal-700 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-teal-100 font-medium text-sm">{{ $jadwal->hari }}</p>
                                <h3 class="text-2xl font-bold mt-1">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</h3>
                                <p class="text-teal-200 text-xs">s/d {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</p>
                            </div>
                            <div class="bg-white/20 p-2 rounded-lg">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <h4 class="text-xl font-bold truncate" title="{{ $jadwal->mapel->nama_mapel }}">{{ $jadwal->mapel->nama_mapel }}</h4>
                            <p class="text-teal-100 text-sm mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                {{ $jadwal->kelas->nama_kelas }}
                            </p>
                        </div>

                        <a href="{{ route('tutor.kelas.detail', $jadwal->id) }}" class="block w-full text-center bg-white text-teal-700 font-bold py-2 px-4 rounded-lg hover:bg-teal-50 transition shadow">
                            Masuk Kelas
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-8 text-center border border-gray-100">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-gray-100 mb-4">
                    <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Tidak ada jadwal mengajar hari ini</h3>
                <p class="text-gray-500 mt-1">Nikmati hari libur Anda atau persiapkan materi untuk besok!</p>
            </div>
        @endif
    </div>

    <!-- Daftar Semua Kelas Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <h4 class="text-lg font-bold text-gray-700">Daftar Semua Kelas Saya</h4>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari & Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($allClasses as $jadwal)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $jadwal->hari }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $jadwal->kelas->nama_kelas }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $jadwal->mapel->nama_mapel }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('tutor.kelas.detail', $jadwal->id) }}" class="text-teal-600 hover:text-teal-900 font-semibold hover:underline">
                                    Lihat Detail &rarr;
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                Belum ada kelas yang dijadwalkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $allClasses->links() }}
        </div>
    </div>
</div>
