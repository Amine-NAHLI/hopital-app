@extends('layouts.app')
@section('title', 'Nouveau RDV')
@section('page-title', 'Nouveau Rendez-vous')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-calendar-plus"></i> Nouveau Rendez-vous
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.rendez-vous.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Patient <span class="text-danger">*</span></label>
                        <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror">
                            <option value="">-- Choisir un patient --</option>
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nom_complet }} ({{ $p->cin }})
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Médecin <span class="text-danger">*</span></label>
                        <select name="medecin_id" class="form-select @error('medecin_id') is-invalid @enderror">
                            <option value="">-- Choisir un médecin --</option>
                            @foreach($medecins as $m)
                                <option value="{{ $m->id }}" {{ old('medecin_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->nom_complet }} — {{ $m->specialite }}
                                </option>
                            @endforeach
                        </select>
                        @error('medecin_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date & Heure <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="date_heure"
                            class="form-control @error('date_heure') is-invalid @enderror" value="{{ old('date_heure') }}">
                        @error('date_heure')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="en_attente">En attente</option>
                            <option value="confirme">Confirmé</option>
                            <option value="annule">Annulé</option>
                            <option value="termine">Terminé</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Motif</label>
                        <textarea name="motif" class="form-control" rows="3">{{ old('motif') }}</textarea>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.rendez-vous.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection