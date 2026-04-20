@extends('layouts.app')
@section('title', 'Mes Patients')
@section('page-title', 'Mes Patients')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-people"></i> Liste des Patients
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>CIN</th>
                        <th>Téléphone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $p)
                        <tr>
                            <td>{{ $p->nom_complet }}</td>
                            <td>{{ $p->cin }}</td>
                            <td>{{ $p->telephone }}</td>
                            <td>
                                <a href="{{ route('medecin.patients.show', $p) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucun patient.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $patients->links() }}
        </div>
    </div>
@endsection