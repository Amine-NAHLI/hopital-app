@extends('layouts.app')
@section('title', 'Annuaire Patients')
@section('page-title', 'Mes Patients')

@section('content')
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <form action="{{ route('medecin.patients.index') }}" method="GET" class="row g-3">
                <div class="col-md-10">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" 
                               placeholder="Rechercher par nom, prénom ou CIN..." value="{{ $search ?? '' }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                        Filtrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Patient</th>
                            <th>Identifiant (CIN)</th>
                            <th>Contact</th>
                            <th>Dernière Visite</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $p)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($p->photo)
                                            <img src="{{ asset('storage/' . $p->photo) }}" class="rounded-circle me-3" width="45" height="45" style="object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-primary-light text-primary d-flex align-items-center justify-content-center me-3 fw-bold" 
                                                 style="width: 45px; height: 45px; background: #e0e7ff;">
                                                {{ strtoupper(substr($p->prenom, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark">{{ $p->nom_complet }}</div>
                                            <span class="text-muted small">{{ $p->sexe === 'homme' ? 'Masculin' : 'Féminin' }}, {{ \Carbon\Carbon::parse($p->date_naissance)->age }} ans</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1">{{ $p->cin }}</span>
                                </td>
                                <td>
                                    <div class="small"><i class="bi bi-telephone text-muted me-2"></i>{{ $p->telephone }}</div>
                                    <div class="small text-muted"><i class="bi bi-envelope text-muted me-2"></i>{{ $p->email ?? 'N/A' }}</div>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ $p->rendezVous()->where('statut', 'termine')->latest()->first()?->date_heure?->format('d/m/Y') ?? 'Aucune' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('medecin.patients.show', $p) }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                                        <i class="bi bi-folder2-open me-1"></i> Dossier Médical
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted py-4">
                                        <i class="bi bi-person-x fs-1 d-block mb-2"></i>
                                        Aucun patient trouvé.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($patients->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $patients->links() }}
            </div>
        @endif
    </div>
@endsection
