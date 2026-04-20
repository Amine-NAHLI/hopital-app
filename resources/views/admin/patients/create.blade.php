@extends('layouts.app')
@section('title', 'Nouveau Patient')
@section('page-title', 'Ajouter un Patient')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-person-plus"></i> Nouveau Patient
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.patients.store') }}" enctype="multipart/form-data">
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
                    <div class="col-md-4">
                        <label class="form-label fw-bold">CIN <span class="text-danger">*</span></label>
                        <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror"
                            value="{{ old('cin') }}">
                        @error('cin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date de naissance <span class="text-danger">*</span></label>
                        <input type="date" name="date_naissance"
                            class="form-control @error('date_naissance') is-invalid @enderror"
                            value="{{ old('date_naissance') }}">
                        @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Sexe <span class="text-danger">*</span></label>
                        <select name="sexe" class="form-select @error('sexe') is-invalid @enderror">
                            <option value="">-- Choisir --</option>
                            <option value="homme" {{ old('sexe') === 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ old('sexe') === 'femme' ? 'selected' : '' }}>Femme</option>
                        </select>
                        @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                            value="{{ old('telephone') }}">
                        @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Adresse <span class="text-danger">*</span></label>
                        <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                            value="{{ old('adresse') }}">
                        @error('adresse')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-bold">Antécédents médicaux</label>
                        <textarea name="antecedents" class="form-control" rows="3">{{ old('antecedents') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Photo</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                            accept="image/*">
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection