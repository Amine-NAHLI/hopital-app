@extends('layouts.app')
@section('title', 'Modifier Médecin')
@section('page-title', 'Modifier le Médecin')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-pencil"></i> Modifier — {{ $medecin->nom_complet }}
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.medecins.update', $medecin) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nom</label>
                        <input type="text" name="nom" class="form-control" value="{{ old('nom', $medecin->nom) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $medecin->prenom) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Spécialité</label>
                        <select name="specialite" class="form-select">
                            @foreach(['Cardiologie', 'Pédiatrie', 'Neurologie', 'Dermatologie', 'Orthopédie', 'Gynécologie', 'Ophtalmologie', 'Psychiatrie', 'Radiologie', 'Urgences'] as $s)
                                <option value="{{ $s }}" {{ $medecin->specialite === $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Téléphone</label>
                        <input type="text" name="telephone" class="form-control"
                            value="{{ old('telephone', $medecin->telephone) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $medecin->email) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Photo</label>
                        @if($medecin->photo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $medecin->photo) }}" width="80" class="rounded">
                            </div>
                        @endif
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-circle"></i> Mettre à jour
                    </button>
                    <a href="{{ route('admin.medecins.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection