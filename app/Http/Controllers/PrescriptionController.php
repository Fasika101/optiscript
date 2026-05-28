<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Prescription;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::with('patient')
            ->where('user_id', auth()->id());

        if ($request->filled('search')) {
            $q = $request->search;
            $query->whereHas('patient', fn($b) => $b->where('name', 'like', "%{$q}%"));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('prescription_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('prescription_date', '<=', $request->date_to);
        }

        $prescriptions = $query->orderByDesc('prescription_date')->paginate(15)->withQueryString();

        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create(Request $request)
    {
        $patients = Patient::where('user_id', auth()->id())->orderBy('name')->get();
        $selectedPatient = $request->filled('patient_id')
            ? Patient::where('user_id', auth()->id())->find($request->patient_id)
            : null;

        return view('prescriptions.create', compact('patients', 'selectedPatient'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'       => ['required', Rule::exists('patients', 'id')->where('user_id', auth()->id())],
            'prescription_date' => 'required|date',
            'od_sphere'        => 'nullable|numeric|between:-6,6',
            'od_cylinder'      => 'nullable|numeric|between:-6,6',
            'od_axis'          => 'nullable|integer|between:0,180',
            'od_add'           => 'nullable|numeric|between:0,5',
            'od_va'            => 'nullable|string|max:20',
            'os_sphere'        => 'nullable|numeric|between:-6,6',
            'os_cylinder'      => 'nullable|numeric|between:-6,6',
            'os_axis'          => 'nullable|integer|between:0,180',
            'os_add'           => 'nullable|numeric|between:0,5',
            'os_va'            => 'nullable|string|max:20',
            'pd_far'           => 'nullable|numeric|between:40,80',
            'pd_near'          => 'nullable|numeric|between:40,80',
            'pd_right'         => 'nullable|numeric|between:20,45',
            'pd_left'          => 'nullable|numeric|between:20,45',
            'diagnosis'        => 'nullable|string|max:500',
            'lens_type'        => 'nullable|in:single_vision,bifocal,progressive,contact_lens,reading_glasses',
            'recommendation'   => 'nullable|string',
            'notes'            => 'nullable|string',
            'next_visit'       => 'nullable|date',
        ]);

        $validated['user_id'] = auth()->id();
        $prescription = Prescription::create($validated);

        return redirect()->route('prescriptions.show', $prescription)
            ->with('success', 'Prescription created successfully.');
    }

    public function show(Prescription $prescription)
    {
        $this->authorize('view', $prescription);
        $prescription->load('patient', 'user');

        return view('prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $this->authorize('update', $prescription);
        $patients = Patient::where('user_id', auth()->id())->orderBy('name')->get();

        return view('prescriptions.edit', compact('prescription', 'patients'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $this->authorize('update', $prescription);

        $validated = $request->validate([
            'patient_id'       => ['required', Rule::exists('patients', 'id')->where('user_id', auth()->id())],
            'prescription_date' => 'required|date',
            'od_sphere'        => 'nullable|numeric|between:-6,6',
            'od_cylinder'      => 'nullable|numeric|between:-6,6',
            'od_axis'          => 'nullable|integer|between:0,180',
            'od_add'           => 'nullable|numeric|between:0,5',
            'od_va'            => 'nullable|string|max:20',
            'os_sphere'        => 'nullable|numeric|between:-6,6',
            'os_cylinder'      => 'nullable|numeric|between:-6,6',
            'os_axis'          => 'nullable|integer|between:0,180',
            'os_add'           => 'nullable|numeric|between:0,5',
            'os_va'            => 'nullable|string|max:20',
            'pd_far'           => 'nullable|numeric|between:40,80',
            'pd_near'          => 'nullable|numeric|between:40,80',
            'pd_right'         => 'nullable|numeric|between:20,45',
            'pd_left'          => 'nullable|numeric|between:20,45',
            'diagnosis'        => 'nullable|string|max:500',
            'lens_type'        => 'nullable|in:single_vision,bifocal,progressive,contact_lens,reading_glasses',
            'recommendation'   => 'nullable|string',
            'notes'            => 'nullable|string',
            'next_visit'       => 'nullable|date',
        ]);

        $prescription->update($validated);

        return redirect()->route('prescriptions.show', $prescription)
            ->with('success', 'Prescription updated successfully.');
    }

    public function destroy(Prescription $prescription)
    {
        $this->authorize('delete', $prescription);
        $prescription->delete();

        return redirect()->route('prescriptions.index')
            ->with('success', 'Prescription deleted.');
    }

    public function download(Prescription $prescription)
    {
        $this->authorize('view', $prescription);
        $prescription->load('patient', 'user');

        $pdf = Pdf::loadView('prescriptions.pdf', compact('prescription'))
            ->setPaper('a5', 'portrait');

        $filename = 'RX-' . str_pad($prescription->id, 6, '0', STR_PAD_LEFT)
            . '-' . $prescription->patient->name . '.pdf';

        return $pdf->download($filename);
    }

    public function print(Prescription $prescription)
    {
        $this->authorize('view', $prescription);
        $prescription->load('patient', 'user');

        return view('prescriptions.print', compact('prescription'));
    }
}
