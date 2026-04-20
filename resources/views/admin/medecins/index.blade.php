@extends('layouts.app')
@section('title', 'Médecins')
@section('page-title', 'Gestion des Médecins')

@section('content')
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-person-badge"></i> Liste des Médecins</span>
            <a href="{{ route('admin.medecins.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouveau Médecin
            </a>
        </div>
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou spécialité..."
                        value="{{ $search }}">
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                    @if($search)
                        <a href="{{ route('admin.medecins.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i>
                        </a>
                    @endif
                </div>
            </form>

            <div class="row g-3">
                @forelse($medecins as $medecin)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                @if($medecin->photo)
                                    <img src="{{ asset('storage/' . $medecin->photo) }}" class="rounded-circle mb-3" width="80"
                                        height="80" style="object-fit:cover">
                                @else
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center
                                                    justify-content-center mx-auto mb-3"
                                        style="width:80px;height:80px;font-size:28px">
                                        {{ strtoupper(substr($medecin->prenom, 0, 1)) }}
                                    </div>
                                @endif
                                <h5>{{ $medecin->nom_complet }}</h5>
                                <span class="badge bg-info text-dark mb-2">{{ $medecin->specialite }}</span>
                                <p class="text-muted small mb-1"><i class="bi bi-telephone"></i> {{ $medecin->telephone }}</p>
                                <p class="text-muted small"><i class="bi bi-envelope"></i> {{ $medecin->email }}</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="{{ route('admin.medecins.show', $medecin) }}"
                                        class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.medecins.edit', $medecin) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.medecins.destroy', $medecin) }}"
                                        onsubmit="return confirm('Supprimer ce médecin ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-4">
                        Aucun médecin trouvé.
                    </div>
                @endforelse
            </div>
            <div class="mt-3">{{ $medecins->links() }}</div>
        </div>
    </div>
@endsection