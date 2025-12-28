<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'ASC SmartEdu' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased text-gray-900 bg-white">
    <div class="min-h-screen flex w-full"> 
        
        <!-- Left Side - Branding (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-5/12 bg-teal-50 flex-col justify-between p-12 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 rounded-full bg-teal-100/50 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-orange-100/50 blur-3xl"></div>

            <!-- Logo Area -->
            <div class="relative z-10">
                <div class="flex items-center gap-3">
                    <svg class="w-10 h-10 text-orange-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold text-gray-900 leading-none tracking-tight">ASC SmartEdu</span>
                        <span class="text-xs text-orange-500 font-semibold tracking-widest uppercase mt-0.5">Learn Today Shine Tomorrow</span>
                    </div>
                </div>
            </div>

            <!-- Main Branding Content -->
            <div class="relative z-10 flex-1 flex flex-col items-center justify-center text-center">
                <div class="relative mb-8">
                     <!-- Image with consistent styling -->
                     <div class="relative w-64 h-64 mx-auto">
                        <div class="absolute inset-0 bg-teal-200 rounded-full rotate-6 opacity-30 animate-pulse"></div>
                        <img 
                            src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                            alt="Student Learning" 
                            class="relative w-full h-full object-cover rounded-full border-4 border-white shadow-xl"
                        >
                        <!-- Floating Badge -->
                         <div class="absolute -bottom-4 -right-4 bg-white p-3 rounded-xl shadow-lg flex items-center gap-2 animate-bounce">
                            <div class="bg-teal-100 p-1.5 rounded-lg text-teal-600">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="text-sm font-bold text-gray-800">Terpercaya</span>
                        </div>
                     </div>
                </div>
                
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Mulai Perjalanan <br> <span class="text-teal-600">Belajar Anda</span>
                </h2>
                <p class="text-gray-600 max-w-sm mx-auto leading-relaxed">
                    Dapatkan akses ke materi pembelajaran terbaik dan tutor berpengalaman untuk masa depan yang lebih cerah.
                </p>
            </div>

            <!-- Copyright -->
            <div class="relative z-10 text-xs text-gray-400 font-medium">
                &copy; {{ date('Y') }} ASC SmartEdu. All rights reserved.
            </div>
        </div>

        <!-- Right Side - Authentication Form (Scrollable content) -->
        <div class="w-full lg:w-7/12 bg-white flex flex-col items-center p-6 lg:p-12 relative overflow-y-auto h-screen">
             <!-- Mobile Logo (Visible only on small screens) -->
             <div class="lg:hidden w-full max-w-md mx-auto mb-8 flex items-center gap-2 mt-8">
                 <svg class="w-8 h-8 text-orange-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="text-xl font-bold text-gray-900">ASC SmartEdu</span>
             </div>

            <div class="w-full max-w-lg my-auto py-12 lg:py-0">
                {{ $slot }}
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
