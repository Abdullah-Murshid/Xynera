@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'icon' => null,
    'type' => 'button'
])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 font-bold rounded-full transition-all duration-200 cursor-pointer tracking-wide';
    
    $variants = [
        'primary' => 'bg-agency-accent text-white border-none shadow-[0_4px_24px_var(--color-agency-accent-glow)] hover:opacity-90 hover:-translate-y-0.5',
        'outline' => 'bg-transparent text-agency-text border border-agency-stroke hover:bg-white/5 hover:border-white/20',
        'ghost' => 'bg-transparent text-agency-text border border-agency-stroke hover:bg-white/5 hover:border-white/20', // ghost in current CSS is similar to outline
    ];

    $sizes = [
        'sm' => 'text-[0.8rem] px-5 py-1.5',
        'md' => 'text-[0.85rem] px-6 py-2',
        'lg' => 'text-[0.9rem] px-8 py-3.5 shadow-[0_6px_28px_var(--color-agency-accent-glow)] hover:shadow-[0_10px_36px_rgba(236,91,19,0.4)]',
        'xl' => 'text-[1rem] px-10 py-4.5 shadow-[0_8px_32px_rgba(236,91,19,0.3)] hover:scale-105 hover:shadow-[0_12px_40px_rgba(236,91,19,0.45)]',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if($icon)
            <span class="material-symbols-outlined !text-[1.1em]">{{ $icon }}</span>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
        @if($icon)
            <span class="material-symbols-outlined !text-[1.1em]">{{ $icon }}</span>
        @endif
    </button>
@endif
