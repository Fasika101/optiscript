<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $totalPatients = Patient::where('user_id', $user->id)->count();
        $totalPrescriptions = Prescription::where('user_id', $user->id)->count();
        $thisMonthPrescriptions = Prescription::where('user_id', $user->id)
            ->whereMonth('prescription_date', now()->month)
            ->whereYear('prescription_date', now()->year)
            ->count();

        $recentPrescriptions = Prescription::with('patient')
            ->where('user_id', $user->id)
            ->orderByDesc('prescription_date')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalPatients',
            'totalPrescriptions',
            'thisMonthPrescriptions',
            'recentPrescriptions'
        ));
    }
}
