<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Welcome back</h2>
            <p class="text-gray-500 text-sm mt-1">Sign in to your clinic account</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                       placeholder="doctor@clinic.com">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <div class="flex justify-between mb-1.5">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-sky-600 hover:underline">Forgot password?</a>
                    @endif
                </div>
                <input type="password" name="password" required autocomplete="current-password"
                       class="w-full px-4 py-3 rounded-xl border @error('password') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                       placeholder="••••••••">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                <label for="remember" class="text-sm text-gray-600">Remember me for 30 days</label>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
                Sign In to Dashboard
            </button>

            <p class="text-center text-sm text-gray-500">
                New clinic?
                <a href="{{ route('register') }}" class="text-sky-600 font-semibold hover:underline">Create an account</a>
            </p>
        </form>
    </div>
</x-guest-layout>
