<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Pesanan #{{ $order->order_number }} - Mutya Store</title>

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

            <div class="flex items-center space-x-4 text-sm">
                <a href="{{ route('orders.index') }}" class="text-[#75686D] hover:text-[#3A3033] text-xs font-medium">
                    ← Kembali ke Riwayat Pesanan
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-5xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
        <!-- Success Alert if just placed -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="text-emerald-500 font-bold">✓</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Order Header Card -->
        <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-4 border-b border-[#EBDDE2]">
                <div>
                    <div class="flex items-center space-x-2 text-xs text-[#75686D] mb-1">
                        <span>Waktu Pesan:</span>
                        <span class="text-[#3A3033] font-medium">
                            {{ $order->placed_at ? $order->placed_at->format('d M Y, H:i') : $order->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                    <h1 class="font-serif-display text-xl sm:text-2xl font-bold text-[#3A3033]">
                        Pesanan <span class="font-mono text-[#D98FAF]">#{{ $order->order_number }}</span>
                    </h1>
                </div>

                <div class="flex items-center space-x-2 flex-wrap gap-y-2">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $order->statusBadgeClass() }}">
                        Status: {{ $order->statusLabel() }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $order->paymentStatusBadgeClass() }}">
                        Pembayaran: {{ $order->paymentStatusLabel() }}
                    </span>
                </div>
            </div>

            <!-- Visual Order Tracking Timeline -->
            <div class="pt-6">
                <h2 class="text-xs font-semibold text-[#75686D] uppercase tracking-wider mb-5">
                    Lacak Perjalanan Pesanan
                </h2>

                @if($order->isCancelled())
                    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                        <p class="font-semibold text-rose-900 mb-1">✕ Pesanan Ini Telah Dibatalkan</p>
                        <p>Pesanan telah dibatalkan dan tidak lagi diproses. Stok telah dikembalikan ke inventaris.</p>
                    </div>
                @else
                    <!-- Stepper Timeline -->
                    <div class="relative">
                        <!-- Horizontal Track (desktop) -->
                        <div class="hidden md:grid grid-cols-7 gap-2 relative">
                            <!-- Background connecting bar -->
                            <div class="absolute top-4 left-6 right-6 h-0.5 bg-[#EBDDE2] -z-0"></div>

                            @foreach($order->trackingTimeline() as $step)
                                <div class="flex flex-col items-center text-center relative z-10">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold transition {{ $step['is_completed'] ? 'bg-[#D98FAF] text-white shadow-xs' : 'bg-white border-2 border-[#EBDDE2] text-[#75686D]' }} {{ $step['is_current'] ? 'ring-4 ring-[#D98FAF]/25 scale-105' : '' }}">
                                        @if($step['is_completed'] && ! $step['is_current'])
                                            ✓
                                        @else
                                            {{ $loop->iteration }}
                                        @endif
                                    </div>
                                    <span class="text-xs font-semibold mt-2 {{ $step['is_completed'] ? 'text-[#3A3033]' : 'text-[#75686D]' }}">
                                        {{ $step['title'] }}
                                    </span>
                                    <span class="text-[10px] text-[#75686D] mt-0.5 max-w-[100px] leading-tight">
                                        {{ $step['description'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Vertical Track (mobile) -->
                        <div class="md:hidden space-y-4 relative pl-6 before:content-[''] before:absolute before:left-2.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-[#EBDDE2]">
                            @foreach($order->trackingTimeline() as $step)
                                <div class="relative flex items-start space-x-3">
                                    <div class="absolute -left-6 top-0.5 w-5 h-5 rounded-full flex items-center justify-center text-[10px] font-bold {{ $step['is_completed'] ? 'bg-[#D98FAF] text-white' : 'bg-white border border-[#EBDDE2] text-[#75686D]' }} {{ $step['is_current'] ? 'ring-2 ring-[#D98FAF]/30' : '' }}">
                                        @if($step['is_completed'] && ! $step['is_current'])
                                            ✓
                                        @else
                                            {{ $loop->iteration }}
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold {{ $step['is_completed'] ? 'text-[#3A3033]' : 'text-[#75686D]' }}">
                                            {{ $step['title'] }}
                                        </p>
                                        <p class="text-[11px] text-[#75686D]">{{ $step['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            <!-- Left: Order Items & Delivery Info -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Purchased Items Snapshot Card -->
                <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs">
                    <h2 class="font-serif-display text-base font-bold text-[#3A3033] pb-3 border-b border-[#EBDDE2] mb-4">
                        Daftar Produk yang Dipesan
                    </h2>

                    <div class="divide-y divide-[#EBDDE2]">
                        @foreach($order->items as $item)
                            @php
                                $primaryImage = $item->product?->primaryImage();
                            @endphp
                            <div class="py-4 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
                                <div class="flex items-center space-x-3.5">
                                    <div class="w-14 h-14 rounded-xl bg-[#FFF9F5] border border-[#EBDDE2] overflow-hidden shrink-0 flex items-center justify-center">
                                        @if($primaryImage)
                                            <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-lg text-[#D98FAF]">❀</span>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-sm text-[#3A3033]">{{ $item->product_name }}</h3>
                                        <div class="flex items-center space-x-2 text-xs text-[#75686D] mt-0.5">
                                            <span>Varian: <strong class="text-[#3A3033]">{{ $item->variant_name }}</strong></span>
                                            <span>•</span>
                                            <span class="font-mono text-[11px]">{{ $item->sku }}</span>
                                        </div>
                                        <p class="text-xs text-[#75686D] mt-0.5">
                                            {{ $item->quantity }} x {{ $item->formattedUnitPrice() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="font-semibold text-sm text-[#3A3033]">
                                        {{ $item->formattedSubtotal() }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Address Card -->
                <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs">
                    <h2 class="font-serif-display text-base font-bold text-[#3A3033] pb-3 border-b border-[#EBDDE2] mb-4">
                        Alamat Pengiriman
                    </h2>

                    <div class="text-xs space-y-2">
                        <div class="flex items-baseline space-x-2">
                            <span class="font-semibold text-sm text-[#3A3033]">{{ $order->shipping_recipient_name }}</span>
                            <span class="text-[#75686D] font-mono">({{ $order->shipping_phone }})</span>
                        </div>
                        <p class="text-sm text-[#3A3033] leading-relaxed">
                            {{ $order->shipping_address }}
                        </p>
                        <p class="text-[#75686D]">
                            {{ $order->shipping_city }}, {{ $order->shipping_province }} {{ $order->shipping_postal_code }}
                        </p>

                        @if($order->customer_note)
                            <div class="mt-4 p-3 rounded-xl bg-[#FFF9F5] border border-[#EBDDE2] text-xs text-[#75686D]">
                                <strong class="text-[#3A3033] block mb-0.5">Catatan Pesanan dari Anda:</strong>
                                {{ $order->customer_note }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Shipping & Price Breakdown -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Shipment Card -->
                <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs">
                    <h2 class="font-serif-display text-base font-bold text-[#3A3033] pb-3 border-b border-[#EBDDE2] mb-4">
                        Informasi Ekspedisi
                    </h2>

                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between">
                            <span class="text-[#75686D]">Kurir:</span>
                            <span class="font-medium text-[#3A3033]">{{ $order->shipment?->courier ?? 'Mutya Express Delivery' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#75686D]">Layanan:</span>
                            <span class="font-medium text-[#3A3033]">{{ $order->shipment?->service ?? 'Reguler' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#75686D]">No. Resi:</span>
                            <span class="font-mono font-medium text-[#3A3033]">
                                {{ $order->shipment?->tracking_number ?? 'Belum diterbitkan' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#75686D]">Status Pengiriman:</span>
                            <span class="font-medium text-[#D98FAF] uppercase">
                                {{ $order->shipment?->status ?? 'Menunggu Pengiriman' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Price Summary Card -->
                <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs space-y-3 text-xs">
                    <h2 class="font-serif-display text-base font-bold text-[#3A3033] pb-3 border-b border-[#EBDDE2]">
                        Rincian Pembayaran
                    </h2>

                    <div class="flex justify-between text-[#75686D]">
                        <span>Subtotal Produk</span>
                        <span class="font-medium text-[#3A3033]">{{ $order->formattedSubtotal() }}</span>
                    </div>

                    <div class="flex justify-between text-[#75686D]">
                        <span>Biaya Pengiriman</span>
                        <span class="font-medium text-[#3A3033]">{{ $order->formattedShippingCost() }}</span>
                    </div>

                    @if($order->discount_amount > 0)
                        <div class="flex justify-between text-emerald-600">
                            <span>Diskon Voucher</span>
                            <span class="font-medium">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <div class="pt-3 border-t border-[#EBDDE2] flex justify-between items-baseline text-sm">
                        <span class="font-bold text-[#3A3033]">Total Akhir</span>
                        <span class="font-serif-display text-lg font-bold text-[#D98FAF]">
                            {{ $order->formattedGrandTotal() }}
                        </span>
                    </div>
                </div>

                <div class="text-center pt-2">
                    <a href="{{ route('shop.index') }}"
                        class="text-xs text-[#75686D] hover:text-[#D98FAF] font-medium transition">
                        ← Lanjutkan Berbelanja
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-auto bg-white border-t border-[#EBDDE2] py-6 text-center text-xs text-[#75686D]">
        <p>&copy; {{ date('Y') }} Mutya Store. Soft Luxury Hijab Boutique.</p>
    </footer>
</body>
</html>
