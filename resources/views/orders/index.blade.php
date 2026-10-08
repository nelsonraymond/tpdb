<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Riwayat Pesanan Saya - Mutya Store</title>

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
                <a href="{{ route('orders.index') }}" class="text-[#D98FAF] font-semibold transition">Pesanan Saya</a>
            </nav>

            <div class="flex items-center space-x-4 text-sm">
                <a href="{{ route('wishlist.index') }}" class="text-[#75686D] hover:text-[#D98FAF] text-xs font-medium flex items-center">
                    <span class="mr-1">♡</span> Wishlist
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

    <main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
        <!-- Breadcrumb / Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-xs text-[#75686D] mb-1">
                <a href="{{ route('profile') }}" class="hover:underline">Akun</a>
                <span>/</span>
                <span class="text-[#3A3033] font-medium">Pesanan Saya</span>
            </div>
            <h1 class="font-serif-display text-2xl sm:text-3xl font-bold text-[#3A3033]">Riwayat Pesanan</h1>
            <p class="text-xs sm:text-sm text-[#75686D] mt-1">Lacak dan pantau status pemesanan hijab dan aksesori Anda.</p>
        </div>

        @if($orders->isEmpty())
            <div class="bg-white rounded-2xl border border-[#EBDDE2] p-10 text-center shadow-xs">
                <div class="w-16 h-16 mx-auto rounded-full bg-[#FFF9F5] border border-[#EBDDE2] flex items-center justify-center text-2xl text-[#D98FAF] mb-4">
                    📦
                </div>
                <h2 class="font-serif-display text-xl font-bold text-[#3A3033] mb-2">Belum Ada Riwayat Pesanan</h2>
                <p class="text-sm text-[#75686D] max-w-md mx-auto mb-6">
                    Anda belum pernah membuat pesanan di Mutya Store. Jelajahi katalog hijab anggun kami dan mulai berbelanja hari ini!
                </p>
                <a href="{{ route('shop.index') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-[#D98FAF] hover:bg-[#c97e9e] text-white text-sm font-medium rounded-xl transition">
                    Lihat Koleksi Produk
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] p-5 sm:p-6 shadow-xs hover:border-[#D98FAF]/60 transition">
                        <!-- Header Row -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-4 border-b border-[#EBDDE2]">
                            <div>
                                <div class="flex items-center space-x-3 flex-wrap gap-y-1">
                                    <span class="font-mono text-sm font-bold text-[#3A3033]">{{ $order->order_number }}</span>
                                    <span class="text-xs text-[#75686D]">
                                        {{ $order->placed_at ? $order->placed_at->format('d M Y, H:i') : $order->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 flex-wrap gap-y-1">
                                <!-- Order Status Badge -->
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $order->statusBadgeClass() }}">
                                    {{ $order->statusLabel() }}
                                </span>
                                <!-- Payment Status Badge -->
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $order->paymentStatusBadgeClass() }}">
                                    {{ $order->paymentStatusLabel() }}
                                </span>
                            </div>
                        </div>

                        <!-- Items Overview -->
                        <div class="py-4 space-y-3">
                            @foreach($order->items->take(2) as $item)
                                @php
                                    $primaryImage = $item->product?->primaryImage();
                                @endphp
                                <div class="flex items-center justify-between gap-4 text-xs">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-lg bg-[#FFF9F5] border border-[#EBDDE2] overflow-hidden shrink-0 flex items-center justify-center">
                                            @if($primaryImage)
                                                <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-sm text-[#D98FAF]">❀</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-[#3A3033]">{{ $item->product_name }}</p>
                                            <p class="text-[#75686D]">Varian: {{ $item->variant_name }} ({{ $item->quantity }} pcs)</p>
                                        </div>
                                    </div>
                                    <span class="font-medium text-[#3A3033] shrink-0">{{ $item->formattedSubtotal() }}</span>
                                </div>
                            @endforeach

                            @if($order->items->count() > 2)
                                <p class="text-[11px] text-[#75686D] italic">
                                    + {{ $order->items->count() - 2 }} produk lainnya
                                </p>
                            @endif
                        </div>

                        <!-- Footer Row -->
                        <div class="pt-4 border-t border-[#EBDDE2] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="text-xs text-[#75686D]">
                                Total Pesanan ({{ $order->items->sum('quantity') }} produk):
                                <span class="text-base font-bold text-[#D98FAF] ml-1">{{ $order->formattedGrandTotal() }}</span>
                            </div>

                            <div>
                                <a href="{{ route('orders.show', $order) }}"
                                    class="inline-flex items-center px-4 py-2 bg-[#FFF9F5] hover:bg-[#D98FAF] hover:text-white border border-[#EBDDE2] text-[#3A3033] text-xs font-medium rounded-xl transition">
                                    Lihat Detail & Lacak Pesanan →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="pt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </main>

    <footer class="mt-auto bg-white border-t border-[#EBDDE2] py-6 text-center text-xs text-[#75686D]">
        <p>&copy; {{ date('Y') }} Mutya Store. Soft Luxury Hijab Boutique.</p>
    </footer>
</body>
</html>
