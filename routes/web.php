<?php

/**
 * Fichier : web.php
 * Description : Définition des routes Web de l'application.
 * Rôle : Mappe les URLs vers les contrôleurs correspondants pour l'interface utilisateur.
 */


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AIAssistantController;

Route::get('/', function () {
    $users = \App\Models\User::all();
    return view('welcome', compact('users'));
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $user = auth()->user();
    return redirect()->route($user->isAdmin() ? 'admin.dashboard' : 'medecin.dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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

    // Assistant IA Clinique
    Route::get('/ai-assistant', [AIAssistantController::class, 'index'])->name('ai.assistant');
    Route::post('/ai-assistant/analyze', [AIAssistantController::class, 'analyze'])->name('ai.analyze');
    Route::post('/ai-assistant/generate-treatment', [AIAssistantController::class, 'generateTreatment'])->name('ai.generate_treatment');
    Route::post('/ai-assistant/download-pdf', [AIAssistantController::class, 'downloadPdf'])->name('ai.download_pdf');
    Route::get('/ai-assistant/patient-data/{id}', [AIAssistantController::class, 'getPatientData'])->name('ai.patient_data');
    Route::get('/ai-assistant/consultation-data/{id}', [AIAssistantController::class, 'getConsultationData'])->name('ai.consultation_data');
});