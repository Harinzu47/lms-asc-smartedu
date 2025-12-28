<div>
    <x-slot name="header">Profile Saya</x-slot>

    <div class="space-y-8">
        <!-- Header Section -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Profile</h2>
            <p class="text-gray-500">Perbarui informasi pribadi dan keamanan akun Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column: Photo -->
            <div class="col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center">
                    <div class="relative h-32 w-32 mx-auto mb-4">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="h-32 w-32 rounded-full object-cover border-4 border-teal-50">
                        @elseif ($existingPhoto)
                            <img src="{{ Storage::url($existingPhoto) }}" class="h-32 w-32 rounded-full object-cover border-4 border-teal-50">
                        @else
                            <div class="h-32 w-32 rounded-full bg-teal-100 flex items-center justify-center border-4 border-teal-50 text-teal-600 text-3xl font-bold mx-auto">
                                {{ substr($name, 0, 1) }}
                            </div>
                        @endif
                        
                        <label for="photo-upload" class="absolute bottom-0 right-0 h-8 w-8 bg-teal-600 rounded-full flex items-center justify-center cursor-pointer hover:bg-teal-700 transition text-white shadow-md">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </label>
                        <input type="file" id="photo-upload" wire:model="photo" class="hidden" accept="image/*">
                    </div>
                    
                    <h3 class="font-bold text-gray-900 text-lg">{{ $name }}</h3>
                    <p class="text-sm text-gray-500 mb-4">{{ $email }}</p>
                    
                    @error('photo') <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
                    
                    <button wire:click="saveProfile" wire:loading.attr="disabled" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-md">
                        Simpan Foto
                    </button>
                </div>
            </div>

            <!-- Right Column: Details & Password -->
            <div class="col-span-1 md:col-span-2 space-y-6">
                
                <!-- Information Form -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-4 mb-4">Informasi Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" value="{{ $name }}" class="block w-full bg-gray-50 border border-gray-300 text-gray-500 rounded-lg shadow-sm focus:outline-none cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" value="{{ $email }}" class="block w-full bg-gray-50 border border-gray-300 text-gray-500 rounded-lg shadow-sm focus:outline-none cursor-not-allowed" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                            <input type="text" wire:model="nomor_telepon" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="0812...">
                            @error('nomor_telepon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                         <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea wire:model="alamat" rows="3" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="Alamat lengkap..."></textarea>
                            @error('alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button wire:click="saveProfile" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-6 rounded-lg transition shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

                <!-- Password Form -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                     <h3 class="font-bold text-gray-800 border-b border-gray-100 pb-4 mb-4">Ganti Password</h3>
                     <div class="grid grid-cols-1 gap-4 max-w-lg">
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                            <input type="password" wire:model="current_password" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                             @error('current_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                            <input type="password" wire:model="new_password" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                             @error('new_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                            <input type="password" wire:model="new_password_confirmation" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        </div>
                     </div>
                     <div class="mt-6 flex justify-end">
                        <button wire:click="updatePassword" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-6 rounded-lg transition shadow-md">
                            Ganti Password
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
