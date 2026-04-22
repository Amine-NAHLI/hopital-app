@extends('layouts.app')
@section('title', 'Gestion du Calendrier')
@section('page-title', 'Rendez-vous Hospitaliers')

@section('content')
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-bottom">
            <div>
                <h4 class="mb-0 fw-bold text-dark">Planning des Consultations</h4>
                <p class="text-muted small mb-0">Suivi et gestion des rendez-vous par patient et praticien</p>
            </div>
            <a href="{{ route('admin.rendez-vous.create') }}" class="btn btn-primary px-4 shadow-sm rounded-3">
                <i class="bi bi-calendar-plus me-2"></i> Nouveau Rendez-vous
            </a>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary small fw-bold text-uppercase">
                            <th class="ps-4 py-3">ID / Référence</th>
                            <th class="py-3">Patient</th>
                            <th class="py-3">Praticien</th>
                            <th class="py-3">Date & Heure</th>
                            <th class="py-3">Statut</th>
                            <th class="text-end pe-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rendezVous as $rdv)
                            <tr>
                                <td class="ps-4">
                                    <span class="badge bg-light text-secondary border px-2 py-1">#RDV-{{ str_pad($rdv->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm rounded-circle bg-primary-light text-primary d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 38px; height: 38px; background: #eef2ff;">
                                            {{ strtoupper(substr($rdv->patient->prenom, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $rdv->patient->nom_complet }}</div>
                                            <div class="x-small text-muted">CIN: {{ $rdv->patient->cin }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium text-secondary">
                                        <i class="bi bi-person-badge me-2 text-primary"></i>Dr. {{ $rdv->medecin->nom_complet }}
                                    </div>
                                    <span class="x-small text-muted ms-4">{{ $rdv->medecin->specialite }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark"><i class="bi bi-calendar3 me-2 text-muted"></i>{{ $rdv->date_heure->format('d M Y') }}</span>
                                        <span class="small text-primary fw-medium ms-4">{{ $rdv->date_heure->format('H:i') }}</span>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $statusConfig = [
                                            'en_attente' => ['class' => 'bg-warning-light text-warning', 'label' => 'En attente', 'dot' => '#f59e0b'],
                                            'confirme' => ['class' => 'bg-success-light text-success', 'label' => 'Confirmé', 'dot' => '#10b981'],
                                            'termine' => ['class' => 'bg-info-light text-info', 'label' => 'Terminé', 'dot' => '#06b6d4'],
                                            'annule' => ['class' => 'bg-danger-light text-danger', 'label' => 'Annulé', 'dot' => '#ef4444'],
                                        ][$rdv->statut] ?? ['class' => 'bg-light text-muted', 'label' => ucfirst($rdv->statut), 'dot' => '#64748b'];
                                    @endphp
                                    <span class="badge {{ $statusConfig['class'] }} rounded-pill px-3 py-2 d-inline-flex align-items-center" 
                                          style="background-color: {{ str_replace('text-', '', $statusConfig['class']) === 'success' ? '#ecfdf5' : (str_replace('text-', '', $statusConfig['class']) === 'warning' ? '#fffbeb' : (str_replace('text-', '', $statusConfig['class']) === 'danger' ? '#fef2f2' : '#ecfeff')) }}; 
                                                 color: {{ $statusConfig['dot'] }}">
                                        <span class="rounded-circle me-2" style="width: 8px; height: 8px; background: {{ $statusConfig['dot'] }}"></span>
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('admin.rendez-vous.show', $rdv) }}" class="btn btn-icon-hover" title="Détails">
                                            <i class="bi bi-eye text-primary"></i>
                                        </a>
                                        <a href="{{ route('admin.rendez-vous.edit', $rdv) }}" class="btn btn-icon-hover" title="Modifier">
                                            <i class="bi bi-pencil-square text-warning"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.rendez-vous.destroy', $rdv) }}" class="d-inline" onsubmit="return confirm('Supprimer ce rendez-vous ?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-icon-hover" title="Supprimer">
                                                <i class="bi bi-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="bi bi-calendar-x text-muted display-4 mb-3 d-block"></i>
                                        <h5 class="text-secondary">Aucun rendez-vous trouvé</h5>
                                        <p class="text-muted small">Les rendez-vous planifiés apparaîtront dans cette liste.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($rendezVous->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $rendezVous->links() }}
            </div>
        @endif
    </div>

    <style>
        .btn-icon-hover {
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px; border: 1px solid transparent;
            transition: all 0.2s ease; background: transparent;
        }
        .btn-icon-hover:hover {
            background: #f8fafc; border-color: #e2e8f0; transform: translateY(-1px);
        }
        .bg-primary-light { background-color: #eef2ff; }
        .x-small { font-size: 0.75rem; }
    </style>
@endsection