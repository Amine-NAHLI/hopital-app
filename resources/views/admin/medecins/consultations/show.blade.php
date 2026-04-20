@extends('layouts.app')
@section('title', 'Consultation')
@section('page-title', 'Détail Consultation')

@section('content')
    <div class="card">
        <div class="card-header text-white" style="background:#4527a0">
            <i class="bi bi-clipboard2-pulse"></i> Consultation #{{ $consultation->id }}
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Patient</th>
                    <td>{{ $consultation->patient->nom_complet }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Diagnostic</th>
                    <td>{{ $consultation->diagnostic }}</td>
                </tr>
                <tr>
                    <th>Traitement</th>
                    <td>{{ $consultation->traitement ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>{{ $consultation->notes ?? '—' }}</td>
                </tr>
                <tr>
                    <th>Prix</th>
                    <td><strong>{{ $consultation->prix }} DH</strong></td>
                </tr>
            </table>
            <a href="{{ route('medecin.consultations.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>
@endsection