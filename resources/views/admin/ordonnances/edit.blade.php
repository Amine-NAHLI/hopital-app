@extends('layouts.app')
@section('title', 'Modifier Ordonnance')
@section('page-title', 'Modifier Ordonnance')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-pencil"></i> Modifier Ordonnance #{{ $ordonnance->id }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.ordonnances.update', $ordonnance) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Médicaments</label>
                        <textarea name="medicaments" class="form-control"
                            rows="4">{{ old('medicaments', $ordonnance->medicaments) }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Instructions</label>
                        <textarea name="instructions" class="form-control"
                            rows="3">{{ old('instructions', $ordonnance->instructions) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nouveau fichier PDF</label>
                        @if($ordonnance->fichier)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $ordonnance->fichier) }}" target="_blank"
                                    class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-file-pdf"></i> Fichier actuel
                                </a>
                            </div>
                        @endif
                        <input type="file" name="fichier" class="form-control" accept=".pdf">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Mettre à jour
                    </button>
                    <a href="{{ route('admin.ordonnances.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection