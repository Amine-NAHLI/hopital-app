@extends('layouts.app')
@section('title', 'Ordonnance')
@section('page-title', 'Détail Ordonnance')

@section('content')
    <div class="card">
        <div class="card-header bg-danger text-white">
            <i class="bi bi-file-medical"></i> Ordonnance #{{ $ordonnance->id }}
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Patient</th>
                            <td>{{ $ordonnance->patient->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Médecin</th>
                            <td>{{ $ordonnance->medecin->nom_complet }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>{{ \Carbon\Carbon::parse($ordonnance->date_ordonnance)->format('d/m/Y') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <strong>Médicaments :</strong>
                    <pre class="bg-light p-3 rounded mt-2">{{ $ordonnance->medicaments }}</pre>
                    @if($ordonnance->instructions)
                        <strong>Instructions :</strong>
                        <p class="mt-1">{{ $ordonnance->instructions }}</p>
                    @endif
                    @if($ordonnance->fichier)
                        <a href="{{ asset('storage/' . $ordonnance->fichier) }}" target="_blank"
                            class="btn btn-outline-danger mt-2">
                            <i class="bi bi-file-pdf"></i> Télécharger le PDF
                        </a>
                    @endif
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('admin.ordonnances.edit', $ordonnance) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Modifier
                </a>
                <a href="{{ route('admin.ordonnances.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
@endsection