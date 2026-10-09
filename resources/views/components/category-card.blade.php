@props(['category', 'product' => null, 'size' => 'md', 'showCount' => false])

{{-- CategoryCard — DESIGN.md §17 editorial mosaic tile:
     image-led, no heavy outline, Playfair name overlay, product count as subtle support info.
     Works both inside a sized grid cell (mosaic) and standalone (media block keeps 4:5/wide ratio). --}}
<a href="{{ route('shop.category', $category->slug) }}"
    {{ $attributes->merge(['class' => 'group relative block rounded-2xl overflow-hidden bg-surface min-h-[140px] shadow-card hover:shadow-card-hover transition-all duration-300']) }}>

    {{-- Media layer: absolute fills the grid cell; the aspect wrapper gives height when standalone. --}}
    <div class="absolute inset-0">
        @if ($product?->primaryImage())
            <img src="{{ Storage::url($product->primaryImage()->image_path) }}" alt="{{ $category->name }}"
                class="w-full h-full object-cover group-hover:scale-103 transition duration-500" loading="lazy">
        @elseif ($category->products->isNotEmpty() && $category->products->first()?->primaryImage())
            <img src="{{ Storage::url($category->products->first()->primaryImage()->image_path) }}" alt="{{ $category->name }}"
                class="w-full h-full object-cover group-hover:scale-103 transition duration-500" loading="lazy">
        @else
            {{-- Graceful visual placeholder until real photography lands --}}
            <div class="absolute inset-0 bg-gradient-to-br from-pink-soft/50 via-white to-cream">
                <svg class="absolute right-3 bottom-3 w-16 h-16 text-pink-mauve opacity-20 pointer-events-none"
                    viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                    <path d="M20 95 C22 70 28 50 45 30"/>
                    <path d="M30 70 C18 66 12 55 14 42 C28 48 33 60 30 70Z"/>
                    <circle cx="47" cy="26" r="6"/><circle cx="38" cy="20" r="4.5"/><circle cx="56" cy="20" r="4.5"/>
                </svg>
            </div>
        @endif
    </div>

    {{-- Invisible sizing spacer so the card has height outside fixed-size grids --}}
    <div aria-hidden="true" class="{{ $size === 'wide' ? 'aspect-16/10 sm:aspect-21/9' : 'aspect-4/5' }}"></div>

    {{-- Legibility scrim + editorial caption --}}
    <div class="absolute inset-0 bg-gradient-to-t from-ink/55 via-ink/5 to-transparent" aria-hidden="true"></div>
    <div class="absolute inset-x-0 bottom-0 p-4 sm:p-5">
        <p class="font-display text-lg sm:text-xl text-white leading-snug">{{ $category->name }}</p>
        <p class="mt-0.5 text-[11px] tracking-wide text-white/70 group-hover:text-pink-soft transition duration-300">
            @if ($showCount){{ $category->products->count() }} pilihan · @endif Belanja →
        </p>
    </div>
</a>
