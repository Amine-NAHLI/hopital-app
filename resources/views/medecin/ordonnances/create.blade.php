@extends('layouts.app')
@section('title', 'Rédiger une Ordonnance')
@section('page-title', 'Nouvelle Prescription')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 p-3 me-3" style="background: #fee2e2; color: #dc2626;">
                            <i class="bi bi-file-earmark-medical-fill fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-secondary">Rédaction d'Ordonnance</h4>
                            <p class="text-muted small mb-0">Rédigez la prescription détaillée pour votre patient.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('medecin.ordonnances.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="medecin_id" value="{{ auth()->user()->medecin->id }}">
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Patient Bénéficiaire <span class="text-danger">*</span></label>
                                <select name="patient_id" class="form-select bg-light @error('patient_id') is-invalid @enderror">
                                    <option value="">-- Sélectionner le patient --</option>
                                    @foreach($patients as $p)
                                        <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>{{ $p->nom_complet }} ({{ $p->cin }})</option>
                                    @endforeach
                                </select>
                                @error('patient_id')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Date d'émission <span class="text-danger">*</span></label>
                                <input type="date" name="date_ordonnance" class="form-control bg-light"
                                       value="{{ old('date_ordonnance', date('Y-m-d')) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Médicaments & Posologie <span class="text-danger">*</span></label>
                                <textarea name="medicaments" class="form-control bg-light @error('medicaments') is-invalid @enderror" 
                                          rows="8" placeholder="Ex: Paracétamol 500mg, 1 cp 3x/jour pendant 5 jours..."></textarea>
                                @error('medicaments')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Scanner de l'ordonnance signée (Optionnel)</label>
                                <div class="border rounded-3 p-3 bg-light text-center">
                                    <i class="bi bi-cloud-upload fs-2 text-muted d-block mb-2"></i>
                                    <input type="file" name="fichier" class="form-control form-control-sm mx-auto" style="max-width: 300px;" accept="application/pdf,image/*">
                                    <p class="x-small text-muted mt-2 mb-0">Format PDF ou Image (Max 5MB)</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('medecin.ordonnances.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="bi bi-printer me-2"></i> Enregistrer la Prescription
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
