<div>
    <x-slot name="header">
        Ubah Profile
    </x-slot>

    <!-- Header Section matches design -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}</h1>
        <div class="mt-4 md:mt-0 bg-teal-600 text-white py-2 px-4 rounded-full text-sm font-medium shadow-md">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <!-- Left Column: Photo Upload -->
            <div class="md:col-span-1 flex flex-col items-center">
                <div class="w-full aspect-square border-2 border-dashed border-teal-300 rounded-2xl flex flex-col items-center justify-center p-4 relative bg-teal-50/30 group hover:bg-teal-50 transition cursor-pointer"
                     onclick="document.getElementById('profile-photo').click()">
                    
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" class="w-40 h-40 rounded-full object-cover shadow-md mb-4 border-4 border-white">
                    @elseif ($existingPhoto)
                        <img src="{{ Storage::url($existingPhoto) }}" class="w-40 h-40 rounded-full object-cover shadow-md mb-4 border-4 border-white">
                    @else
                         <div class="w-40 h-40 rounded-full bg-teal-200 flex items-center justify-center mb-4 text-teal-600 text-5xl font-bold border-4 border-white shadow-md">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif

                    <p class="text-center text-sm text-gray-500 font-medium px-4">
                        Klik foto untuk mengubah atau gunakan tombol dibawah ini
                    </p>

                    <!-- Hidden Input -->
                    <input type="file" id="profile-photo" wire:model="photo" class="hidden">
                    
                    <!-- Simulating button inside the dashed area as per design, typically below or overlay -->
                </div>
                
                <button onclick="document.getElementById('profile-photo').click()" class="mt-4 bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-6 rounded-lg shadow transition w-full md:w-auto">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                    Pilih foto
                </button>
                @error('photo') <span class="text-red-500 text-xs mt-2">{{ $message }}</span> @enderror
            </div>

            <!-- Right Column: Form -->
            <div class="md:col-span-2">
                <h2 class="text-xl font-bold text-gray-800 mb-6 border-b border-gray-200 pb-2">Ubah Profile</h2>
                
                <form wire:submit.prevent="save">
                    <div class="space-y-5">
                        <!-- Nama (Readonly) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama</label>
                            <input type="text" wire:model="name" readonly class="w-full bg-gray-200 text-gray-600 border-transparent rounded-lg focus:ring-0 cursor-not-allowed">
                        </div>

                        <!-- Jenis Kelamin (Readonly) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                            <input type="text" wire:model="jenis_kelamin" readonly class="w-full bg-gray-200 text-gray-600 border-transparent rounded-lg focus:ring-0 cursor-not-allowed">
                        </div>

                        <!-- Nomor Telepon (Editable) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" wire:model="nomor_telepon" class="w-full bg-gray-100 border-transparent focus:bg-white focus:border-teal-500 focus:ring-teal-500 rounded-lg transition" placeholder="08xxxxxxxxxx">
                            @error('nomor_telepon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Alamat (Editable) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                            <textarea wire:model="alamat" rows="2" class="w-full bg-gray-100 border-transparent focus:bg-white focus:border-teal-500 focus:ring-teal-500 rounded-lg transition" placeholder="Alamat lengkap"></textarea>
                            @error('alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email (Readonly) -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                            <input type="email" wire:model="email" readonly class="w-full bg-gray-200 text-gray-600 border-transparent rounded-lg focus:ring-0 cursor-not-allowed">
                        </div>
                        
                        <!-- Change Password Link -->
                        <div class="text-left">
                            <a href="#" class="text-blue-500 hover:text-blue-700 text-sm font-medium hover:underline">Ganti password</a>
                        </div>

                        <!-- Submit Button -->
                         <button type="submit" class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
