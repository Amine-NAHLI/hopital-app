@extends('layouts.app')
@section('title', 'Modifier Consultation')
@section('page-title', 'Édition du Rapport Médical')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background: #f5f3ff; color: #7c3aed;">
                        <i class="bi bi-pencil-square fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-dark">Ajustement du Rapport Clinique</h4>
                        <p class="text-muted small mb-0">Consultation n° #CONS-{{ str_pad($consultation->id, 4, '0', STR_PAD_LEFT) }} du {{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y') }}</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="alert bg-light border-0 d-flex align-items-center mb-4">
                        <div class="avatar-sm rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <i class="bi bi-person text-primary"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Patient concerné</span>
                            <span class="fw-bold text-dark">{{ $consultation->patient->nom_complet }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.consultations.update', $consultation) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-activity text-primary me-2"></i> Observations Médicales
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Diagnostic <span class="text-danger">*</span></label>
                                <textarea name="diagnostic" class="form-control bg-light @error('diagnostic') is-invalid @enderror" 
                                          rows="4" placeholder="Symptômes, analyse et conclusion médicale...">{{ old('diagnostic', $consultation->diagnostic) }}</textarea>
                                @error('diagnostic') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Traitement Prescrit</label>
                                <textarea name="traitement" class="form-control" rows="3" 
                                          placeholder="Médicaments, posologie ou soins recommandés...">{{ old('traitement', $consultation->traitement) }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Notes Additionnelles</label>
                                <textarea name="notes" class="form-control" rows="2" 
                                          placeholder="Observations privées ou rappels...">{{ old('notes', $consultation->notes) }}</textarea>
                            </div>
                        </div>

                        <div class="row g-4 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Tarification (DH)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white fw-bold">DH</span>
                                    <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror" 
                                           value="{{ old('prix', $consultation->prix) }}" min="0" step="0.01">
                                </div>
                                @error('prix') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-8">
                                <div class="p-3 rounded-3 bg-warning-light border-start border-warning border-4" style="background: #fffbeb;">
                                    <p class="small mb-0 text-muted">
                                        <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                                        La modification du prix pourra entraîner une incohérence avec la facture déjà émise si celle-ci a déjà été réglée.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.consultations.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-warning px-5 shadow text-white fw-bold">
                                <i class="bi bi-check2-circle me-2"></i> Mettre à jour le rapport
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection