@props([
    'label',
    'name',
    'options' => [],
    'selected' => null,
    'required' => false
])

<div class="flex flex-col gap-2 w-full uppercase tracking-widest text-agency-muted">
    <label class="text-[0.7rem] font-bold">
        {{ $label }}
        @if($required)<span class="text-agency-accent">*</span>@endif
    </label>
    <select 
        name="{{ $name }}" 
        id="{{ $name }}" 
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'appearance-none w-full bg-agency-surface-light border border-agency-stroke rounded-xl px-4 py-3.5 text-[0.9rem] text-agency-text focus:outline-none focus:border-agency-accent/50 transition-all duration-300 ' . ($errors->has($name) ? 'border-red-500' : '')]) }}
    >
        @foreach($options as $value => $text)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>
</div>
