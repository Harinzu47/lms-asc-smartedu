<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'ASC SmartEdu - Learn Today, Shine Tomorrow' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans text-gray-900 antialiased">
    
    <div x-data="{ scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20)"
         class="min-h-screen bg-white">

        <!-- Navbar -->
        <nav :class="{ 'bg-white shadow-md py-2': scrolled, 'bg-transparent py-4': !scrolled }"
             class="fixed w-full z-50 transition-all duration-300 top-0 left-0 border-b border-transparent">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                             <!-- Simple Logo Placeholder or SVG -->
                            <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="font-bold text-2xl tracking-tight text-teal-700">ASC <span class="text-orange-500">SmartEdu</span></span>
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex space-x-8 items-center">
                        <a href="#home" class="text-gray-600 hover:text-teal-600 font-medium transition">Home</a>
                        <a href="#about" class="text-gray-600 hover:text-teal-600 font-medium transition">About Us</a>
                        <a href="#program" class="text-gray-600 hover:text-teal-600 font-medium transition">Program</a>
                        <a href="#metode" class="text-gray-600 hover:text-teal-600 font-medium transition">Metode Belajar</a>
                    </div>

                    <!-- Auth Buttons -->
                    <div class="hidden md:flex items-center space-x-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-teal-600 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 text-teal-600 border border-teal-600 rounded-full font-medium hover:bg-teal-50 transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-teal-600 text-white rounded-full font-medium hover:bg-teal-700 shadow-md transition transform hover:-translate-y-0.5">
                                SignUp
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="-mr-2 flex items-center md:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
