@props([
    'eyebrow' => null,
    'title' => null,
    'linkText' => null,
    'linkHref' => '#',
    'reveal' => true,
    'delay' => null
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap items-end justify-between gap-6 mb-12' . ($reveal ? ' reveal ' . ($delay ? 'delay-[' . $delay . 's]' : '') : '')]) }}>
    <div>
        @if($eyebrow)
            <x-eyebrow :label="$eyebrow" class="mb-3" />
        @endif
        <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-[1.05]">
            {!! $title !!}
        </h2>
    </div>
    @if($linkText)
        <a href="{{ $linkHref }}" class="group flex items-center gap-2 text-[0.75rem] font-bold uppercase tracking-widest text-agency-accent no-underline transition-all">
            {{ $linkText }}
            <span class="material-symbols-outlined !text-[0.85rem] transition-transform group-hover:translate-x-1.5">arrow_forward</span>
        </a>
    @endif
</div>
