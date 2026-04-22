@extends('layouts.app')
@section('title', 'Nouveau Patient')
@section('page-title', 'Admission Nouveau Patient')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary-light text-primary rounded-3 p-3 me-3">
                            <i class="bi bi-person-plus-fill fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-secondary">Formulaire d'Admission</h4>
                            <p class="text-muted small mb-0">Veuillez renseigner les informations d'identité et de contact du patient.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.patients.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Section: Identité -->
                        <div class="mb-5">
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">
                                <i class="bi bi-card-text text-primary me-2"></i> Informations d'Identité
                            </h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Nom de famille <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                        <input type="text" name="nom" class="form-control bg-light border-start-0 @error('nom') is-invalid @enderror"
                                               value="{{ old('nom') }}" placeholder="Ex: Benani">
                                    </div>
                                    @error('nom')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Prénom <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                        <input type="text" name="prenom" class="form-control bg-light border-start-0 @error('prenom') is-invalid @enderror"
                                               value="{{ old('prenom') }}" placeholder="Ex: Ahmed">
                                    </div>
                                    @error('prenom')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary">CIN / Identifiant <span class="text-danger">*</span></label>
                                    <input type="text" name="cin" class="form-control @error('cin') is-invalid @enderror"
                                           value="{{ old('cin') }}" placeholder="Ex: AB123456">
                                    @error('cin')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary">Date de naissance <span class="text-danger">*</span></label>
                                    <input type="date" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror"
                                           value="{{ old('date_naissance') }}">
                                    @error('date_naissance')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold text-secondary">Sexe <span class="text-danger">*</span></label>
                                    <select name="sexe" class="form-select @error('sexe') is-invalid @enderror">
                                        <option value="">Sélectionner</option>
                                        <option value="homme" {{ old('sexe') === 'homme' ? 'selected' : '' }}>Homme</option>
                                        <option value="femme" {{ old('sexe') === 'femme' ? 'selected' : '' }}>Femme</option>
                                    </select>
                                    @error('sexe')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section: Contact -->
                        <div class="mb-5">
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">
                                <i class="bi bi-telephone-inbound text-primary me-2"></i> Coordonnées de Contact
                            </h5>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Téléphone mobile <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-phone text-muted"></i></span>
                                        <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror"
                                               value="{{ old('telephone') }}" placeholder="+212 6XX XXX XXX">
                                    </div>
                                    @error('telephone')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold text-secondary">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope text-muted"></i></span>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="exemple@mail.com">
                                    </div>
                                    @error('email')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-secondary">Adresse de résidence <span class="text-danger">*</span></label>
                                    <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror"
                                           value="{{ old('adresse') }}" placeholder="Rue, Quartier, Ville">
                                    @error('adresse')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section: Médical -->
                        <div class="mb-5">
                            <h5 class="fw-bold text-dark border-bottom pb-2 mb-4">
                                <i class="bi bi-heart-pulse text-primary me-2"></i> Informations Médicales & Photo
                            </h5>
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-secondary">Antécédents & Observations particulières</label>
                                    <textarea name="antecedents" class="form-control" rows="3" 
                                              placeholder="Allergies, maladies chroniques, interventions passées...">{{ old('antecedents') }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-semibold text-secondary">Photo d'identité</label>
                                    <div class="border rounded-3 p-4 text-center bg-light shadow-inner">
                                        <i class="bi bi-cloud-arrow-up fs-2 text-primary d-block mb-2"></i>
                                        <p class="small text-muted mb-3">Glissez-déposez une image ou cliquez pour parcourir</p>
                                        <input type="file" name="photo" class="form-control w-50 mx-auto @error('photo') is-invalid @enderror" accept="image/*">
                                        @error('photo')<div class="text-danger x-small mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary px-4 py-2">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 py-2 shadow">
                                <i class="bi bi-save-fill me-2"></i> Enregistrer le Patient
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection