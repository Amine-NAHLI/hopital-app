@extends('layouts.app')
@section('title', 'Aperçu Ordonnance')
@section('page-title', 'Prescription Médicale')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <div class="card-header bg-white border-bottom py-4 px-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-bold text-dark mb-0">MediCore<span class="text-primary">Pro</span> Hospital</h4>
                            <p class="text-muted small mb-0">Service de Soins Spécialisés</p>
                        </div>
                        <div class="text-end">
                            <h5 class="fw-bold text-secondary mb-0">ORDONNANCE</h5>
                            <p class="text-muted small mb-0">Réf: #ORD-{{ str_pad($ordonnance->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <!-- En-tête Médical -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <h6 class="text-muted small fw-bold text-uppercase mb-2">Prescripteur</h6>
                            <p class="mb-0 fw-bold fs-5 text-dark">Dr. {{ $ordonnance->medecin->nom_complet }}</p>
                            <p class="text-primary small fw-medium mb-0">{{ $ordonnance->medecin->specialite }}</p>
                            <p class="text-muted x-small">Tél: {{ $ordonnance->medecin->telephone }}</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="text-muted small fw-bold text-uppercase mb-2">Patient</h6>
                            <p class="mb-0 fw-bold fs-5 text-dark">{{ $ordonnance->patient->nom_complet }}</p>
                            <p class="text-muted small mb-0">CIN: {{ $ordonnance->patient->cin }}</p>
                            <p class="text-muted small">Date: {{ \Carbon\Carbon::parse($ordonnance->date_ordonnance)->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- Corps de l'ordonnance -->
                    <div class="my-5 py-4 border-top border-bottom border-light">
                        <div class="d-flex mb-4">
                            <div class="bg-primary-light text-primary rounded-circle p-2 me-3" style="width: 40px; height: 40px; display:flex; align-items:center; justify-content:center;">
                                <i class="bi bi-prescription fs-4"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-0 mt-2">Prescriptions :</h5>
                        </div>
                        
                        <div class="ms-5">
                            <div class="bg-light p-4 rounded-3 text-secondary shadow-inner" style="white-space: pre-line; line-height: 1.8; font-size: 1.1rem; border: 1px dashed #cbd5e1;">
                                {{ $ordonnance->medicaments }}
                            </div>
                        </div>
                    </div>

                    @if($ordonnance->instructions)
                        <div class="mb-5">
                            <h6 class="fw-bold text-dark small text-uppercase mb-2">Instructions Complémentaires :</h6>
                            <p class="text-muted fst-italic ms-3">{{ $ordonnance->instructions }}</p>
                        </div>
                    @endif

                    <!-- Pied de page -->
                    <div class="d-flex justify-content-between align-items-end mt-5 pt-5 border-top border-light">
                        <div class="text-muted small">
                            <p class="mb-1"><i class="bi bi-geo-alt me-1"></i> 123 Avenue de la Santé, Casablanca</p>
                            <p class="mb-0"><i class="bi bi-info-circle me-1"></i> Valable 3 mois à compter de la date d'émission</p>
                        </div>
                        <div class="text-center" style="width: 200px;">
                            <div class="mb-2" style="height: 60px; border-bottom: 1px solid #e2e8f0;"></div>
                            <p class="x-small text-muted mb-0">Signature & Cachet du Médecin</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex gap-3 justify-content-center">
                <button onclick="window.print()" class="btn btn-dark px-4 shadow-sm">
                    <i class="bi bi-printer me-2"></i> Imprimer l'ordonnance
                </button>
                @if($ordonnance->fichier)
                    <a href="{{ asset('storage/' . $ordonnance->fichier) }}" target="_blank" class="btn btn-outline-danger px-4">
                        <i class="bi bi-file-pdf me-2"></i> Télécharger le scan
                    </a>
                @endif
                <a href="{{ route('medecin.ordonnances.index') }}" class="btn btn-link text-muted text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .sidebar-wrapper, .topbar, .btn, .btn-group, .navbar, footer { display: none !important; }
            .main-content { padding: 0 !important; margin: 0 !important; width: 100% !important; }
            .card { border: none !important; box-shadow: none !important; }
            body { background: white !important; }
        }
    </style>
@endsection
