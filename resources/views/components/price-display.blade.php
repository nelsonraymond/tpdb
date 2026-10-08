@props(['price', 'compareAt' => null, 'size' => 'sm'])

{{-- PriceDisplay — DESIGN.md §15: discount price with struck compare-at. Rupiah format. --}}
<span {{ $attributes->merge(['class' => 'inline-flex items-baseline gap-1.5 flex-wrap min-w-0']) }}>
    <span class="{{ $size === 'lg' ? 'text-lg' : 'text-sm' }} font-semibold text-ink whitespace-nowrap">
        Rp{{ number_format($price, 0, ',', '.') }}
    </span>
    @if ($compareAt && $compareAt > $price)
        <span class="{{ $size === 'lg' ? 'text-sm' : 'text-xs' }} text-muted line-through whitespace-nowrap">
            Rp{{ number_format($compareAt, 0, ',', '.') }}
        </span>
    @endif
</span>
