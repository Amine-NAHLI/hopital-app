@extends('layouts.app')
@section('title', 'Détail RDV')
@section('page-title', 'Détail du Rendez-vous')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-calendar-check"></i> Rendez-vous #{{ $rendezVous->id }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Patient</th>
                            <td>{{ $rendezVous->patient->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Médecin</th>
                            <td>{{ $rendezVous->medecin->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Spécialité</th>
                            <td>{{ $rendezVous->medecin->specialite }}</td>
                        </tr>
                        <tr>
                            <th>Date & Heure</th>
                            <td>{{ $rendezVous->date_heure->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Motif</th>
                            <td>{{ $rendezVous->motif ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Statut</th>
                            <td>
                                <span
                                    class="badge bg-{{ $rendezVous->statut === 'confirme' ? 'success' : ($rdv->statut === 'annule' ? 'danger' : 'warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $rendezVous->statut)) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.rendez-vous.edit', $rendezVous) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <a href="{{ route('admin.rendez-vous.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
@endsection