@extends('layouts.app')
@section('title', 'Mes Consultations')
@section('page-title', 'Mes Consultations')

@section('content')
    <div class="card">
        <div class="card-header text-white d-flex justify-content-between" style="background:#4527a0">
            <span><i class="bi bi-clipboard2-pulse"></i> Mes Consultations</span>
            <a href="{{ route('medecin.consultations.create') }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Nouvelle
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Diagnostic</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($consultations as $c)
                        <tr>
                            <td>{{ $c->patient->nom_complet }}</td>
                            <td>{{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($c->diagnostic, 40) }}</td>
                            <td>{{ $c->prix }} DH</td>
                            <td>
                                <a href="{{ route('medecin.consultations.show', $c) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucune consultation.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $consultations->links() }}
        </div>
    </div>
@endsection