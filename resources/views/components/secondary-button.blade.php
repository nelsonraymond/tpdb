@props(['href' => null, 'type' => 'submit'])

{{-- SecondaryButton — DESIGN.md §11: transparent, deep pink border + text. --}}
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-7 py-3 rounded-xl border border-pink-deep text-pink-deep hover:bg-pink-soft/30 text-sm font-medium transition duration-300 cursor-pointer min-h-[48px]']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-7 py-3 rounded-xl border border-pink-deep text-pink-deep hover:bg-pink-soft/30 text-sm font-medium transition duration-300 cursor-pointer min-h-[48px]']) }}>
        {{ $slot }}
    </button>
@endif
