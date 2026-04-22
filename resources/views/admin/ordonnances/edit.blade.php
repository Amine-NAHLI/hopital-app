@extends('layouts.app')
@section('title', 'Modifier Ordonnance')
@section('page-title', 'Révision de Prescription')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background: #fee2e2; color: #dc2626;">
                        <i class="bi bi-file-earmark-medical fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-dark">Mise à jour de l'Ordonnance</h4>
                        <p class="text-muted small mb-0">Référence archive : #ORD-{{ str_pad($ordonnance->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="alert bg-light border-0 d-flex align-items-center mb-4">
                        <div class="avatar-sm rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-person text-danger"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Patient bénéficiaire</span>
                            <span class="fw-bold text-dark">{{ $ordonnance->patient->nom_complet }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.ordonnances.update', $ordonnance) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-capsule text-danger me-2"></i> Prescription Médicamenteuse
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Médicaments & Dosage <span class="text-danger">*</span></label>
                                <textarea name="medicaments" class="form-control bg-light @error('medicaments') is-invalid @enderror" 
                                          rows="6" placeholder="Liste des médicaments et posologie détaillée...">{{ old('medicaments', $ordonnance->medicaments) }}</textarea>
                                @error('medicaments') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Instructions de prise</label>
                                <textarea name="instructions" class="form-control" rows="3" 
                                          placeholder="Recommandations d'hygiène, alimentation, ou effets secondaires à surveiller...">{{ old('instructions', $ordonnance->instructions) }}</textarea>
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i> Document Numérisé
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Remplacer le scan (PDF uniquement)</label>
                                <div class="border rounded-3 p-4 bg-light text-center">
                                    @if($ordonnance->fichier)
                                        <div class="mb-3">
                                            <a href="{{ asset('storage/' . $ordonnance->fichier) }}" target="_blank" class="btn btn-sm btn-outline-danger px-3 rounded-pill">
                                                <i class="bi bi-file-pdf me-1"></i> Voir le scan actuel
                                            </a>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <i class="bi bi-cloud-arrow-up fs-2 text-muted mb-2"></i>
                                        <input type="file" name="fichier" class="form-control form-control-sm mx-auto" style="max-width: 350px;" accept=".pdf">
                                        <p class="x-small text-muted mt-2 mb-0">Laissez vide pour conserver le document existant. Format PDF requis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.ordonnances.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-danger px-5 shadow text-white fw-bold" style="background-color: #dc2626;">
                                <i class="bi bi-check-circle me-2"></i> Mettre à jour l'ordonnance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection