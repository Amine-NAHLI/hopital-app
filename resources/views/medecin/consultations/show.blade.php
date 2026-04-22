@extends('layouts.app')
@section('title', 'Détails Consultation')
@section('page-title', 'Compte-rendu Médical')

@section('content')
    <div class="row g-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold text-secondary">
                        <i class="bi bi-file-earmark-medical text-primary me-2"></i> Rapport de visite #CONS-{{ str_pad($consultation->id, 5, '0', STR_PAD_LEFT) }}
                    </h4>
                    <div class="badge bg-light text-dark border px-3 py-2 fw-medium">
                        <i class="bi bi-calendar-event text-primary me-2"></i> {{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y') }}
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="mb-5">
                        <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                            <i class="bi bi-activity text-primary me-2"></i> Diagnostic Clinique
                        </h5>
                        <div class="p-3 rounded-3 bg-light border-start border-primary border-4">
                            <p class="mb-0 fs-5 text-secondary" style="line-height: 1.6;">{{ $consultation->diagnostic }}</p>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                            <i class="bi bi-capsule text-primary me-2"></i> Traitement & Recommandations
                        </h5>
                        <div class="text-secondary" style="white-space: pre-line;">
                            {{ $consultation->traitement ?? 'Aucun traitement spécifique noté.' }}
                        </div>
                    </div>

                    @if($consultation->notes)
                        <div class="mb-4">
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                <i class="bi bi-journal-text text-primary me-2"></i> Notes Internes
                            </h5>
                            <p class="text-muted small italic">{{ $consultation->notes }}</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white p-4 border-top">
                    <div class="d-flex gap-3">
                        <a href="{{ route('medecin.consultations.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-2"></i> Retour à mes consultations
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <h5 class="mb-0 fw-bold text-secondary">Intervenants</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary-light text-primary rounded-circle p-3 me-3">
                            <i class="bi bi-person-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Patient</span>
                            <h6 class="mb-0 fw-bold text-dark">{{ $consultation->patient->nom_complet }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-accent-soft text-accent rounded-circle p-3 me-3" style="background: #ecfeff; color: #0891b2">
                            <i class="bi bi-person-badge-fill fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Médecin Traitant</span>
                            <h6 class="mb-0 fw-bold text-dark">Dr. {{ $consultation->medecin->nom_complet }}</h6>
                            <span class="x-small text-muted">{{ $consultation->medecin->specialite }}</span>
                        </div>
                    </div>
                    <div class="border-top pt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted fw-medium">Honoraires</span>
                            <span class="fs-4 fw-bold text-primary">{{ number_format($consultation->prix, 2) }} DH</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($consultation->ordonnance)
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-4 px-4 border-bottom">
                        <h5 class="mb-0 fw-bold text-secondary">Document Lié</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger-light text-danger rounded-3 p-2 me-3" style="background: #fee2e2;">
                                <i class="bi bi-file-medical-fill fs-5"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold small">Ordonnance Médicale</h6>
                                <a href="{{ route('medecin.ordonnances.show', $consultation->ordonnance) }}" class="small text-decoration-none">Consulter l'archive</a>
                            </div>
                            <i class="bi bi-chevron-right text-muted"></i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
