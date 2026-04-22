@extends('layouts.app')
@section('title', 'Nouveau RDV')
@section('page-title', 'Planification Médicale')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 p-3 me-3" style="background: #fffbeb; color: #d97706;">
                            <i class="bi bi-calendar-plus-fill fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-secondary">Réserver un créneau</h4>
                            <p class="text-muted small mb-0">Sélectionnez une date et un praticien pour le patient.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.rendez-vous.store') }}">
                        @csrf
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Patient <span class="text-danger">*</span></label>
                                <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror shadow-none">
                                    <option value="">-- Choisir un patient --</option>
                                    @foreach($patients as $p)
                                        <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->nom_complet }} ({{ $p->cin }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('patient_id')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Médecin Praticien <span class="text-danger">*</span></label>
                                <select name="medecin_id" class="form-select @error('medecin_id') is-invalid @enderror shadow-none">
                                    <option value="">-- Choisir un médecin --</option>
                                    @foreach($medecins as $m)
                                        <option value="{{ $m->id }}" {{ old('medecin_id') == $m->id ? 'selected' : '' }}>
                                            Dr. {{ $m->nom_complet }} ({{ $m->specialite }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('medecin_id')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Date & Heure souhaitée <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-clock"></i></span>
                                    <input type="datetime-local" name="date_heure"
                                           class="form-control @error('date_heure') is-invalid @enderror" value="{{ old('date_heure') }}">
                                </div>
                                @error('date_heure')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">État initial du rendez-vous</label>
                                <select name="statut" class="form-select bg-light">
                                    <option value="en_attente" selected>En attente</option>
                                    <option value="confirme">Confirmé immédiatement</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Motif ou symptômes préliminaires</label>
                                <textarea name="motif" class="form-control" rows="4" placeholder="Ex: Contrôle annuel, douleurs abdominales, etc.">{{ old('motif') }}</textarea>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.rendez-vous.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow" style="background: var(--primary);">
                                <i class="bi bi-calendar-check me-2"></i> Valider le rendez-vous
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection