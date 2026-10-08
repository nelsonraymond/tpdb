<x-layouts.app>
    @section('title', 'Mutya — Elegance in Every Wrap')

    {{-- ================= HERO (§13: editorial, cream bg, floral edges) ================= --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-cream via-white to-pink-soft/40">
        {{-- Floral line-art corners (opacity 10–35%, never over content) --}}
        <svg class="absolute -top-8 -left-10 w-44 h-44 md:w-64 md:h-64 text-pink-deep opacity-[0.12] pointer-events-none" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
            <path d="M20 95 C22 70 28 50 45 30"/>
            <path d="M30 70 C18 66 12 55 14 42 C28 48 33 60 30 70Z"/>
            <circle cx="47" cy="26" r="6"/><circle cx="38" cy="20" r="4.5"/><circle cx="56" cy="20" r="4.5"/><circle cx="47" cy="14" r="4"/>
        </svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 lg:py-24 grid md:grid-cols-2 gap-10 md:gap-12 items-center relative">
            <div class="order-2 md:order-1 text-center md:text-left">
                <p class="text-xs tracking-[0.25em] uppercase text-pink-mauve font-semibold mb-4">Hijab Boutique · Premium Collection</p>
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-semibold text-ink leading-tight">
                    Elegance in<br>Every <em class="italic text-pink-deep">Wrap</em>
                </h1>
                <p class="mt-5 text-sm md:text-base text-muted leading-relaxed max-w-md mx-auto md:mx-0">
                    Temukan hijab yang nyaman, elegan, dan cocok untuk setiap momen — dari voal premium hingga satin untuk acara spesial Anda.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                    <a href="{{ route('shop.index') }}"
                        class="inline-flex items-center justify-center px-7 py-3 rounded-xl bg-pink-deep hover:bg-pink-mauve text-white text-sm font-medium transition-all duration-300 hover:-translate-y-0.5 shadow-card hover:shadow-card-hover min-h-[48px]">
                        Belanja Sekarang
                    </a>
                    <a href="#koleksi-unggulan"
                        class="inline-flex items-center justify-center px-7 py-3 rounded-xl border border-pink-deep text-pink-deep hover:bg-pink-soft/30 text-sm font-medium transition duration-300 min-h-[48px]">
                        Jelajahi Koleksi
                    </a>
                </div>
                {{-- Trust row --}}
                <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-x-6 gap-y-2 text-[11px] text-muted">
                    <span>✦ Material Premium</span>
                    <span>✦ Gratis Ongkir</span>
                    <span>✦ Pembayaran Aman</span>
                </div>
            </div>

            {{-- Editorial visual panel (placeholder until product photography; 4:5 ratio per §16) --}}
            <div class="order-1 md:order-2 mx-auto w-full max-w-sm md:max-w-none">
                <div class="relative aspect-4/5 rounded-2xl overflow-hidden bg-pink-soft/40 border border-line shadow-card">
                    @if ($featuredProducts->isNotEmpty() && $featuredProducts->first()->primaryImage())
                        <img src="{{ Storage::url($featuredProducts->first()->primaryImage()->image_path) }}"
                            alt="{{ $featuredProducts->first()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center gap-3 bg-gradient-to-b from-pink-soft/50 via-white to-cream">
                            <span class="text-5xl text-pink-deep/60" aria-hidden="true">❀</span>
                            <p class="font-display italic text-lg text-pink-mauve">Elegance in every detail.</p>
                            <p class="text-[11px] text-muted tracking-wide uppercase">Foto editorial segera hadir</p>
                        </div>
                    @endif
                    {{-- Soft caption card --}}
                    <div class="absolute bottom-4 left-4 right-4 md:right-auto bg-white/90 backdrop-blur rounded-xl px-4 py-3 shadow-card">
                        <p class="text-[10px] uppercase tracking-widest text-pink-mauve font-semibold">Koleksi Terbaru</p>
                        <p class="font-display text-sm text-ink mt-0.5">Spring Edit — Pastel Series</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= FEATURED CATEGORIES (§14 + merchandising discovery) ================= --}}
    <section id="koleksi-unggulan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 md:pt-20 pb-4">
        <div class="flex items-end justify-between mb-6 md:mb-8">
            <div>
                <p class="text-[11px] tracking-[0.2em] uppercase text-pink-mauve font-semibold mb-1">Temukan Gayamu</p>
                <h2 class="font-display text-2xl md:text-3xl font-semibold text-ink">Kategori Pilihan</h2>
            </div>
            <a href="{{ route('shop.index') }}" class="hidden sm:inline-flex items-center text-sm text-pink-deep hover:text-pink-mauve transition font-medium">
                Semua Kategori →
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach ($categories as $cat)
                <a href="{{ route('shop.category', $cat->slug) }}"
                    class="group relative rounded-2xl overflow-hidden border border-line bg-white shadow-card hover:shadow-card-hover transition-all duration-300">
                    <div class="aspect-4/5 bg-pink-soft/30 overflow-hidden">
                        @php $catImg = $cat->products->filter(fn ($p) => $p->primaryImage())->first()?->primaryImage(); @endphp
                        @if ($catImg)
                            <img src="{{ Storage::url($catImg->image_path) }}" alt="{{ $cat->name }}"
                                class="w-full h-full object-cover group-hover:scale-103 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="font-display italic text-pink-mauve/70 text-sm">{{ $cat->name }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink/60 to-transparent pt-10 pb-3 px-3">
                        <p class="text-white font-medium text-sm">{{ $cat->name }}</p>
                        <p class="text-white/80 text-[11px] group-hover:text-pink-soft transition">{{ $cat->products->count() }} produk · Lihat →</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="sm:hidden mt-6 text-center">
            <a href="{{ route('shop.index') }}" class="inline-flex items-center text-sm text-pink-deep font-medium">Semua Kategori →</a>
        </div>
    </section>

    {{-- ================= BEST SELLER (§15 product cards) ================= --}}
    @if ($bestSellers->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center max-w-xl mx-auto mb-8 md:mb-12">
                <p class="text-[11px] tracking-[0.2em] uppercase text-pink-mauve font-semibold mb-1">Paling Dicari</p>
                <h2 class="font-display text-2xl md:text-3xl font-semibold text-ink">Best Seller Minggu Ini</h2>
                <p class="text-sm text-muted mt-2">Favorit pelanggan Mutya — cepat habis, jangan sampai ketinggalan.</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach ($bestSellers as $prod)
                    <x-product-card :product="$prod" />
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('shop.index', ['sort' => 'best_seller']) }}" class="inline-flex items-center text-sm text-pink-deep hover:text-pink-mauve font-medium transition">
                    Lihat Semua Best Seller →
                </a>
            </div>
        </section>
    @endif

    {{-- ================= PROMO BANNER (§23: subtle pink gradient, floral inside) ================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-4">
        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-cream to-pink-soft/60 border border-line">
            <svg class="absolute right-0 top-0 h-full w-40 text-pink-deep opacity-[0.15] pointer-events-none" viewBox="0 0 100 200" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                <path d="M70 200 C72 150 75 110 85 60"/>
                <path d="M76 140 C60 135 52 120 55 100 C74 108 80 128 76 140Z"/>
                <circle cx="86" cy="52" r="8"/><circle cx="74" cy="44" r="6"/><circle cx="96" cy="44" r="6"/>
            </svg>
            <div class="relative px-6 py-10 md:px-14 md:py-14 max-w-lg">
                <p class="text-[11px] tracking-[0.2em] uppercase text-pink-mauve font-semibold">Penawaran Terbatas</p>
                <h3 class="font-display text-2xl md:text-4xl font-semibold text-ink mt-2 leading-snug">
                    Diskon hingga 20%<br><em class="italic text-pink-deep">untuk Koleksi Voal</em>
                </h3>
                <p class="text-sm text-muted mt-3">Warna lembut, tekstur halus, ringan sepanjang hari.</p>
                <a href="{{ route('shop.index', ['q' => 'Voal']) }}"
                    class="mt-6 inline-flex items-center justify-center px-6 py-3 rounded-xl bg-pink-deep hover:bg-pink-mauve text-white text-sm font-medium transition-all duration-300 hover:-translate-y-0.5 shadow-card min-h-[48px]">
                    Belanja Sekarang
                </a>
            </div>
        </div>
    </section>

    {{-- ================= NEW ARRIVALS ================= --}}
    @if ($newArrivals->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="flex items-end justify-between mb-6 md:mb-10">
                <div>
                    <p class="text-[11px] tracking-[0.2em] uppercase text-pink-mauve font-semibold mb-1">Baru Tiba</p>
                    <h2 class="font-display text-2xl md:text-3xl font-semibold text-ink">New Arrivals</h2>
                </div>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center text-sm text-pink-deep hover:text-pink-mauve transition font-medium">
                    Semua Produk →
                </a>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach ($newArrivals as $prod)
                    <x-product-card :product="$prod" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- ================= WHY CHOOSE US (§24: 4 compact line-icon cards) ================= --}}
    <section class="bg-surface border-y border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <h2 class="font-display text-xl md:text-2xl font-semibold text-ink text-center mb-8 md:mb-10">Kenapa Memilih Mutya?</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                @foreach ([
                    ['icon' => 'M12 3l2.1 4.9L19 9l-4.4 3.2L16 17l-4-2.8L8 17l1.4-4.8L5 9l4.9-1.1L12 3z', 'title' => 'Kualitas Premium', 'desc' => 'Jahitan rapi & bahan terpilih'],
                    ['icon' => 'M4 12h16M4 12c0-4 3-7 8-7s8 3 8 7M9 15v3M15 15v3', 'title' => 'Nyaman Seharian', 'desc' => 'Ringan, adem, tidak mudah kusut'],
                    ['icon' => 'M3 7h11v8H3zM14 10h4l3 3v2h-7zM7 18a2 2 0 100-4 2 2 0 000 4zM18 18a2 2 0 100-4 2 2 0 000 4z', 'title' => 'Pengiriman Cepat', 'desc' => 'Dikirim 1×24 jam kerja'],
                    ['icon' => 'M12 3l7 3v5c0 5-3 8-7 10-4-2-7-5-7-10V6l7-3zM9 12l2 2 4-4', 'title' => 'Pembayaran Aman', 'desc' => 'Transaksi terverifikasi & enkripsi'],
                ] as $item)
                    <div class="flex flex-col items-center text-center gap-3">
                        <span class="w-12 h-12 rounded-full bg-pink-soft/40 border border-line flex items-center justify-center">
                            <svg class="w-5 h-5 text-pink-mauve" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true"><path d="{{ $item['icon'] }}"/></svg>
                        </span>
                        <div>
                            <h3 class="text-sm font-semibold text-ink">{{ $item['title'] }}</h3>
                            <p class="text-xs text-muted mt-1 leading-relaxed">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= TESTIMONIALS (§25: cream bg, big quote, optional floral corner) ================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="text-center mb-8 md:mb-12">
            <p class="text-[11px] tracking-[0.2em] uppercase text-pink-mauve font-semibold mb-1">Kata Pelanggan</p>
            <h2 class="font-display text-2xl md:text-3xl font-semibold text-ink">Dicintai Ribuan Hijabers</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-4 md:gap-6">
            @foreach ([
                ['name' => 'Rania, Bandung', 'text' => 'Bahannya lembut banget, warnanya persis seperti foto. Sudah repeat order 3 kali!'],
                ['name' => 'Aisyah, Jakarta', 'text' => 'Pengiriman cepat, packing rapi dengan kartu ucapan. Rasanya belanja di boutique.'],
                ['name' => 'Nadia, Surabaya', 'text' => 'Pashmina voal-nya tidak licin dan mudah dibentuk. Wajib punya warna dusty pink.'],
            ] as $t)
                <figure class="relative bg-cream border border-line rounded-2xl p-6 shadow-card">
                    <span class="font-display text-5xl leading-none text-pink-soft absolute top-3 left-5" aria-hidden="true">“</span>
                    <blockquote class="relative text-sm text-ink leading-relaxed pt-6">{{ $t['text'] }}</blockquote>
                    <figcaption class="mt-4 flex items-center gap-3">
                        <span class="w-9 h-9 rounded-full bg-pink-soft/60 flex items-center justify-center font-display text-pink-mauve text-sm" aria-hidden="true">{{ mb_substr($t['name'], 0, 1) }}</span>
                        <div>
                            <p class="text-xs font-semibold text-ink">{{ $t['name'] }}</p>
                            <p class="text-[11px] text-gold" aria-label="Rating 5 bintang">★★★★★</p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </section>

    {{-- ================= INSTAGRAM GALLERY (editorial composition placeholders) ================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 md:pb-20">
        <div class="text-center mb-6 md:mb-10">
            <p class="text-[11px] tracking-[0.2em] uppercase text-pink-mauve font-semibold mb-1">@mutya.store</p>
            <h2 class="font-display text-2xl md:text-3xl font-semibold text-ink">Follow Our Journey</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
            @foreach (['Soft Pink Moments', 'Morning Editorial', 'Texture Study', 'Pastel Palette'] as $i => $caption)
                <div class="group relative aspect-square rounded-xl overflow-hidden bg-pink-soft/30 border border-line">
                    <div class="w-full h-full flex items-center justify-center transition group-hover:scale-103 duration-500">
                        <span class="text-3xl text-pink-deep/40" aria-hidden="true">❀</span>
                    </div>
                    <div class="absolute inset-0 bg-ink/0 group-hover:bg-ink/40 transition duration-300 flex items-center justify-center">
                        <span class="text-white text-xs opacity-0 group-hover:opacity-100 transition duration-300">{{ $caption }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.app>
