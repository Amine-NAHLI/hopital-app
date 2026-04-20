@extends('layouts.app')
@section('title', 'Ordonnances')
@section('page-title', 'Gestion des Ordonnances')

@section('content')
    <div class="card">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-file-medical"></i> Liste des Ordonnances</span>
            <a href="{{ route('admin.ordonnances.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouvelle Ordonnance
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Médecin</th>
                        <th>Date</th>
                        <th>Médicaments</th>
                        <th>Fichier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ordonnances as $o)
                        <tr>
                            <td>{{ $o->id }}</td>
                            <td>{{ $o->patient->nom_complet }}</td>
                            <td>{{ $o->medecin->nom_complet }}</td>
                            <td>{{ \Carbon\Carbon::parse($o->date_ordonnance)->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($o->medicaments, 40) }}</td>
                            <td>
                                @if($o->fichier)
                                    <a href="{{ asset('storage/' . $o->fichier) }}" target="_blank"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-file-pdf"></i> PDF
                                    </a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.ordonnances.show', $o) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.ordonnances.edit', $o) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.ordonnances.destroy', $o) }}" class="d-inline"
                                    onsubmit="return confirm('Supprimer cette ordonnance ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucune ordonnance.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $ordonnances->links() }}
        </div>
    </div>
@endsection