@extends('layouts.app')
@section('title', 'Nouvelle Consultation')
@section('page-title', 'Examen Clinique')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 p-3 me-3" style="background: #f5f3ff; color: #7c3aed;">
                            <i class="bi bi-clipboard2-plus-fill fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-secondary">Rapport de Consultation</h4>
                            <p class="text-muted small mb-0">Renseignez les observations cliniques et le traitement pour le patient.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('medecin.consultations.store') }}">
                        @csrf
                        <input type="hidden" name="medecin_id" value="{{ auth()->user()->medecin->id }}">
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-person-check text-primary me-2"></i> Informations Patient
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Sélectionner le Rendez-vous <span class="text-danger">*</span></label>
                                <select name="rendez_vous_id" class="form-select bg-light @error('rendez_vous_id') is-invalid @enderror">
                                    <option value="">-- Choisir le rendez-vous --</option>
                                    @foreach($rendezVous as $rdv)
                                        <option value="{{ $rdv->id }}" {{ (old('rendez_vous_id') == $rdv->id || request('rendez_vous_id') == $rdv->id) ? 'selected' : '' }}>
                                            {{ $rdv->patient->nom_complet }} — {{ $rdv->date_heure->format('d/m/Y H:i') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rendez_vous_id')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Patient <span class="text-danger">*</span></label>
                                <select name="patient_id" class="form-select bg-light @error('patient_id') is-invalid @enderror">
                                    <option value="">-- Confirmer le patient --</option>
                                    @foreach($patients as $p)
                                        <option value="{{ $p->id }}" {{ (old('patient_id') == $p->id || request('patient_id') == $p->id) ? 'selected' : '' }}>{{ $p->nom_complet }} ({{ $p->cin }})</option>
                                    @endforeach
                                </select>
                                @error('patient_id')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Date de l'examen <span class="text-danger">*</span></label>
                                <input type="date" name="date_consultation" class="form-control bg-light"
                                       value="{{ old('date_consultation', date('Y-m-d')) }}">
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-activity text-primary me-2"></i> Observations Cliniques
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Diagnostic & Analyse <span class="text-danger">*</span></label>
                                <textarea name="diagnostic" class="form-control bg-light @error('diagnostic') is-invalid @enderror" 
                                          rows="5" placeholder="Symptômes décrits, signes cliniques, diagnostic suspecté ou confirmé...">{{ old('diagnostic') }}</textarea>
                                @error('diagnostic')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Traitement & Prescriptions</label>
                                <textarea name="traitement" class="form-control" rows="4" placeholder="Détail du traitement, posologie, examens complémentaires à effectuer..."></textarea>
                            </div>
                        </div>

                        <div class="row g-4 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Honoraires (DH) <span class="text-danger">*</span></label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-white fw-bold">DH</span>
                                    <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror"
                                           value="{{ old('prix', 200) }}" min="0" step="0.01">
                                </div>
                                @error('prix')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-8">
                                <div class="p-3 rounded-3 bg-light border-start border-primary border-4">
                                    <p class="small mb-0 text-muted">
                                        <i class="bi bi-info-circle-fill text-primary me-1"></i>
                                        En validant ce rapport, le rendez-vous sera marqué comme <strong>terminé</strong> et une facture sera automatiquement générée par le système.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('medecin.dashboard') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="bi bi-check2-all me-2"></i> Enregistrer la Consultation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
