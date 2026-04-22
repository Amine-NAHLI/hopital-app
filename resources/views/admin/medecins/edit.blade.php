@extends('layouts.app')
@section('title', 'Modifier Praticien')
@section('page-title', 'Édition du Profil Médical')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background: #ecfeff; color: #0891b2;">
                        <i class="bi bi-person-vcard fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-dark">Mise à jour du Praticien</h4>
                        <p class="text-muted small mb-0">Modifier les informations professionnelles de Dr. {{ $medecin->nom_complet }}</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('admin.medecins.update', $medecin) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-info-circle text-primary me-2"></i> Identité Professionnelle
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Nom de famille <span class="text-danger">*</span></label>
                                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" 
                                       value="{{ old('nom', $medecin->nom) }}" required>
                                @error('nom') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Prénom <span class="text-danger">*</span></label>
                                <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" 
                                       value="{{ old('prenom', $medecin->prenom) }}" required>
                                @error('prenom') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Spécialité Médicale <span class="text-danger">*</span></label>
                                <select name="specialite" class="form-select @error('specialite') is-invalid @enderror" required>
                                    @foreach(['Cardiologie', 'Pédiatrie', 'Neurologie', 'Dermatologie', 'Orthopédie', 'Gynécologie', 'Ophtalmologie', 'Psychiatrie', 'Radiologie', 'Urgences', 'Médecine Générale'] as $s)
                                        <option value="{{ $s }}" {{ old('specialite', $medecin->specialite) === $s ? 'selected' : '' }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                                @error('specialite') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Ville d'exercice</label>
                                <input type="text" name="ville" class="form-control" value="{{ old('ville', $medecin->ville ?? 'Casablanca') }}">
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-envelope-paper text-primary me-2"></i> Coordonnées de Contact
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Numéro de Téléphone <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-phone"></i></span>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" 
                                           value="{{ old('telephone', $medecin->telephone) }}" required>
                                </div>
                                @error('telephone') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Adresse Email Professionnelle <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-at"></i></span>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $medecin->email) }}" required>
                                </div>
                                @error('email') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-camera text-primary me-2"></i> Photo de Profil
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center p-3 bg-light rounded-3 border">
                                    @if($medecin->photo)
                                        <img src="{{ asset('storage/' . $medecin->photo) }}" class="rounded-circle mb-3 shadow-sm" width="100" height="100" style="object-fit: cover;">
                                    @else
                                        <div class="avatar-lg mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold bg-secondary text-white mb-3" style="width:100px; height:100px; font-size: 2rem;">
                                            {{ strtoupper(substr($medecin->prenom, 0, 1)) }}
                                        </div>
                                    @endif
                                    <input type="file" name="photo" class="form-control form-control-sm" accept="image/*">
                                    <p class="x-small text-muted mt-2 mb-0">Format recommandé: Carré, JPEG/PNG</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="p-4 rounded-3 bg-primary-soft h-100" style="background: #eef2ff;">
                                    <h6 class="fw-bold text-primary mb-2"><i class="bi bi-shield-lock-fill me-2"></i> Sécurité des données</h6>
                                    <p class="small text-secondary mb-0">La modification de l'email professionnel impactera les identifiants de connexion si le médecin utilise ce même email pour accéder à son espace praticien.</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.medecins.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="bi bi-check-circle me-2"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection