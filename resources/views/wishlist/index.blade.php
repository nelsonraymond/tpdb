<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wishlist Saya - Mutya Store</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

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
<body class="min-h-screen flex flex-col bg-[#FFF9F5]">
    <!-- Navbar -->
    <header class="bg-white border-b border-[#EBDDE2] sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                <span class="text-[#D98FAF] text-lg">❀</span>
                <span class="font-serif-display text-xl font-bold tracking-wider text-[#3A3033] uppercase">MUTYA</span>
            </a>

            <nav class="hidden md:flex items-center space-x-6 text-sm">
                <a href="{{ route('home') }}" class="text-[#75686D] hover:text-[#D98FAF] transition">Beranda</a>
                <a href="{{ route('shop.index') }}" class="text-[#75686D] hover:text-[#D98FAF] transition">Koleksi Produk</a>
            </nav>

            <div class="flex items-center space-x-4 text-sm">
                <a href="{{ route('wishlist.index') }}" class="text-[#D98FAF] font-semibold text-xs flex items-center">
                    <span class="mr-1">♥</span> Wishlist
                </a>
                <a href="{{ route('cart.index') }}" class="text-[#75686D] hover:text-[#D98FAF] text-xs font-medium flex items-center">
                    <span class="mr-1">🛒</span> Keranjang
                </a>
                <a href="{{ route('profile') }}" class="text-[#75686D] hover:text-[#3A3033] text-xs font-medium">
                    Akun
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="mb-8">
            <h1 class="font-serif-display text-2xl sm:text-3xl font-bold text-[#3A3033]">Daftar Keinginan (Wishlist)</h1>
            <p class="text-xs text-[#75686D] mt-1">Simpan produk hijab yang Anda sukai untuk dibeli nanti</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($wishlists->isEmpty())
            <div class="bg-white rounded-2xl border border-[#EBDDE2] p-12 text-center max-w-lg mx-auto shadow-xs">
                <div class="w-16 h-16 rounded-full bg-pink-50 text-[#D98FAF] flex items-center justify-center mx-auto mb-4 text-2xl">
                    ♡
                </div>
                <h2 class="font-serif-display text-xl font-bold text-[#3A3033]">Wishlist Anda Masih Kosong</h2>
                <p class="text-xs text-[#75686D] mt-1 mb-6">Tandai hijab favorit dengan ikon hati untuk menyimpannya di sini.</p>
                <a href="{{ route('shop.index') }}"
                    class="inline-block px-6 py-2.5 rounded-xl bg-[#D98FAF] hover:bg-[#B97897] text-white font-medium text-xs transition shadow-xs">
                    Jelajahi Koleksi Hijab
                </a>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($wishlists as $wish)
                    @php $product = $wish->product; @endphp
                    @if($product)
                        <div class="bg-white rounded-2xl border border-[#EBDDE2] overflow-hidden flex flex-col justify-between group shadow-xs hover:shadow-md transition">
                            <div class="relative aspect-4/5 block overflow-hidden bg-[#FFF9F5]">
                                @php $primaryImg = $product->primaryImage(); @endphp
                                @if ($primaryImg)
                                    <img src="{{ Storage::url($primaryImg->image_path) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-103 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#D98FAF] bg-pink-50/50">
                                        <span class="font-serif-display text-base italic">Mutya</span>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('wishlist.destroy', $product) }}" class="absolute top-2.5 right-2.5">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus dari Wishlist"
                                        class="w-8 h-8 rounded-full bg-white/90 text-rose-500 hover:text-rose-700 flex items-center justify-center shadow-xs transition cursor-pointer">
                                        ♥
                                    </button>
                                </form>
                            </div>

                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] text-[#75686D] block mb-0.5">{{ $product->category->name }}</span>
                                    <a href="{{ route('shop.product', $product->slug) }}"
                                        class="font-medium text-sm text-[#3A3033] hover:text-[#D98FAF] line-clamp-1">
                                        {{ $product->name }}
                                    </a>
                                    <div class="text-xs font-semibold text-[#3A3033] mt-1.5">
                                        Rp{{ number_format($product->base_price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="mt-3 pt-3 border-t border-[#EBDDE2]/60 flex items-center justify-between">
                                    <a href="{{ route('shop.product', $product->slug) }}"
                                        class="w-full py-1.5 rounded-xl bg-[#FFF9F5] hover:bg-[#F8C8DC]/30 border border-[#EBDDE2] text-xs font-medium text-[#3A3033] text-center transition">
                                        Lihat Pilihan Varian
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            @if($wishlists->hasPages())
                <div class="mt-8">
                    {{ $wishlists->links() }}
                </div>
            @endif
        @endif
    </main>
</body>
</html>
