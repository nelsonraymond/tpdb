<x-layouts.app>
    @section('title', ($selectedCategory ? $selectedCategory->name . ' — ' : 'Semua Koleksi — ') . 'Mutya Store')

    {{-- ================= SHOP PAGE — DESIGN.md v3: product-first, editorial-minimal =================
         Reuses shared components (layout navbar/footer, ProductCard) and the proven CatalogController
         query logic (category filter, search q, sort, paginate(12)->withQueryString()). No fake controls. --}}

    <div class="bg-white border-b border-line">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">

            {{-- Breadcrumb — concise page context --}}
            <nav aria-label="Breadcrumb" class="text-[11px] text-muted mb-6">
                <ol class="flex items-center gap-1.5 flex-wrap">
                    <li><a href="{{ route('home') }}" class="hover:text-pink-deep transition">Beranda</a></li>
                    <li aria-hidden="true" class="text-line">/</li>
                    @if ($selectedCategory)
                        <li><a href="{{ route('shop.index') }}" class="hover:text-pink-deep transition">Koleksi</a></li>
                        <li aria-hidden="true" class="text-line">/</li>
                        <li aria-current="page" class="text-ink">{{ $selectedCategory->name }}</li>
                    @else
                        <li aria-current="page" class="text-ink">Koleksi</li>
                    @endif
                    @if (request('q'))
                        <li aria-hidden="true" class="text-line">/</li>
                        <li aria-current="page" class="text-ink">“{{ request('q') }}”</li>
                    @endif
                </ol>
            </nav>

            {{-- Heading + supporting copy + accurate count --}}
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-[11px] tracking-[0.3em] uppercase text-pink-mauve font-medium mb-2">
                        {{ $selectedCategory ? 'Kategori' : 'Boutique Collection' }}
                    </p>
                    <h1 class="font-display text-3xl md:text-4xl font-medium text-ink leading-tight">
                        {{ $selectedCategory?->name ?? 'Semua Koleksi Hijab' }}
                    </h1>
                    <p class="mt-2 text-sm text-muted leading-relaxed max-w-xl">
                        {{ $selectedCategory?->description ?? 'Sentuhan kelembutan dan elegansi modern untuk menyempurnakan setiap penampilan Anda.' }}
                    </p>
                </div>

                <p class="text-xs text-muted shrink-0 sm:text-right sm:pb-1">
                    <span class="text-ink font-semibold">{{ number_format($products->total(), 0, ',', '.') }}</span>
                    produk ditemukan
                </p>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">

        {{-- ============ Category navigation — real DB categories, link-based ============ --}}
        @php
            $keepQuery = array_filter(['q' => request('q'), 'sort' => request('sort')]);
            $activeSlug = $selectedCategory?->slug ?? request('category');
        @endphp
        <nav class="mb-6 -mx-4 px-4 sm:mx-0 sm:px-0" aria-label="Filter kategori">
            <div class="flex items-center gap-2 overflow-x-auto pb-1 sm:flex-wrap sm:overflow-visible">
                <a href="{{ route('shop.index', $keepQuery) }}"
                    class="px-4 min-h-[40px] inline-flex items-center rounded-full text-xs font-medium shrink-0 transition border
                    {{ ! $activeSlug
                        ? 'bg-ink text-white border-ink'
                        : 'bg-white text-muted border-line hover:border-pink-deep hover:text-pink-deep' }}">
                    Semua
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('shop.category', ['category' => $cat->slug, ...$keepQuery]) }}"
                        class="px-4 min-h-[40px] inline-flex items-center gap-1.5 rounded-full text-xs font-medium shrink-0 transition border
                        {{ $activeSlug === $cat->slug
                            ? 'bg-ink text-white border-ink'
                            : 'bg-white text-muted border-line hover:border-pink-deep hover:text-pink-deep' }}">
                        {{ $cat->name }}
                        <span class="{{ $activeSlug === $cat->slug ? 'opacity-70' : 'opacity-60' }}">{{ $cat->products_count }}</span>
                    </a>
                @endforeach
            </div>
        </nav>

        {{-- ============ Search + Sort toolbar (both supported by existing backend) ============ --}}
        <form method="GET" action="{{ $selectedCategory ? route('shop.category', $selectedCategory) : route('shop.index') }}"
            class="flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between mb-8">
            <div class="relative w-full sm:w-64">
                <label for="shop-search" class="sr-only">Cari produk</label>
                <input id="shop-search" type="search" name="q" value="{{ request('q') }}" placeholder="Cari hijab…"
                    class="w-full min-h-[44px] pl-9 pr-3 rounded-xl border border-line bg-white text-sm text-ink placeholder:text-muted/70 focus:outline-none focus:ring-1 focus:ring-pink-deep transition">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-muted pointer-events-none" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                @if ($sort !== 'newest')
                    <input type="hidden" name="sort" value="{{ $sort }}">
                @endif
            </div>

            <div class="flex items-center gap-3">
                <label for="shop-sort" class="text-xs text-muted whitespace-nowrap">Urutkan</label>
                <select id="shop-sort" name="sort" onchange="this.form.submit()"
                    class="min-h-[44px] px-3 rounded-xl border border-line bg-white text-sm text-ink focus:outline-none focus:ring-1 focus:ring-pink-deep cursor-pointer">
                    <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="price_asc" {{ $sort === 'price_asc' ? 'selected' : '' }}>Harga: Terendah</option>
                    <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Harga: Tertinggi</option>
                    <option value="best_seller" {{ $sort === 'best_seller' ? 'selected' : '' }}>Best Seller</option>
                </select>
                <noscript>
                    <button type="submit" class="min-h-[44px] px-4 rounded-xl bg-ink text-white text-xs font-medium">Terapkan</button>
                </noscript>
            </div>
        </form>

        {{-- ============ Product grid — shared ProductCard, mobile-first 2 → 3 → 4 columns ============ --}}
        @if ($products->count())
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-x-4 gap-y-8 sm:gap-x-6 sm:gap-y-10">
                @foreach ($products as $prod)
                    <x-product-card :product="$prod" />
                @endforeach
            </div>

            @if ($products->hasPages())
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            {{-- ============ Tasteful empty state ============ --}}
            <div class="border border-line bg-white py-16 px-6 text-center">
                <p class="font-display text-xl text-ink">Belum ada produk yang cocok</p>
                <p class="text-sm text-muted mt-2 max-w-md mx-auto leading-relaxed">
                    Coba ubah kata kunci pencarian atau pilih kategori lain untuk melihat koleksi Mutya selengkapnya.
                </p>
                <a href="{{ route('shop.index') }}"
                    class="mt-6 inline-flex min-h-[44px] items-center px-5 rounded-full bg-pink-deep hover:bg-pink-mauve text-white text-sm font-medium transition">
                    Lihat Semua Koleksi
                </a>
            </div>
        @endif
    </main>

</x-layouts.app>
