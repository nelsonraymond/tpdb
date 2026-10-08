<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pembayaran Pesanan #{{ $order->order_number }} - Mutya Store</title>

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
                <a href="{{ route('shop.index') }}" class="hidden sm:inline text-[#75686D] hover:text-[#3A3033] text-xs font-medium">Belanja Lagi</a>
                <a href="{{ route('orders.show', $order) }}" class="text-[#75686D] hover:text-[#3A3033] text-xs font-medium">
                    ← Detail Pesanan
                </a>
            </div>
        </div>
    </header>

    <main class="flex-1 max-w-3xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10 relative">
        <!-- Subtle floral decoration -->
        <div class="pointer-events-none select-none absolute -top-4 right-2 text-[#EBDDE2] text-6xl opacity-40">❀</div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">{{ session('error') }}</div>
        @endif

        <!-- Header Card -->
        <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs mb-6">
            <p class="text-xs text-[#75686D] mb-1">Selesaikan pembayaran untuk pesanan Anda</p>
            <h1 class="font-serif-display text-xl sm:text-2xl font-bold text-[#3A3033] mb-3">
                Pesanan <span class="font-mono text-[#D98FAF]">#{{ $order->order_number }}</span>
            </h1>
            <div class="flex items-center space-x-2 flex-wrap gap-y-2">
                <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $order->statusBadgeClass() }}">
                    Status Pesanan: {{ $order->statusLabel() }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $order->paymentStatusBadgeClass() }}">
                    Pembayaran: {{ $order->paymentStatusLabel() }}
                </span>
            </div>
        </div>

        <!-- Payment Detail Card -->
        <div class="bg-white rounded-2xl border border-[#EBDDE2] p-6 shadow-xs mb-6">
            <h2 class="font-serif-display text-lg font-semibold text-[#3A3033] mb-4">Informasi Pembayaran</h2>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                <div>
                    <dt class="text-[#75686D] text-xs uppercase tracking-wide mb-0.5">Metode Pembayaran</dt>
                    <dd class="text-[#3A3033] font-medium">{{ $payment?->payment_method ?? 'midtrans_snap' }}</dd>
                </div>
                <div>
                    <dt class="text-[#75686D] text-xs uppercase tracking-wide mb-0.5">Penyedia</dt>
                    <dd class="text-[#3A3033] font-medium">{{ ucfirst($payment?->provider ?? 'midtrans') }} (Sandbox)</dd>
                </div>
                <div>
                    <dt class="text-[#75686D] text-xs uppercase tracking-wide mb-0.5">Status Pembayaran</dt>
                    <dd>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold border {{ $payment?->statusBadgeClass() ?? $order->paymentStatusBadgeClass() }}">
                            {{ $payment?->statusLabel() ?? $order->paymentStatusLabel() }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-[#75686D] text-xs uppercase tracking-wide mb-0.5">Referensi Transaksi</dt>
                    <dd class="text-[#3A3033] font-mono text-xs break-all">{{ $payment?->transaction_reference ?? '— akan dibuat saat pembayaran diproses —' }}</dd>
                </div>
                @if($payment?->paid_at)
                    <div>
                        <dt class="text-[#75686D] text-xs uppercase tracking-wide mb-0.5">Waktu Bayar</dt>
                        <dd class="text-[#3A3033] font-medium">{{ $payment->paid_at->format('d M Y, H:i') }}</dd>
                    </div>
                @endif
                <div>
                    <dt class="text-[#75686D] text-xs uppercase tracking-wide mb-0.5">Total Tagihan</dt>
                    <dd class="font-serif-display text-xl font-bold text-[#D98FAF]">{{ $order->formattedGrandTotal() }}</dd>
                </div>
            </dl>

            <div class="mt-5 pt-4 border-t border-[#EBDDE2] flex justify-between text-sm">
                <span class="text-[#75686D]">Subtotal produk</span>
                <span class="text-[#3A3033]">{{ $order->formattedSubtotal() }}</span>
            </div>
            <div class="mt-1.5 flex justify-between text-sm">
                <span class="text-[#75686D]">Ongkos kirim</span>
                <span class="text-[#3A3033]">{{ $order->formattedShippingCost() }}</span>
            </div>
            <div class="mt-1.5 flex justify-between font-semibold text-sm">
                <span class="text-[#3A3033]">Grand total</span>
                <span class="text-[#3A3033]">{{ $order->formattedGrandTotal() }}</span>
            </div>
        </div>

        <!-- Instructions Card -->
        <div class="bg-[#FFF9F5] rounded-2xl border border-[#EBDDE2] p-6 mb-6">
            <h2 class="font-serif-display text-base font-semibold text-[#3A3033] mb-2">Instruksi Pembayaran</h2>
            @if($order->payment_status === 'paid')
                <p class="text-sm text-emerald-700">✓ Pembayaran sudah diterima. Pesanan Anda sedang kami proses. Pantau statusnya di halaman detail pesanan.</p>
            @elseif($order->status === 'cancelled')
                <p class="text-sm text-rose-700">Pesanan ini sudah dibatalkan. Tidak ada pembayaran yang diperlukan.</p>
            @else
                <ol class="list-decimal list-inside text-sm text-[#75686D] space-y-1.5">
                    <li>Lakukan pembayaran sebesar <span class="text-[#3A3033] font-semibold">{{ $order->formattedGrandTotal() }}</span> melalui metode yang dipilih.</li>
                    <li>Status pesanan akan diperbarui otomatis setelah pembayaran terverifikasi oleh sistem kami.</li>
                    <li>Simpan referensi transaksi di atas bila diperlukan untuk konfirmasi manual.</li>
                </ol>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('orders.show', $order) }}"
                class="flex-1 inline-flex items-center justify-center px-4 py-3 rounded-xl font-medium text-sm border border-[#EBDDE2] bg-white text-[#3A3033] hover:bg-[#FFF9F5] transition">
                Lihat Detail Pesanan
            </a>
            <a href="{{ route('shop.index') }}"
                class="flex-1 inline-flex items-center justify-center px-4 py-3 rounded-xl font-medium text-sm text-[#75686D] hover:text-[#3A3033] transition">
                Kembali ke Toko
            </a>
        </div>

        @if($order->status === 'pending' && $order->payment_status !== 'paid')
            <!-- Local Development Simulator -->
            <div class="mt-8 bg-white rounded-2xl border border-dashed border-[#D98FAF]/50 p-5">
                <p class="text-[10px] font-bold uppercase tracking-widest text-[#D98FAF] mb-1">⚠ LOCAL DEVELOPMENT ONLY</p>
                <p class="text-xs text-[#75686D] mb-4">Simulator pembayaran untuk pengujian di lingkungan lokal. Bukan mekanisme pembayaran produksi.</p>
                <div class="flex flex-wrap gap-2">
                    <form method="POST" action="{{ route('payments.simulate', $order) }}">
                        @csrf
                        <input type="hidden" name="status" value="paid">
                        <button type="submit"
                            class="px-4 py-2 rounded-xl text-sm font-medium text-white bg-[#D98FAF] hover:bg-[#B97897] shadow-xs transition cursor-pointer">
                            Simulasi: Bayar Berhasil
                        </button>
                    </form>
                    <form method="POST" action="{{ route('payments.simulate', $order) }}">
                        @csrf
                        <input type="hidden" name="status" value="failed">
                        <button type="submit"
                            class="px-4 py-2 rounded-xl text-sm font-medium text-rose-700 border border-rose-200 bg-rose-50 hover:bg-rose-100 transition cursor-pointer">
                            Simulasi: Gagal
                        </button>
                    </form>
                    <form method="POST" action="{{ route('payments.simulate', $order) }}">
                        @csrf
                        <input type="hidden" name="status" value="expired">
                        <button type="submit"
                            class="px-4 py-2 rounded-xl text-sm font-medium text-amber-700 border border-amber-200 bg-amber-50 hover:bg-amber-100 transition cursor-pointer">
                            Simulasi: Kedaluwarsa
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </main>

    <footer class="bg-white border-t border-[#EBDDE2] py-6 text-center text-xs text-[#75686D]">
        ❀ Mutya Store — Hijab &amp; Fashion Muslimah
    </footer>
</body>
</html>
