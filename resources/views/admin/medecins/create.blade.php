@extends('layouts.app')
@section('title', 'Nouveau Médecin')
@section('page-title', 'Ajouter un Médecin')

@section('content')
    <div class="card">
        <div class="card-header bg-success text-white">
            <i class="bi bi-person-plus"></i> Nouveau Médecin
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.medecins.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nom <span class="text-danger">*</span></label>
                        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                            value="{{ old('nom') }}">
                        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Prénom <span class="text-danger">*</span></label>
                        <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
                            value="{{ old('prenom') }}">
                        @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Spécialité <span class="text-danger">*</span></label>
                        <select name="specialite" class="form-select @error('specialite') is-invalid @enderror">
                            <option value="">-- Choisir --</option>
                            @foreach(['Cardiologie', 'Pédiatrie', 'Neurologie', 'Dermatologie', 'Orthopédie', 'Gynécologie', 'Ophtalmologie', 'Psychiatrie', 'Radiologie', 'Urgences'] as $s)
                                <option value="{{ $s }}" {{ old('specialite') === $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        @error('specialite')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                            value="{{ old('telephone') }}">
                        @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Mot de passe <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.medecins.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection