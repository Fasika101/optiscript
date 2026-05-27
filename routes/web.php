<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('patients', PatientController::class);

    Route::resource('prescriptions', PrescriptionController::class);
    Route::get('/prescriptions/{prescription}/download', [PrescriptionController::class, 'download'])->name('prescriptions.download');
    Route::get('/prescriptions/{prescription}/print', [PrescriptionController::class, 'print'])->name('prescriptions.print');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/',                          [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/doctors',                   [AdminController::class, 'doctors'])->name('doctors');
    Route::get('/doctors/{user}',            [AdminController::class, 'doctorShow'])->name('doctors.show');
    Route::delete('/doctors/{user}',         [AdminController::class, 'doctorDestroy'])->name('doctors.destroy');
    Route::get('/patients',                  [AdminController::class, 'patients'])->name('patients');
    Route::get('/prescriptions',             [AdminController::class, 'prescriptions'])->name('prescriptions');
    Route::get('/prescriptions/{prescription}', [AdminController::class, 'prescriptionShow'])->name('prescriptions.show');
});

require __DIR__.'/auth.php';
