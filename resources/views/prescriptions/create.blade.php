@extends('layouts.app')
@section('title', 'Write Prescription')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center gap-3">
        <a href="{{ route('prescriptions.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Write Prescription</h1>
            <p class="text-sm text-gray-500">Create a new eye prescription for your patient</p>
        </div>
    </div>

    <form method="POST" action="{{ route('prescriptions.store') }}" class="space-y-6">
        @csrf

        {{-- Patient & Date --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <div class="w-5 h-5 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-xs font-bold">1</div>
                Patient & Date
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Patient <span class="text-red-500">*</span></label>
                    <select name="patient_id" required
                            class="w-full px-4 py-2.5 rounded-xl border @error('patient_id') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent bg-white">
                        <option value="">Select a patient</option>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ old('patient_id', $selectedPatient?->id) == $patient->id ? 'selected' : '' }}>
                            {{ $patient->name }} @if($patient->age) ({{ $patient->age }}y) @endif
                        </option>
                        @endforeach
                    </select>
                    @error('patient_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    <a href="{{ route('patients.create') }}" class="text-xs text-sky-600 hover:underline mt-1 inline-block">+ Register new patient</a>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Prescription Date <span class="text-red-500">*</span></label>
                    <input type="date" name="prescription_date" value="{{ old('prescription_date', date('Y-m-d')) }}" required
                           class="w-full px-4 py-2.5 rounded-xl border @error('prescription_date') border-red-400 @else border-gray-200 @enderror text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
            </div>
        </div>

        {{-- Vision Prescription --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <div class="w-5 h-5 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-xs font-bold">2</div>
                Vision Prescription (Rx)
            </h2>

            <div class="overflow-x-auto -mx-6 px-6">
                <p class="text-xs text-gray-400 mb-2 sm:hidden flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" /></svg>
                    Scroll to see all fields
                </p>
                <table class="w-full min-w-[580px]">
                    <thead>
                        <tr class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="text-left pb-3 pr-4 w-24">Eye</th>
                            <th class="pb-3 px-2 text-center">Sphere (SPH)</th>
                            <th class="pb-3 px-2 text-center">Cylinder (CYL)</th>
                            <th class="pb-3 px-2 text-center">Axis</th>
                            <th class="pb-3 px-2 text-center">Add</th>
                            <th class="pb-3 px-2 text-center">VA</th>
                            <th class="pb-3 px-2 text-center">Prism</th>
                            <th class="pb-3 px-2 text-center">Base</th>
                        </tr>
                    </thead>
                    <tbody class="space-y-2">
                        {{-- OD Right Eye --}}
                        <tr>
                            <td class="pr-4 pb-3">
                                <div class="bg-blue-50 border border-blue-100 rounded-xl px-3 py-2 text-center">
                                    <p class="text-xs font-bold text-blue-800">OD</p>
                                    <p class="text-xs text-blue-600">Right Eye</p>
                                </div>
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="od_sphere" value="{{ old('od_sphere') }}" step="0.25" min="-30" max="30"
                                       placeholder="e.g. -2.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="od_cylinder" value="{{ old('od_cylinder') }}" step="0.25" min="-10" max="10"
                                       placeholder="e.g. -1.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="od_axis" value="{{ old('od_axis') }}" step="1" min="0" max="180"
                                       placeholder="0-180"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="od_add" value="{{ old('od_add') }}" step="0.25" min="0" max="5"
                                       placeholder="+0.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="text" name="od_va" value="{{ old('od_va') }}" placeholder="6/6"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="od_prism" value="{{ old('od_prism') }}" step="0.25" placeholder="0.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <select name="od_base" class="w-full px-2 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white">
                                    <option value="">—</option>
                                    <option value="BI" {{ old('od_base') == 'BI' ? 'selected' : '' }}>BI</option>
                                    <option value="BO" {{ old('od_base') == 'BO' ? 'selected' : '' }}>BO</option>
                                    <option value="BU" {{ old('od_base') == 'BU' ? 'selected' : '' }}>BU</option>
                                    <option value="BD" {{ old('od_base') == 'BD' ? 'selected' : '' }}>BD</option>
                                </select>
                            </td>
                        </tr>
                        {{-- OS Left Eye --}}
                        <tr>
                            <td class="pr-4 pb-3">
                                <div class="bg-violet-50 border border-violet-100 rounded-xl px-3 py-2 text-center">
                                    <p class="text-xs font-bold text-violet-800">OS</p>
                                    <p class="text-xs text-violet-600">Left Eye</p>
                                </div>
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="os_sphere" value="{{ old('os_sphere') }}" step="0.25" min="-30" max="30"
                                       placeholder="e.g. -2.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="os_cylinder" value="{{ old('os_cylinder') }}" step="0.25" min="-10" max="10"
                                       placeholder="e.g. -1.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="os_axis" value="{{ old('os_axis') }}" step="1" min="0" max="180"
                                       placeholder="0-180"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="os_add" value="{{ old('os_add') }}" step="0.25" min="0" max="5"
                                       placeholder="+0.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="text" name="os_va" value="{{ old('os_va') }}" placeholder="6/6"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                            </td>
                            <td class="px-2 pb-3">
                                <input type="number" name="os_prism" value="{{ old('os_prism') }}" step="0.25" placeholder="0.00"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                            </td>
                            <td class="px-2 pb-3">
                                <select name="os_base" class="w-full px-2 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 bg-white">
                                    <option value="">—</option>
                                    <option value="BI" {{ old('os_base') == 'BI' ? 'selected' : '' }}>BI</option>
                                    <option value="BO" {{ old('os_base') == 'BO' ? 'selected' : '' }}>BO</option>
                                    <option value="BU" {{ old('os_base') == 'BU' ? 'selected' : '' }}>BU</option>
                                    <option value="BD" {{ old('os_base') == 'BD' ? 'selected' : '' }}>BD</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-xs text-gray-400 bg-gray-50 rounded-xl p-3">
                <strong>Guide:</strong> SPH = Sphere power · CYL = Cylinder power · AXIS = Cylinder orientation (0-180°) · ADD = Near addition power · VA = Visual Acuity · Leave blank if not applicable
            </div>
        </div>

        {{-- Pupillary Distance --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <div class="w-5 h-5 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-xs font-bold">3</div>
                Pupillary Distance (PD)
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Far PD (Binocular)</label>
                    <div class="relative">
                        <input type="number" name="pd_far" value="{{ old('pd_far') }}" step="0.5" min="40" max="80"
                               placeholder="e.g. 64"
                               class="w-full px-3 py-2.5 pr-8 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">mm</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Near PD (Binocular)</label>
                    <div class="relative">
                        <input type="number" name="pd_near" value="{{ old('pd_near') }}" step="0.5" min="40" max="80"
                               placeholder="e.g. 62"
                               class="w-full px-3 py-2.5 pr-8 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">mm</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Right PD (Monocular)</label>
                    <div class="relative">
                        <input type="number" name="pd_right" value="{{ old('pd_right') }}" step="0.5" min="20" max="45"
                               placeholder="e.g. 32"
                               class="w-full px-3 py-2.5 pr-8 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">mm</span>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Left PD (Monocular)</label>
                    <div class="relative">
                        <input type="number" name="pd_left" value="{{ old('pd_left') }}" step="0.5" min="20" max="45"
                               placeholder="e.g. 32"
                               class="w-full px-3 py-2.5 pr-8 rounded-xl border border-gray-200 text-sm text-center focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent font-mono">
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">mm</span>
                    </div>
                </div>
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
                    <input type="text" name="diagnosis" value="{{ old('diagnosis') }}"
                           placeholder="e.g. Myopia, Hyperopia, Astigmatism..."
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Lens Type</label>
                    <select name="lens_type" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent bg-white">
                        <option value="">Select lens type</option>
                        <option value="single_vision" {{ old('lens_type') == 'single_vision' ? 'selected' : '' }}>Single Vision</option>
                        <option value="bifocal" {{ old('lens_type') == 'bifocal' ? 'selected' : '' }}>Bifocal</option>
                        <option value="progressive" {{ old('lens_type') == 'progressive' ? 'selected' : '' }}>Progressive</option>
                        <option value="contact_lens" {{ old('lens_type') == 'contact_lens' ? 'selected' : '' }}>Contact Lens</option>
                        <option value="reading_glasses" {{ old('lens_type') == 'reading_glasses' ? 'selected' : '' }}>Reading Glasses</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Recommendations</label>
                <textarea name="recommendation" rows="2"
                          placeholder="Frame style, lens coating, lifestyle advice..."
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent resize-none">{{ old('recommendation') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Additional Notes</label>
                <textarea name="notes" rows="2"
                          placeholder="Any other clinical observations..."
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent resize-none">{{ old('notes') }}</textarea>
            </div>

            <div class="max-w-xs">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Next Visit Date</label>
                <input type="date" name="next_visit" value="{{ old('next_visit') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-transparent">
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('prescriptions.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Cancel</a>
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition shadow-sm text-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Save Prescription
            </button>
        </div>
    </form>
</div>
@endsection
