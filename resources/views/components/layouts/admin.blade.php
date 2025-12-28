<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Panel' }} - ASC SmartEdu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#1a8882] text-white flex-shrink-0 flex flex-col hidden md:flex transition-all duration-300">
        <!-- Brand -->
        <div class="h-16 flex items-center px-6 bg-[#166e69]">
            <span class="text-xl font-bold tracking-wider">ASC SmartEdu</span>
        </div>

        <!-- User Profile Section -->
        @auth
        <div class="flex flex-col items-center py-6 border-b border-teal-600/30">
            <div class="h-20 w-20 rounded-full bg-white/20 flex items-center justify-center overflow-hidden mb-3">
                 @if(Auth::user()->profile_photo_path)
                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" class="h-full w-full object-cover">
                 @else
                    <span class="text-3xl font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                 @endif
            </div>
            <h3 class="font-semibold text-lg text-center px-4">{{ Auth::user()->name }}</h3>
            <p class="text-xs text-teal-100 mt-1 uppercase tracking-wide">{{ Auth::user()->role->label() ?? 'Admin' }}</p>
        </div>
        @endauth

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 space-y-1 px-3">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Dashboard
            </a>
            
            <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.users') ? 'bg-white/20' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                User Management
            </a>

            <a href="{{ route('admin.schedule') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.schedule') ? 'bg-white/20' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                Jadwal Kelas
            </a>

            <!-- Master Data Dropdown -->
            <div x-data="{ open: {{ request()->routeIs('admin.master.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-2 rounded-lg hover:bg-white/10 transition focus:outline-none">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        Master Data
                    </div>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open" class="pl-11 pr-3 space-y-1 mt-1" x-transition>
                    <a href="{{ route('admin.master.kelas') }}" class="block py-2 px-3 rounded hover:bg-white/10 text-sm {{ request()->routeIs('admin.master.kelas') ? 'bg-white/20' : 'text-teal-100' }}">Kelas</a>
                    <a href="{{ route('admin.master.mapel') }}" class="block py-2 px-3 rounded hover:bg-white/10 text-sm {{ request()->routeIs('admin.master.mapel') ? 'bg-white/20' : 'text-teal-100' }}">Mata Pelajaran</a>
                </div>
            </div>

             <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 rounded-lg hover:bg-red-500/20 text-red-100 hover:text-white transition">
                    <svg class="w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50">
        <!-- Header -->
        <header class="bg-white shadow-sm flex items-center justify-between px-6 py-4 z-10">
            <!-- Mobile Menu Toggle -->
            <button class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
            </button>
            
            <h1 class="text-2xl font-bold text-gray-800 ml-4 md:ml-0">{{ $header ?? '' }}</h1>

            <div class="flex items-center gap-4">
                 <button class="text-gray-400 hover:text-gray-600 relative">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-400"></span>
                 </button>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto p-8">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal:confirm', (event) => {
                const data = event[0];
                Swal.fire({
                    title: data.title || 'Are you sure?',
                    text: data.text || "You won't be able to revert this!",
                    icon: data.icon || 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1a8882',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch(data.onConfirmed, { id: data.id });
                    }
                })
            });

            Livewire.on('swal:modal', (event) => {
                const data = event[0];
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.icon,
                    timer: 2000,
                    showConfirmButton: false
                });
            });
        });
    </script>
</body>
</html>
