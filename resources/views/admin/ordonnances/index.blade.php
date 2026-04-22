@extends('layouts.app')
@section('title', 'Ordonnances')
@section('page-title', 'Registre des Prescriptions')

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold text-secondary">Suivi des Ordonnances</h4>
                <p class="text-muted small mb-0">Gestion et archivage des prescriptions médicales</p>
            </div>
            <a href="{{ route('admin.ordonnances.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-file-earmark-medical me-2"></i> Nouvelle Prescription
            </a>
        </div>
        <div class="card-body px-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr class="bg-light">
                            <th class="ps-4">Référence</th>
                            <th>Bénéficiaire</th>
                            <th>Praticien émetteur</th>
                            <th>Date d'émission</th>
                            <th>Médicaments prescrits</th>
                            <th>Document</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ordonnances as $o)
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-light text-secondary border px-2 py-1">ORD-{{ str_pad($o->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $o->patient->nom_complet }}</div>
                                    <span class="text-muted small">Dossier #P-{{ str_pad($o->patient->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info-light rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                             style="width:32px; height:32px; background: #e0f2fe; color: #0369a1;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <span class="fw-medium text-secondary">Dr. {{ $o->medecin->nom_complet }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark small">
                                        <i class="bi bi-calendar-check text-muted me-1"></i>
                                        {{ \Carbon\Carbon::parse($o->date_ordonnance)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted small" title="{{ $o->medicaments }}">
                                        {{ Str::limit($o->medicaments, 35) }}
                                    </span>
                                </td>
                                <td>
                                    @if($o->fichier)
                                        <a href="{{ asset('storage/' . $o->fichier) }}" target="_blank"
                                           class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-filetype-pdf fs-6"></i> Visualiser
                                        </a>
                                    @else
                                        <span class="badge bg-light text-muted fw-normal border">Aucun scan</span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group shadow-sm rounded">
                                        <a href="{{ route('admin.ordonnances.show', $o) }}" class="btn btn-sm btn-white border" title="Détails">
                                            <i class="bi bi-eye-fill text-info"></i>
                                        </a>
                                        <a href="{{ route('admin.ordonnances.edit', $o) }}" class="btn btn-sm btn-white border" title="Modifier">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.ordonnances.destroy', $o) }}" class="d-inline"
                                              onsubmit="return confirm('Supprimer définitivement cette ordonnance ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-white border" title="Supprimer">
                                                <i class="bi bi-trash3-fill text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted py-4">
                                        <i class="bi bi-file-earmark-excel fs-1 d-block mb-2"></i>
                                        Aucune ordonnance n'a été émise à ce jour.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $ordonnances->links() }}
            </div>
        </div>
    </div>
@endsection