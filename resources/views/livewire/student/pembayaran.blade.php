<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Pembayaran</h1>
        <p class="text-gray-600">Informasi pembayaran dan status verifikasi akun Anda.</p>
    </div>

    <!-- Payment List -->
    <div class="space-y-4">
        <!-- Registration Payment Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-200">
            <div class="p-6 md:flex md:items-center md:justify-between">
                
                <!-- Left Details -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">
                            Pendaftaran
                        </span>
                        <span class="text-xs text-gray-500">
                            {{ $user->created_at->translatedFormat('d F Y, H:i') }}
                        </span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-1">
                        Biaya Pendaftaran Member Baru
                    </h3>
                    <p class="text-gray-600 text-sm">
                        Pembayaran administrasi awal untuk aktivasi akun siswa ASC SmartEdu.
                    </p>

                    <div class="mt-4 flex items-center gap-2">
                         <svg class="w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-semibold text-teal-700">Pembayaran Terverifikasi & Lunas</span>
                    </div>
                </div>

                <!-- Right Proof Image -->
                <div class="mt-6 md:mt-0 md:ml-8 flex-shrink-0">
                     @if($user->bukti_pembayaran)
                        <div class="relative group cursor-pointer" x-data="{ open: false }">
                            <img 
                                src="{{ Storage::url($user->bukti_pembayaran) }}" 
                                alt="Bukti Transfer" 
                                class="h-24 w-32 object-cover rounded-lg border border-gray-200 shadow-sm"
                                @click="open = true"
                            >
                            <div class="absolute inset-0 bg-black/40 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200" @click="open = true">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </div>

                            <!-- Modal Preview -->
                            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm" @click.self="open = false">
                                <div class="relative max-w-3xl w-full bg-white rounded-xl overflow-hidden shadow-2xl">
                                    <button @click="open = false" class="absolute top-2 right-2 p-2 bg-black/50 text-white rounded-full hover:bg-black/70 transition">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                    <img src="{{ Storage::url($user->bukti_pembayaran) }}" class="w-full h-auto max-h-[80vh] object-contain">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="h-24 w-32 bg-gray-100 rounded-lg border border-gray-200 flex items-center justify-center text-xs text-gray-400 text-center p-2">
                            Tidak ada bukti
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100">
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>ID Transaksi: #REG-{{ substr(md5($user->id . $user->created_at), 0, 8) }}</span>
                    <span>Metode: Transfer Bank</span>
                </div>
            </div>
        </div>

        <!-- Add more payment cards here in future -->
    </div>
</div>
