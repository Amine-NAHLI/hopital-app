@extends('layouts.app')
@section('title', 'Rendez-vous')
@section('page-title', 'Détail Rendez-vous')

@section('content')
    <div class="card">
        <div class="card-header bg-warning">
            <i class="bi bi-calendar-check"></i> Rendez-vous #{{ $rendezVous->id }}
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Patient</th>
                    <td>{{ $rendezVous->patient->nom_complet }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $rendezVous->date_heure->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Motif</th>
                    <td>{{ $rendezVous->motif ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Statut</th>
                    <td>{{ ucfirst(str_replace('_', ' ', $rendezVous->statut)) }}</td>
                </tr>
            </table>
            <div class="d-flex gap-2">
                <a href="{{ route('medecin.rendez-vous.edit', $rendezVous) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Modifier statut
                </a>
                <a href="{{ route('medecin.rendez-vous.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
@endsection