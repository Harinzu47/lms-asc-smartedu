<div class="space-y-6">
    <div class="text-center md:text-left">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">SIGN IN</h1>
    </div>

    <form wire:submit="login" class="space-y-5">
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-600 mb-2">Email</label>
            <input
                wire:model="email"
                type="email"
                id="email"
                placeholder="Masukkan email anda"
                class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-lg text-gray-800 placeholder-gray-400 focus:ring-0 focus:border-gray-200 transaction duration-200 @error('email') border-red-500 @enderror"
            >
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div x-data="{ showPassword: false }">
            <label for="password" class="block text-sm font-semibold text-gray-600 mb-2">Kata sandi</label>
            <div class="relative">
                <input
                    wire:model="password"
                    :type="showPassword ? 'text' : 'password'"
                    id="password"
                    placeholder="Masukkan kata sandi"
                    class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-lg text-gray-800 placeholder-gray-400 focus:ring-0 focus:border-gray-200 transaction duration-200 pr-10 @error('password') border-red-500 @enderror"
                >
                <button 
                    type="button" 
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                >
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input
                wire:model="remember"
                type="checkbox"
                id="remember"
                class="w-4 h-4 text-orange-500 border-gray-300 rounded focus:ring-orange-500"
            >
            <label for="remember" class="ml-2 text-sm text-gray-500">Remember me</label>
        </div>

        <!-- Register Link -->
        <div class="pt-2">
            <span class="text-xs text-gray-500">Belum punya akun?</span>
            <a href="{{ route('register') }}" class="text-xs font-bold text-teal-600 hover:underline" wire:navigate>
                Daftar Sekarang
            </a>
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full py-3.5 px-4 bg-[#FF6600] hover:bg-[#e65c00] text-white font-bold rounded-full transition duration-200 shadow-md"
            wire:loading.attr="disabled"
        >
            <span wire:loading.remove wire:target="login">Log in</span>
            <span wire:loading wire:target="login">Loading...</span>
        </button>

        <!-- Forgot Password -->
        <div class="text-center pt-2">
            <a href="#" class="text-sm font-bold text-teal-600 hover:text-teal-700">
                Forgot your password?
            </a>
        </div>
    </form>
</div>
