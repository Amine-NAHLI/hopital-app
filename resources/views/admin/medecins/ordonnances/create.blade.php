@extends('layouts.app')
@section('title', 'Nouvelle Ordonnance')
@section('page-title', 'Nouvelle Ordonnance')

@section('content')
    <div class="card">
        <div class="card-header bg-danger text-white">
            <i class="bi bi-file-medical"></i> Nouvelle Ordonnance
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('medecin.ordonnances.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Consultation</label>
                        <select name="consultation_id" class="form-select">
                            <option value="">-- Choisir --</option>
                            @foreach($consultations as $c)
                                <option value="{{ $c->id }}">
                                    {{ $c->patient->nom_complet }} —
                                    {{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m/Y') }}
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
                        <input type="date" name="date_ordonnance" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Médicaments <span class="text-danger">*</span></label>
                        <textarea name="medicaments" class="form-control @error('medicaments') is-invalid @enderror"
                            rows="4">{{ old('medicaments') }}</textarea>
                        @error('medicaments')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Instructions</label>
                        <textarea name="instructions" class="form-control" rows="3">{{ old('instructions') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fichier PDF</label>
                        <input type="file" name="fichier" class="form-control" accept=".pdf">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="{{ route('medecin.ordonnances.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection