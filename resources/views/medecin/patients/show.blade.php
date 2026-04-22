@extends('layouts.app')
@section('title', 'Dossier Médical')
@section('page-title', 'Dossier Patient — Espace Praticien')

@section('content')
    <div class="row g-4">
        <!-- Colonne Gauche: Profil Médical -->
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm mb-4 h-100">
                <div class="card-body p-4 text-center">
                    <div class="position-relative d-inline-block mb-4">
                        @if($patient->photo)
                            <img src="{{ asset('storage/' . $patient->photo) }}" class="rounded-circle shadow-md" 
                                 width="140" height="140" style="object-fit:cover; border: 4px solid #f5f3ff;">
                        @else
                            <div class="avatar-xl mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-md bg-accent-soft text-accent" 
                                 style="width:140px; height:140px; font-size: 3rem; background: #ecfeff; color: #0891b2">
                                {{ strtoupper(substr($patient->prenom, 0, 1)) }}
                            </div>
                        @endif
                        <span class="position-absolute bottom-0 end-0 p-2 bg-primary rounded-circle border border-white border-4 shadow-sm">
                            <i class="bi bi-shield-check text-white" style="font-size: 0.8rem;"></i>
                        </span>
                    </div>

                    <h3 class="fw-bold text-dark mb-1">{{ $patient->nom_complet }}</h3>
                    <p class="text-muted small mb-4">Dossier Médical #D-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge rounded-pill {{ $patient->sexe === 'homme' ? 'bg-primary-light text-primary' : 'bg-danger-light text-danger' }} px-3 py-2"
                              style="{{ $patient->sexe === 'femme' ? 'background: #fff1f2; color: #e11d48' : 'background: #eff6ff; color: #2563eb' }}">
                            {{ ucfirst($patient->sexe) }}
                        </span>
                        <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                            {{ \Carbon\Carbon::parse($patient->date_naissance)->age }} ans
                        </span>
                    </div>

                    <div class="list-group list-group-flush text-start border-top pt-3 mb-4">
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-medium">CIN / Identifiant</span>
                            <span class="fw-bold text-secondary">{{ $patient->cin }}</span>
                        </div>
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-medium">Téléphone Patient</span>
                            <span class="fw-bold text-secondary">{{ $p->telephone ?? 'N/A' }}</span>
                        </div>
                        <div class="list-group-item border-0 px-0 mt-2">
                            <span class="text-muted d-block small mb-1 fw-medium">Résumé des Antécédents</span>
                            <div class="p-3 rounded-3 bg-warning-light border-start border-warning border-4" style="background: #fffbeb;">
                                <p class="small text-dark mb-0">{{ $patient->antecedents ?? 'Aucun antécédent renseigné.' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('medecin.consultations.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary shadow-sm">
                            <i class="bi bi-plus-circle me-2"></i> Nouvelle Consultation
                        </a>
                        <a href="{{ route('medecin.patients.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne Droite: Historique Clinique -->
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3 px-4 pt-4">
                    <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-activity text-primary me-2"></i> Activité Médicale Récente</h5>
                    <ul class="nav nav-pills nav-fill bg-light p-1 rounded-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-2" id="pills-rdv-tab" data-bs-toggle="pill" data-bs-target="#pills-rdv" type="button" role="tab">
                                <i class="bi bi-calendar-check me-2"></i> Rendez-vous
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-2" id="pills-consult-tab" data-bs-toggle="pill" data-bs-target="#pills-consult" type="button" role="tab">
                                <i class="bi bi-clipboard2-pulse me-2"></i> Consultations
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-2" id="pills-presc-tab" data-bs-toggle="pill" data-bs-target="#pills-presc" type="button" role="tab">
                                <i class="bi bi-file-medical me-2"></i> Ordonnances
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-0">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Rendez-vous Tab -->
                        <div class="tab-pane fade show active" id="pills-rdv" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Date</th>
                                            <th>Praticien</th>
                                            <th class="text-end pe-4">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->rendezVous->sortByDesc('date_heure') as $rdv)
                                            <tr>
                                                <td class="ps-4 fw-medium">{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                                                <td>Dr. {{ $rdv->medecin->nom_complet }}</td>
                                                <td class="text-end pe-4">
                                                    <span class="badge rounded-pill @if($rdv->statut === 'confirme') bg-success @elseif($rdv->statut === 'annule') bg-danger @else bg-warning @endif">
                                                        {{ ucfirst($rdv->statut) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="text-center py-5 text-muted">Aucun rendez-vous planifié</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Consultations Tab -->
                        <div class="tab-pane fade" id="pills-consult" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Date</th>
                                            <th>Médecin</th>
                                            <th>Diagnostic / Notes</th>
                                            <th class="text-end pe-4">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->consultations->sortByDesc('date_consultation') as $c)
                                            <tr>
                                                <td class="ps-4 fw-medium">{{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m/Y') }}</td>
                                                <td>Dr. {{ $c->medecin->nom_complet }}</td>
                                                <td><span class="small text-muted">{{ Str::limit($c->diagnostic, 60) }}</span></td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('medecin.consultations.show', $c) }}" class="btn btn-sm btn-light border">
                                                        Voir
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center py-5 text-muted">Aucune consultation passée</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Ordonnances Tab -->
                        <div class="tab-pane fade" id="pills-presc" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Date</th>
                                            <th>Médecin Émetteur</th>
                                            <th>Aperçu</th>
                                            <th class="text-end pe-4">Fichier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->ordonnances->sortByDesc('date_ordonnance') as $o)
                                            <tr>
                                                <td class="ps-4 fw-medium">{{ \Carbon\Carbon::parse($o->date_ordonnance)->format('d/m/Y') }}</td>
                                                <td>Dr. {{ $o->medecin->nom_complet }}</td>
                                                <td><span class="small text-muted">{{ Str::limit($o->medicaments, 40) }}</span></td>
                                                <td class="text-end pe-4">
                                                    @if($o->fichier)
                                                        <a href="{{ asset('storage/' . $o->fichier) }}" target="_blank" class="text-danger">
                                                            <i class="bi bi-file-pdf fs-5"></i>
                                                        </a>
                                                    @else
                                                        <span class="text-muted small">N/A</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center py-5 text-muted">Aucune ordonnance émise</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
