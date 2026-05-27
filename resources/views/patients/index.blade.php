@extends('layouts.app')
@section('title', 'Patients')

@section('content')
<div
    x-data="{
        showModal: {{ $errors->any() ? 'true' : 'false' }},
        openModal() { this.showModal = true; document.body.style.overflow = 'hidden'; },
        closeModal() { this.showModal = false; document.body.style.overflow = ''; }
    }"
    class="space-y-6"
>

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Patients</h1>
            <p class="text-sm text-gray-500 mt-0.5">Manage your patient records and prescription history</p>
        </div>
        <button @click="openModal()"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Patient
        </button>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('patients.index') }}" class="flex gap-3">
        <div class="relative flex-1 max-w-md">
            <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name, phone, or email..."
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
        </div>
        <button type="submit" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Search</button>
        @if(request('search'))
        <a href="{{ route('patients.index') }}" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-50 transition">Clear</a>
        @endif
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @if($patients->isEmpty())
        <div class="text-center py-16">
            <div class="w-16 h-16 rounded-full bg-violet-50 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-violet-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </div>
            <p class="text-gray-500 font-medium">No patients found</p>
            <p class="text-sm text-gray-400 mt-1">{{ request('search') ? 'Try a different search term.' : 'Start by adding your first patient.' }}</p>
            @if(!request('search'))
            <button @click="openModal()" class="inline-flex items-center gap-1.5 mt-4 px-4 py-2 bg-sky-600 text-white text-sm font-semibold rounded-lg hover:bg-sky-700 transition">
                Add first patient
            </button>
            @endif
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Patient</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden sm:table-cell">Contact</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden md:table-cell">Age</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden md:table-cell">Rx Count</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3 hidden lg:table-cell">Last Visit</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wider px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($patients as $patient)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-violet-100 to-purple-200 flex items-center justify-center text-violet-700 font-semibold text-xs flex-shrink-0">
                                    {{ strtoupper(substr($patient->name, 0, 2)) }}
                                </div>
                                <div>
                                    <a href="{{ route('patients.show', $patient) }}" class="text-sm font-semibold text-gray-900 hover:text-sky-700 transition">{{ $patient->name }}</a>
                                    @if($patient->gender)
                                    <p class="text-xs text-gray-400 capitalize">{{ $patient->gender }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden sm:table-cell">
                            <p class="text-sm text-gray-700">{{ $patient->phone ?? '—' }}</p>
                            @if($patient->email)<p class="text-xs text-gray-400">{{ $patient->email }}</p>@endif
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="text-sm text-gray-700">{{ $patient->age ? $patient->age . ' yrs' : '—' }}</span>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-700">
                                {{ $patient->prescriptions_count }}
                            </span>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <span class="text-sm text-gray-500">
                                {{ $patient->latestPrescription?->prescription_date?->format('M d, Y') ?? '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('patients.show', $patient) }}" class="text-sm text-sky-600 hover:text-sky-800 font-medium transition">View</a>
                                <a href="{{ route('prescriptions.create', ['patient_id' => $patient->id]) }}" class="text-sm text-emerald-600 hover:text-emerald-800 font-medium transition">Prescribe</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($patients->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $patients->links() }}
        </div>
        @endif
        @endif
    </div>

    {{-- ───── Add Patient Modal ───── --}}
    <div
        x-show="showModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
        style="display: none;"
    >
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

        {{-- Modal Panel --}}
        <div
            x-show="showModal"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
            class="relative w-full sm:max-w-lg bg-white sm:rounded-2xl rounded-t-2xl shadow-2xl overflow-hidden flex flex-col max-h-[92dvh] sm:max-h-[90vh]"
            @click.stop
        >
            {{-- Modal Header --}}
            <div class="flex items-center justify-between px-5 pt-5 pb-4 border-b border-gray-100 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-violet-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-violet-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-gray-900">Register New Patient</h2>
                        <p class="text-xs text-gray-400">Add patient to your records</p>
                    </div>
                </div>
                <button @click="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Scrollable Form Body --}}
            <div class="overflow-y-auto flex-1">
                <form method="POST" action="{{ route('patients.store') }}" id="addPatientForm">
                    @csrf
                    <div class="px-5 py-4 space-y-4">

                        {{-- Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   placeholder="Patient's full name"
                                   class="w-full px-4 py-2.5 rounded-xl border @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        {{-- DOB + Gender --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Gender</label>
                                <select name="gender"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent bg-white">
                                    <option value="">Select</option>
                                    <option value="male"   {{ old('gender') == 'male'   ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other"  {{ old('gender') == 'other'  ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>

                        {{-- Phone + Email --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                       placeholder="+251 9XX XXX XXX"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       placeholder="Optional"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            </div>
                        </div>

                        {{-- Address --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}"
                                   placeholder="Sub-city, Woreda..."
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                        </div>

                        {{-- Medical Notes --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Medical Notes</label>
                            <textarea name="medical_notes" rows="2"
                                      placeholder="Allergies, conditions, history..."
                                      class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent resize-none">{{ old('medical_notes') }}</textarea>
                        </div>

                    </div>

                    {{-- Modal Footer (sticky) --}}
                    <div class="px-5 pb-5 pt-3 border-t border-gray-100 bg-white flex gap-3 flex-shrink-0">
                        <button type="button" @click="closeModal()"
                                class="flex-1 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
                            Register Patient
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
