@extends('layouts.app')
@section('title', 'Profile & Clinic Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900">Profile & Clinic Settings</h1>
        <p class="text-sm text-gray-500 mt-1">Update your personal info and clinic details that appear on prescriptions</p>
    </div>

    @if(session('status') === 'profile-updated')
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         class="flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm font-medium">
        <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        Profile updated successfully.
    </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PATCH')

        {{-- Clinic / Practice Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Clinic / Practice Information</h2>
            <p class="text-xs text-gray-400 -mt-3">This information will appear on all printed prescriptions.</p>

            <div class="flex items-start gap-5">
                {{-- Logo Upload --}}
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-sky-100 to-blue-200 flex items-center justify-center overflow-hidden border-2 border-sky-200">
                        @if($user->logo_path)
                        <img src="{{ Storage::url($user->logo_path) }}" class="w-full h-full object-contain" alt="Clinic Logo">
                        @else
                        <svg class="w-8 h-8 text-sky-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        @endif
                    </div>
                    <label class="block text-xs text-sky-600 font-medium text-center mt-1.5 cursor-pointer hover:underline">
                        <input type="file" name="logo" accept="image/*" class="hidden">
                        Upload Logo
                    </label>
                    @error('logo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex-1 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Clinic / Hospital Name</label>
                        <input type="text" name="clinic_name" value="{{ old('clinic_name', $user->clinic_name) }}"
                               placeholder="e.g. Addis Eye Care Center"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                        @error('clinic_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Specialty</label>
                            <select name="specialty" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white">
                                @foreach(['Optometrist','Ophthalmologist','Eye Care Specialist','Optician','General Practitioner'] as $s)
                                <option value="{{ $s }}" {{ old('specialty', $user->specialty) == $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">License Number</label>
                            <input type="text" name="license_number" value="{{ old('license_number', $user->license_number) }}"
                                   placeholder="e.g. ETH-OPT-12345"
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           placeholder="+251 9XX XXX XXXX"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Clinic Address</label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                           placeholder="Addis Ababa, Bole Sub-city..."
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
            </div>
        </div>

        {{-- Personal Account Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Account Information</h2>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border @error('name') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-2.5 rounded-xl border @error('email') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
                Save Changes
            </button>
        </div>
    </form>

    {{-- Change Password --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">Change Password</h2>

        @if(session('status') === 'password-updated')
        <div class="flex items-center gap-2 text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl px-4 py-3 text-sm mb-4">
            Password updated successfully.
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Current Password</label>
                <input type="password" name="current_password"
                       class="w-full max-w-md px-4 py-2.5 rounded-xl border @error('current_password', 'updatePassword') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                @error('current_password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">New Password</label>
                <input type="password" name="password"
                       class="w-full max-w-md px-4 py-2.5 rounded-xl border @error('password', 'updatePassword') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                @error('password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full max-w-md px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
            <button type="submit" class="px-5 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                Update Password
            </button>
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="bg-white rounded-2xl border border-red-100 p-6">
        <h2 class="text-sm font-semibold text-red-700 mb-3">Danger Zone</h2>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-700">Delete your account</p>
                <p class="text-xs text-gray-400 mt-0.5">Once deleted, all your data will be permanently removed.</p>
            </div>
            <form method="POST" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('Are you sure? This will delete your account and ALL prescriptions.')">
                @csrf @method('DELETE')
                <input type="hidden" name="password" id="delete-password" value="">
                <button type="button" onclick="
                    const pw = prompt('Enter your password to confirm deletion:');
                    if(pw) { document.getElementById('delete-password').value = pw; this.closest('form').submit(); }
                " class="px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 font-medium text-sm rounded-xl border border-red-200 transition">
                    Delete Account
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
