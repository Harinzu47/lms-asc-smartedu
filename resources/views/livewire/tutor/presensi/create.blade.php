<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Input Presensi</h2>
            <p class="text-gray-600">{{ $jadwal->mapel->nama_mapel }} - {{ $jadwal->kelas->nama_kelas }}</p>
        </div>
        <a href="{{ route('tutor.presensi.riwayat', $jadwal->id) }}" class="text-gray-600 hover:text-gray-800 font-medium" wire:navigate>
            Kembali
        </a>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Tanggal Input -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pertemuan</label>
            <input type="date" wire:model.live="tanggal" id="tanggal" class="w-full max-w-xs px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
            @error('tanggal') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- List Siswa -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-800">Daftar Siswa</h3>
            </div>
            
            <div class="divide-y divide-gray-100">
                @foreach($students as $student)
                <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold">
                            {{ $student->initials() }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $student->name }}</p>
                            <p class="text-xs text-gray-500">{{ $student->email }}</p>
                        </div>
                    </div>

                    <!-- Radio Options -->
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" value="Hadir" wire:model="attendanceData.{{ $student->id }}" class="text-green-600 focus:ring-green-500 w-4 h-4">
                            <span class="text-sm font-medium text-gray-700">Hadir</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" value="Sakit" wire:model="attendanceData.{{ $student->id }}" class="text-blue-600 focus:ring-blue-500 w-4 h-4">
                            <span class="text-sm font-medium text-gray-700">Sakit</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" value="Izin" wire:model="attendanceData.{{ $student->id }}" class="text-yellow-600 focus:ring-yellow-500 w-4 h-4">
                            <span class="text-sm font-medium text-gray-700">Izin</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" value="Alpha" wire:model="attendanceData.{{ $student->id }}" class="text-red-600 focus:ring-red-500 w-4 h-4">
                            <span class="text-sm font-medium text-gray-700">Alpha</span>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Catatan -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan Pertemuan (Opsional)</label>
            <textarea wire:model="catatan" id="catatan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent placeholder-gray-400" placeholder="Tulis catatan mengenai pertemuan ini..."></textarea>
        </div>

        <!-- Submit -->
        <div class="flex justify-between items-center">
            <div>
                @if($isEditing)
                <button type="button" wire:click="delete" wire:confirm="Apakah Anda yakin ingin menghapus data presensi untuk tanggal ini?" class="px-6 py-3 bg-red-100 hover:bg-red-200 text-red-700 font-bold rounded-lg transition duration-200 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Presensi
                </button>
                @endif
            </div>
            
            <button type="submit" class="px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition duration-200 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Presensi
            </button>
        </div>
    </form>
</div>
