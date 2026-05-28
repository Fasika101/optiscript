@props(['name', 'selected' => null])

@php
    $selected = old($name, $selected);
    $options = \App\Support\RxOptions::integerRange(0, 180);
    $classes = 'w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono bg-white';
@endphp

<select name="{{ $name }}" {{ $attributes->merge(['class' => $classes]) }}>
    <option value="">—</option>
    @foreach ($options as $val)
        <option value="{{ $val }}" @selected(\App\Support\RxOptions::isSelected($selected, $val))>
            {{ $val }}°
        </option>
    @endforeach
</select>
