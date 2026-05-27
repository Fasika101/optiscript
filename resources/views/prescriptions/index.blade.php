@extends('layouts.app')
@section('title', 'Prescriptions')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Prescriptions</h1>
            <p class="text-sm text-gray-500 mt-1">All eye prescriptions you have written</p>
        </div>
        <a href="{{ route('prescriptions.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            New Prescription
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('prescriptions.index') }}" class="flex flex-wrap gap-3">
        <div class="relative flex-1 min-w-48">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by patient name..."
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
        </div>
        <input type="date" name="date_from" value="{{ request('date_from') }}"
               class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
        <input type="date" name="date_to" value="{{ request('date_to') }}"
               class="px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
        <button type="submit" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Filter</button>
        @if(request()->anyFilled(['search','date_from','date_to']))
        <a href="{{ route('prescriptions.index') }}" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-50 transition">Clear</a>
        @endif
    </form>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @if($prescriptions->isEmpty())
        <div class="text-center py-16">
            <div class="w-16 h-16 rounded-full bg-sky-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <p class="text-gray-500 font-medium">No prescriptions found</p>
            <a href="{{ route('prescriptions.create') }}" class="inline-flex mt-3 text-sky-600 text-sm font-medium hover:underline">Write your first prescription</a>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Patient</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden sm:table-cell">Date</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden md:table-cell">OD (Right)</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden md:table-cell">OS (Left)</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden lg:table-cell">Type</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($prescriptions as $rx)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-sky-100 to-blue-200 flex items-center justify-center text-sky-700 font-semibold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($rx->patient->name, 0, 2)) }}
                                </div>
                                <a href="{{ route('patients.show', $rx->patient) }}" class="text-sm font-semibold text-gray-900 hover:text-sky-700 transition">{{ $rx->patient->name }}</a>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden sm:table-cell">
                            <span class="text-sm text-gray-700">{{ $rx->prescription_date->format('M d, Y') }}</span>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="text-xs font-mono text-gray-700">
                                {{ $rx->formatValue($rx->od_sphere) }} / {{ $rx->formatValue($rx->od_cylinder) }} × {{ $rx->od_axis ?? '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="text-xs font-mono text-gray-700">
                                {{ $rx->formatValue($rx->os_sphere) }} / {{ $rx->formatValue($rx->os_cylinder) }} × {{ $rx->os_axis ?? '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            @if($rx->lens_type)
                            <span class="px-2.5 py-0.5 bg-sky-50 text-sky-700 text-xs font-medium rounded-full">{{ $rx->lens_type_label }}</span>
                            @else
                            <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('prescriptions.show', $rx) }}" class="text-xs font-medium text-sky-600 hover:text-sky-800 transition">View</a>
                                <a href="{{ route('prescriptions.print', $rx) }}" target="_blank" class="text-xs font-medium text-gray-500 hover:text-gray-800 transition">Print</a>
                                <a href="{{ route('prescriptions.download', $rx) }}" class="text-xs font-medium text-emerald-600 hover:text-emerald-800 transition">PDF</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($prescriptions->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $prescriptions->links() }}
        </div>
        @endif
        @endif
    </div>
</div>
@endsection
