@extends('layouts.app')
@section('title', 'Modifier Consultation')
@section('page-title', 'Modifier la Consultation')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-pencil"></i> Modifier Consultation #{{ $consultation->id }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.consultations.update', $consultation) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Diagnostic <span class="text-danger">*</span></label>
                        <textarea name="diagnostic" class="form-control"
                            rows="3">{{ old('diagnostic', $consultation->diagnostic) }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Traitement</label>
                        <textarea name="traitement" class="form-control"
                            rows="3">{{ old('traitement', $consultation->traitement) }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea name="notes" class="form-control"
                            rows="2">{{ old('notes', $consultation->notes) }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Prix (DH)</label>
                        <input type="number" name="prix" class="form-control" value="{{ old('prix', $consultation->prix) }}"
                            min="0" step="0.01">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Mettre à jour
                    </button>
                    <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection