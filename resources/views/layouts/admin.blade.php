<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#1e1b4b">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin — {{ config('app.name') }} — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-950 text-gray-100">

<div class="min-h-screen flex flex-col">

    {{-- Admin Top Bar --}}
    <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">

                {{-- Brand --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-violet-500 to-purple-700 flex items-center justify-center shadow">
                            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <div class="hidden sm:block">
                            <span class="text-xs font-bold text-violet-400 uppercase tracking-widest">Super Admin</span>
                        </div>
                    </a>

                    {{-- Nav Links --}}
                    <div class="hidden md:flex items-center ml-6 gap-1">
                        <a href="{{ route('admin.dashboard') }}"
                           class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400 hover:text-gray-100 hover:bg-gray-800' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.doctors') }}"
                           class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->routeIs('admin.doctors*') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400 hover:text-gray-100 hover:bg-gray-800' }}">
                            Doctors
                        </a>
                        <a href="{{ route('admin.patients') }}"
                           class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->routeIs('admin.patients') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400 hover:text-gray-100 hover:bg-gray-800' }}">
                            Patients
                        </a>
                        <a href="{{ route('admin.prescriptions') }}"
                           class="px-3 py-1.5 rounded-lg text-xs font-semibold transition {{ request()->routeIs('admin.prescriptions*') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400 hover:text-gray-100 hover:bg-gray-800' }}">
                            Prescriptions
                        </a>
                    </div>
                </div>

                {{-- Right --}}
                <div x-data="{ open: false }" class="relative flex items-center gap-3">
                    <span class="hidden sm:inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-violet-900/50 border border-violet-700/40 text-xs font-semibold text-violet-300">
                        <span class="w-1.5 h-1.5 rounded-full bg-violet-400"></span>
                        Super Admin
                    </span>
                    <button @click="open = !open" class="flex items-center gap-1.5 px-2 py-1.5 rounded-lg text-xs font-medium text-gray-300 hover:bg-gray-800 transition">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-violet-500 to-purple-700 flex items-center justify-center text-white font-bold text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                         class="absolute right-0 top-10 w-44 bg-gray-800 border border-gray-700 rounded-xl shadow-xl py-1 z-50">
                        <div class="px-3 py-2 border-b border-gray-700">
                            <p class="text-xs font-semibold text-gray-200 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-xs text-red-400 hover:bg-gray-700 transition">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Nav --}}
        <div class="md:hidden border-t border-gray-800 px-4 py-2 flex gap-1 overflow-x-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex-shrink-0 px-3 py-1.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400' }}">Dashboard</a>
            <a href="{{ route('admin.doctors') }}" class="flex-shrink-0 px-3 py-1.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.doctors*') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400' }}">Doctors</a>
            <a href="{{ route('admin.patients') }}" class="flex-shrink-0 px-3 py-1.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.patients') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400' }}">Patients</a>
            <a href="{{ route('admin.prescriptions') }}" class="flex-shrink-0 px-3 py-1.5 rounded-lg text-xs font-semibold {{ request()->routeIs('admin.prescriptions*') ? 'bg-violet-900/60 text-violet-300' : 'text-gray-400' }}">Prescriptions</a>
        </div>
    </nav>

    {{-- Flash --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 mt-4">
        <div class="flex items-center gap-3 bg-emerald-900/40 border border-emerald-700/50 text-emerald-300 px-4 py-3 rounded-xl text-sm font-medium">
            <svg class="w-5 h-5 text-emerald-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    {{-- Content --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-3 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-gray-800 py-4 text-center text-xs text-gray-600">
        OptiScript · Super Admin Panel · Powered by <span class="text-violet-500 font-semibold">New Online Optics</span>
    </footer>
</div>

@stack('scripts')
</body>
</html>
