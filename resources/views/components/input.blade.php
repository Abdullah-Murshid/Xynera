@props([
    'label',
    'name',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false
])

<div class="flex flex-col gap-2 w-full">
    <label class="text-[0.7rem] font-bold uppercase tracking-widest text-agency-muted">
        {{ $label }}
        @if($required)<span class="text-agency-accent">*</span>@endif
    </label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'bg-white/5 border border-agency-stroke rounded-xl px-4 py-3.5 text-[0.9rem] text-agency-text placeholder:text-agency-muted transition-all duration-300 focus:outline-none focus:border-agency-accent/50 focus:bg-white/8 ' . ($errors->has($name) ? 'border-red-500' : '')]) }}
    />
    @error($name)
        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
    @enderror
</div>
