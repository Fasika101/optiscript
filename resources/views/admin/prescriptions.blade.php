@extends('layouts.admin')
@section('title', 'All Prescriptions')

@section('content')
<div class="space-y-5">

    <div>
        <h1 class="text-xl font-bold text-white">All Prescriptions</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $prescriptions->total() }} prescriptions across all doctors</p>
    </div>

    <form method="GET" action="{{ route('admin.prescriptions') }}" class="flex flex-wrap gap-3">
        <div class="relative flex-1 min-w-44">
            <svg class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Patient or doctor name..."
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-gray-800 border border-gray-700 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500">
        </div>
        <input type="date" name="date_from" value="{{ request('date_from') }}"
               class="px-4 py-2.5 rounded-xl bg-gray-800 border border-gray-700 text-sm text-gray-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
        <input type="date" name="date_to" value="{{ request('date_to') }}"
               class="px-4 py-2.5 rounded-xl bg-gray-800 border border-gray-700 text-sm text-gray-300 focus:outline-none focus:ring-2 focus:ring-violet-500">
        <button type="submit" class="px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-700 transition">Filter</button>
        @if(request()->anyFilled(['search','date_from','date_to']))
        <a href="{{ route('admin.prescriptions') }}" class="px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-sm text-gray-500 hover:bg-gray-700 transition">Clear</a>
        @endif
    </form>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
        @if($prescriptions->isEmpty())
        <div class="text-center py-16 text-gray-500 text-sm">No prescriptions found.</div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-800 bg-gray-800/30">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Patient</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden sm:table-cell">Doctor</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden md:table-cell">OD</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden md:table-cell">OS</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Date</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Type</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($prescriptions as $rx)
                    <tr class="hover:bg-gray-800/40 transition">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-sky-900/50 flex items-center justify-center text-sky-400 text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($rx->patient->name, 0, 2)) }}
                                </div>
                                <span class="text-sm font-medium text-gray-200">{{ $rx->patient->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 hidden sm:table-cell">
                            <p class="text-sm text-gray-400">{{ $rx->user->name }}</p>
                            <p class="text-xs text-gray-600">{{ $rx->user->clinic_name ?? '' }}</p>
                        </td>
                        <td class="px-5 py-3 hidden md:table-cell">
                            <span class="text-xs font-mono text-gray-400">{{ $rx->formatValue($rx->od_sphere) }} / {{ $rx->formatValue($rx->od_cylinder) }}</span>
                        </td>
                        <td class="px-5 py-3 hidden md:table-cell">
                            <span class="text-xs font-mono text-gray-400">{{ $rx->formatValue($rx->os_sphere) }} / {{ $rx->formatValue($rx->os_cylinder) }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="text-sm text-gray-300">{{ $rx->prescription_date->format('M d, Y') }}</span>
                        </td>
                        <td class="px-5 py-3 hidden lg:table-cell">
                            @if($rx->lens_type)
                            <span class="px-2 py-0.5 bg-sky-900/40 text-sky-400 text-xs font-medium rounded-full">{{ $rx->lens_type_label }}</span>
                            @else<span class="text-gray-600 text-xs">—</span>@endif
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.prescriptions.show', $rx) }}" class="text-xs text-violet-400 hover:text-violet-300 font-medium">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($prescriptions->hasPages())
        <div class="px-5 py-4 border-t border-gray-800">
            {{ $prescriptions->links() }}
        </div>
        @endif
        @endif
    </div>
</div>
@endsection
