@if ($count > 0)
    <span class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] px-1 rounded-full bg-pink-deep text-white text-[10px] font-semibold flex items-center justify-center">{{ $count > 99 ? '99+' : $count }}</span>
@endif
