@extends('layouts.app')
@section('title', 'Nouveau Médecin')
@section('page-title', 'Enregistrement Nouveau Praticien')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="bg-accent-soft text-accent rounded-3 p-3 me-3" style="background: #ecfeff; color: #0891b2">
                            <i class="bi bi-person-badge-fill fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-secondary">Profil du Praticien</h4>
                            <p class="text-muted small mb-0">Créez un compte pour un nouveau membre du corps médical.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.medecins.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-5">
                            <!-- Colonne Gauche: Identité & Contact -->
                            <div class="col-lg-7">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">
                                    <i class="bi bi-person-lines-fill text-primary me-2"></i> Identité & Coordonnées
                                </h5>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Nom de famille <span class="text-danger">*</span></label>
                                        <input type="text" name="nom" class="form-control bg-light @error('nom') is-invalid @enderror"
                                               value="{{ old('nom') }}" placeholder="Nom">
                                        @error('nom')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Prénom <span class="text-danger">*</span></label>
                                        <input type="text" name="prenom" class="form-control bg-light @error('prenom') is-invalid @enderror"
                                               value="{{ old('prenom') }}" placeholder="Prénom">
                                        @error('prenom')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold text-secondary">Spécialité Médicale <span class="text-danger">*</span></label>
                                        <select name="specialite" class="form-select bg-light @error('specialite') is-invalid @enderror">
                                            <option value="">-- Sélectionner la spécialité --</option>
                                            @foreach(['Cardiologie', 'Pédiatrie', 'Neurologie', 'Dermatologie', 'Orthopédie', 'Gynécologie', 'Ophtalmologie', 'Psychiatrie', 'Radiologie', 'Urgences', 'Médecine Générale'] as $s)
                                                <option value="{{ $s }}" {{ old('specialite') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                            @endforeach
                                        </select>
                                        @error('specialite')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Téléphone Professionnel <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                                   value="{{ old('telephone') }}" placeholder="Ex: 06XXXXXXXX">
                                        </div>
                                        @error('telephone')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Email de connexion <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope-at"></i></span>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}" placeholder="dr.nom@medicore.com">
                                        </div>
                                        @error('email')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Colonne Droite: Sécurité & Photo -->
                            <div class="col-lg-5">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">
                                    <i class="bi bi-shield-lock text-primary me-2"></i> Sécurité & Profil
                                </h5>
                                <div class="card bg-light border-0 p-4 mb-4">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold text-secondary">Mot de passe initial <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="bi bi-key"></i></span>
                                            <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="Min 8 caractères">
                                        </div>
                                        @error('password')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                        <div class="form-text x-small">Le médecin pourra changer son mot de passe lors de sa première connexion.</div>
                                    </div>
                                    
                                    <div>
                                        <label class="form-label fw-semibold text-secondary">Photo de profil Professionnelle</label>
                                        <div class="border rounded-3 p-3 bg-white text-center">
                                            <i class="bi bi-person-bounding-box fs-1 text-muted d-block mb-2"></i>
                                            <input type="file" name="photo" class="form-control form-control-sm" accept="image/*">
                                            <div class="form-text x-small mt-2">Format JPG, PNG (Max 2MB)</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-3 rounded-3" style="background: #eff6ff; color: #1d4ed8;">
                                    <div class="d-flex">
                                        <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                                        <p class="small mb-0">En créant ce compte, le médecin aura accès à son tableau de bord personnel pour gérer ses patients et rendez-vous.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.medecins.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="bi bi-check2-circle me-2"></i> Finaliser l'inscription
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection