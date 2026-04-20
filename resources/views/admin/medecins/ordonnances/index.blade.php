@extends('layouts.app')
@section('title', 'Mes Ordonnances')
@section('page-title', 'Mes Ordonnances')

@section('content')
    <div class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between">
            <span><i class="bi bi-file-medical"></i> Mes Ordonnances</span>
            <a href="{{ route('medecin.ordonnances.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouvelle
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Médicaments</th>
                        <th>Fichier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordonnances as $o)
                        <tr>
                            <td>{{ $o->patient->nom_complet }}</td>
                            <td>{{ \Carbon\Carbon::parse($o->date_ordonnance)->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($o->medicaments, 40) }}</td>
                            <td>
                                @if($o->fichier)
                                    <a href="{{ asset('storage/' . $o->fichier) }}" target="_blank"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-file-pdf"></i>
                                    </a>
                                @else — @endif
                            </td>
                            <td>
                                <a href="{{ route('medecin.ordonnances.show', $o) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucune ordonnance.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $ordonnances->links() }}
        </div>
    </div>
@endsection