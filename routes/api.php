<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

// Route publique : login API
Route::post('/login', [ApiController::class, 'login']);

// Routes protégées par token Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Infos utilisateur connecté
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    });

    // Endpoints principaux
    Route::get('/patients', [ApiController::class, 'patients']);
    Route::get('/patients/{id}', [ApiController::class, 'patientDetail']);
    Route::get('/medecins', [ApiController::class, 'medecins']);
    Route::get('/rendez-vous', [ApiController::class, 'rendezVous']);
    Route::get('/stats', [ApiController::class, 'stats']);

    Route::post('/logout', [ApiController::class, 'logout']);
});