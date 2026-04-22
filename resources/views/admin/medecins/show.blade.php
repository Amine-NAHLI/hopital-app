@extends('layouts.app')
@section('title', 'Fiche Médecin')
@section('page-title', 'Profil Praticien')

@section('content')
    <div class="row g-4">
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="position-relative d-inline-block mb-4">
                        @if($medecin->photo)
                            <img src="{{ asset('storage/' . $medecin->photo) }}" class="rounded-circle shadow-md" 
                                 width="150" height="150" style="object-fit:cover; border: 4px solid #f0fdfa;">
                        @else
                            <div class="avatar-xl mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-md bg-accent-soft text-accent" 
                                 style="width:150px; height:150px; font-size: 3.5rem; background: #ecfeff; color: #0891b2;">
                                {{ strtoupper(substr($medecin->prenom, 0, 1)) }}
                            </div>
                        @endif
                        <span class="position-absolute bottom-0 end-0 p-2 bg-success rounded-circle border border-white border-4 shadow-sm" title="Actif"></span>
                    </div>

                    <h3 class="fw-bold text-dark mb-1">Dr. {{ $medecin->nom_complet }}</h3>
                    <div class="badge rounded-pill bg-accent-soft text-accent px-3 py-2 mb-4" style="background: #ecfeff; color: #0891b2">
                        {{ $medecin->specialite }}
                    </div>

                    <div class="list-group list-group-flush text-start border-top pt-3 mb-4">
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-medium">Téléphone</span>
                            <span class="fw-bold text-secondary">{{ $medecin->telephone }}</span>
                        </div>
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-medium">Email Pro</span>
                            <span class="fw-bold text-secondary text-truncate" style="max-width: 180px;">{{ $medecin->email }}</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.medecins.edit', $medecin) }}" class="btn btn-warning text-white">
                            <i class="bi bi-pencil-square me-2"></i> Modifier le profil
                        </a>
                        <a href="{{ route('admin.medecins.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-secondary">
                        <i class="bi bi-calendar-check text-primary me-2"></i> Agenda Récent
                    </h5>
                    <a href="{{ route('admin.rendez-vous.index', ['medecin_id' => $medecin->id]) }}" class="btn btn-sm btn-light border text-primary fw-bold">
                        Voir tout l'agenda
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Patient</th>
                                    <th>Date & Heure</th>
                                    <th class="text-end pe-4">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($medecin->rendezVous->sortByDesc('date_heure')->take(10) as $rdv)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark">{{ $rdv->patient->nom_complet }}</div>
                                            <span class="text-muted small">CIN: {{ $rdv->patient->cin }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border fw-medium">
                                                <i class="bi bi-clock me-1 text-primary"></i>
                                                {{ $rdv->date_heure->format('d/m/Y H:i') }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <span class="badge rounded-pill @if($rdv->statut === 'confirme') bg-success @elseif($rdv->statut === 'annule') bg-danger @else bg-warning @endif shadow-sm">
                                                {{ ucfirst($rdv->statut) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5">
                                            <div class="text-muted py-3">
                                                <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>
                                                Aucun rendez-vous enregistré pour ce praticien.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection