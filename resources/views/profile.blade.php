<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Profil Saya - Mutya Store</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FFF9F5;
            color: #3A3033;
        }
        .font-serif-display {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="min-h-screen bg-[#FFF9F5] flex flex-col">
    <!-- Navbar placeholder -->
    <header class="bg-white border-b border-[#EBDDE2] px-6 py-4 flex items-center justify-between">
        <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
            <span class="text-[#D98FAF] text-lg">❀</span>
            <span class="font-serif-display text-xl font-bold tracking-wider text-[#3A3033] uppercase">MUTYA</span>
        </a>

        <div class="flex items-center space-x-4">
            <a href="{{ route('home') }}" class="text-sm text-[#75686D] hover:text-[#3A3033]">Beranda</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-3.5 py-1.5 text-sm font-medium text-[#75686D] hover:text-[#3A3033] bg-[#FFF9F5] hover:bg-[#F8C8DC]/30 border border-[#EBDDE2] rounded-xl transition cursor-pointer">
                    Keluar
                </button>
            </form>
        </div>
    </header>

    <main class="flex-1 max-w-3xl w-full mx-auto p-6 md:p-10">
        <div class="bg-white rounded-2xl border border-[#EBDDE2] p-8 shadow-xs">
            <div class="border-b border-[#EBDDE2] pb-5 mb-6">
                <h1 class="font-serif-display text-2xl font-bold text-[#3A3033]">Profil Pengguna</h1>
                <p class="text-sm text-[#75686D] mt-1">Informasi akun Anda di Mutya Store</p>
            </div>

            <div class="space-y-4">
                <div class="p-4 rounded-xl bg-[#FFF9F5] border border-[#EBDDE2] flex justify-between items-center">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-[#75686D] font-medium block">Nama</span>
                        <span class="text-base font-medium text-[#3A3033]">{{ $user->name }}</span>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-[#FFF9F5] border border-[#EBDDE2] flex justify-between items-center">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-[#75686D] font-medium block">Email</span>
                        <span class="text-base font-medium text-[#3A3033]">{{ $user->email }}</span>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-[#FFF9F5] border border-[#EBDDE2] flex justify-between items-center">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-[#75686D] font-medium block">Nomor Telepon</span>
                        <span class="text-base font-medium text-[#3A3033]">{{ $user->phone ?? '-' }}</span>
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-[#FFF9F5] border border-[#EBDDE2] flex justify-between items-center">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-[#75686D] font-medium block">Role</span>
                        <span class="inline-flex items-center text-xs font-semibold uppercase tracking-wider text-[#D98FAF] bg-pink-100 px-2.5 py-0.5 rounded-full mt-1">
                            {{ $user->role }}
                        </span>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#EBDDE2] grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="{{ route('addresses.index') }}"
                        class="p-4 rounded-xl border border-[#EBDDE2] hover:border-[#D98FAF] bg-white hover:bg-[#FFF9F5]/40 transition flex items-center justify-between">
                        <div>
                            <span class="block text-sm font-semibold text-[#3A3033]">Buku Alamat</span>
                            <span class="text-xs text-[#75686D]">Kelola alamat pengiriman pesanan</span>
                        </div>
                        <span class="text-base text-[#D98FAF]">📍</span>
                    </a>

                    <a href="{{ route('orders.index') }}"
                        class="p-4 rounded-xl border border-[#EBDDE2] hover:border-[#D98FAF] bg-white hover:bg-[#FFF9F5]/40 transition flex items-center justify-between">
                        <div>
                            <span class="block text-sm font-semibold text-[#3A3033]">Pesanan Saya</span>
                            <span class="text-xs text-[#75686D]">Lihat riwayat dan status pesanan</span>
                        </div>
                        <span class="text-base text-[#D98FAF]">📦</span>
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
