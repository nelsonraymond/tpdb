@props(['product', 'filled' => null])

@php
    $isFilled = $filled ?? (auth()->check() && auth()->user()->wishlists()->where('product_id', $product->id)->exists());
@endphp

{{-- WishlistButton — DESIGN.md §19: ♡ outline / ♥ filled, smooth toggle.
     Posts to existing wishlist.toggle route (server-side auth check → login redirect for guests). --}}
<form method="POST" action="{{ route('wishlist.toggle', $product) }}" class="inline-flex {{ $attributes->get('class', '') }}">
    @csrf
    <button type="submit"
        aria-label="{{ $isFilled ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}"
        title="{{ $isFilled ? 'Hapus dari wishlist' : 'Tambah ke wishlist' }}"
        class="group/wish w-9 h-9 rounded-full bg-white/85 backdrop-blur border border-line inline-flex items-center justify-center transition duration-300 hover:border-pink-deep focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-deep cursor-pointer">
        <svg class="w-[18px] h-[18px] transition-transform duration-300 group-hover/wish:scale-110 {{ $isFilled ? 'fill-pink-deep text-pink-deep' : 'fill-none text-pink-deep' }}"
            stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20s-7-4.6-9.2-9A5.2 5.2 0 0112 6.5 5.2 5.2 0 0121.2 11C19 15.4 12 20 12 20z"/>
        </svg>
    </button>
</form>
