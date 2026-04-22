@extends('layouts.app')
@section('title', 'Patients')
@section('page-title', 'Gestion des Patients')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <span><i class="bi bi-people"></i> Liste des Patients</span>
            <a href="{{ route('admin.patients.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouveau Patient
            </a>
        </div>
        <div class="card-body">
            <form method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, prenom ou CIN..."
                        value="{{ $search }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                    @if($search)
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i> Effacer
                        </a>
                    @endif
                </div>
            </form>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Nom Complet</th>
                        <th>CIN</th>
                        <th>Telephone</th>
                        <th>Sexe</th>
                        <th>Date Naissance</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>{{ $patient->id }}</td>
                            <td>
                                @if($patient->photo)
                                    <img src="{{ asset('storage/' . $patient->photo) }}" class="rounded-circle" width="40" height="40"
                                        style="object-fit:cover">
                                @else
                                    <div class="avatar-circle" style="background: linear-gradient(135deg, #0f766e, #14b8a6);">
                                        {{ strtoupper(substr($patient->prenom, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td>{{ $patient->nom_complet }}</td>
                            <td>{{ $patient->cin }}</td>
                            <td>{{ $patient->telephone }}</td>
                            <td>
                                <span class="badge bg-{{ $patient->sexe === 'homme' ? 'primary' : 'danger' }}">
                                    {{ ucfirst($patient->sexe) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.patients.show', $patient) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.patients.destroy', $patient) }}" class="d-inline"
                                    onsubmit="return confirm('Supprimer ce patient ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Aucun patient trouve.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $patients->links() }}
        </div>
    </div>
@endsection