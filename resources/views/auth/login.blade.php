<x-layouts.auth>
    <x-slot:title>Masuk - Mutya Store</x-slot:title>

    <div class="mb-6 text-center">
        <h1 class="font-serif-display text-2xl font-bold text-[#3A3033]">Selamat Datang</h1>
        <p class="text-sm text-[#75686D] mt-1">Masuk ke akun Anda untuk melanjutkan belanja</p>
    </div>

    @if ($errors->any())
        <div class="mb-5 p-3.5 rounded-xl bg-pink-50 border border-pink-200 text-sm text-[#75686D]">
            <ul class="list-disc list-inside space-y-1 text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-[#3A3033] mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] focus:outline-none focus:ring-2 focus:ring-[#D98FAF] focus:border-transparent text-sm text-[#3A3033] bg-[#FFF9F5]/40"
                placeholder="nama@email.com">
        </div>

        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-sm font-medium text-[#3A3033]">Kata Sandi</label>
            </div>
            <input type="password" name="password" id="password" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] focus:outline-none focus:ring-2 focus:ring-[#D98FAF] focus:border-transparent text-sm text-[#3A3033] bg-[#FFF9F5]/40"
                placeholder="••••••••">
        </div>

        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center text-[#75686D]">
                <input type="checkbox" name="remember" class="rounded border-[#EBDDE2] text-[#D98FAF] focus:ring-[#D98FAF] mr-2">
                Ingat saya
            </label>
        </div>

        <button type="submit"
            class="w-full py-2.5 px-4 rounded-xl font-medium text-white bg-[#D98FAF] hover:bg-[#B97897] shadow-sm hover:shadow transition duration-200 cursor-pointer text-sm">
            Masuk
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-[#75686D]">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-[#D98FAF] hover:text-[#B97897] font-medium ml-1">
            Daftar Sekarang
        </a>
    </div>
</x-layouts.auth>
