<x-layouts.auth>
    <x-slot:title>Daftar Akun - Mutya Store</x-slot:title>

    <div class="mb-6 text-center">
        <h1 class="font-serif-display text-2xl font-bold text-[#3A3033]">Daftar Akun Baru</h1>
        <p class="text-sm text-[#75686D] mt-1">Bergabunglah dan nikmati koleksi hijab terbaik</p>
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

    <form method="POST" action="{{ route('register.submit') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-[#3A3033] mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] focus:outline-none focus:ring-2 focus:ring-[#D98FAF] focus:border-transparent text-sm text-[#3A3033] bg-[#FFF9F5]/40"
                placeholder="Alya Nurhaliza">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-[#3A3033] mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] focus:outline-none focus:ring-2 focus:ring-[#D98FAF] focus:border-transparent text-sm text-[#3A3033] bg-[#FFF9F5]/40"
                placeholder="alya@email.com">
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-[#3A3033] mb-1">Nomor WhatsApp / HP (Opsional)</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] focus:outline-none focus:ring-2 focus:ring-[#D98FAF] focus:border-transparent text-sm text-[#3A3033] bg-[#FFF9F5]/40"
                placeholder="08123456789">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-[#3A3033] mb-1">Kata Sandi</label>
            <input type="password" name="password" id="password" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] focus:outline-none focus:ring-2 focus:ring-[#D98FAF] focus:border-transparent text-sm text-[#3A3033] bg-[#FFF9F5]/40"
                placeholder="Minimal 8 karakter">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-[#3A3033] mb-1">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] focus:outline-none focus:ring-2 focus:ring-[#D98FAF] focus:border-transparent text-sm text-[#3A3033] bg-[#FFF9F5]/40"
                placeholder="Ulangi kata sandi">
        </div>

        <button type="submit"
            class="w-full py-2.5 px-4 rounded-xl font-medium text-white bg-[#D98FAF] hover:bg-[#B97897] shadow-sm hover:shadow transition duration-200 cursor-pointer text-sm">
            Buat Akun
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-[#75686D]">
        Sudah memiliki akun?
        <a href="{{ route('login') }}" class="text-[#D98FAF] hover:text-[#B97897] font-medium ml-1">
            Masuk di sini
        </a>
    </div>
</x-layouts.auth>
