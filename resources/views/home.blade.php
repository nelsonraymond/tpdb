<x-layouts.app>
    @section('title', 'Mutya — Elegance in Every Wrap')

    {{-- ================= HERO (DESIGN.md §16: editorial split, asymmetric 2/5+3/5) =================
         Botanical line-art lives ONLY in the section's outer corners, far from the text column. --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-cream via-white to-surface">
        {{-- Fine botanical sprig — top-right corner, outside the content grid (§11: hero edge, low opacity) --}}
        <svg class="pointer-events-none absolute -top-4 right-[-2rem] w-40 h-40 sm:w-52 sm:h-52 text-pink-mauve opacity-[0.14]"
            viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
            <path d="M78 96 C80 72 82 52 92 30"/>
            <path d="M82 66 C70 62 64 52 66 40 C78 46 84 58 82 66Z"/>
            <circle cx="93" cy="24" r="5"/><circle cx="85" cy="18" r="3.5"/><circle cx="99" cy="18" r="3.5"/>
        </svg>
        {{-- Small petal echo — bottom-left corner, opposite the copy block --}}
        <svg class="pointer-events-none absolute bottom-[-1.5rem] left-[-1.5rem] w-32 h-32 sm:w-40 sm:h-40 text-pink-deep opacity-[0.10]"
            viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
            <path d="M20 95 C22 70 28 50 45 30"/>
            <path d="M30 70 C18 66 12 55 14 42 C28 48 33 60 30 70Z"/>
            <circle cx="47" cy="26" r="6"/>
        </svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-16 md:pt-20 md:pb-24 lg:pt-24 lg:pb-28 relative">
            <div class="grid gap-12 md:gap-10 items-center md:grid-cols-[minmax(0,2fr)_minmax(0,3fr)]">
                {{-- Copy column --}}
                <div class="text-center md:text-left">
                    <p class="text-[11px] tracking-[0.3em] uppercase text-pink-mauve font-medium mb-5">Hijab Boutique · Premium Collection</p>
                    <h1 class="hero-display font-display font-medium text-ink">
                        Elegance<br>in Every <em class="italic text-pink-deep">Wrap</em>
                    </h1>
                    <p class="mt-6 text-sm md:text-base text-muted leading-relaxed max-w-md mx-auto md:mx-0">
                        Temukan hijab yang nyaman, elegan, dan cocok untuk setiap momen — dari voal premium hingga satin untuk acara spesial Anda.
                    </p>
                    <div class="mt-9 flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                        <x-primary-button :href="route('shop.index')" class="w-full sm:w-auto">Belanja Sekarang</x-primary-button>
                        <a href="#koleksi-unggulan"
                            class="inline-flex items-center justify-center px-7 py-3 text-sm font-medium text-ink hover:text-pink-mauve underline decoration-pink-deep/40 underline-offset-8 transition min-h-[48px]">
                            Jelajahi Koleksi
                        </a>
                    </div>
                    {{-- Trust line — plain type, no pills/badges --}}
                    <p class="mt-10 text-[11px] text-muted tracking-wide">
                        Material Premium <span class="mx-1.5 text-pink-soft" aria-hidden="true">·</span>
                        Gratis Ongkir <span class="mx-1.5 text-pink-soft" aria-hidden="true">·</span>
                        Pembayaran Aman
                    </p>
                </div>

                {{-- Editorial media panel — 4:5 (compact on mobile so the headline is reached sooner), no heavy border --}}
                <div class="mx-auto w-full max-w-[16.5rem] sm:max-w-[20rem] md:max-w-none">
                    <div class="relative aspect-4/5 rounded-2xl overflow-hidden bg-pink-soft/30 shadow-card">
                        @php $heroProduct = $featuredProducts->first(); $heroImg = $heroProduct?->primaryImage(); @endphp
                        @if ($heroImg)
                            <img src="{{ Storage::url($heroImg->image_path) }}"
                                alt="{{ $heroProduct->name }}" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            {{-- Soft-light studio backdrop — swap this whole block for a real campaign photo later --}}
                            <div class="absolute inset-0 bg-gradient-to-b from-cream via-white to-pink-soft/40"></div>
                            <div class="pointer-events-none absolute -top-16 left-1/2 -translate-x-1/2 w-[130%] aspect-square rounded-full bg-white/70 blur-3xl"></div>
                            <div class="pointer-events-none absolute -bottom-24 -right-16 w-72 aspect-square rounded-full bg-pink-soft/40 blur-3xl"></div>
                            {{-- Draped fabric folds — abstract silk-scarf composition --}}
                            <svg class="absolute inset-0 w-full h-full text-pink-mauve" viewBox="0 0 400 500" preserveAspectRatio="xMidYMid slice" fill="none" stroke="currentColor" stroke-width="1.25" aria-hidden="true">
                                <defs>
                                    <linearGradient id="mutya-drape-a" x1="0" y1="0" x2="1" y2="1">
                                        <stop offset="0" stop-color="#F8C8DC" stop-opacity="0.55"/>
                                        <stop offset="1" stop-color="#FFFFFF" stop-opacity="0.25"/>
                                    </linearGradient>
                                    <linearGradient id="mutya-drape-b" x1="0" y1="0" x2="1" y2="1">
                                        <stop offset="0" stop-color="#EFA7C1" stop-opacity="0.45"/>
                                        <stop offset="1" stop-color="#FFF9F5" stop-opacity="0.20"/>
                                    </linearGradient>
                                    <linearGradient id="mutya-drape-c" x1="0" y1="0" x2="0.6" y2="1">
                                        <stop offset="0" stop-color="#B97897" stop-opacity="0.28"/>
                                        <stop offset="1" stop-color="#F8C8DC" stop-opacity="0.12"/>
                                    </linearGradient>
                                </defs>
                                <path d="M-20 110 C 90 60 170 160 260 110 C 330 72 380 120 420 90 L 420 -20 L -20 -20 Z" fill="url(#mutya-drape-a)" stroke="none"/>
                                <path d="M-20 235 C 80 180 190 285 290 225 C 350 190 400 240 420 210 L 420 128 C 380 158 330 110 260 148 C 170 198 90 98 -20 148 Z" fill="url(#mutya-drape-b)" stroke="none"/>
                                <path d="M-20 372 C 90 315 200 420 300 358 C 355 325 400 372 420 345 L 420 250 C 400 280 350 230 290 265 C 190 325 80 222 -20 277 Z" fill="url(#mutya-drape-c)" stroke="none"/>
                                <path d="M-20 520 C 90 450 205 545 310 480 C 360 450 400 486 420 462 L 420 520 Z" fill="#D98FAF" fill-opacity="0.16" stroke="none"/>
                                {{-- Fine fold lines --}}
                                <path d="M30 150 C 110 108 175 195 265 150" opacity="0.22"/>
                                <path d="M15 285 C 100 232 205 330 300 272" opacity="0.20"/>
                                <path d="M40 410 C 130 355 230 448 330 392" opacity="0.18"/>
                            </svg>
                            {{-- Delicate botanical sprig echoing the section corner ornaments --}}
                            <svg class="pointer-events-none absolute top-8 right-7 w-24 h-24 sm:w-28 sm:h-28 text-pink-mauve opacity-30"
                                viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                <path d="M78 96 C80 72 82 52 92 30"/>
                                <path d="M82 66 C70 62 64 52 66 40 C78 46 84 58 82 66Z"/>
                                <circle cx="93" cy="24" r="5"/><circle cx="85" cy="18" r="3.5"/><circle cx="99" cy="18" r="3.5"/>
                            </svg>
                            <p class="absolute bottom-20 inset-x-0 text-center font-display italic text-sm sm:text-base text-pink-mauve/70">
                                Elegance in every detail.
                            </p>
                        @endif
                        {{-- Floating caption chip (§3: floating badge, not a boxed card) --}}
                        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur rounded-xl px-4 py-2.5 shadow-card">
                            <p class="text-[10px] uppercase tracking-widest text-pink-mauve font-medium">Koleksi Terbaru</p>
                            <p class="font-display text-sm text-ink mt-0.5">Spring Edit — Pastel Series</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ================= SHOP BY STYLE — EDITORIAL CATEGORY MOSAIC (DESIGN.md §17) =================
         Real categories from HomeController; reusable CategoryCard tiles in varied sizes. --}}
    <section id="koleksi-unggulan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <x-section-heading eyebrow="Temukan Gayamu" title="Belanja per Gaya"
            :href="route('shop.index')" linkLabel="Semua Kategori" />

        <div class="mt-8 md:mt-10 grid grid-cols-2 auto-rows-[minmax(150px,auto)] gap-3 md:grid-cols-6 md:auto-rows-[16rem] md:gap-5">
            @foreach ($categories->values() as $i => $cat)
                {{-- Mobile: feature tile spans both columns; last even-count tile spans full width to avoid an orphan. --}}
                <x-category-card :category="$cat" :show-count="$i === 0"
                    :class="'min-h-[170px] ' . (($i === 0 || ($i === $categories->count() - 1 && $categories->count() % 2 === 0)) ? 'col-span-2 min-h-[240px]' : '')" />
            @endforeach
        </div>
    </section>

    {{-- ================= BEST SELLER (§18) ================= --}}
    @if ($bestSellers->isNotEmpty())
        <section class="bg-surface py-16 md:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <x-section-heading eyebrow="Paling Dicari" title="Most Loved" align="center"
                    subtitle="Favorit pelanggan Mutya — cepat habis, jangan sampai ketinggalan." />
                <div class="mt-10 md:mt-12 grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                    @foreach ($bestSellers as $prod)
                        <x-product-card :product="$prod" />
                    @endforeach
                </div>
                <div class="mt-10 text-center">
                    <a href="{{ route('shop.index', ['sort' => 'best_seller']) }}" class="inline-flex items-center text-sm text-pink-deep hover:text-pink-mauve font-medium transition min-h-[44px]">
                        Lihat Semua Best Seller <span aria-hidden="true" class="ml-1">→</span>
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ================= PROMO CAMPAIGN (§23: one strong block, soft gradient, no outline) ================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-cream via-white to-pink-soft/50 shadow-card">
            {{-- Botanical confined to the far-right edge, clear of the copy (§11 placement rules) --}}
            <svg class="pointer-events-none absolute -right-6 top-1/2 -translate-y-1/2 h-[110%] w-36 sm:w-44 text-pink-mauve opacity-[0.15]"
                viewBox="0 0 100 200" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                <path d="M70 200 C72 150 75 110 85 60"/>
                <path d="M76 140 C60 135 52 120 55 100 C74 108 80 128 76 140Z"/>
                <circle cx="86" cy="52" r="8"/><circle cx="74" cy="44" r="6"/><circle cx="96" cy="44" r="6"/>
            </svg>
            <div class="relative px-6 py-12 sm:px-10 md:px-14 md:py-16 max-w-lg">
                <p class="text-[11px] tracking-[0.3em] uppercase text-pink-mauve font-medium">Penawaran Terbatas</p>
                <h3 class="font-display text-3xl md:text-4xl font-medium text-ink mt-3 leading-snug">
                    Diskon hingga 20%<br><em class="italic text-pink-deep">untuk Koleksi Voal</em>
                </h3>
                <p class="text-sm text-muted mt-4 leading-relaxed">Warna lembut, tekstur halus, ringan sepanjang hari.</p>
                <x-primary-button :href="route('shop.index', ['q' => 'Voal'])" class="mt-8">Belanja Sekarang</x-primary-button>
            </div>
        </div>
    </section>

    {{-- ================= NEW ARRIVALS (§20) ================= --}}
    @if ($newArrivals->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 md:pb-24">
            <x-section-heading eyebrow="Baru Tiba" title="Just In" :href="route('shop.index')" linkLabel="Semua Produk" />
            <div class="mt-8 md:mt-10 grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach ($newArrivals as $prod)
                    <x-product-card :product="$prod" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- ================= BRAND PROMISE (§22-inspired: quiet typographic strip, no icon pills) ================= --}}
    <section class="border-y border-line/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 md:py-16">
            <h2 class="font-display text-xl md:text-2xl font-medium text-ink text-center mb-10 md:mb-12">Kenapa Memilih Mutya?</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-10 text-center">
                @foreach ([
                    ['title' => 'Kualitas Premium', 'desc' => 'Jahitan rapi & bahan terpilih'],
                    ['title' => 'Nyaman Seharian', 'desc' => 'Ringan, adem, tidak mudah kusut'],
                    ['title' => 'Pengiriman Cepat', 'desc' => 'Dikirim 1×24 jam kerja'],
                    ['title' => 'Pembayaran Aman', 'desc' => 'Transaksi terverifikasi & enkripsi'],
                ] as $item)
                    <div>
                        <span class="block w-6 h-px bg-pink-deep/60 mx-auto mb-4" aria-hidden="true"></span>
                        <h3 class="font-display text-base text-ink">{{ $item['title'] }}</h3>
                        <p class="text-xs text-muted mt-2 leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ================= REVIEWS (§24: only genuine published reviews; graceful empty state) ================= --}}
    @if ($reviews->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <x-section-heading eyebrow="Kata Pelanggan" title="Cerita dari Mereka" align="center" />
            <div class="mt-10 md:mt-12 grid md:grid-cols-3 gap-8 md:gap-10">
                @foreach ($reviews as $review)
                    <figure class="text-center md:text-left">
                        <span class="font-display text-5xl leading-none text-pink-soft block mb-2" aria-hidden="true">“</span>
                        <blockquote class="font-display italic text-base md:text-lg text-ink leading-relaxed">
                            {{ $review->comment }}
                        </blockquote>
                        <figcaption class="mt-5">
                            <p class="text-xs font-medium text-ink">{{ $review->user?->name ?? 'Pelanggan Mutya' }}</p>
                            <p class="text-[11px] text-muted mt-1">
                                Pembelian{{ $review->product ? ' · ' . $review->product->name : '' }}
                            </p>
                            <p class="text-xs text-gold mt-1.5" aria-label="Rating {{ $review->rating }} bintang">
                                @for ($s = 1; $s <= 5; $s++)<span aria-hidden="true">@if ($s <= $review->rating)★@else☆@endif</span>@endfor
                            </p>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ================= SOCIAL GALLERY (§25: clean visual grid, minimal copy) ================= --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 md:pb-24">
        <div class="text-center mb-8 md:mb-10">
            <p class="text-[11px] tracking-[0.25em] uppercase text-pink-mauve font-medium mb-1">&#64;mutya.store</p>
            <h2 class="font-display text-2xl md:text-3xl font-medium text-ink">Follow Our Journey</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
            @foreach (['Soft Pink Moments', 'Morning Editorial', 'Texture Study', 'Pastel Palette'] as $caption)
                <div class="group relative aspect-square rounded-2xl overflow-hidden bg-gradient-to-br from-pink-soft/40 via-white to-cream">
                    <svg class="absolute inset-0 m-auto w-14 h-14 text-pink-mauve opacity-20 pointer-events-none transition group-hover:scale-103 duration-500"
                        viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                        <path d="M50 90 C50 64 50 44 50 24"/>
                        <path d="M50 56 C36 51 30 40 32 28 C45 33 52 44 50 56Z"/>
                        <circle cx="50" cy="18" r="5"/>
                    </svg>
                    <div class="absolute inset-0 bg-ink/0 group-hover:bg-ink/35 transition duration-300 flex items-end p-4">
                        <span class="text-white text-xs opacity-0 group-hover:opacity-100 transition duration-300">{{ $caption }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ================= NEWSLETTER (§26) ================= --}}
    <x-newsletter-section />
</x-layouts.app>
