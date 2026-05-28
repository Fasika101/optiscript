@extends('layouts.app')
@section('title', 'Edit Prescription')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center gap-3">
        <a href="{{ route('prescriptions.show', $prescription) }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Prescription</h1>
            <p class="text-sm text-gray-500">Rx #{{ str_pad($prescription->id, 6, '0', STR_PAD_LEFT) }} · {{ $prescription->patient->name }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('prescriptions.update', $prescription) }}" class="space-y-6">
        @csrf @method('PATCH')

        {{-- Patient & Date --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <div class="w-5 h-5 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-xs font-bold">1</div>
                Patient & Date
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Patient <span class="text-red-500">*</span></label>
                    <select name="patient_id" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white">
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id', $prescription->patient_id) == $patient->id ? 'selected' : '' }}>
                            {{ $patient->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Prescription Date <span class="text-red-500">*</span></label>
                    <input type="date" name="prescription_date"
                           value="{{ old('prescription_date', $prescription->prescription_date->format('Y-m-d')) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>
            </div>
        </div>

        {{-- Vision Prescription --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <div class="w-5 h-5 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-xs font-bold">2</div>
                Vision Prescription (Rx)
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[480px]">
                    <thead>
                        <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="text-left pb-3 pr-4 w-24">Eye</th>
                            <th class="pb-3 px-2 text-center">SPH</th>
                            <th class="pb-3 px-2 text-center">CYL</th>
                            <th class="pb-3 px-2 text-center">Axis</th>
                            <th class="pb-3 px-2 text-center">Add</th>
                            <th class="pb-3 px-2 text-center">VA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('prescriptions.partials.rx-table-rows', ['prescription' => $prescription])
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PD --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <div class="w-5 h-5 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-xs font-bold">3</div>
                Pupillary Distance (PD)
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach(['pd_far' => 'Far PD', 'pd_near' => 'Near PD', 'pd_right' => 'Right PD', 'pd_left' => 'Left PD'] as $field => $label)
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1.5">{{ $label }}</label>
                    <div class="relative">
                        <input type="number" name="{{ $field }}" value="{{ old($field, $prescription->$field) }}"
                               step="0.5"
                               class="w-full px-3 py-2.5 pr-8 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 font-mono">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">mm</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Clinical Notes --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <div class="w-5 h-5 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-xs font-bold">4</div>
                Clinical Notes
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Diagnosis</label>
                    <input type="text" name="diagnosis" value="{{ old('diagnosis', $prescription->diagnosis) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Lens Type</label>
                    <select name="lens_type" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white">
                        <option value="">Select lens type</option>
                        @foreach(['single_vision' => 'Single Vision','bifocal' => 'Bifocal','progressive' => 'Progressive','contact_lens' => 'Contact Lens','reading_glasses' => 'Reading Glasses'] as $val => $lbl)
                        <option value="{{ $val }}" {{ old('lens_type', $prescription->lens_type) == $val ? 'selected' : '' }}>{{ $lbl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Recommendations</label>
                <textarea name="recommendation" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 resize-none">{{ old('recommendation', $prescription->recommendation) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Additional Notes</label>
                <textarea name="notes" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 resize-none">{{ old('notes', $prescription->notes) }}</textarea>
            </div>
            <div class="max-w-xs">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Next Visit Date</label>
                <input type="date" name="next_visit" value="{{ old('next_visit', $prescription->next_visit?->format('Y-m-d')) }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500">
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('prescriptions.show', $prescription) }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
            <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">Update Prescription</button>
        </div>
    </form>
</div>
@endsection
