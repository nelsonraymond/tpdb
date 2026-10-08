<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $selectedCategory ? $selectedCategory->name . ' - ' : '' }}Koleksi Hijab - Mutya Store</title>

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
                <a href="{{ route('shop.index') }}" class="text-[#D98FAF] font-medium">Koleksi Produk</a>
            </nav>

            <div class="flex items-center space-x-4 text-sm">
                <a href="{{ route('wishlist.index') }}" class="text-[#75686D] hover:text-[#D98FAF] text-xs font-medium flex items-center">
                    <span class="mr-1">♡</span> Wishlist
                </a>
                <a href="{{ route('cart.index') }}" class="text-[#75686D] hover:text-[#D98FAF] text-xs font-medium flex items-center">
                    <span class="mr-1">🛒</span> Keranjang
                </a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-xl bg-pink-100 text-[#D98FAF] font-medium text-xs">
                            Admin Panel
                        </a>
                    @else
                        <a href="{{ route('profile') }}" class="text-[#75686D] hover:text-[#3A3033] text-xs font-medium">
                            Akun
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-[#75686D] hover:text-red-600 transition cursor-pointer">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-[#75686D] hover:text-[#D98FAF] text-xs font-medium">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-3.5 py-1.5 rounded-xl bg-[#D98FAF] hover:bg-[#B97897] text-white text-xs font-medium transition">
                        Daftar
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Catalog Header -->
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-xs uppercase tracking-widest text-[#D98FAF] font-semibold">Koleksi Eksklusif</span>
            <h1 class="font-serif-display text-3xl sm:text-4xl font-bold text-[#3A3033] mt-1">
                {{ $selectedCategory ? $selectedCategory->name : 'Semua Koleksi Hijab' }}
            </h1>
            <p class="text-sm text-[#75686D] mt-2">
                {{ $selectedCategory?->description ?? 'Sentuhan kelembutan dan elegansi modern untuk menyempurnakan setiap penampilan Anda.' }}
            </p>
        </div>

        <!-- Filter & Search Controls -->
        <div class="bg-white rounded-2xl border border-[#EBDDE2] p-4 mb-8 shadow-xs">
            <form method="GET" action="{{ $selectedCategory ? route('shop.category', $selectedCategory) : route('shop.index') }}"
                class="flex flex-col md:flex-row gap-4 items-center justify-between">
                
                <!-- Category Pills (Horizontal Scroll on Mobile) -->
                <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-1 md:pb-0">
                    <a href="{{ route('shop.index') }}"
                        class="px-3.5 py-1.5 rounded-full text-xs font-medium shrink-0 transition {{ ! $selectedCategory ? 'bg-[#D98FAF] text-white' : 'bg-[#FFF9F5] text-[#75686D] hover:bg-[#F8C8DC]/30 border border-[#EBDDE2]' }}">
                        Semua
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('shop.category', $cat->slug) }}"
                            class="px-3.5 py-1.5 rounded-full text-xs font-medium shrink-0 transition {{ $selectedCategory?->id === $cat->id ? 'bg-[#D98FAF] text-white' : 'bg-[#FFF9F5] text-[#75686D] hover:bg-[#F8C8DC]/30 border border-[#EBDDE2]' }}">
                            {{ $cat->name }} <span class="opacity-70">({{ $cat->products_count }})</span>
                        </a>
                    @endforeach
                </div>

                <!-- Search & Sort Controls -->
                <div class="flex flex-wrap sm:flex-nowrap gap-3 w-full md:w-auto">
                    <div class="relative flex-1 sm:w-56">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari hijab..."
                            class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-[#EBDDE2] text-xs text-[#3A3033] bg-[#FFF9F5]/40 focus:outline-none focus:ring-1 focus:ring-[#D98FAF]">
                        <svg class="w-3.5 h-3.5 text-[#75686D] absolute left-2.5 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>

                    <select name="sort" onchange="this.form.submit()"
                        class="px-3 py-1.5 rounded-xl border border-[#EBDDE2] text-xs text-[#3A3033] bg-white focus:outline-none">
                        <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                        <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                        <option value="best_seller" {{ $sort === 'best_seller' ? 'selected' : '' }}>Best Seller</option>
                    </select>

                    <button type="submit" class="px-3.5 py-1.5 bg-[#3A3033] hover:bg-[#524449] text-white rounded-xl text-xs font-medium transition cursor-pointer">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @forelse ($products as $prod)
                <div class="bg-white rounded-2xl border border-[#EBDDE2] overflow-hidden group hover:shadow-md transition duration-300 flex flex-col">
                    <!-- Product Image Container (Ratio 4:5 as per DESIGN.md) -->
                    <a href="{{ route('shop.product', $prod->slug) }}" class="relative aspect-4/5 block overflow-hidden bg-[#FFF9F5]">
                        @php $primaryImg = $prod->primaryImage(); @endphp
                        @if ($primaryImg)
                            <img src="{{ Storage::url($primaryImg->image_path) }}" alt="{{ $prod->name }}"
                                class="w-full h-full object-cover group-hover:scale-103 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-[#D98FAF] bg-pink-50/50">
                                <span class="font-serif-display text-base italic text-[#D98FAF]">Mutya Hijab</span>
                            </div>
                        @endif

                        <!-- Badges -->
                        <div class="absolute top-2.5 left-2.5 flex flex-col gap-1">
                            @if ($prod->is_best_seller)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#D98FAF] text-white shadow-xs">
                                    Best Seller
                                </span>
                            @endif
                            @if ($prod->is_featured)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#C9A227] text-white shadow-xs">
                                    Pilihan
                                </span>
                            @endif
                        </div>
                    </a>

                    <!-- Product Info -->
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] text-[#75686D] block mb-0.5">{{ $prod->category->name }}</span>
                            <a href="{{ route('shop.product', $prod->slug) }}"
                                class="font-medium text-sm text-[#3A3033] hover:text-[#D98FAF] transition line-clamp-1">
                                {{ $prod->name }}
                            </a>
                            <div class="text-[11px] text-[#75686D] mt-0.5">{{ $prod->material }}</div>
                        </div>

                        <div class="mt-3 pt-3 border-t border-[#EBDDE2]/60 flex items-baseline justify-between">
                            <div>
                                <span class="text-sm font-semibold text-[#3A3033]">
                                    Rp{{ number_format($prod->base_price, 0, ',', '.') }}
                                </span>
                                @if ($prod->compare_at_price && $prod->compare_at_price > $prod->base_price)
                                    <span class="text-xs text-[#75686D] line-through ml-1">
                                        Rp{{ number_format($prod->compare_at_price, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>

                            @if($prod->hasAvailableStock())
                                <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full">
                                    Tersedia
                                </span>
                            @else
                                <span class="text-[10px] text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">
                                    Habis
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <p class="font-serif-display text-xl text-[#3A3033]">Belum ada produk yang ditemukan</p>
                    <p class="text-xs text-[#75686D] mt-1">Coba gunakan kata kunci lain atau pilih kategori lain.</p>
                    <a href="{{ route('shop.index') }}" class="mt-4 inline-block px-4 py-2 bg-[#D98FAF] text-white rounded-xl text-xs font-medium">
                        Lihat Semua Koleksi
                    </a>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @endif
    </main>
</body>
</html>
