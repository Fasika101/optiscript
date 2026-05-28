@php
    $prescription = $prescription ?? null;
    $eyes = [
        'od' => [
            'label' => 'OD',
            'sub' => 'Right Eye',
            'wrap' => 'bg-blue-50 border border-blue-100',
            'title' => 'text-blue-800',
            'subClass' => 'text-blue-600',
        ],
        'os' => [
            'label' => 'OS',
            'sub' => 'Left Eye',
            'wrap' => 'bg-violet-50 border border-violet-100',
            'title' => 'text-violet-800',
            'subClass' => 'text-violet-600',
        ],
    ];
@endphp

@foreach ($eyes as $prefix => $eye)
    <tr>
        <td class="pr-4 pb-3">
            <div class="{{ $eye['wrap'] }} rounded-xl px-3 py-2 text-center">
                <p class="text-xs font-bold {{ $eye['title'] }}">{{ $eye['label'] }}</p>
                <p class="text-xs {{ $eye['subClass'] }}">{{ $eye['sub'] }}</p>
            </div>
        </td>
        <td class="px-2 pb-3">
            <x-rx-select
                :name="$prefix.'_sphere'"
                :selected="$prescription?->{$prefix.'_sphere'}"
                min="-6"
                max="6"
            />
        </td>
        <td class="px-2 pb-3">
            <x-rx-select
                :name="$prefix.'_cylinder'"
                :selected="$prescription?->{$prefix.'_cylinder'}"
                min="-6"
                max="6"
            />
        </td>
        <td class="px-2 pb-3">
            <x-rx-axis-select
                :name="$prefix.'_axis'"
                :selected="$prescription?->{$prefix.'_axis'}"
            />
        </td>
        <td class="px-2 pb-3">
            <x-rx-select
                :name="$prefix.'_add'"
                :selected="$prescription?->{$prefix.'_add'}"
                min="0"
                max="5"
            />
        </td>
        <td class="px-2 pb-3">
            <input type="text" name="{{ $prefix }}_va"
                   value="{{ old($prefix.'_va', $prescription?->{$prefix.'_va'}) }}"
                   placeholder="6/6"
                   class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
        </td>
    </tr>
@endforeach
