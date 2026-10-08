<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $product->name }} - Mutya Store</title>

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
                    <a href="{{ route('profile') }}" class="text-[#75686D] hover:text-[#3A3033] text-xs font-medium">
                        Akun
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-[#75686D] hover:text-[#D98FAF] text-xs font-medium">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Alerts -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-sm text-red-800">
                <ul class="list-disc list-inside text-xs space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Breadcrumb -->
        <nav class="text-xs text-[#75686D] mb-6 flex items-center space-x-2">
            <a href="{{ route('home') }}" class="hover:text-[#D98FAF]">Beranda</a>
            <span>/</span>
            <a href="{{ route('shop.index') }}" class="hover:text-[#D98FAF]">Koleksi</a>
            <span>/</span>
            <a href="{{ route('shop.category', $product->category->slug) }}" class="hover:text-[#D98FAF]">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-[#3A3033] font-medium truncate">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 bg-white rounded-2xl border border-[#EBDDE2] p-6 sm:p-8 shadow-xs">
            <!-- Left: Images Gallery -->
            <div class="space-y-4">
                @php $primaryImg = $product->primaryImage(); @endphp
                <div class="aspect-4/5 rounded-2xl overflow-hidden bg-[#FFF9F5] border border-[#EBDDE2]">
                    @if ($primaryImg)
                        <img src="{{ Storage::url($primaryImg->image_path) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-[#D98FAF]">
                            <span class="font-serif-display text-xl italic">Mutya Hijab</span>
                        </div>
                    @endif
                </div>

                @if($product->images->count() > 1)
                    <div class="flex gap-2 overflow-x-auto pb-2">
                        @foreach($product->images as $img)
                            <div class="w-16 h-20 rounded-xl overflow-hidden border border-[#EBDDE2] shrink-0 bg-[#FFF9F5]">
                                <img src="{{ Storage::url($img->image_path) }}" alt="{{ $img->alt_text }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right: Product Information & Purchase Controls -->
            <div class="flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs uppercase tracking-wider text-[#D98FAF] font-semibold">{{ $product->category->name }}</span>
                            <span class="text-xs text-gray-300">•</span>
                            <span class="text-xs text-[#75686D] font-mono">SKU: {{ $product->sku }}</span>
                        </div>

                        <!-- Wishlist Toggle Button -->
                        @auth
                            @php
                                $isWishlisted = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
                            @endphp
                            <form method="POST" action="{{ route('wishlist.toggle', $product) }}">
                                @csrf
                                <button type="submit" title="{{ $isWishlisted ? 'Hapus dari Wishlist' : 'Simpan ke Wishlist' }}"
                                    class="p-2 rounded-xl border border-[#EBDDE2] hover:bg-[#FFF9F5] transition flex items-center text-xs {{ $isWishlisted ? 'text-rose-500 font-semibold' : 'text-[#75686D]' }} cursor-pointer">
                                    <span class="text-base mr-1">{{ $isWishlisted ? '♥' : '♡' }}</span>
                                    <span>{{ $isWishlisted ? 'Tersimpan' : 'Wishlist' }}</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" title="Masuk untuk menyimpan ke Wishlist"
                                class="p-2 rounded-xl border border-[#EBDDE2] hover:bg-[#FFF9F5] transition flex items-center text-xs text-[#75686D]">
                                <span class="text-base mr-1">♡</span> Wishlist
                            </a>
                        @endauth
                    </div>

                    <h1 class="font-serif-display text-2xl sm:text-3xl font-bold text-[#3A3033]">
                        {{ $product->name }}
                    </h1>

                    <!-- Rating & Reviews Summary -->
                    <div class="flex items-center space-x-2 mt-2">
                        <div class="flex text-amber-400 text-xs">
                            @for($i = 1; $i <= 5; $i++)
                                <span>{{ $i <= round($averageRating) ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                        <span class="text-xs font-semibold text-[#3A3033]">{{ number_format($averageRating, 1) }}</span>
                        <span class="text-xs text-[#75686D]">({{ $reviewCount }} ulasan)</span>
                    </div>

                    <!-- Price -->
                    <div class="mt-4 flex items-baseline space-x-3">
                        <span class="text-2xl font-bold text-[#3A3033]">
                            Rp{{ number_format($product->base_price, 0, ',', '.') }}
                        </span>
                        @if ($product->compare_at_price && $product->compare_at_price > $product->base_price)
                            <span class="text-sm text-[#75686D] line-through">
                                Rp{{ number_format($product->compare_at_price, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>

                    <!-- Material & Details -->
                    <div class="mt-4 py-3 border-y border-[#EBDDE2] space-y-1 text-xs text-[#75686D]">
                        @if($product->material)
                            <div><strong>Bahan:</strong> {{ $product->material }}</div>
                        @endif
                        @if($product->care_instructions)
                            <div><strong>Perawatan:</strong> {{ $product->care_instructions }}</div>
                        @endif
                    </div>

                    <!-- Add to Cart Form -->
                    <form method="POST" action="{{ route('cart.items.store') }}" class="mt-5 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-[#3A3033] mb-2">
                                Pilih Varian Warna & Ukuran <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                                @forelse($product->variants as $index => $variant)
                                    <label class="relative p-2.5 rounded-xl border border-[#EBDDE2] text-xs transition cursor-pointer has-checked:border-[#D98FAF] has-checked:bg-pink-50/40 {{ $variant->stock_qty <= 0 ? 'opacity-40 pointer-events-none' : 'hover:border-[#D98FAF]' }}">
                                        <input type="radio" name="product_variant_id" value="{{ $variant->id }}"
                                            {{ $index === 0 && $variant->stock_qty > 0 ? 'checked' : '' }}
                                            class="sr-only">
                                        <div class="flex items-center space-x-2">
                                            @if($variant->color_hex)
                                                <span class="w-3.5 h-3.5 rounded-full border border-gray-300 shrink-0" style="background-color: {{ $variant->color_hex }}"></span>
                                            @endif
                                            <span class="font-medium text-[#3A3033] truncate">{{ $variant->name }}</span>
                                        </div>
                                        <div class="flex items-center justify-between text-[10px] text-[#75686D] mt-1">
                                            <span>{{ $variant->size ?? 'All Size' }}</span>
                                            <span>{{ $variant->stock_qty > 0 ? $variant->stock_qty . ' pcs' : 'Habis' }}</span>
                                        </div>
                                        @if($variant->additional_price > 0)
                                            <div class="text-[10px] text-[#D98FAF] font-medium mt-0.5">
                                                +Rp{{ number_format($variant->additional_price, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </label>
                                @empty
                                    <div class="col-span-full text-xs text-[#75686D]">Belum ada varian produk.</div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="flex items-center space-x-3 pt-2">
                            <label for="quantity" class="text-xs font-semibold text-[#3A3033]">Kuantitas:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ max(1, $totalStock) }}"
                                class="w-20 px-3 py-1.5 rounded-xl border border-[#EBDDE2] text-xs text-center text-[#3A3033] bg-[#FFF9F5]/40 focus:outline-none focus:ring-1 focus:ring-[#D98FAF]">
                            <span class="text-xs text-[#75686D]">
                                Total Stok Tersedia: <strong>{{ $totalStock }} pcs</strong>
                            </span>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-3">
                            @if($totalStock > 0 && $product->variants->isNotEmpty())
                                <button type="submit"
                                    class="w-full py-3 rounded-xl bg-[#D98FAF] hover:bg-[#B97897] text-white font-medium text-sm shadow-xs transition cursor-pointer">
                                    + Tambah ke Keranjang
                                </button>
                            @else
                                <button type="button" disabled
                                    class="w-full py-3 rounded-xl bg-gray-200 text-gray-500 font-medium text-sm cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </form>

                    <!-- Description -->
                    <div class="mt-6 pt-5 border-t border-[#EBDDE2]">
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-[#3A3033] mb-1.5">Deskripsi Produk</h3>
                        <p class="text-xs text-[#75686D] leading-relaxed whitespace-pre-line">
                            {{ $product->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
