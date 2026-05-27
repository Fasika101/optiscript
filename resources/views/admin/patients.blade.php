@extends('layouts.admin')
@section('title', 'All Patients')

@section('content')
<div class="space-y-5">

    <div>
        <h1 class="text-xl font-bold text-white">All Patients</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $patients->total() }} patients across all clinics</p>
    </div>

    <form method="GET" action="{{ route('admin.patients') }}" class="flex gap-3">
        <div class="relative flex-1 max-w-sm">
            <svg class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name or phone..."
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-gray-800 border border-gray-700 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500">
        </div>
        <button type="submit" class="px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-700 transition">Search</button>
        @if(request('search'))
        <a href="{{ route('admin.patients') }}" class="px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-700 transition">Clear</a>
        @endif
    </form>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
        @if($patients->isEmpty())
        <div class="text-center py-16 text-gray-500 text-sm">No patients found.</div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-800 bg-gray-800/30">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Patient</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden sm:table-cell">Doctor / Clinic</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden md:table-cell">Contact</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Rx</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Registered</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($patients as $patient)
                    <tr class="hover:bg-gray-800/40 transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-sky-900/50 flex items-center justify-center text-sky-400 text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($patient->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-200">{{ $patient->name }}</p>
                                    @if($patient->gender || $patient->age)
                                    <p class="text-xs text-gray-500">
                                        @if($patient->age) {{ $patient->age }} yrs @endif
                                        @if($patient->gender) · {{ ucfirst($patient->gender) }} @endif
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 hidden sm:table-cell">
                            <p class="text-sm text-gray-300">{{ $patient->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $patient->user->clinic_name ?? '—' }}</p>
                        </td>
                        <td class="px-5 py-4 hidden md:table-cell">
                            <p class="text-sm text-gray-400">{{ $patient->phone ?? '—' }}</p>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-violet-900/40 text-violet-300">
                                {{ $patient->prescriptions_count }}
                            </span>
                        </td>
                        <td class="px-5 py-4 hidden lg:table-cell">
                            <span class="text-sm text-gray-500">{{ $patient->created_at->format('M d, Y') }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($patients->hasPages())
        <div class="px-5 py-4 border-t border-gray-800">
            {{ $patients->links() }}
        </div>
        @endif
        @endif
    </div>
</div>
@endsection
