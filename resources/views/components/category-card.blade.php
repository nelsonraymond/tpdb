@props(['category', 'product' => null, 'size' => 'md'])

{{-- CategoryCard — DESIGN.md §14: large image, rounded 16px, name overlay, hover zoom 1.03, subtle CTA. --}}
<a href="{{ route('shop.category', $category->slug) }}"
    {{ $attributes->merge(['class' => 'group relative rounded-2xl overflow-hidden border border-line bg-white shadow-card hover:shadow-card-hover transition-all duration-300 block']) }}>
    <div class="{{ $size === 'tall' ? 'aspect-4/5' : ($size === 'wide' ? 'aspect-16/10 sm:aspect-21/9' : 'aspect-4/5') }} bg-pink-soft/30 overflow-hidden">
        @if ($product?->primaryImage())
            <img src="{{ Storage::url($product->primaryImage()->image_path) }}" alt="{{ $category->name }}"
                class="w-full h-full object-cover group-hover:scale-103 transition duration-500" loading="lazy">
        @elseif ($category->products->isNotEmpty() && $category->products->first()?->primaryImage())
            <img src="{{ Storage::url($category->products->first()->primaryImage()->image_path) }}" alt="{{ $category->name }}"
                class="w-full h-full object-cover group-hover:scale-103 transition duration-500" loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-b from-pink-soft/50 via-white to-cream">
                <span class="text-3xl text-pink-deep/40" aria-hidden="true">❀</span>
            </div>
        @endif
    </div>
    <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink/65 to-transparent pt-12 pb-3 px-4">
        <p class="text-white font-medium text-sm">{{ $category->name }}</p>
        <p class="text-white/80 text-[11px] group-hover:text-pink-soft transition opacity-0 group-focus-visible:opacity-100 md:group-hover:opacity-100 duration-300">Lihat koleksi →</p>
    </div>
</a>
