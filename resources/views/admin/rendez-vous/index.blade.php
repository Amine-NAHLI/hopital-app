@extends('layouts.app')
@section('title', 'Rendez-vous')
@section('page-title', 'Gestion des Rendez-vous')

@section('content')
    <div class="card">
        <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <span><i class="bi bi-calendar-check"></i> Liste des Rendez-vous</span>
            <a href="{{ route('admin.rendez-vous.create') }}" class="btn btn-dark btn-sm">
                <i class="bi bi-plus-circle"></i> Nouveau RDV
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Médecin</th>
                        <th>Date & Heure</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rendezVous as $rdv)
                                <tr>
                                    <td>{{ $rdv->id }}</td>
                                    <td>{{ $rdv->patient->nom_complet }}</td>
                                    <td>{{ $rdv->medecin->nom_complet }}</td>
                                    <td>{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                                    <td>{{ Str::limit($rdv->motif, 30) ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{
                        $rdv->statut === 'confirme' ? 'success' :
                        ($rdv->statut === 'annule' ? 'danger' :
                            ($rdv->statut === 'termine' ? 'secondary' : 'warning'))
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.rendez-vous.show', $rdv) }}" class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.rendez-vous.edit', $rdv) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.rendez-vous.destroy', $rdv) }}" class="d-inline"
                                            onsubmit="return confirm('Supprimer ce rendez-vous ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucun rendez-vous.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $rendezVous->links() }}
        </div>
    </div>
@endsection