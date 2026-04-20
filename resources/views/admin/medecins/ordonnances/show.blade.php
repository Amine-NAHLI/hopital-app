@extends('layouts.app')
@section('title', 'Ordonnance')
@section('page-title', 'Détail Ordonnance')

@section('content')
    <div class="card">
        <div class="card-header bg-danger text-white">
            <i class="bi bi-file-medical"></i> Ordonnance #{{ $ordonnance->id }}
        </div>
        <div class="card-body">
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
            <strong>Médicaments :</strong>
            <pre class="bg-light p-3 rounded mt-2">{{ $ordonnance->medicaments }}</pre>
            @if($ordonnance->instructions)
                <strong>Instructions :</strong>
                <p>{{ $ordonnance->instructions }}</p>
            @endif
            @if($ordonnance->fichier)
                <a href="{{ asset('storage/' . $ordonnance->fichier) }}" target="_blank" class="btn btn-outline-danger">
                    <i class="bi bi-file-pdf"></i> Télécharger PDF
                </a>
            @endif
            <div class="mt-3">
                <a href="{{ route('medecin.ordonnances.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
@endsection