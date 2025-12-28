<div class="bg-gray-50">
    
    <!-- Hero Section -->
    <section id="home" class="relative bg-white overflow-hidden pt-20 pb-16 sm:pb-24 lg:pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <h1 class="block text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                        Learn Today,<br class="hidden lg:inline">
                        <span class="text-teal-600 block mt-1">Shine Tomorrow</span>
                    </h1>
                    <p class="mt-4 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Di ASC Smart Edu, setiap siswa punya potensi untuk bersinar. Dengan bimbingan terstruktur, tutor profesional, dan pendekatan yang menyenangkan, kami bantu siswa paham materi, percaya diri, dan berprestasi!
                    </p>
                    <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0 flex flex-col sm:flex-row gap-4">
                        <a href="#contact" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-500 hover:bg-orange-600 md:py-4 md:text-lg md:px-10 shadow-lg transition transform hover:-translate-y-1">
                            Contact Kami
                        </a>
                        <a href="{{ route('register') }}" class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 md:py-4 md:text-lg md:px-10 shadow-lg transition transform hover:-translate-y-1">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                        <button type="button" class="relative block w-full bg-white rounded-lg overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                           <span class="sr-only">Watch our video to learn more</span>
                           <!-- Hero Image -->
                            <img src="{{ asset('images/hero-illustration.png') }}" alt="Students learning" class="w-full h-full object-cover">

                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decoration Dots -->
        <div class="absolute bottom-0 right-0 mb-10 mr-10 hidden lg:block">
            <div class="flex space-x-2">
                <span class="block w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="block w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="block w-2 h-2 bg-gray-300 rounded-full"></span>
            </div>
        </div>
    </section>
    
    <!-- About Us Section -->
    <section id="about" class="py-16 bg-teal-600 text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl font-extrabold tracking-tight uppercase mb-8 border-b-2 border-teal-400 inline-block pb-2">About Us</h2>
            <div class="bg-teal-700/50 rounded-2xl p-8 backdrop-blur-sm shadow-inner">
                <p class="mt-4 text-lg leading-relaxed text-teal-50">
                    <span class="font-bold text-white">ASC SmartEdu</span> adalah platform belajar untuk siswa SD, SMP, dan SMA dengan pendekatan yang menyenangkan dan efektif. 
                    Kami percaya setiap siswa punya cara belajar yang berbeda, karena itu kami hadir dengan program fleksibel, durasi yang bisa disesuaikan, dan materi dari pengajar berpengalaman. 
                    Dengan metode interaktif, kami siap menjadi teman belajarmu menuju prestasi terbaik.
                </p>
            </div>
        </div>
        <!-- Wave Separator Bottom -->
         <div class="absolute bottom-0 w-full overflow-hidden leading-none z-0">
            <svg class="relative block w-full h-12 md:h-24 lg:h-32 text-indigo-50" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-gray-50"></path>
            </svg>
        </div>
    </section>

    <!-- Program Section -->
    <section id="program" class="py-16 sm:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Program Pilihan ASC SmartEdu</h2>
                <p class="mt-4 text-xl text-gray-500">Belajar sesuai jenjang, fokus pada kebutuhanmu.</p>
            </div>
            
            <div class="mt-16 grid gap-8 lg:grid-cols-3 lg:gap-x-8">
                <!-- Card 1: SD -->
                <div class="relative bg-white p-8 rounded-2xl shadow-sm border border-teal-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 h-16 w-16 bg-orange-100 rounded-full flex items-center justify-center border-4 border-white shadow-sm">
                        <span class="text-2xl">🎒</span>
                    </div>
                    <div class="flex flex-col h-full">
                        <div class="flex items-center mb-6">
                            <div class="h-14 w-14 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-2xl mr-4">
                                C
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">ASC Cendekia</h3>
                                <span class="text-sm font-medium text-teal-600 bg-teal-50 px-2 py-0.5 rounded">Kelas 1-6 SD</span>
                            </div>
                        </div>
                        <ul class="space-y-3 mb-8 flex-1">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Matematika</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">IPS</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">IPA</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Bahasa Inggris</span>
                            </li>
                        </ul>
                        <a href="#" class="w-full block text-center px-4 py-2 border border-teal-600 text-teal-600 font-bold rounded-lg hover:bg-teal-50 transition">Detail Program</a>
                    </div>
                </div>

                <!-- Card 2: SMP -->
                <div class="relative bg-white p-8 rounded-2xl shadow-md border-t-4 border-orange-500 hover:shadow-xl hover:-translate-y-1 transition duration-300 transform scale-105 z-10">
                     <div class="absolute top-0 right-0 -mt-4 -mr-4 h-16 w-16 bg-orange-100 rounded-full flex items-center justify-center border-4 border-white shadow-sm">
                        <span class="text-2xl">🚀</span>
                    </div>
                    <div class="flex flex-col h-full">
                         <div class="flex items-center mb-6">
                            <div class="h-14 w-14 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-2xl mr-4">
                                P
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">ASC Prima</h3>
                                <span class="text-sm font-medium text-orange-600 bg-orange-50 px-2 py-0.5 rounded">Kelas 7-9 SMP</span>
                            </div>
                        </div>
                        <ul class="space-y-3 mb-8 flex-1">
                             <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Matematika</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">IPS</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">IPA</span>
                            </li>
                             <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Bahasa Inggris</span>
                            </li>
                        </ul>
                         <a href="#" class="w-full block text-center px-4 py-3 bg-orange-500 text-white font-bold rounded-lg hover:bg-orange-600 shadow-lg transition">Pilih Populer</a>
                    </div>
                </div>

                <!-- Card 3: SMA -->
                <div class="relative bg-white p-8 rounded-2xl shadow-sm border border-teal-100 hover:shadow-xl hover:-translate-y-1 transition duration-300">
                     <div class="absolute top-0 right-0 -mt-4 -mr-4 h-16 w-16 bg-orange-100 rounded-full flex items-center justify-center border-4 border-white shadow-sm">
                        <span class="text-2xl">🎓</span>
                    </div>
                    <div class="flex flex-col h-full">
                        <div class="flex items-center mb-6">
                            <div class="h-14 w-14 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold text-2xl mr-4">
                                S
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">ASC Satria</h3>
                                <span class="text-sm font-medium text-teal-600 bg-teal-50 px-2 py-0.5 rounded">Kelas 10-12 SMA</span>
                            </div>
                        </div>
                        <ul class="space-y-3 mb-8 flex-1">
                             <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Matematika</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Bahasa Inggris</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Biologi & Kimia</span>
                            </li>
                             <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-gray-600">Fisika</span>
                            </li>
                        </ul>
                         <a href="#" class="w-full block text-center px-4 py-2 border border-teal-600 text-teal-600 font-bold rounded-lg hover:bg-teal-50 transition">Detail Program</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex justify-center md:justify-start space-x-6 md:order-2">
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h1.667zm-1.63 14.5c2.484 0 4.5-2.016 4.5-4.5s-2.016-4.5-4.5-4.5-4.5 2.016-4.5 4.5 2.016 4.5 4.5 4.5zm0-1.8c-1.49 0-2.7-1.21-2.7-2.7s1.21-2.7 2.7-2.7 2.7 1.21 2.7 2.7-1.21 2.7-2.7 2.7zm5.85-8.4a1.08 1.08 0 110-2.16 1.08 1.08 0 010 2.16z" clip-rule="evenodd" /></svg>
                    </a>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-base text-gray-400">
                        &copy; 2025 ASC SmartEdu. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>
