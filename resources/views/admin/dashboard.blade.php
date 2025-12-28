<x-layouts.admin>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-gray-600">Ini adalah halaman dashboard admin. Silakan pilih menu di samping untuk mengelola data.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-teal-50 p-6 rounded-xl border border-teal-100 flex items-center">
                 <div class="p-3 rounded-full bg-teal-100 text-teal-600 mr-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                 </div>
                 <div>
                     <h3 class="text-lg font-semibold text-gray-700">Total Siswa</h3>
                     <p class="text-2xl font-bold text-teal-700">{{ \App\Models\User::where('role', 'siswa')->count() }}</p>
                 </div>
            </div>
            
             <div class="bg-orange-50 p-6 rounded-xl border border-orange-100 flex items-center">
                 <div class="p-3 rounded-full bg-orange-100 text-orange-600 mr-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                 </div>
                 <div>
                     <h3 class="text-lg font-semibold text-gray-700">Total Kelas</h3>
                     <p class="text-2xl font-bold text-orange-700">{{ \App\Models\Kelas::count() }}</p>
                 </div>
            </div>

            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 flex items-center">
                 <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                 </div>
                 <div>
                     <h3 class="text-lg font-semibold text-gray-700">Mata Pelajaran</h3>
                     <p class="text-2xl font-bold text-blue-700">{{ \App\Models\MataPelajaran::count() }}</p>
                 </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
