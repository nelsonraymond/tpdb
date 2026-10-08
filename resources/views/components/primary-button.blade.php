@props(['href' => null, 'type' => 'submit'])

{{-- PrimaryButton — DESIGN.md §11: deep pink, white text, radius 12px, smooth hover lift. --}}
@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-7 py-3 rounded-xl bg-pink-deep hover:bg-pink-mauve text-white text-sm font-medium transition-all duration-300 hover:-translate-y-0.5 shadow-card hover:shadow-card-hover cursor-pointer min-h-[48px]']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-7 py-3 rounded-xl bg-pink-deep hover:bg-pink-mauve text-white text-sm font-medium transition-all duration-300 hover:-translate-y-0.5 shadow-card hover:shadow-card-hover cursor-pointer min-h-[48px]']) }}>
        {{ $slot }}
    </button>
@endif
