@extends('layouts.app')
@section('title', 'Patient')
@section('page-title', 'Fiche Patient')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-person"></i> {{ $patient->nom_complet }}
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>CIN</th>
                    <td>{{ $patient->cin }}</td>
                </tr>
                <tr>
                    <th>Date naissance</th>
                    <td>{{ \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Téléphone</th>
                    <td>{{ $patient->telephone }}</td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td>{{ $patient->adresse }}</td>
                </tr>
                <tr>
                    <th>Antécédents</th>
                    <td>{{ $patient->antecedents ?? '—' }}</td>
                </tr>
            </table>
            <a href="{{ route('medecin.patients.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>
@endsection