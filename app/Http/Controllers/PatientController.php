<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::where('user_id', auth()->id())
            ->withCount('prescriptions')
            ->with('latestPrescription');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $patients = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'phone'         => 'nullable|string|max:30',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
            'medical_notes' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $patient = Patient::create($validated);

        return redirect()->route('prescriptions.create', ['patient_id' => $patient->id])
            ->with('success', 'Patient registered successfully.');
    }

    public function show(Patient $patient)
    {
        $this->authorize('view', $patient);

        $prescriptions = $patient->prescriptions()
            ->orderByDesc('prescription_date')
            ->get();

        return view('patients.show', compact('patient', 'prescriptions'));
    }

    public function edit(Patient $patient)
    {
        $this->authorize('update', $patient);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'phone'         => 'nullable|string|max:30',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
            'medical_notes' => 'nullable|string',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.show', $patient)
            ->with('success', 'Patient information updated.');
    }

    public function destroy(Patient $patient)
    {
        $this->authorize('delete', $patient);
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient record deleted.');
    }
}
