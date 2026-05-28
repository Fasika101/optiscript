@extends('layouts.app')
@section('title', 'Prescription #' . str_pad($prescription->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() == url()->current() ? route('prescriptions.index') : url()->previous() }}"
               class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Rx #{{ str_pad($prescription->id, 6, '0', STR_PAD_LEFT) }}
                </h1>
                <p class="text-sm text-gray-500">
                    {{ $prescription->patient->name }} &nbsp;·&nbsp; {{ $prescription->prescription_date->format('F d, Y') }}
                </p>
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('prescriptions.edit', $prescription) }}"
               class="px-4 py-2 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Edit</a>
            <a href="{{ route('prescriptions.print', $prescription) }}" target="_blank"
               class="inline-flex items-center gap-1.5 px-4 py-2 border border-sky-200 bg-sky-50 rounded-xl text-sm font-medium text-sky-700 hover:bg-sky-100 transition">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
                Print
            </a>
            <a href="{{ route('prescriptions.download', $prescription) }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Download PDF
            </a>
        </div>
    </div>

    {{-- Prescription Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

        {{-- Clinic Header --}}
        <div class="bg-gradient-to-r from-sky-600 to-blue-700 px-8 py-6 text-white">
            <div class="flex items-start justify-between">
                <div>
                    @if($prescription->user->logo_path)
                    <img src="{{ Storage::url($prescription->user->logo_path) }}" class="h-12 mb-3 object-contain brightness-0 invert" alt="Logo">
                    @endif
                    <h2 class="text-xl font-bold">{{ $prescription->user->clinic_name ?? $prescription->user->name }}</h2>
                    <p class="text-sky-200 text-sm mt-0.5">{{ $prescription->user->specialty ?? 'Optometrist' }}</p>
                    @if($prescription->user->license_number)
                    <p class="text-sky-200 text-xs mt-0.5">License: {{ $prescription->user->license_number }}</p>
                    @endif
                </div>
                <div class="text-right">
                    <p class="text-sky-100 text-xs">Contact</p>
                    @if($prescription->user->phone)<p class="text-white text-sm font-medium">{{ $prescription->user->phone }}</p>@endif
                    @if($prescription->user->address)<p class="text-sky-200 text-xs mt-0.5">{{ $prescription->user->address }}</p>@endif
                </div>
            </div>
        </div>

        <div class="px-8 py-6 space-y-6">

            {{-- Patient Info Row --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pb-5 border-b border-gray-100">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Patient</p>
                    <p class="text-sm font-semibold text-gray-900 mt-1">{{ $prescription->patient->name }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Age / Gender</p>
                    <p class="text-sm text-gray-900 mt-1">
                        {{ $prescription->patient->age ? $prescription->patient->age . ' yrs' : '—' }}
                        @if($prescription->patient->gender) · <span class="capitalize">{{ $prescription->patient->gender }}</span>@endif
                    </p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</p>
                    <p class="text-sm text-gray-900 mt-1">{{ $prescription->prescription_date->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Rx Number</p>
                    <p class="text-sm font-mono font-semibold text-gray-900 mt-1">#{{ str_pad($prescription->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            {{-- Prescription Table --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">Vision Prescription</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 rounded-xl">
                                <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3 rounded-l-xl">Eye</th>
                                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">SPH</th>
                                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">CYL</th>
                                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">AXIS</th>
                                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">ADD</th>
                                <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3 rounded-r-xl">VA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-100">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                                            <span class="text-xs font-bold text-blue-700">OD</span>
                                        </div>
                                        <span class="text-xs text-gray-500">Right Eye</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->formatValue($prescription->od_sphere) }}</td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->formatValue($prescription->od_cylinder) }}</td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->od_axis !== null ? $prescription->od_axis . '°' : '—' }}</td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->formatValue($prescription->od_add) }}</td>
                                <td class="px-4 py-4 text-center text-sm text-gray-900">{{ $prescription->od_va ?? '—' }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-violet-100 flex items-center justify-center">
                                            <span class="text-xs font-bold text-violet-700">OS</span>
                                        </div>
                                        <span class="text-xs text-gray-500">Left Eye</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->formatValue($prescription->os_sphere) }}</td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->formatValue($prescription->os_cylinder) }}</td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->os_axis !== null ? $prescription->os_axis . '°' : '—' }}</td>
                                <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-900">{{ $prescription->formatValue($prescription->os_add) }}</td>
                                <td class="px-4 py-4 text-center text-sm text-gray-900">{{ $prescription->os_va ?? '—' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PD & Other Info --}}
            @if($prescription->pd_far || $prescription->pd_near || $prescription->pd_right || $prescription->pd_left)
            <div class="pb-5 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-3">Pupillary Distance</h3>
                <div class="flex flex-wrap gap-6">
                    @if($prescription->pd_far)
                    <div class="text-center">
                        <p class="text-xs text-gray-400">Far PD</p>
                        <p class="text-lg font-bold text-gray-900 font-mono">{{ $prescription->pd_far }}</p>
                        <p class="text-xs text-gray-400">mm</p>
                    </div>
                    @endif
                    @if($prescription->pd_near)
                    <div class="text-center">
                        <p class="text-xs text-gray-400">Near PD</p>
                        <p class="text-lg font-bold text-gray-900 font-mono">{{ $prescription->pd_near }}</p>
                        <p class="text-xs text-gray-400">mm</p>
                    </div>
                    @endif
                    @if($prescription->pd_right)
                    <div class="text-center">
                        <p class="text-xs text-gray-400">Right PD</p>
                        <p class="text-lg font-bold text-gray-900 font-mono">{{ $prescription->pd_right }}</p>
                        <p class="text-xs text-gray-400">mm</p>
                    </div>
                    @endif
                    @if($prescription->pd_left)
                    <div class="text-center">
                        <p class="text-xs text-gray-400">Left PD</p>
                        <p class="text-lg font-bold text-gray-900 font-mono">{{ $prescription->pd_left }}</p>
                        <p class="text-xs text-gray-400">mm</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Clinical Notes --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @if($prescription->diagnosis)
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Diagnosis</p>
                    <p class="text-sm text-gray-900">{{ $prescription->diagnosis }}</p>
                </div>
                @endif
                @if($prescription->lens_type)
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Lens Type</p>
                    <span class="inline-flex px-3 py-1 bg-sky-100 text-sky-700 text-sm font-medium rounded-full">{{ $prescription->lens_type_label }}</span>
                </div>
                @endif
                @if($prescription->recommendation)
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Recommendations</p>
                    <p class="text-sm text-gray-900">{{ $prescription->recommendation }}</p>
                </div>
                @endif
                @if($prescription->notes)
                <div class="sm:col-span-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Notes</p>
                    <p class="text-sm text-gray-900">{{ $prescription->notes }}</p>
                </div>
                @endif
                @if($prescription->next_visit)
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Next Visit</p>
                    <p class="text-sm text-gray-900">{{ $prescription->next_visit->format('F d, Y') }}</p>
                </div>
                @endif
            </div>

        </div>

        {{-- Footer signature strip --}}
        <div class="bg-gray-50 border-t border-gray-100 px-8 py-4 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-700">{{ $prescription->user->name }}</p>
                <p class="text-xs text-gray-400">{{ $prescription->user->specialty ?? 'Eye Care Specialist' }}</p>
            </div>
            <p class="text-xs text-gray-400">Issued: {{ $prescription->prescription_date->format('F d, Y') }}</p>
        </div>
    </div>

    {{-- Danger Zone --}}
    <div class="bg-white rounded-2xl border border-red-100 p-6 flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-gray-700">Delete this prescription</p>
            <p class="text-xs text-gray-400 mt-0.5">This action cannot be undone.</p>
        </div>
        <form method="POST" action="{{ route('prescriptions.destroy', $prescription) }}"
              onsubmit="return confirm('Delete this prescription? This cannot be undone.')">
            @csrf @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-medium text-sm rounded-xl border border-red-200 transition">
                Delete
            </button>
        </form>
    </div>

</div>
@endsection
