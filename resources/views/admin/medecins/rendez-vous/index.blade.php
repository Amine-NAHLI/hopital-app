@extends('layouts.app')
@section('title', 'Mes Rendez-vous')
@section('page-title', 'Mes Rendez-vous')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-calendar-check"></i> Mes Rendez-vous
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Motif</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rendezVous as $rdv)
                        <tr>
                            <td>{{ $rdv->patient->nom_complet }}</td>
                            <td>{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                            <td>{{ $rdv->motif ?? '—' }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $rdv->statut === 'confirme' ? 'success' : ($rdv->statut === 'annule' ? 'danger' : 'warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('medecin.rendez-vous.show', $rdv) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('medecin.rendez-vous.edit', $rdv) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucun rendez-vous.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $rendezVous->links() }}
        </div>
    </div>
@endsection