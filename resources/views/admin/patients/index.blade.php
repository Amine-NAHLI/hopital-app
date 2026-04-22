@extends('layouts.app')
@section('title', 'Annuaire Patients')
@section('page-title', 'Base de données Patients')

@section('content')
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-bottom">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Journal des Patients</h4>
                <p class="text-muted small mb-0">Gestion centralisée des dossiers médicaux et administratifs</p>
            </div>
            <a href="{{ route('admin.patients.create') }}" class="btn btn-primary px-4 shadow-sm rounded-3">
                <i class="bi bi-person-plus me-2"></i> Ajouter un Patient
            </a>
        </div>
        
        <div class="card-body p-4">
            <!-- Recherche Stylisée -->
            <form method="GET" class="mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="input-group input-group-lg shadow-sm rounded-pill overflow-hidden border p-1 bg-white">
                            <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="search" class="form-control border-0 px-2 fs-6" 
                                   placeholder="Nom, CIN, téléphone ou identifiant..." value="{{ $search }}">
                            <button class="btn btn-dark rounded-pill px-5 fw-bold" type="submit">Filtrer</button>
                            @if($search)
                                <a href="{{ route('admin.patients.index') }}" class="btn btn-light rounded-pill ms-1 d-flex align-items-center px-3">
                                    <i class="bi bi-x fs-4"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary small fw-bold text-uppercase">
                            <th class="ps-4 py-3">ID / Dossier</th>
                            <th class="py-3">Informations Patient</th>
                            <th class="py-3">Identité (CIN)</th>
                            <th class="py-3">Contact</th>
                            <th class="py-3">Genre</th>
                            <th class="text-end pe-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-light text-secondary border px-2 py-1">#P-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($patient->photo)
                                            <img src="{{ asset('storage/' . $patient->photo) }}" class="rounded-circle me-3 shadow-sm" 
                                                 width="42" height="42" style="object-fit:cover; border: 2px solid white;">
                                        @else
                                            <div class="avatar-sm me-3 rounded-circle d-flex align-items-center justify-content-center fw-bold bg-primary-light text-primary" 
                                                 style="width:42px; height:42px; font-size: 0.9rem; background: #eef2ff;">
                                                {{ strtoupper(substr($patient->prenom, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="fw-bold text-dark">{{ $patient->nom_complet }}</div>
                                            <div class="x-small text-muted">Né(e) le {{ \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-medium text-secondary">{{ $patient->cin }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="small text-dark fw-medium"><i class="bi bi-telephone me-2 text-primary"></i>{{ $patient->telephone }}</span>
                                        <span class="x-small text-muted ms-4">{{ $patient->email ?? 'Sans email' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $genderColor = $patient->sexe === 'homme' ? ['bg' => '#eff6ff', 'text' => '#2563eb', 'dot' => '#3b82f6'] : ['bg' => '#fdf2f8', 'text' => '#db2777', 'dot' => '#ec4899'];
                                    @endphp
                                    <span class="badge rounded-pill px-3 py-2 d-inline-flex align-items-center" 
                                          style="background-color: {{ $genderColor['bg'] }}; color: {{ $genderColor['text'] }}">
                                        <span class="rounded-circle me-2" style="width: 6px; height: 6px; background: {{ $genderColor['dot'] }}"></span>
                                        {{ ucfirst($patient->sexe) }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.patients.show', $patient) }}" class="btn btn-icon-hover" title="Dossier Médical">
                                            <i class="bi bi-folder2-open text-primary"></i>
                                        </a>
                                        <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-icon-hover" title="Modifier">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.patients.destroy', $patient) }}" class="d-inline" onsubmit="return confirm('Supprimer ce patient ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-icon-hover" title="Supprimer">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-5">
                                        <i class="bi bi-person-x text-muted display-4 mb-3 d-block"></i>
                                        <h5 class="text-secondary">Aucun patient trouvé</h5>
                                        <p class="text-muted">La base de données est vide ou votre recherche n'a rien donné.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($patients->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $patients->links() }}
            </div>
        @endif
    </div>

    <style>
        .btn-icon-hover {
            width: 34px; height: 34px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; border: 1px solid transparent;
            transition: all 0.2s ease; background: transparent;
        }
        .btn-icon-hover:hover {
            background: #f8fafc; border-color: #e2e8f0; transform: translateY(-1px);
        }
        .x-small { font-size: 0.75rem; }
    </style>
@endsection