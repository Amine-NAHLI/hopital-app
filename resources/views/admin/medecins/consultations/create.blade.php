@extends('layouts.app')
@section('title', 'Nouvelle Consultation')
@section('page-title', 'Nouvelle Consultation')

@section('content')
    <div class="card">
        <div class="card-header text-white" style="background:#4527a0">
            <i class="bi bi-clipboard2-plus"></i> Nouvelle Consultation
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('medecin.consultations.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Rendez-vous</label>
                        <select name="rendez_vous_id" class="form-select">
                            <option value="">-- Choisir --</option>
                            @foreach($rendezVous as $rdv)
                                <option value="{{ $rdv->id }}">
                                    {{ $rdv->patient->nom_complet }} — {{ $rdv->date_heure->format('d/m/Y H:i') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Patient</label>
                        <select name="patient_id" class="form-select">
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->nom_complet }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="medecin_id" value="{{ auth()->user()->medecin->id }}">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date</label>
                        <input type="date" name="date_consultation" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Diagnostic <span class="text-danger">*</span></label>
                        <textarea name="diagnostic" class="form-control @error('diagnostic') is-invalid @enderror"
                            rows="3">{{ old('diagnostic') }}</textarea>
                        @error('diagnostic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Traitement</label>
                        <textarea name="traitement" class="form-control" rows="3">{{ old('traitement') }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Prix (DH)</label>
                        <input type="number" name="prix" class="form-control" value="0" min="0" step="0.01">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="{{ route('medecin.consultations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection