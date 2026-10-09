{{-- Catalog category chips — single source of truth, included by catalog/index.blade.php for BOTH
     the mobile filter sheet and the desktop inline row. Link-based (no JS needed), preserves
     active q/sort query params. Requires: $keepQuery, $activeSlug, $categories --}}
<a href="{{ route('shop.index', $keepQuery) }}"
    class="px-4 min-h-[40px] inline-flex items-center rounded-full text-xs font-medium shrink-0 transition border
    {{ ! $activeSlug
        ? 'bg-ink text-white border-ink'
        : 'bg-white text-muted border-line hover:border-pink-deep hover:text-pink-deep focus-visible:ring-2 focus-visible:ring-pink-deep focus:outline-none' }}">
    Semua
</a>
@foreach ($categories as $cat)
    <a href="{{ route('shop.category', ['category' => $cat->slug, ...$keepQuery]) }}"
        class="px-4 min-h-[40px] inline-flex items-center gap-1.5 rounded-full text-xs font-medium shrink-0 transition border
        {{ $activeSlug === $cat->slug
            ? 'bg-ink text-white border-ink'
            : 'bg-white text-muted border-line hover:border-pink-deep hover:text-pink-deep focus-visible:ring-2 focus-visible:ring-pink-deep focus:outline-none' }}">
        {{ $cat->name }}
        <span class="{{ $activeSlug === $cat->slug ? 'opacity-70' : 'opacity-60' }}">{{ $cat->products_count }}</span>
    </a>
@endforeach
