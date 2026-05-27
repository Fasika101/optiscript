@extends('layouts.admin')
@section('title', $user->name)

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.doctors') }}" class="text-gray-500 hover:text-gray-300 transition">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-600 to-purple-800 flex items-center justify-center text-white font-bold text-base">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">{{ $user->name }}</h1>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.doctors.destroy', $user) }}"
              onsubmit="return confirm('Delete {{ $user->name }} and all their data?')">
            @csrf @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-900/30 hover:bg-red-900/60 text-red-400 font-medium text-sm rounded-xl border border-red-800/50 transition">
                Delete Account
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- Profile Card --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 space-y-4">
            <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Profile</h2>

            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-800/50 rounded-xl p-3 text-center">
                    <p class="text-2xl font-bold text-violet-300">{{ $user->prescriptions_count }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">Prescriptions</p>
                </div>
                <div class="bg-gray-800/50 rounded-xl p-3 text-center">
                    <p class="text-2xl font-bold text-sky-300">{{ $user->patients_count }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">Patients</p>
                </div>
            </div>

            <div class="space-y-2.5 pt-1">
                @if($user->clinic_name)
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-gray-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                    <span class="text-sm text-gray-300">{{ $user->clinic_name }}</span>
                </div>
                @endif
                @if($user->specialty)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                    <span class="text-sm text-gray-300">{{ $user->specialty }}</span>
                </div>
                @endif
                @if($user->phone)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                    <span class="text-sm text-gray-300">{{ $user->phone }}</span>
                </div>
                @endif
                @if($user->license_number)
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>
                    <span class="text-sm text-gray-300">Lic. {{ $user->license_number }}</span>
                </div>
                @endif
                <div class="flex items-center gap-2 pt-1 border-t border-gray-800">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                    <span class="text-xs text-gray-500">Joined {{ $user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Monthly Chart --}}
        <div class="lg:col-span-2 bg-gray-900 border border-gray-800 rounded-2xl p-5">
            <h2 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-5">Prescription Activity — Last 6 Months</h2>
            @php $maxCount = $monthlyStats->max('count') ?: 1; @endphp
            <div class="flex items-end gap-3 h-28">
                @foreach($monthlyStats as $stat)
                <div class="flex-1 flex flex-col items-center gap-1.5">
                    <span class="text-xs font-semibold text-gray-400">{{ $stat['count'] }}</span>
                    <div class="w-full rounded-t-lg bg-violet-600/80"
                         style="height: {{ round(($stat['count'] / $maxCount) * 100) }}%; min-height: 4px;"></div>
                    <span class="text-xs text-gray-500">{{ $stat['month'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recent Prescriptions --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-800 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-300">Recent Prescriptions</h2>
            <span class="text-xs text-gray-500">{{ $user->prescriptions_count }} total</span>
        </div>
        @if($recentPrescriptions->isEmpty())
        <div class="text-center py-10 text-gray-600 text-sm">No prescriptions written yet.</div>
        @else
        <div class="divide-y divide-gray-800">
            @foreach($recentPrescriptions as $rx)
            <div class="flex items-center justify-between px-5 py-3 hover:bg-gray-800/40 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-sky-900/50 flex items-center justify-center text-sky-400 text-xs font-bold flex-shrink-0">
                        {{ strtoupper(substr($rx->patient->name, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-200">{{ $rx->patient->name }}</p>
                        <p class="text-xs text-gray-500">{{ $rx->prescription_date->format('M d, Y') }}
                            @if($rx->lens_type) · {{ $rx->lens_type_label }} @endif
                        </p>
                    </div>
                </div>
                <a href="{{ route('admin.prescriptions.show', $rx) }}" class="text-xs text-violet-400 hover:text-violet-300">View</a>
            </div>
            @endforeach
        </div>
        @endif
    </div>

</div>
@endsection
