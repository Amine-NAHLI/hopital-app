@extends('layouts.app')
@section('title', 'Fiche Médecin')
@section('page-title', 'Fiche Médecin')

@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    @if($medecin->photo)
                        <img src="{{ asset('storage/' . $medecin->photo) }}" class="rounded-circle mb-3" width="120" height="120"
                            style="object-fit:cover">
                    @else
                        <div class="rounded-circle bg-success text-white d-flex align-items-center
                                        justify-content-center mx-auto mb-3" style="width:120px;height:120px;font-size:40px">
                            {{ strtoupper(substr($medecin->prenom, 0, 1)) }}
                        </div>
                    @endif
                    <h4>{{ $medecin->nom_complet }}</h4>
                    <span class="badge bg-info text-dark mb-3">{{ $medecin->specialite }}</span>
                    <table class="table table-sm text-start">
                        <tr>
                            <th>Téléphone</th>
                            <td>{{ $medecin->telephone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $medecin->email }}</td>
                        </tr>
                    </table>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('admin.medecins.edit', $medecin) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <a href="{{ route('admin.medecins.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-calendar-check"></i> Rendez-vous récents
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Date</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medecin->rendezVous->take(5) as $rdv)
                                <tr>
                                    <td>{{ $rdv->patient->nom_complet }}</td>
                                    <td>{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                                    <td><span class="badge bg-success">{{ $rdv->statut }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Aucun rendez-vous</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection