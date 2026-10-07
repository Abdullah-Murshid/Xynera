@props([
    'label' => '',
    'reveal' => false,
    'delay' => null
])

<div {{ $attributes->merge(['class' => 'flex items-center gap-2.5 text-agency-accent mb-6' . ($reveal ? ' reveal ' . ($delay ? 'delay-[' . $delay . 's]' : '') : '')]) }}>
    <span class="h-[1px] w-8 bg-agency-accent shrink-0"></span>
    <span class="text-[0.65rem] font-bold uppercase tracking-[0.2em]">{{ $label }}</span>
</div>
