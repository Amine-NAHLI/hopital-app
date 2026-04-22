@extends('layouts.app')
@section('title', 'Consultations')
@section('page-title', 'Gestion des Consultations')

@section('content')
    <div class="card">
        <div class="card-header text-white d-flex justify-content-between align-items-center"
            style="background: linear-gradient(135deg, #7c3aed, #6d28d9)">
            <span><i class="bi bi-clipboard2-pulse"></i> Liste des Consultations</span>
            <a href="{{ route('admin.consultations.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouvelle Consultation
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Medecin</th>
                        <th>Date</th>
                        <th>Diagnostic</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($consultations as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->patient->nom_complet }}</td>
                            <td>{{ $c->medecin->nom_complet }}</td>
                            <td>{{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($c->diagnostic, 40) }}</td>
                            <td><strong>{{ $c->prix }} DH</strong></td>
                            <td>
                                <a href="{{ route('admin.consultations.show', $c) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.consultations.edit', $c) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.consultations.destroy', $c) }}" class="d-inline"
                                    onsubmit="return confirm('Supprimer cette consultation ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucune consultation.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $consultations->links() }}
        </div>
    </div>
@endsection