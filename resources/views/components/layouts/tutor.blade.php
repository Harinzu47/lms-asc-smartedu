<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Tutor Panel - SmartEdu' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar (Desktop & Mobile) -->
        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-[#1a8882] text-white transition-transform duration-300 ease-in-out transform lg:translate-x-0 lg:static lg:inset-0 shadow-xl flex flex-col"
               :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <!-- Sidebar Header: Profile Summary -->
            {{-- Replacing Logo with Profile Summary as per request --}}
            <div class="flex flex-col items-center justify-center py-8 border-b border-teal-600/30 bg-[#166e69]">
                <div class="h-20 w-20 rounded-full bg-white/20 flex items-center justify-center p-1 mb-3 shadow-lg">
                    @if(auth()->user()->profile_photo_path)
                        <img src="{{ Storage::url(auth()->user()->profile_photo_path) }}" class="h-full w-full rounded-full object-cover border-2 border-white">
                    @else
                        <div class="h-full w-full rounded-full bg-teal-800 flex items-center justify-center border-2 border-white">
                            <span class="text-2xl font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <h2 class="text-lg font-bold tracking-wide text-white text-center px-4 leading-tight">{{ auth()->user()->name }}</h2>
                <p class="text-sm text-teal-200/80 mt-1">Pengajar</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 mt-6 space-y-2 overflow-y-auto">
                {{-- Dashboard --}}
                <a href="{{ route('tutor.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition group {{ request()->routeIs('tutor.dashboard') ? 'bg-teal-800 border-l-4 border-white shadow-lg' : 'hover:bg-teal-700 hover:text-white text-teal-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('tutor.dashboard') ? 'text-white' : 'text-teal-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                    Dashboard
                </a>

                {{-- Ubah Profile --}}
                <a href="{{ route('tutor.profile') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition group {{ request()->routeIs('tutor.profile') ? 'bg-teal-800 border-l-4 border-white shadow-lg' : 'hover:bg-teal-700 hover:text-white text-teal-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('tutor.profile') ? 'text-white' : 'text-teal-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Ubah Profile
                </a>

                {{-- Kelas --}}
                <a href="{{ route('tutor.kelas.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition group {{ request()->routeIs('tutor.kelas.*') ? 'bg-teal-800 border-l-4 border-white shadow-lg' : 'hover:bg-teal-700 hover:text-white text-teal-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('tutor.kelas.*') ? 'text-white' : 'text-teal-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                    Kelas
                </a>

                <a href="{{ route('tutor.jadwal') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition group {{ request()->routeIs('tutor.jadwal') ? 'bg-teal-800 border-l-4 border-white shadow-lg' : 'hover:bg-teal-700 hover:text-white text-teal-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('tutor.jadwal') ? 'text-white' : 'text-teal-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Jadwal
                </a>

                <a href="{{ route('tutor.presensi.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition group {{ request()->routeIs('tutor.presensi*') ? 'bg-teal-800 border-l-4 border-white shadow-lg' : 'hover:bg-teal-700 hover:text-white text-teal-50' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('tutor.presensi*') ? 'text-white' : 'text-teal-200 group-hover:text-white' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                    Presensi
                </a>
            </nav>

             <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-teal-600/30">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 rounded-lg hover:bg-red-500/20 text-teal-100 hover:text-red-200 transition">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header (Top Bar - Minimalist, mostly for mobile toggle and logo if needed, OR just plain as design implies sidebar handles profile) -->
            <!-- Design shows header is mostly white space or search bar. User didn't specify Header changes, but Profile Page has its own "Halo" header. -->
            <!-- I will keep the header from previous version but simplify it. -->
            <header class="bg-white shadow-sm z-20 h-20 flex items-center justify-between px-6 lg:px-10 lg:hidden">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-teal-600 focus:outline-none mr-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
                    </button>
                    <span class="text-xl font-bold text-teal-600">SMART EDU</span>
                </div>
            </header>

            <!-- Main Content Scroll -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6 lg:p-10">
                {{ $slot }}
            </main>
        </div>

        <!-- Overlay for mobile sidebar -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 z-20 lg:hidden"></div>
    </div>

    <!-- SweetAlert Listeners -->
    <script>
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail[0].title,
                text: event.detail[0].text,
                icon: event.detail[0].icon,
                confirmButtonColor: '#1a8882',
            });
        });
        
        window.addEventListener('swal:confirm', event => {
            // ... (keep confirm logic if needed)
        });
    </script>
</body>
</html>
