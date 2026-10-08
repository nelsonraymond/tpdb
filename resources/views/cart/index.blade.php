<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Keranjang Belanja - Mutya Store</title>

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
                <a href="{{ route('wishlist.index') }}" class="text-[#75686D] hover:text-[#D98FAF] text-xs font-medium flex items-center">
                    <span class="mr-1">♡</span> Wishlist
                </a>
                <a href="{{ route('cart.index') }}" class="text-[#D98FAF] font-semibold text-xs flex items-center">
                    <span class="mr-1">🛒</span> Keranjang
                    @if($cart && $cart->totalItems() > 0)
                        <span class="ml-1 px-1.5 py-0.2 rounded-full bg-[#D98FAF] text-white text-[10px]">
                            {{ $cart->totalItems() }}
                        </span>
                    @endif
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

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="mb-8">
            <h1 class="font-serif-display text-2xl sm:text-3xl font-bold text-[#3A3033]">Keranjang Belanja</h1>
            <p class="text-xs text-[#75686D] mt-1">Periksa kembali pilihan hijab favorit Anda sebelum melanjutkan</p>
        </div>

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

        @if(! $cart || $cart->items->isEmpty())
            <div class="bg-white rounded-2xl border border-[#EBDDE2] p-12 text-center max-w-lg mx-auto shadow-xs">
                <div class="w-16 h-16 rounded-full bg-pink-50 text-[#D98FAF] flex items-center justify-center mx-auto mb-4 text-2xl">
                    🛍️
                </div>
                <h2 class="font-serif-display text-xl font-bold text-[#3A3033]">Keranjang Anda Masih Kosong</h2>
                <p class="text-xs text-[#75686D] mt-1 mb-6">Jelajahi koleksi hijab kami dan temukan pilihan anggun favorit Anda.</p>
                <a href="{{ route('shop.index') }}"
                    class="inline-block px-6 py-2.5 rounded-xl bg-[#D98FAF] hover:bg-[#B97897] text-white font-medium text-xs transition shadow-xs">
                    Mulai Belanja Hijab
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items Table / List -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] overflow-hidden shadow-xs">
                        <div class="p-4 bg-[#FFF9F5] border-b border-[#EBDDE2] flex justify-between items-center text-xs font-semibold text-[#75686D] uppercase">
                            <span>Item Produk ({{ $cart->totalItems() }})</span>
                            <form method="POST" action="{{ route('cart.destroy') }}" onsubmit="return confirm('Kosongkan keranjang belanja?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-normal normal-case cursor-pointer">
                                    Kosongkan Keranjang
                                </button>
                            </form>
                        </div>

                        <div class="divide-y divide-[#EBDDE2]">
                            @foreach($cart->items as $item)
                                @php
                                    $variant = $item->variant;
                                    $product = $variant->product;
                                    $img = $product->primaryImage();
                                @endphp
                                <div class="p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                    <div class="flex items-center space-x-3.5">
                                        @if($img)
                                            <img src="{{ Storage::url($img->image_path) }}" alt="{{ $product->name }}"
                                                class="w-16 h-20 object-cover rounded-xl border border-[#EBDDE2] bg-[#FFF9F5] shrink-0">
                                        @else
                                            <div class="w-16 h-20 rounded-xl bg-pink-50 border border-[#EBDDE2] flex items-center justify-center text-[#D98FAF] text-[10px] shrink-0">
                                                Mutya
                                            </div>
                                        @endif
                                        <div>
                                            <span class="text-[10px] text-[#75686D] uppercase tracking-wider block">{{ $product->category->name }}</span>
                                            <a href="{{ route('shop.product', $product->slug) }}" class="font-medium text-sm text-[#3A3033] hover:text-[#D98FAF] transition">
                                                {{ $product->name }}
                                            </a>
                                            <div class="flex items-center space-x-2 text-xs text-[#75686D] mt-1">
                                                @if($variant->color_hex)
                                                    <span class="w-3 h-3 rounded-full border border-gray-300" style="background-color: {{ $variant->color_hex }}"></span>
                                                @endif
                                                <span>{{ $variant->name }}</span>
                                                <span>•</span>
                                                <span>{{ $variant->size ?? 'All Size' }}</span>
                                            </div>
                                            <div class="text-xs font-semibold text-[#3A3033] mt-1">
                                                Rp{{ number_format($item->unit_price, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quantity Update & Subtotal Controls -->
                                    <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-4">
                                        <form method="POST" action="{{ route('cart.items.update', $item) }}" class="flex items-center space-x-1.5">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $variant->stock_qty }}"
                                                class="w-16 px-2 py-1.5 border border-[#EBDDE2] rounded-xl text-center text-xs bg-[#FFF9F5]/40 focus:outline-none focus:ring-1 focus:ring-[#D98FAF]">
                                            <button type="submit" title="Perbarui Kuantitas"
                                                class="px-2.5 py-1.5 rounded-xl border border-[#EBDDE2] text-xs font-medium text-[#75686D] hover:bg-[#FFF9F5] transition cursor-pointer">
                                                Ubah
                                            </button>
                                        </form>

                                        <div class="text-right">
                                            <span class="text-xs font-bold text-[#3A3033] block">
                                                Rp{{ number_format($item->subtotal(), 0, ',', '.') }}
                                            </span>
                                            <form method="POST" action="{{ route('cart.items.destroy', $item) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-[11px] text-red-500 hover:text-red-700 cursor-pointer">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary Column -->
                <div class="space-y-4">
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs space-y-4">
                        <h2 class="font-serif-display text-lg font-bold text-[#3A3033] border-b border-[#EBDDE2] pb-3">
                            Ringkasan Belanja
                        </h2>

                        <div class="space-y-2 text-xs text-[#75686D]">
                            <div class="flex justify-between">
                                <span>Total Item</span>
                                <span class="font-medium text-[#3A3033]">{{ $cart->totalItems() }} pcs</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Subtotal Produk</span>
                                <span class="font-semibold text-[#3A3033]">
                                    Rp{{ number_format($cart->subtotal(), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span>Biaya Pengiriman</span>
                                <span class="text-emerald-700">Dihitung saat checkout</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-[#EBDDE2] flex justify-between items-baseline">
                            <span class="text-sm font-bold text-[#3A3033]">Total Subtotal</span>
                            <span class="text-xl font-bold text-[#D98FAF]">
                                Rp{{ number_format($cart->subtotal(), 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                            class="block w-full py-3 rounded-xl bg-[#D98FAF] hover:bg-[#c97e9e] text-white font-medium text-xs transition shadow-xs text-center">
                            Lanjut ke Checkout →
                        </a>

                        <a href="{{ route('shop.index') }}"
                            class="block w-full py-2.5 rounded-xl border border-[#EBDDE2] text-xs font-medium text-[#75686D] hover:bg-[#FFF9F5] text-center transition">
                            ← Lanjut Berbelanja
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </main>
</body>
</html>
