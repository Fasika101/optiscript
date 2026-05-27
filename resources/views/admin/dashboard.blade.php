@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-xl font-bold text-white">Overview</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ now()->format('l, F j, Y') }}</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Doctors</p>
                <div class="w-8 h-8 rounded-lg bg-violet-900/50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-violet-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ number_format($totalDoctors) }}</p>
            <a href="{{ route('admin.doctors') }}" class="text-xs text-violet-400 hover:underline mt-1 block">View all →</a>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Patients</p>
                <div class="w-8 h-8 rounded-lg bg-sky-900/50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ number_format($totalPatients) }}</p>
            <a href="{{ route('admin.patients') }}" class="text-xs text-sky-400 hover:underline mt-1 block">View all →</a>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Rx</p>
                <div class="w-8 h-8 rounded-lg bg-emerald-900/50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ number_format($totalPrescriptions) }}</p>
            <a href="{{ route('admin.prescriptions') }}" class="text-xs text-emerald-400 hover:underline mt-1 block">View all →</a>
        </div>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">This Month</p>
                <div class="w-8 h-8 rounded-lg bg-amber-900/50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-white">{{ number_format($thisMonth) }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ now()->format('F Y') }}</p>
        </div>
    </div>

    {{-- Monthly Bar Chart + Top Doctors --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

        {{-- Monthly Activity --}}
        <div class="lg:col-span-3 bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <h2 class="text-sm font-semibold text-gray-300 mb-5">Prescriptions — Last 6 Months</h2>
            @php $maxCount = $monthlyStats->max('count') ?: 1; @endphp
            <div class="flex items-end gap-3 h-32">
                @foreach($monthlyStats as $stat)
                <div class="flex-1 flex flex-col items-center gap-1.5">
                    <span class="text-xs font-semibold text-gray-400">{{ $stat['count'] }}</span>
                    <div class="w-full rounded-t-lg bg-violet-600/80 transition-all"
                         style="height: {{ $maxCount > 0 ? round(($stat['count'] / $maxCount) * 100) : 0 }}%; min-height: 4px;">
                    </div>
                    <span class="text-xs text-gray-500">{{ $stat['month'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Top Doctors --}}
        <div class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-300">Top Doctors</h2>
                <a href="{{ route('admin.doctors') }}" class="text-xs text-violet-400 hover:underline">All</a>
            </div>
            @if($topDoctors->isEmpty())
            <p class="text-sm text-gray-600 text-center py-6">No registered doctors yet.</p>
            @else
            <div class="space-y-3">
                @foreach($topDoctors as $i => $doc)
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-gray-600 w-4">{{ $i + 1 }}</span>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-violet-600 to-purple-800 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                        {{ strtoupper(substr($doc->name, 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('admin.doctors.show', $doc) }}" class="text-sm font-semibold text-gray-200 hover:text-violet-300 truncate block">{{ $doc->name }}</a>
                        <p class="text-xs text-gray-500 truncate">{{ $doc->clinic_name ?? 'No clinic set' }}</p>
                    </div>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-violet-900/50 text-violet-300 flex-shrink-0">
                        {{ $doc->prescriptions_count }}
                    </span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    {{-- Recent Prescriptions --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-800 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-300">Recent Prescriptions</h2>
            <a href="{{ route('admin.prescriptions') }}" class="text-xs text-violet-400 hover:underline">View all</a>
        </div>
        @if($recentPrescriptions->isEmpty())
        <div class="text-center py-10 text-gray-600 text-sm">No prescriptions yet.</div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-800">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Patient</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden sm:table-cell">Doctor</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden md:table-cell">Date</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Type</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($recentPrescriptions as $rx)
                    <tr class="hover:bg-gray-800/50 transition">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-sky-900/50 flex items-center justify-center text-sky-400 text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($rx->patient->name, 0, 2)) }}
                                </div>
                                <span class="text-sm text-gray-200 font-medium">{{ $rx->patient->name }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3 hidden sm:table-cell">
                            <span class="text-sm text-gray-400">{{ $rx->user->name }}</span>
                        </td>
                        <td class="px-5 py-3 hidden md:table-cell">
                            <span class="text-sm text-gray-400">{{ $rx->prescription_date->format('M d, Y') }}</span>
                        </td>
                        <td class="px-5 py-3 hidden lg:table-cell">
                            @if($rx->lens_type)
                            <span class="px-2 py-0.5 bg-sky-900/40 text-sky-400 text-xs font-medium rounded-full">{{ $rx->lens_type_label }}</span>
                            @else
                            <span class="text-gray-600">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.prescriptions.show', $rx) }}" class="text-xs text-violet-400 hover:text-violet-300 font-medium">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

</div>
@endsection
