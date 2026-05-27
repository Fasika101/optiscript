@extends('layouts.admin')
@section('title', 'Prescription #' . str_pad($prescription->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="max-w-3xl mx-auto space-y-5">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.prescriptions') }}" class="text-gray-500 hover:text-gray-300 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-xl font-bold text-white">Rx #{{ str_pad($prescription->id, 6, '0', STR_PAD_LEFT) }}</h1>
            <p class="text-sm text-gray-500">{{ $prescription->patient->name }} · {{ $prescription->prescription_date->format('M d, Y') }}</p>
        </div>
    </div>

    {{-- Doctor & Patient Info --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Doctor</p>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-600 to-purple-800 flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr($prescription->user->name, 0, 2)) }}
                </div>
                <div>
                    <a href="{{ route('admin.doctors.show', $prescription->user) }}" class="text-sm font-semibold text-gray-200 hover:text-violet-300">{{ $prescription->user->name }}</a>
                    <p class="text-xs text-gray-500">{{ $prescription->user->clinic_name ?? $prescription->user->specialty ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Patient</p>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sky-900/50 flex items-center justify-center text-sky-400 font-bold">
                    {{ strtoupper(substr($prescription->patient->name, 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-200">{{ $prescription->patient->name }}</p>
                    <p class="text-xs text-gray-500">
                        @if($prescription->patient->age) {{ $prescription->patient->age }} yrs @endif
                        @if($prescription->patient->gender) · {{ ucfirst($prescription->patient->gender) }} @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Prescription Data --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-800">
            <h2 class="text-sm font-semibold text-gray-300">Vision Prescription</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-800/30 border-b border-gray-800">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Eye</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">SPH</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">CYL</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">AXIS</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">ADD</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-4 py-3">VA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    <tr>
                        <td class="px-5 py-4"><span class="px-2.5 py-1 bg-blue-900/40 text-blue-400 text-xs font-bold rounded-lg">OD Right</span></td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->formatValue($prescription->od_sphere) }}</td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->formatValue($prescription->od_cylinder) }}</td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->od_axis !== null ? $prescription->od_axis.'°' : '—' }}</td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->formatValue($prescription->od_add) }}</td>
                        <td class="px-4 py-4 text-center text-sm text-gray-300">{{ $prescription->od_va ?? '—' }}</td>
                    </tr>
                    <tr>
                        <td class="px-5 py-4"><span class="px-2.5 py-1 bg-violet-900/40 text-violet-400 text-xs font-bold rounded-lg">OS Left</span></td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->formatValue($prescription->os_sphere) }}</td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->formatValue($prescription->os_cylinder) }}</td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->os_axis !== null ? $prescription->os_axis.'°' : '—' }}</td>
                        <td class="px-4 py-4 text-center font-mono text-sm font-semibold text-gray-200">{{ $prescription->formatValue($prescription->os_add) }}</td>
                        <td class="px-4 py-4 text-center text-sm text-gray-300">{{ $prescription->os_va ?? '—' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if($prescription->pd_far || $prescription->pd_near || $prescription->pd_right || $prescription->pd_left)
        <div class="px-5 py-4 border-t border-gray-800 flex flex-wrap gap-6">
            @foreach(['pd_far' => 'Far PD','pd_near' => 'Near PD','pd_right' => 'Right PD','pd_left' => 'Left PD'] as $field => $label)
            @if($prescription->$field)
            <div class="text-center">
                <p class="text-xs text-gray-500">{{ $label }}</p>
                <p class="text-lg font-bold text-gray-200 font-mono">{{ $prescription->$field }}</p>
                <p class="text-xs text-gray-600">mm</p>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </div>

    @if($prescription->diagnosis || $prescription->lens_type || $prescription->recommendation || $prescription->notes)
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 space-y-3">
        <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Clinical Notes</h2>
        @if($prescription->diagnosis)
        <div><p class="text-xs text-gray-500 mb-1">Diagnosis</p><p class="text-sm text-gray-200">{{ $prescription->diagnosis }}</p></div>
        @endif
        @if($prescription->lens_type)
        <div><p class="text-xs text-gray-500 mb-1">Lens Type</p><span class="px-2.5 py-1 bg-sky-900/40 text-sky-400 text-xs font-semibold rounded-full">{{ $prescription->lens_type_label }}</span></div>
        @endif
        @if($prescription->recommendation)
        <div><p class="text-xs text-gray-500 mb-1">Recommendations</p><p class="text-sm text-gray-200">{{ $prescription->recommendation }}</p></div>
        @endif
        @if($prescription->notes)
        <div><p class="text-xs text-gray-500 mb-1">Notes</p><p class="text-sm text-gray-400">{{ $prescription->notes }}</p></div>
        @endif
    </div>
    @endif

    <div class="flex justify-end">
        <a href="{{ route('prescriptions.print', $prescription) }}" target="_blank"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-800 border border-gray-700 text-sm font-medium text-gray-300 rounded-xl hover:bg-gray-700 transition">
            🖨 Print Prescription
        </a>
    </div>

</div>
@endsection
