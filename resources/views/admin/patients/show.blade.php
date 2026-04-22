@extends('layouts.app')
@section('title', 'Dossier Patient')
@section('page-title', 'Dossier Médical')

@section('content')
    <div class="row g-4">
        <!-- Colonne Gauche: Profil -->
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4 text-center">
                    <div class="position-relative d-inline-block mb-4">
                        @if($patient->photo)
                            <img src="{{ asset('storage/' . $patient->photo) }}" class="rounded-circle shadow-md" 
                                 width="140" height="140" style="object-fit:cover; border: 4px solid var(--primary-light)">
                        @else
                            <div class="avatar-xl mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-md bg-primary-light text-primary" 
                                 style="width:140px; height:140px; font-size: 3rem;">
                                {{ strtoupper(substr($patient->prenom, 0, 1)) }}
                            </div>
                        @endif
                        <span class="position-absolute bottom-0 end-0 p-2 bg-primary rounded-circle border border-white border-4 shadow-sm">    
                            <i class="bi bi-shield-check text-white" style="font-size: 0.8rem;"></i>
                        </span>
                    </div>

                    <h3 class="fw-bold text-dark mb-1">{{ $patient->nom_complet }}</h3>
                    <p class="text-muted small mb-4">Patient ID: #P-{{ str_pad($patient->id, 4, '0', STR_PAD_LEFT) }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <span class="badge rounded-pill {{ $patient->sexe === 'homme' ? 'bg-primary-light text-primary' : 'bg-danger-light text-danger' }} px-3 py-2"
                              style="{{ $patient->sexe === 'femme' ? 'background: #fff1f2; color: #e11d48' : 'background: #eff6ff; color: #2563eb' }}">
                            {{ ucfirst($patient->sexe) }}
                        </span>
                        <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                            {{ \Carbon\Carbon::parse($patient->date_naissance)->age }} ans
                        </span>
                    </div>

                    <div class="list-group list-group-flush text-start border-top pt-3">
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-medium">CIN</span>
                            <span class="fw-bold text-secondary">{{ $patient->cin }}</span>
                        </div>
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-medium">Téléphone</span>
                            <span class="fw-bold text-secondary">{{ $patient->telephone }}</span>
                        </div>
                        <div class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                            <span class="text-muted small fw-medium">Email</span>
                            <span class="fw-bold text-secondary text-truncate" style="max-width: 180px;">{{ $patient->email ?? 'Non renseigné' }}</span>
                        </div>
                        <div class="list-group-item border-0 px-0 mt-2">
                            <span class="text-muted d-block small mb-1 fw-medium">Adresse Résidentielle</span>
                            <span class="text-secondary small">{{ $patient->adresse }}</span>
                        </div>
                    </div>

                    @if($patient->antecedents)
                        <div class="mt-4 p-3 rounded-3 bg-warning-light border-start border-warning border-4 text-start" style="background: #fffbeb;">
                            <h6 class="fw-bold text-warning-emphasis mb-1"><i class="bi bi-exclamation-triangle-fill"></i> Antécédents Médicaux</h6>
                            <p class="small text-warning-emphasis mb-0">{{ $patient->antecedents }}</p>
                        </div>
                    @endif

                    <div class="mt-4 d-grid gap-2">
                        <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-warning text-white">
                            <i class="bi bi-pencil-square me-2"></i> Modifier le dossier
                        </a>
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne Droite: Historique -->
        <div class="col-xl-8 col-lg-7">
            <!-- Onglets d'activité -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-0 py-3 px-4">
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
                            <button class="nav-link rounded-2" id="pills-factures-tab" data-bs-toggle="pill" data-bs-target="#pills-factures" type="button" role="tab">
                                <i class="bi bi-receipt me-2"></i> Factures
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
                                            <th class="ps-4">Date & Heure</th>
                                            <th>Praticien</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->rendezVous as $rdv)
                                            <tr>
                                                <td class="ps-4 fw-medium">{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                                                <td>Dr. {{ $rdv->medecin->nom_complet }}</td>
                                                <td>
                                                    <span class="badge rounded-pill @if($rdv->statut === 'confirme') bg-success @elseif($rdv->statut === 'annule') bg-danger @else bg-warning @endif">
                                                        {{ ucfirst($rdv->statut) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="text-center py-5 text-muted">Aucun rendez-vous trouvé</td></tr>
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
                                            <th>Diagnostic</th>
                                            <th class="text-end pe-4">Tarif</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->consultations as $c)
                                            <tr>
                                                <td class="ps-4 fw-medium">{{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m/Y') }}</td>
                                                <td>Dr. {{ $c->medecin->nom_complet }}</td>
                                                <td><span class="small text-muted">{{ Str::limit($c->diagnostic, 50) }}</span></td>
                                                <td class="text-end pe-4 fw-bold text-primary">{{ number_format($c->prix, 2) }} DH</td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center py-5 text-muted">Aucune consultation enregistrée</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Factures Tab -->
                        <div class="tab-pane fade" id="pills-factures" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">N° Facture</th>
                                            <th>Date d'émission</th>
                                            <th>Montant Total</th>
                                            <th class="text-end pe-4">Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($patient->factures as $f)
                                            <tr>
                                                <td class="ps-4 fw-bold text-secondary">#{{ $f->numero_facture }}</td>
                                                <td>{{ \Carbon\Carbon::parse($f->date_facture)->format('d/m/Y') }}</td>
                                                <td class="fw-bold">{{ number_format($f->montant_total, 2) }} DH</td>
                                                <td class="text-end pe-4">
                                                    <span class="badge rounded-pill @if($f->statut === 'payee') bg-success @elseif($f->statut === 'annulee') bg-danger @else bg-warning @endif">
                                                        {{ ucfirst($f->statut) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center py-5 text-muted">Aucune facture enregistrée</td></tr>
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