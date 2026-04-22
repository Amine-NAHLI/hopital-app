@extends('layouts.app')
@section('title', 'Nouvelle Consultation')
@section('page-title', 'Nouvelle Consultation')

@section('content')
    <div class="card">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #7c3aed, #6d28d9)">
            <i class="bi bi-clipboard2-plus"></i> Nouvelle Consultation
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.consultations.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Rendez-vous <span class="text-danger">*</span></label>
                        <select name="rendez_vous_id" class="form-select @error('rendez_vous_id') is-invalid @enderror">
                            <option value="">-- Choisir --</option>
                            @foreach($rendezVous as $rdv)
                                <option value="{{ $rdv->id }}">
                                    {{ $rdv->patient->nom_complet }} — {{ $rdv->date_heure->format('d/m/Y H:i') }}
                                </option>
                            @endforeach
                        </select>
                        @error('rendez_vous_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Patient <span class="text-danger">*</span></label>
                        <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror">
                            <option value="">-- Choisir --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}">{{ $p->nom_complet }}</option>
                            @endforeach
                        </select>
                        @error('patient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Medecin <span class="text-danger">*</span></label>
                        <select name="medecin_id" class="form-select @error('medecin_id') is-invalid @enderror">
                            <option value="">-- Choisir --</option>
                            @foreach($medecins as $m)
                                <option value="{{ $m->id }}">{{ $m->nom_complet }}</option>
                            @endforeach
                        </select>
                        @error('medecin_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date <span class="text-danger">*</span></label>
                        <input type="date" name="date_consultation" class="form-control"
                            value="{{ old('date_consultation', date('Y-m-d')) }}">
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
                        <label class="form-label fw-bold">Prix (DH) <span class="text-danger">*</span></label>
                        <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror"
                            value="{{ old('prix', 0) }}" min="0" step="0.01">
                        @error('prix')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection