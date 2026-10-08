@props(['eyebrow' => null, 'title', 'subtitle' => null, 'href' => null, 'linkLabel' => null, 'align' => 'left'])

{{-- SectionHeading — DESIGN.md §4 (serif headings) + §11 (text button with arrow). --}}
<div {{ $attributes->merge(['class' => 'flex items-end justify-between gap-4 ' . ($align === 'center' ? 'flex-col items-center text-center max-w-xl mx-auto' : '')]) }}>
    <div class="{{ $align === 'center' ? 'text-center' : '' }}">
        @if ($eyebrow)
            <p class="text-[11px] tracking-[0.2em] uppercase text-pink-mauve font-semibold mb-1">{{ $eyebrow }}</p>
        @endif
        <h2 class="font-display text-2xl md:text-3xl font-semibold text-ink leading-snug">{{ $title }}</h2>
        @if ($subtitle)
            <p class="text-sm text-muted mt-2 leading-relaxed">{{ $subtitle }}</p>
        @endif
    </div>
    @if ($href)
        <a href="{{ $href }}" class="shrink-0 inline-flex items-center text-sm text-pink-deep hover:text-pink-mauve transition font-medium min-h-[44px]">
            {{ $linkLabel ?? 'Lihat Semua' }} <span aria-hidden="true" class="ml-1">→</span>
        </a>
    @endif
</div>
