<x-guest-layout>
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Register Your Clinic</h2>
            <p class="text-gray-500 text-sm mt-1">Create a free account to start writing digital prescriptions</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Your Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full px-4 py-3 rounded-xl border @error('name') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"
                       placeholder="Dr. Abebe Tadesse">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"
                       placeholder="doctor@clinic.com">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" required autocomplete="new-password"
                       class="w-full px-4 py-3 rounded-xl border @error('password') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"
                       placeholder="Minimum 8 characters">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password <span class="text-red-500">*</span></label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500"
                       placeholder="Re-enter password">
            </div>

            <div class="bg-sky-50 rounded-xl px-4 py-3 text-xs text-sky-700 border border-sky-100">
                💡 You can add your clinic name, phone, address and logo after registration in <strong>Profile Settings</strong>.
            </div>

            <button type="submit"
                    class="w-full py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
                Create Free Account
            </button>

            <p class="text-center text-sm text-gray-500">
                Already have an account?
                <a href="{{ route('login') }}" class="text-sky-600 font-semibold hover:underline">Sign in</a>
            </p>
        </form>
    </div>
</x-guest-layout>
