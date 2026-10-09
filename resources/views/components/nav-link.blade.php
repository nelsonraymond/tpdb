@props(["href" => "#", "active" => false, "label" => null])

{{-- Desktop nav link — DESIGN.md §12: active = deep pink text + small underline --}}
<a href="{{ $href }}" {{ $attributes->except('href') }}
    class="text-sm transition hover:text-pink-deep {{ $active ? 'text-pink-deep font-medium border-b-2 border-pink-deep pb-0.5' : 'text-muted' }}">
    {{ $label ?? trim($slot) }}
</a>
