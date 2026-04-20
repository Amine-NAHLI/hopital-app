<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\FactureController;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__ . '/auth.php';

// Routes Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

    Route::resource('patients', PatientController::class);
    Route::resource('medecins', MedecinController::class);
    Route::resource('rendez-vous', RendezVousController::class);
    Route::resource('consultations', ConsultationController::class);
    Route::resource('ordonnances', OrdonnanceController::class);
    Route::resource('factures', FactureController::class);
});

// Routes Médecin
Route::middleware(['auth', 'medecin'])->prefix('medecin')->name('medecin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'medecinDashboard'])->name('dashboard');

    Route::resource('patients', PatientController::class)->only(['index', 'show']);
    Route::resource('rendez-vous', RendezVousController::class)->only(['index', 'show', 'edit', 'update']);
    Route::resource('consultations', ConsultationController::class)->only(['index', 'show', 'create', 'store']);
    Route::resource('ordonnances', OrdonnanceController::class)->only(['index', 'show', 'create', 'store']);
});