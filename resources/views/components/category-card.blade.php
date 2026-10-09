@props(['category', 'product' => null, 'size' => 'md'])

@php
    $catImg = $product?->primaryImage() ?? $category->products->first(fn ($p) => $p->primaryImage())?->primaryImage();
@endphp

{{-- Category Card — DESIGN.md v3 §7.4: Editorial category tile (zero botanical artifacts) --}}
<a href="{{ route('shop.category', $category->slug) }}"
    {{ $attributes->merge(['class' => 'group relative block overflow-hidden rounded-md border border-line bg-white transition-all duration-300 hover:border-pink-mauve/60 hover:shadow-xs']) }}>

    <div class="{{ $size === 'tall' ? 'aspect-[4/5]' : ($size === 'wide' ? 'aspect-[16/9]' : 'aspect-[4/5]') }} w-full overflow-hidden bg-[#FAF6F7]">
        @if ($catImg)
            <img src="{{ Storage::url($catImg->image_path) }}" alt="{{ $category->name }}"
                class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-[1.03]" loading="lazy">
        @else
            {{-- Tasteful neutral editorial placeholder --}}
            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center bg-gradient-to-b from-[#FAF6F7] to-[#F1E8EC] transition-transform duration-500 ease-out group-hover:scale-[1.02]">
                <span class="text-[10px] tracking-[0.25em] uppercase text-muted font-medium mb-1">Kategori</span>
                <span class="font-display text-lg sm:text-xl font-medium text-ink">{{ $category->name }}</span>
            </div>
        @endif
    </div>

    {{-- Clean typographic overlay --}}
    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink/80 via-ink/40 to-transparent pt-12 pb-3.5 px-4 flex items-end justify-between">
        <div>
            <h3 class="text-white font-medium text-sm sm:text-base leading-tight">{{ $category->name }}</h3>
            <p class="text-white/75 text-[11px] mt-0.5">{{ $category->products->count() }} Produk</p>
        </div>
        <span class="text-white/90 text-xs font-medium group-hover:text-pink-soft group-hover:translate-x-0.5 transition-all duration-200">
            Lihat →
        </span>
    </div>
</a>
