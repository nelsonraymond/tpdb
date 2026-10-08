@props(['product'])

{{-- Product card per DESIGN.md §15: image 4:5, name, price, badges, wishlist, add to cart --}}
<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl border border-line overflow-hidden group flex flex-col shadow-card hover:shadow-card-hover transition-all duration-300 relative']) }}>
    <a href="{{ route('shop.product', $product->slug) }}" class="relative aspect-4/5 block overflow-hidden bg-cream">
        @php $primaryImg = $product->primaryImage(); @endphp
        @if ($primaryImg)
            <img src="{{ Storage::url($primaryImg->image_path) }}" alt="{{ $product->name }}"
                class="w-full h-full object-cover group-hover:scale-103 transition duration-500" loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-b from-pink-soft/40 to-cream">
                <span class="font-display italic text-sm text-pink-mauve/70">{{ $product->name }}</span>
            </div>
        @endif

        {{-- Badges --}}
        <div class="absolute top-2.5 left-2.5 flex flex-col gap-1">
            @if ($product->is_best_seller)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-pink-deep text-white shadow-xs">Best Seller</span>
            @endif
            @if ($product->is_featured)
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-gold text-white shadow-xs">Pilihan</span>
            @endif
        </div>

    </a>

    {{-- Wishlist action (§19) — real toggle, delegated to shared component --}}
    <x-wishlist-button :product="$product" class="absolute top-2 right-2 z-10 opacity-0 group-hover:opacity-100 focus-within:opacity-100 transition duration-300" />

    <div class="p-4 flex-1 flex flex-col justify-between">
        <div>
            <span class="text-[11px] text-muted block mb-0.5">{{ $product->category?->name }}</span>
            <a href="{{ route('shop.product', $product->slug) }}"
                class="font-medium text-sm text-ink hover:text-pink-deep transition line-clamp-1">
                {{ $product->name }}
            </a>
            <div class="text-[11px] text-muted mt-0.5">{{ $product->material }}</div>
        </div>

        <div class="mt-3 pt-3 border-t border-line/60 flex items-baseline justify-between gap-2">
            <div class="min-w-0">
                <x-price-display :price="$product->base_price" :compare-at="(float) $product->compare_at_price" />
            </div>
            @if ($product->hasAvailableStock())
                <span class="text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full shrink-0">Tersedia</span>
            @else
                <span class="text-[10px] text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full shrink-0">Habis</span>
            @endif
        </div>
    </div>
</div>
