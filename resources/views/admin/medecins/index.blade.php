@extends('layouts.app')
@section('title', 'Corps Médical')
@section('page-title', 'Gestion de l\'Équipe Médicale')

@section('content')
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-bottom">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Annuaire des Praticiens</h4>
                <p class="text-muted small mb-0">Visualisez et gérez les profils de vos médecins spécialistes</p>
            </div>
            <a href="{{ route('admin.medecins.create') }}" class="btn btn-primary px-4 shadow-sm rounded-3">
                <i class="bi bi-person-plus me-2"></i> Ajouter un Médecin
            </a>
        </div>
        <div class="card-body p-4">
            <form method="GET" class="mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border p-1 bg-white">
                            <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 px-2 fs-6" 
                                   placeholder="Nom, spécialité, ville ou email..." value="{{ $search }}">
                            <button class="btn btn-primary rounded-pill px-5 fw-bold" type="submit">Rechercher</button>
                            @if($search)
                                <a href="{{ route('admin.medecins.index') }}" class="btn btn-light rounded-pill ms-1 d-flex align-items-center px-3">
                                    <i class="bi bi-x fs-4"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            <div class="row g-4">
                @forelse($medecins as $medecin)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm card-medecin overflow-hidden">
                            <div class="card-overlay"></div>
                            <div class="card-body text-center p-4 position-relative">
                                <div class="position-relative d-inline-block mb-4">
                                    @if($medecin->photo)
                                        <img src="{{ asset('storage/' . $medecin->photo) }}" class="rounded-circle shadow-lg" 
                                             width="110" height="110" style="object-fit:cover; border: 4px solid white;">
                                    @else
                                        <div class="avatar-lg mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-lg" 
                                             style="width:110px; height:110px; font-size: 2.5rem; background: linear-gradient(135deg, #4f46e5, #06b6d4); color: white;">
                                            {{ strtoupper(substr($medecin->prenom, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="status-indicator online"></span>
                                </div>
                                
                                <h5 class="fw-bold text-dark mb-1">{{ $medecin->nom_complet }}</h5>
                                <div class="badge rounded-pill bg-primary-soft text-primary mb-4 px-3 py-2" style="background: #eef2ff;">
                                    {{ $medecin->specialite }}
                                </div>
                                
                                <div class="d-flex flex-column gap-2 text-start small mb-4 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center text-secondary">
                                        <i class="bi bi-telephone-fill me-2 text-primary"></i> {{ $medecin->telephone }}
                                    </div>
                                    <div class="d-flex align-items-center text-secondary">
                                        <i class="bi bi-envelope-at-fill me-2 text-primary"></i> 
                                        <span class="text-truncate">{{ $medecin->email }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-secondary">
                                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i> 
                                        <span>{{ $medecin->ville ?? 'Casablanca' }}</span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 justify-content-center pt-2">
                                    <a href="{{ route('admin.medecins.show', $medecin) }}" class="btn btn-sm btn-outline-primary flex-grow-1 py-2 rounded-2">
                                        <i class="bi bi-eye"></i> Profil
                                    </a>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.medecins.edit', $medecin) }}" class="btn btn-sm btn-light border py-2 px-3">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.medecins.destroy', $medecin) }}" 
                                              onsubmit="return confirm('Supprimer ce médecin ?')" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light border py-2 px-3 text-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="py-5">
                            <i class="bi bi-people text-muted display-4 mb-3 d-block"></i>
                            <h5 class="text-secondary">Aucun médecin trouvé</h5>
                            <p class="text-muted">Ajustez vos filtres ou ajoutez un nouveau praticien.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-5">
                {{ $medecins->links() }}
            </div>
        </div>
    </div>

    <style>
        .card-medecin {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0,0,0,0.05) !important;
        }
        .card-medecin:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
            border-color: var(--primary) !important;
        }
        .status-indicator {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 18px;
            height: 18px;
            border: 3px solid white;
            border-radius: 50%;
        }
        .status-indicator.online { background-color: #10b981; }
        
        .card-overlay {
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 80px;
            background: linear-gradient(to bottom right, #f8fafc, #f1f5f9);
            z-index: 0;
        }
    </style>
@endsection