<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Checkout & Pembayaran - Mutya Store</title>

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
                <a href="{{ route('cart.index') }}" class="text-[#75686D] hover:text-[#3A3033] text-xs font-medium">
                    ← Kembali ke Keranjang
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="font-serif-display text-2xl sm:text-3xl font-bold text-[#3A3033]">Checkout Pesanan</h1>
            <p class="text-xs sm:text-sm text-[#75686D] mt-1">Periksa alamat pengiriman, metode kurir, dan rincian hijab pilihan Anda.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm space-y-1">
                <p class="font-semibold text-rose-900">Periksa kesalahan sebelum melanjutkan:</p>
                <ul class="list-disc list-inside text-xs">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="checkout-form" method="POST" action="{{ route('checkout.store') }}">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <!-- Left Section: Forms & Order Items -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- 1. Shipping Address Section -->
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs">
                        <div class="flex items-center justify-between pb-4 border-b border-[#EBDDE2] mb-5">
                            <div class="flex items-center space-x-2.5">
                                <span class="w-7 h-7 rounded-full bg-[#D98FAF]/15 text-[#D98FAF] flex items-center justify-center text-xs font-bold">1</span>
                                <h2 class="font-semibold text-base text-[#3A3033]">Alamat Pengiriman</h2>
                            </div>
                            <a href="{{ route('addresses.create', ['redirect_to' => route('checkout.index')]) }}"
                                class="text-xs text-[#D98FAF] hover:text-[#c97e9e] font-medium flex items-center">
                                + Tambah Alamat Baru
                            </a>
                        </div>

                        @if($addresses->isEmpty())
                            <div class="p-6 rounded-xl bg-[#FFF9F5] border border-dashed border-[#D98FAF]/50 text-center">
                                <p class="text-sm font-medium text-[#3A3033] mb-1">Anda belum memiliki alamat pengiriman tersimpan</p>
                                <p class="text-xs text-[#75686D] mb-4">Mohon tambahkan alamat pengiriman terlebih dahulu untuk melanjutkan proses pesanan.</p>
                                <a href="{{ route('addresses.create', ['redirect_to' => route('checkout.index')]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-[#D98FAF] hover:bg-[#c97e9e] text-white text-xs font-medium rounded-xl transition">
                                    + Tambah Alamat Sekarang
                                </a>
                            </div>
                        @else
                            <div class="space-y-3">
                                @foreach($addresses as $addr)
                                    <label class="block p-4 rounded-xl border {{ old('address_id', $defaultAddress?->id) == $addr->id ? 'border-[#D98FAF] bg-[#FFF9F5]/40 ring-1 ring-[#D98FAF]/30' : 'border-[#EBDDE2] bg-white' }} cursor-pointer hover:border-[#D98FAF]/70 transition">
                                        <div class="flex items-start space-x-3">
                                            <input type="radio" name="address_id" value="{{ $addr->id }}"
                                                {{ old('address_id', $defaultAddress?->id) == $addr->id ? 'checked' : '' }}
                                                class="mt-1 text-[#D98FAF] focus:ring-[#D98FAF] border-[#EBDDE2]">
                                            <div class="flex-1 text-xs">
                                                <div class="flex items-center space-x-2 mb-1">
                                                    <span class="font-semibold text-sm text-[#3A3033]">{{ $addr->recipient_name }}</span>
                                                    <span class="text-[#75686D] font-mono">({{ $addr->phone }})</span>
                                                    @if($addr->label)
                                                        <span class="px-2 py-0.5 rounded-full text-[10px] bg-stone-100 text-[#75686D]">{{ $addr->label }}</span>
                                                    @endif
                                                    @if($addr->is_default)
                                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-[#D98FAF]/15 text-[#D98FAF]">Utama</span>
                                                    @endif
                                                </div>
                                                <p class="text-[#3A3033] leading-relaxed">{{ $addr->fullAddress() }}</p>
                                                @if($addr->notes)
                                                    <p class="text-[11px] text-[#75686D] italic mt-1">Patokan: {{ $addr->notes }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- 2. Shipping Method Section -->
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs">
                        <div class="flex items-center space-x-2.5 pb-4 border-b border-[#EBDDE2] mb-5">
                            <span class="w-7 h-7 rounded-full bg-[#D98FAF]/15 text-[#D98FAF] flex items-center justify-center text-xs font-bold">2</span>
                            <h2 class="font-semibold text-base text-[#3A3033]">Metode Pengiriman</h2>
                        </div>

                        <div class="space-y-3">
                            @foreach($shippingMethods as $method)
                                <label class="block p-4 rounded-xl border border-[#EBDDE2] hover:border-[#D98FAF]/70 cursor-pointer transition">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <input type="radio" name="shipping_method" value="{{ $method['code'] }}"
                                                data-cost="{{ $method['cost'] }}"
                                                {{ old('shipping_method', $defaultShipping) === $method['code'] ? 'checked' : '' }}
                                                class="shipping-method-radio text-[#D98FAF] focus:ring-[#D98FAF] border-[#EBDDE2]">
                                            <div>
                                                <div class="flex items-center space-x-2">
                                                    <span class="font-semibold text-sm text-[#3A3033]">{{ $method['courier'] }} - {{ $method['name'] }}</span>
                                                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-[#FFF9F5] border border-[#EBDDE2] text-[#75686D]">
                                                        {{ $method['estimated_days'] }}
                                                    </span>
                                                </div>
                                                <p class="text-xs text-[#75686D] mt-0.5">{{ $method['description'] }}</p>
                                            </div>
                                        </div>
                                        <span class="font-semibold text-sm text-[#3A3033]">
                                            Rp {{ number_format($method['cost'], 0, ',', '.') }}
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. Customer Note Section -->
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs">
                        <div class="flex items-center space-x-2.5 pb-4 border-b border-[#EBDDE2] mb-4">
                            <span class="w-7 h-7 rounded-full bg-[#D98FAF]/15 text-[#D98FAF] flex items-center justify-center text-xs font-bold">3</span>
                            <h2 class="font-semibold text-base text-[#3A3033]">Catatan Pesanan (Opsional)</h2>
                        </div>

                        <div>
                            <textarea name="customer_note" id="customer_note" rows="2"
                                placeholder="Tambahkan instruksi khusus untuk pesanan atau kurir (opsional)..."
                                class="w-full px-3.5 py-2.5 rounded-xl border border-[#EBDDE2] bg-[#FFF9F5]/40 text-sm focus:outline-none focus:border-[#D98FAF] focus:ring-1 focus:ring-[#D98FAF]">{{ old('customer_note') }}</textarea>
                        </div>
                    </div>

                    <!-- 4. Order Items Review Section -->
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs">
                        <div class="flex items-center justify-between pb-4 border-b border-[#EBDDE2] mb-4">
                            <h2 class="font-semibold text-base text-[#3A3033]">Produk yang Dipesan ({{ $itemCount }} item)</h2>
                            <a href="{{ route('cart.index') }}" class="text-xs text-[#D98FAF] hover:text-[#c97e9e] font-medium">Ubah Keranjang</a>
                        </div>

                        <div class="divide-y divide-[#EBDDE2]">
                            @foreach($cartItems as $item)
                                @php
                                    $variant = $item->variant;
                                    $product = $variant->product;
                                    $primaryImage = $product->primaryImage();
                                @endphp
                                <div class="py-4 first:pt-0 last:pb-0 flex items-center justify-between gap-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-14 h-14 rounded-xl bg-[#FFF9F5] border border-[#EBDDE2] overflow-hidden shrink-0 flex items-center justify-center">
                                            @if($primaryImage)
                                                <img src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-xl text-[#D98FAF]">❀</span>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-sm text-[#3A3033]">{{ $product->name }}</h3>
                                            <div class="flex items-center space-x-2 text-xs text-[#75686D] mt-0.5">
                                                <span>Varian: <strong class="text-[#3A3033]">{{ $variant->name }}</strong></span>
                                                <span>•</span>
                                                <span class="font-mono text-[11px]">{{ $variant->sku }}</span>
                                            </div>
                                            <p class="text-xs text-[#75686D] mt-0.5">
                                                {{ $item->quantity }} x Rp {{ number_format($variant->finalPrice(), 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <span class="font-semibold text-sm text-[#3A3033]">
                                            Rp {{ number_format($variant->finalPrice() * $item->quantity, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Section: Sticky Summary & Confirmation -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs sticky top-24 space-y-5">
                        <h2 class="font-serif-display text-lg font-bold text-[#3A3033] pb-3 border-b border-[#EBDDE2]">
                            Ringkasan Pembayaran
                        </h2>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between text-[#75686D]">
                                <span>Subtotal Produk</span>
                                <span class="font-medium text-[#3A3033]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between text-[#75686D]">
                                <span>Biaya Pengiriman</span>
                                <span id="summary-shipping" class="font-medium text-[#3A3033]">
                                    Rp {{ number_format($shippingCost, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between text-[#75686D]">
                                <span>Diskon Voucher</span>
                                <span class="font-medium text-emerald-600">- Rp 0</span>
                            </div>

                            <div class="pt-3 border-t border-[#EBDDE2] flex justify-between items-baseline">
                                <span class="font-semibold text-base text-[#3A3033]">Total Pembayaran</span>
                                <div class="text-right">
                                    <span id="summary-grand-total" class="font-serif-display text-xl font-bold text-[#D98FAF]">
                                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Confirmation Button -->
                        <div class="pt-2">
                            <button type="submit"
                                {{ $addresses->isEmpty() ? 'disabled' : '' }}
                                class="w-full py-3.5 px-4 bg-[#D98FAF] hover:bg-[#c97e9e] disabled:bg-stone-300 disabled:cursor-not-allowed text-white font-semibold text-sm rounded-xl shadow-xs transition flex items-center justify-center space-x-2">
                                <span>Konfirmasi & Buat Pesanan</span>
                                <span>→</span>
                            </button>
                            @if($addresses->isEmpty())
                                <p class="text-[11px] text-rose-500 text-center mt-2">
                                    Tambahkan alamat pengiriman terlebih dahulu untuk konfirmasi pesanan.
                                </p>
                            @endif
                        </div>

                        <!-- Trust Features -->
                        <div class="pt-4 border-t border-[#EBDDE2] space-y-2 text-[11px] text-[#75686D]">
                            <div class="flex items-center space-x-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Stok produk terkunci otomatis saat pemesanan</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Rincian produk & harga snapshot permanen</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-emerald-500 font-bold">✓</span>
                                <span>Perhitungan harga & stok diverifikasi server-side</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>

    <footer class="mt-auto bg-white border-t border-[#EBDDE2] py-6 text-center text-xs text-[#75686D]">
        <p>&copy; {{ date('Y') }} Mutya Store. Soft Luxury Hijab Boutique.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subtotal = {{ $subtotal }};
            const shippingRadios = document.querySelectorAll('.shipping-method-radio');
            const summaryShipping = document.getElementById('summary-shipping');
            const summaryGrandTotal = document.getElementById('summary-grand-total');

            function formatRupiah(num) {
                return 'Rp ' + Number(num).toLocaleString('id-ID');
            }

            shippingRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.checked) {
                        const cost = parseFloat(this.dataset.cost || 0);
                        const grandTotal = subtotal + cost;

                        if (summaryShipping) {
                            summaryShipping.textContent = formatRupiah(cost);
                        }
                        if (summaryGrandTotal) {
                            summaryGrandTotal.textContent = formatRupiah(grandTotal);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
