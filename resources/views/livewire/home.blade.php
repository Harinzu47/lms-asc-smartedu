<div class="bg-gray-50">

    <!-- Section 1: Hero - White Background -->
    <section id="home" class="min-h-screen flex items-center relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 py-20">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <!-- Left Column: Text -->
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <h1
                        class="block text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                        Learn Today,<br class="hidden lg:inline">
                        <span class="text-teal-600 block mt-1">Shine Tomorrow</span>
                    </h1>
                    <p
                        class="mt-4 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                        Di ASC Smart Edu, setiap siswa punya potensi untuk bersinar. Dengan bimbingan terstruktur, tutor
                        profesional, dan pendekatan yang menyenangkan, kami bantu siswa paham materi, percaya diri, dan
                        berprestasi!
                    </p>
                    <div
                        class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0 flex flex-col sm:flex-row gap-4">
                        <a href="#contact"
                            class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange-500 hover:bg-orange-600 md:py-4 md:text-lg md:px-10 shadow-lg transition transform hover:-translate-y-1 text-center">
                            Contact Kami
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 md:py-4 md:text-lg md:px-10 shadow-lg transition transform hover:-translate-y-1 text-center">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
                <!-- Right Column: Image -->
                <div
                    class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                        <div class="relative block w-full bg-white rounded-lg overflow-hidden">
                            <img src="{{ asset('images/hero-illustration.png') }}" alt="Students learning"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decoration Dots -->
        <div class="absolute bottom-10 right-10 hidden lg:block">
            <div class="flex space-x-2">
                <span class="block w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="block w-2 h-2 bg-gray-300 rounded-full"></span>
                <span class="block w-2 h-2 bg-gray-300 rounded-full"></span>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 hidden lg:block animate-bounce">
            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                </path>
            </svg>
        </div>
    </section>

    <!-- Section 2: About Us - Full Teal Background -->
    <section id="about" class="min-h-screen flex items-center bg-teal-600 text-white relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 py-20">
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight uppercase mb-8">
                <span class="border-b-4 border-teal-300 pb-2">About Us</span>
            </h2>

            <!-- Elegant Box -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 md:p-12 shadow-2xl border border-white/20">
                <div class="flex justify-center mb-6">
                    <div class="h-20 w-20 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
                <p class="text-lg md:text-xl leading-relaxed text-teal-50">
                    <span class="font-bold text-white text-2xl">ASC SmartEdu</span> adalah platform belajar untuk siswa
                    SD, SMP, dan SMA dengan pendekatan yang menyenangkan dan efektif.
                    Kami percaya setiap siswa punya cara belajar yang berbeda, karena itu kami hadir dengan program
                    fleksibel, durasi yang bisa disesuaikan, dan materi dari pengajar berpengalaman.
                    Dengan metode interaktif, kami siap menjadi teman belajarmu menuju prestasi terbaik.
                </p>

                <!-- Stats Row -->
                <div class="mt-10 grid grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white">500+</div>
                        <div class="text-teal-200 text-sm md:text-base mt-1">Siswa Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white">50+</div>
                        <div class="text-teal-200 text-sm md:text-base mt-1">Tutor Profesional</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white">95%</div>
                        <div class="text-teal-200 text-sm md:text-base mt-1">Tingkat Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative Circles -->
        <div class="absolute top-20 left-20 w-40 h-40 bg-teal-500 rounded-full opacity-30 blur-xl hidden lg:block">
        </div>
        <div class="absolute bottom-20 right-20 w-60 h-60 bg-teal-400 rounded-full opacity-20 blur-2xl hidden lg:block">
        </div>
    </section>

    <!-- Section 3: Program Pilihan - Light Gray Background -->
    <section id="program" class="min-h-screen flex items-center bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Program Pilihan ASC SmartEdu</h2>
                <p class="mt-4 text-xl text-gray-500">Belajar sesuai jenjang, fokus pada kebutuhanmu.</p>
                <div
                    class="mt-4 inline-flex items-center px-4 py-2 rounded-full bg-teal-100 text-teal-700 text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg>
                    Program Khusus SMP
                </div>
            </div>

            <!-- Grid 3 Columns -->
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3 lg:gap-8">

                <!-- Card 1: ASC Cendekia - Kelas 7 -->
                <div
                    class="relative bg-white p-8 rounded-2xl shadow-md border-t-4 border-teal-500 hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                    <!-- Badge -->
                    <div
                        class="absolute top-0 right-0 -mt-3 -mr-3 h-14 w-14 bg-teal-100 rounded-full flex items-center justify-center border-4 border-white shadow-md group-hover:scale-110 transition-transform">
                        <span class="text-xl">📚</span>
                    </div>

                    <!-- Header -->
                    <div class="flex items-center mb-6">
                        <div
                            class="h-14 w-14 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white font-bold text-2xl mr-4 shadow-lg">
                            C
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">ASC Cendekia</h3>
                            <span class="text-sm font-medium text-teal-600 bg-teal-50 px-3 py-1 rounded-full">Kelas 7
                                SMP</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-500 text-sm mb-4">Fondasi kuat untuk awal perjalanan SMP</p>

                    <!-- Mapel List -->
                    <ul class="space-y-3 mb-8 flex-1">
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Matematika</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Bahasa Inggris</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">IPA Terpadu</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-teal-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">IPS</span>
                        </li>
                    </ul>

                    <!-- Button - Pinned to Bottom -->
                    <div class="mt-auto">
                        <a href="#"
                            class="w-full block text-center px-4 py-3 border-2 border-teal-600 text-teal-600 font-bold rounded-xl hover:bg-teal-600 hover:text-white transition-all duration-300">
                            Detail Program
                        </a>
                    </div>
                </div>

                <!-- Card 2: ASC Satria - Kelas 8 -->
                <div
                    class="relative bg-white p-8 rounded-2xl shadow-md border-t-4 border-blue-600 hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                    <!-- Badge -->
                    <div
                        class="absolute top-0 right-0 -mt-3 -mr-3 h-14 w-14 bg-blue-100 rounded-full flex items-center justify-center border-4 border-white shadow-md group-hover:scale-110 transition-transform">
                        <span class="text-xl">🚀</span>
                    </div>

                    <!-- Header -->
                    <div class="flex items-center mb-6">
                        <div
                            class="h-14 w-14 rounded-full bg-gradient-to-br from-blue-500 to-teal-600 flex items-center justify-center text-white font-bold text-2xl mr-4 shadow-lg">
                            S
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">ASC Satria</h3>
                            <span class="text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Kelas 8
                                SMP</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-500 text-sm mb-4">Penguatan materi dan persiapan lebih dalam</p>

                    <!-- Mapel List -->
                    <ul class="space-y-3 mb-8 flex-1">
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Matematika</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Bahasa Inggris</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Fisika & Biologi (IPA)</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">IPS</span>
                        </li>
                    </ul>

                    <!-- Button - Pinned to Bottom -->
                    <div class="mt-auto">
                        <a href="#"
                            class="w-full block text-center px-4 py-3 border-2 border-blue-600 text-blue-600 font-bold rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-300">
                            Detail Program
                        </a>
                    </div>
                </div>

                <!-- Card 3: ASC Prima - Kelas 9 (Premium) -->
                <div
                    class="relative bg-gradient-to-br from-amber-50 to-orange-50 p-8 rounded-2xl shadow-lg border-t-4 border-orange-500 hover:shadow-2xl transition-all duration-300 flex flex-col h-full group md:col-span-2 lg:col-span-1">
                    <!-- Popular Badge -->
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                        <span
                            class="bg-gradient-to-r from-orange-500 to-amber-500 text-white text-xs font-bold px-4 py-1 rounded-full shadow-lg">
                            ⭐ TINGKAT AKHIR
                        </span>
                    </div>

                    <!-- Badge -->
                    <div
                        class="absolute top-0 right-0 -mt-3 -mr-3 h-14 w-14 bg-gradient-to-br from-orange-100 to-amber-100 rounded-full flex items-center justify-center border-4 border-white shadow-md group-hover:scale-110 transition-transform">
                        <span class="text-xl">🎓</span>
                    </div>

                    <!-- Header -->
                    <div class="flex items-center mb-6 mt-2">
                        <div
                            class="h-14 w-14 rounded-full bg-gradient-to-br from-orange-400 to-amber-500 flex items-center justify-center text-white font-bold text-2xl mr-4 shadow-lg">
                            P
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">ASC Prima</h3>
                            <span class="text-sm font-medium text-orange-600 bg-orange-100 px-3 py-1 rounded-full">Kelas
                                9 SMP</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-500 text-sm mb-4">Pemantapan maksimal menuju kelulusan</p>

                    <!-- Mapel List -->
                    <ul class="space-y-3 mb-8 flex-1">
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-orange-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Matematika</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-orange-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Bahasa Inggris</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-orange-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium">Pemantapan Ujian Sekolah</span>
                        </li>
                        <li class="flex items-center">
                            <div class="h-5 w-5 rounded-full bg-orange-100 flex items-center justify-center mr-3">
                                <svg class="h-3 w-3 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">IPA & IPS</span>
                        </li>
                    </ul>

                    <!-- Button - Pinned to Bottom (Premium Style) -->
                    <div class="mt-auto">
                        <a href="#"
                            class="w-full block text-center px-4 py-3 bg-gradient-to-r from-orange-500 to-amber-500 text-white font-bold rounded-xl hover:from-orange-600 hover:to-amber-600 shadow-lg hover:shadow-xl transition-all duration-300">
                            Detail Program
                        </a>
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
                    <a href="#" class="text-gray-400 hover:text-gray-300 transition">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300 transition">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.48 2h1.667zm-1.63 14.5c2.484 0 4.5-2.016 4.5-4.5s-2.016-4.5-4.5-4.5-4.5 2.016-4.5 4.5 2.016 4.5 4.5 4.5zm0-1.8c-1.49 0-2.7-1.21-2.7-2.7s1.21-2.7 2.7-2.7 2.7 1.21 2.7 2.7-1.21 2.7-2.7 2.7zm5.85-8.4a1.08 1.08 0 110-2.16 1.08 1.08 0 010 2.16z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300 transition">
                        <span class="sr-only">WhatsApp</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                    </a>
                </div>
                <div class="mt-8 md:mt-0 md:order-1">
                    <p class="text-center text-base text-gray-400">
                        &copy; {{ date('Y') }} ASC SmartEdu. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>