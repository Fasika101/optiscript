<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDoctors       = User::where('role', 'user')->count();
        $totalPatients      = Patient::count();
        $totalPrescriptions = Prescription::count();
        $thisMonth          = Prescription::whereMonth('prescription_date', now()->month)
                                ->whereYear('prescription_date', now()->year)
                                ->count();

        $topDoctors = User::where('role', 'user')
            ->withCount('prescriptions')
            ->orderByDesc('prescriptions_count')
            ->limit(5)
            ->get();

        $recentPrescriptions = Prescription::with('patient', 'user')
            ->orderByDesc('prescription_date')
            ->limit(8)
            ->get();

        // Prescriptions per month (last 6 months)
        $monthlyStats = collect(range(5, 0))->map(function ($monthsAgo) {
            $date = now()->subMonths($monthsAgo);
            return [
                'month' => $date->format('M'),
                'count' => Prescription::whereMonth('prescription_date', $date->month)
                    ->whereYear('prescription_date', $date->year)
                    ->count(),
            ];
        });

        return view('admin.dashboard', compact(
            'totalDoctors', 'totalPatients', 'totalPrescriptions',
            'thisMonth', 'topDoctors', 'recentPrescriptions', 'monthlyStats'
        ));
    }

    public function doctors(Request $request)
    {
        $query = User::where('role', 'user')
            ->withCount(['prescriptions', 'patients']);

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($b) use ($q) {
                $b->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('clinic_name', 'like', "%{$q}%");
            });
        }

        $doctors = $query->orderByDesc('prescriptions_count')->paginate(20)->withQueryString();

        return view('admin.doctors', compact('doctors'));
    }

    public function doctorShow(User $user)
    {
        abort_if($user->isAdmin(), 404);

        $user->load(['prescriptions.patient']);
        $user->loadCount(['prescriptions', 'patients']);

        $recentPrescriptions = $user->prescriptions()
            ->with('patient')
            ->orderByDesc('prescription_date')
            ->limit(10)
            ->get();

        $monthlyStats = collect(range(5, 0))->map(function ($monthsAgo) use ($user) {
            $date = now()->subMonths($monthsAgo);
            return [
                'month' => $date->format('M'),
                'count' => $user->prescriptions()
                    ->whereMonth('prescription_date', $date->month)
                    ->whereYear('prescription_date', $date->year)
                    ->count(),
            ];
        });

        return view('admin.doctor-show', compact('user', 'recentPrescriptions', 'monthlyStats'));
    }

    public function doctorDestroy(User $user)
    {
        abort_if($user->isAdmin(), 403);
        $user->delete();

        return redirect()->route('admin.doctors')
            ->with('success', 'Doctor account deleted successfully.');
    }

    public function patients(Request $request)
    {
        $query = Patient::with('user')
            ->withCount('prescriptions');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($b) use ($q) {
                $b->where('name', 'like', "%{$q}%")
                  ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $patients = $query->orderBy('name')->paginate(20)->withQueryString();

        return view('admin.patients', compact('patients'));
    }

    public function prescriptions(Request $request)
    {
        $query = Prescription::with('patient', 'user');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->whereHas('patient', fn($b) => $b->where('name', 'like', "%{$q}%"))
                  ->orWhereHas('user', fn($b) => $b->where('name', 'like', "%{$q}%"));
        }

        if ($request->filled('date_from')) {
            $query->whereDate('prescription_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('prescription_date', '<=', $request->date_to);
        }

        $prescriptions = $query->orderByDesc('prescription_date')->paginate(20)->withQueryString();

        return view('admin.prescriptions', compact('prescriptions'));
    }

    public function prescriptionShow(Prescription $prescription)
    {
        $prescription->load('patient', 'user');
        return view('admin.prescription-show', compact('prescription'));
    }
}
