@props(['name', 'selected' => null, 'min', 'max', 'step' => 0.25, 'showPlus' => true])

@php
    $selected = old($name, $selected);
    $options = \App\Support\RxOptions::decimalRange((float) $min, (float) $max, (float) $step);
    $classes = 'w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono bg-white';
@endphp

<select name="{{ $name }}" {{ $attributes->merge(['class' => $classes]) }}>
    <option value="">—</option>
    @foreach ($options as $val)
        <option value="{{ number_format($val, 2, '.', '') }}" @selected(\App\Support\RxOptions::isSelected($selected, $val))>
            {{ \App\Support\RxOptions::formatLabel($val, $showPlus) }}
        </option>
    @endforeach
</select>
