@props(['paginator'])

{{-- Pagination — DESIGN.md v3: editorial-minimal, pill buttons, 44px touch targets (mobile §38).
     Uses the paginator's own withQueryString() links so active filters (q/category/sort) survive page changes. --}}
@if ($paginator->hasPages())
    @php
        $itemClass = 'min-w-[44px] h-11 inline-flex items-center justify-center rounded-full text-sm font-medium transition border';
        $idle = 'bg-white text-muted border-line hover:border-pink-deep hover:text-pink-deep focus-visible:ring-2 focus-visible:ring-pink-deep focus:outline-none';
        $disabled = 'bg-white/50 text-muted/40 border-line pointer-events-none select-none';
    @endphp
    <nav class="flex items-center justify-center gap-1.5 sm:gap-2" aria-label="Navigasi halaman produk">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" class="{{ $itemClass }} {{ $disabled }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="sr-only">Sebelumnya</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="{{ $itemClass }} {{ $idle }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="sr-only">Sebelumnya</span>
            </a>
        @endif

        {{-- Page numbers / elements --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($paginator->currentPage() == $page)
                <span aria-current="page" class="{{ $itemClass }} bg-ink text-white border-ink">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="{{ $itemClass }} {{ $idle }}">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="{{ $itemClass }} {{ $idle }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="sr-only">Berikutnya</span>
            </a>
        @else
            <span aria-disabled="true" class="{{ $itemClass }} {{ $disabled }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="sr-only">Berikutnya</span>
            </span>
        @endif
    </nav>

    <p class="text-center text-xs text-muted mt-4">
        Menampilkan halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}
    </p>
@endif
