@extends('layouts.app')
@section('title', 'Modifier Patient')
@section('page-title', 'Édition du Dossier Patient')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background: #eef2ff; color: #4f46e5;">
                        <i class="bi bi-person-gear fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-dark">Modification du Profil</h4>
                        <p class="text-muted small mb-0">Mettez à jour les informations de {{ $patient->nom_complet }}</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.patients.update', $patient) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Section 1: Informations Personnelles -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-person-badge text-primary me-2"></i> Informations Personnelles
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Prénom <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" 
                                           value="{{ old('prenom', $patient->prenom) }}" required>
                                </div>
                                @error('prenom') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Nom <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person-fill"></i></span>
                                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                                           value="{{ old('nom', $patient->nom) }}" required>
                                </div>
                                @error('nom') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Date de Naissance <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                    <input type="date" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" 
                                           value="{{ old('date_naissance', $patient->date_naissance) }}" required>
                                </div>
                                @error('date_naissance') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Sexe <span class="text-danger">*</span></label>
                                <div class="d-flex gap-4 mt-2">
                                    <div class="form-check custom-option">
                                        <input class="form-check-input" type="radio" name="sexe" id="sexeH" value="homme" 
                                               {{ old('sexe', $patient->sexe) === 'homme' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="sexeH">Homme</label>
                                    </div>
                                    <div class="form-check custom-option">
                                        <input class="form-check-input" type="radio" name="sexe" id="sexeF" value="femme" 
                                               {{ old('sexe', $patient->sexe) === 'femme' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="sexeF">Femme</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Contact & Administratif -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-info-circle text-primary me-2"></i> Contact & Administratif
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">CIN <span class="text-danger">*</span></label>
                                <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror" 
                                       value="{{ old('cin', $patient->cin) }}" required placeholder="Ex: AB123456">
                                @error('cin') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Téléphone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-phone"></i></span>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                                           value="{{ old('telephone', $patient->telephone) }}" required>
                                </div>
                                @error('telephone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $patient->email) }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Adresse Résidentielle</label>
                                <textarea name="adresse" class="form-control" rows="2">{{ old('adresse', $patient->adresse) }}</textarea>
                            </div>
                        </div>

                        <!-- Section 3: Médical & Photo -->
                        <div class="row g-4 mb-4">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-heart-pulse text-primary me-2"></i> Données Médicales & Médias
                                </h5>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold text-secondary">Antécédents Médicaux</label>
                                <textarea name="antecedents" class="form-control" rows="6" 
                                          placeholder="Allergies, maladies chroniques, interventions passées...">{{ old('antecedents', $patient->antecedents) }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold text-secondary">Photo du Patient</label>
                                <div class="border rounded-3 p-4 text-center bg-light h-100 d-flex flex-column justify-content-center">
                                    @if($patient->photo)
                                        <img src="{{ asset('storage/' . $patient->photo) }}" class="rounded-circle mx-auto mb-3 shadow-sm" width="80" height="80" style="object-fit: cover;">
                                    @else
                                        <i class="bi bi-camera fs-1 text-muted d-block mb-2"></i>
                                    @endif
                                    <input type="file" name="photo" class="form-control form-control-sm">
                                    <p class="x-small text-muted mt-2 mb-0">Modifier la photo (JPEG, PNG)</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 shadow">
                                <i class="bi bi-check-lg me-2"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .custom-option {
            padding: 10px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            transition: all 0.2s;
        }
        .custom-option:hover { background: #f8fafc; }
        .form-check-input:checked + .form-check-label { font-weight: bold; color: var(--primary); }
        .x-small { font-size: 0.75rem; }
    </style>
@endsection
