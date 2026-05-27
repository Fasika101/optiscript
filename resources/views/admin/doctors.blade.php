@extends('layouts.admin')
@section('title', 'Registered Doctors')

@section('content')
<div class="space-y-5">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
            <h1 class="text-xl font-bold text-white">Registered Doctors</h1>
            <p class="text-sm text-gray-500 mt-0.5">{{ $doctors->total() }} registered accounts</p>
        </div>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.doctors') }}" class="flex gap-3">
        <div class="relative flex-1 max-w-sm">
            <svg class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search name, email, clinic..."
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl bg-gray-800 border border-gray-700 text-sm text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-transparent">
        </div>
        <button type="submit" class="px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-sm font-medium text-gray-300 hover:bg-gray-700 transition">Search</button>
        @if(request('search'))
        <a href="{{ route('admin.doctors') }}" class="px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-700 transition">Clear</a>
        @endif
    </form>

    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
        @if($doctors->isEmpty())
        <div class="text-center py-16 text-gray-500 text-sm">No registered doctors found.</div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-800 bg-gray-800/30">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Doctor</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden sm:table-cell">Clinic</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden md:table-cell">Specialty</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Patients</th>
                        <th class="text-center text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Rx Issued</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3 hidden lg:table-cell">Joined</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-5 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($doctors as $doc)
                    <tr class="hover:bg-gray-800/40 transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-violet-600 to-purple-800 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($doc->name, 0, 2)) }}
                                </div>
                                <div>
                                    <a href="{{ route('admin.doctors.show', $doc) }}" class="text-sm font-semibold text-gray-200 hover:text-violet-300 transition">{{ $doc->name }}</a>
                                    <p class="text-xs text-gray-500">{{ $doc->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 hidden sm:table-cell">
                            <span class="text-sm text-gray-400">{{ $doc->clinic_name ?? '—' }}</span>
                        </td>
                        <td class="px-5 py-4 hidden md:table-cell">
                            <span class="text-sm text-gray-400">{{ $doc->specialty ?? '—' }}</span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-sky-900/40 text-sky-400">
                                {{ $doc->patients_count }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-violet-900/40 text-violet-300">
                                {{ $doc->prescriptions_count }}
                            </span>
                        </td>
                        <td class="px-5 py-4 hidden lg:table-cell">
                            <span class="text-sm text-gray-500">{{ $doc->created_at->format('M d, Y') }}</span>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <a href="{{ route('admin.doctors.show', $doc) }}" class="text-xs font-medium text-violet-400 hover:text-violet-300 transition">View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($doctors->hasPages())
        <div class="px-5 py-4 border-t border-gray-800">
            {{ $doctors->links() }}
        </div>
        @endif
        @endif
    </div>
</div>
@endsection
