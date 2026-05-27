<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="description" content="Ethiopia's Unified Eye Prescription System">
    <meta name="theme-color" content="#0284c7">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OptiScript') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-sky-50 via-white to-blue-50 min-h-screen">

    <div class="min-h-screen flex flex-col">
        <div class="flex-1 flex flex-col items-center justify-center px-4 py-12">

            {{-- Brand Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-sky-500 to-blue-700 shadow-xl mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    Opti<span class="text-sky-600">Script</span>
                </h1>
                <p class="mt-1 text-gray-500 text-sm">Ethiopia's Unified Eye Prescription System</p>
            </div>

            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

        {{-- Footer --}}
        <footer class="text-center py-6 text-xs text-gray-400">
            Powered with ❤️ by
            <span class="font-semibold text-sky-700">New Online Optics</span>
            — Giving back to the community, free forever
        </footer>
    </div>

</body>
</html>
