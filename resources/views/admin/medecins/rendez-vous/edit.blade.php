@extends('layouts.app')
@section('title', 'Modifier RDV')
@section('page-title', 'Modifier Rendez-vous')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-pencil"></i> Modifier RDV #{{ $rendezVous->id }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('medecin.rendez-vous.update', $rendezVous) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Patient</label>
                        <select name="patient_id" class="form-select">
                            @foreach($patients as $p)
                                <option value="{{ $p->id }}" {{ $rendezVous->patient_id == $p->id ? 'selected' : '' }}>
                                    {{ $p->nom_complet }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Médecin</label>
                        <select name="medecin_id" class="form-select">
                            @foreach($medecins as $m)
                                <option value="{{ $m->id }}" {{ $rendezVous->medecin_id == $m->id ? 'selected' : '' }}>
                                    {{ $m->nom_complet }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Statut</label>
                        <select name="statut" class="form-select">
                            @foreach(['en_attente', 'confirme', 'annule', 'termine'] as $s)
                                <option value="{{ $s }}" {{ $rendezVous->statut === $s ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $s)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Date & Heure</label>
                        <input type="datetime-local" name="date_heure" class="form-control"
                            value="{{ $rendezVous->date_heure->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Motif</label>
                        <textarea name="motif" class="form-control" rows="3">{{ $rendezVous->motif }}</textarea>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Mettre à jour
                    </button>
                    <a href="{{ route('medecin.rendez-vous.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection