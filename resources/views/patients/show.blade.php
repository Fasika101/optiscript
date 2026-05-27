@extends('layouts.app')
@section('title', $patient->name)

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('patients.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-200 flex items-center justify-center text-violet-700 font-bold text-base">
                    {{ strtoupper(substr($patient->name, 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $patient->name }}</h1>
                    <p class="text-sm text-gray-500">
                        @if($patient->age) {{ $patient->age }} years old &nbsp;·&nbsp; @endif
                        @if($patient->gender) <span class="capitalize">{{ $patient->gender }}</span> @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('patients.edit', $patient) }}"
               class="px-4 py-2 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Edit</a>
            <a href="{{ route('prescriptions.create', ['patient_id' => $patient->id]) }}"
               class="inline-flex items-center gap-2 px-5 py-2 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                New Prescription
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Patient Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Patient Information</h2>

            <div class="space-y-3">
                @if($patient->phone)
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <span class="text-sm text-gray-700">{{ $patient->phone }}</span>
                </div>
                @endif

                @if($patient->email)
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    <span class="text-sm text-gray-700">{{ $patient->email }}</span>
                </div>
                @endif

                @if($patient->address)
                <div class="flex items-start gap-3">
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <span class="text-sm text-gray-700">{{ $patient->address }}</span>
                </div>
                @endif

                @if($patient->date_of_birth)
                <div class="flex items-center gap-3">
                    <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <span class="text-sm text-gray-700">{{ $patient->date_of_birth->format('M d, Y') }}</span>
                </div>
                @endif
            </div>

            @if($patient->medical_notes)
            <div class="pt-3 border-t border-gray-100">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Medical Notes</p>
                <p class="text-sm text-gray-700">{{ $patient->medical_notes }}</p>
            </div>
            @endif

            <div class="pt-3 border-t border-gray-100">
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Statistics</p>
                <div class="grid grid-cols-2 gap-3">
                    <div class="text-center p-3 bg-sky-50 rounded-xl">
                        <p class="text-xl font-bold text-sky-700">{{ $prescriptions->count() }}</p>
                        <p class="text-xs text-sky-600">Prescriptions</p>
                    </div>
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs font-semibold text-gray-600">Patient Since</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $patient->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Prescription History --}}
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900">Prescription History</h2>
                <span class="text-xs text-gray-400">{{ $prescriptions->count() }} records</span>
            </div>

            @if($prescriptions->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-sm">No prescriptions yet for this patient.</p>
                <a href="{{ route('prescriptions.create', ['patient_id' => $patient->id]) }}"
                   class="inline-flex items-center gap-1.5 mt-3 text-sky-600 text-sm font-medium hover:underline">
                    Write first prescription
                </a>
            </div>
            @else
            <div class="divide-y divide-gray-100">
                @foreach($prescriptions as $rx)
                <div class="px-6 py-4 hover:bg-gray-50/50 transition">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-sm font-semibold text-gray-900">{{ $rx->prescription_date->format('F d, Y') }}</span>
                                @if($rx->lens_type)
                                <span class="px-2 py-0.5 bg-sky-100 text-sky-700 text-xs font-medium rounded-full">{{ $rx->lens_type_label }}</span>
                                @endif
                            </div>

                            {{-- Mini prescription table --}}
                            <div class="grid grid-cols-2 gap-3 text-xs">
                                <div class="bg-blue-50 rounded-lg p-3">
                                    <p class="font-semibold text-blue-800 mb-1.5">OD (Right Eye)</p>
                                    <div class="grid grid-cols-3 gap-1 text-blue-700">
                                        <div><span class="text-blue-500">SPH</span><br>{{ $rx->formatValue($rx->od_sphere) }}</div>
                                        <div><span class="text-blue-500">CYL</span><br>{{ $rx->formatValue($rx->od_cylinder) }}</div>
                                        <div><span class="text-blue-500">AXIS</span><br>{{ $rx->od_axis ?? '—' }}°</div>
                                    </div>
                                </div>
                                <div class="bg-violet-50 rounded-lg p-3">
                                    <p class="font-semibold text-violet-800 mb-1.5">OS (Left Eye)</p>
                                    <div class="grid grid-cols-3 gap-1 text-violet-700">
                                        <div><span class="text-violet-500">SPH</span><br>{{ $rx->formatValue($rx->os_sphere) }}</div>
                                        <div><span class="text-violet-500">CYL</span><br>{{ $rx->formatValue($rx->os_cylinder) }}</div>
                                        <div><span class="text-violet-500">AXIS</span><br>{{ $rx->os_axis ?? '—' }}°</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5 flex-shrink-0">
                            <a href="{{ route('prescriptions.show', $rx) }}"
                               class="px-3 py-1.5 text-xs font-medium text-sky-600 hover:text-sky-800 border border-sky-200 rounded-lg hover:bg-sky-50 transition text-center">View</a>
                            <a href="{{ route('prescriptions.print', $rx) }}" target="_blank"
                               class="px-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-800 border border-gray-200 rounded-lg hover:bg-gray-50 transition text-center">Print</a>
                            <a href="{{ route('prescriptions.download', $rx) }}"
                               class="px-3 py-1.5 text-xs font-medium text-emerald-600 hover:text-emerald-800 border border-emerald-200 rounded-lg hover:bg-emerald-50 transition text-center">PDF</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

    </div>

    {{-- Danger Zone --}}
    <div class="bg-white rounded-2xl border border-red-100 p-6">
        <h2 class="text-sm font-semibold text-red-700 mb-3">Danger Zone</h2>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-700">Delete this patient record</p>
                <p class="text-xs text-gray-500 mt-0.5">This will permanently delete the patient and all their prescriptions.</p>
            </div>
            <form method="POST" action="{{ route('patients.destroy', $patient) }}"
                  onsubmit="return confirm('Delete {{ $patient->name }} and all their prescriptions? This cannot be undone.')">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-medium text-sm rounded-xl border border-red-200 transition">
                    Delete Patient
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
