@extends('layouts.app')
@section('title', 'Facture Détails')
@section('page-title', 'Gestion de Facturation')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
            <div class="card border-0 shadow-sm overflow-hidden mb-4">
                <!-- Header style Facture -->
                <div class="card-header bg-dark py-5 px-5 text-white">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="fw-bold mb-1">MediCore<span class="text-accent" style="color: var(--accent)">Pro</span></h2>
                            <p class="text-secondary small mb-0">Hôpital Privé de Spécialités</p>
                            <p class="x-small text-secondary mb-0">Casablanca, Maroc | +212 5 22 00 00 00</p>
                        </div>
                        <div class="text-end">
                            <h1 class="display-6 fw-bold mb-0">FACTURE</h1>
                            <p class="fs-5 mb-0">N° {{ $facture->numero_facture }}</p>
                            <span class="badge {{ $facture->statut === 'payee' ? 'bg-success' : 'bg-warning' }} mt-2 px-3 py-2 rounded-pill shadow-sm">
                                {{ strtoupper($facture->statut) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <div class="row mb-5">
                        <div class="col-sm-6">
                            <h6 class="text-muted text-uppercase fw-bold small mb-3">Facturé à :</h6>
                            <h5 class="fw-bold text-dark mb-1">{{ $facture->patient->nom_complet }}</h5>
                            <p class="text-muted mb-1">{{ $facture->patient->adresse }}</p>
                            <p class="text-muted small">Tél: {{ $facture->patient->telephone }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="text-muted text-uppercase fw-bold small mb-3">Détails :</h6>
                            <p class="text-dark mb-1"><strong>Date :</strong> {{ \Carbon\Carbon::parse($facture->date_facture)->format('d/m/Y') }}</p>
                            <p class="text-dark mb-1"><strong>Mode :</strong> {{ $facture->mode_paiement ? ucfirst($facture->mode_paiement) : 'Non défini' }}</p>
                            <p class="text-dark"><strong>Praticien :</strong> Dr. {{ $facture->consultation->medecin->nom_complet }}</p>
                        </div>
                    </div>

                    <div class="table-responsive mb-5">
                        <table class="table table-borderless align-middle">
                            <thead class="border-bottom">
                                <tr class="text-muted small text-uppercase">
                                    <th class="py-3">Description du service</th>
                                    <th class="py-3 text-center">Quantité</th>
                                    <th class="py-3 text-end">Prix Unitaire</th>
                                    <th class="py-3 text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="py-4">
                                        <h6 class="fw-bold mb-1">Consultation Médicale</h6>
                                        <p class="text-muted small mb-0">Examen clinique et diagnostic du {{ \Carbon\Carbon::parse($facture->consultation->date_consultation)->format('d/m/Y') }}</p>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-end">{{ number_format($facture->montant_total, 2) }} DH</td>
                                    <td class="text-end fw-bold text-dark">{{ number_format($facture->montant_total, 2) }} DH</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-end py-3 text-muted">Sous-total</td>
                                    <td class="text-end py-3 fw-bold">{{ number_format($facture->montant_total, 2) }} DH</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="text-end py-2 text-muted">TVA (0%)</td>
                                    <td class="text-end py-2 fw-bold">0.00 DH</td>
                                </tr>
                                <tr class="border-top">
                                    <td colspan="2"></td>
                                    <td class="text-end py-4 fw-bold fs-5 text-dark">TOTAL NET</td>
                                    <td class="text-end py-4 fw-bold fs-4 text-primary">{{ number_format($facture->montant_total, 2) }} DH</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="p-4 rounded-3 bg-light border-start border-primary border-4 mb-4">
                        <h6 class="fw-bold text-dark mb-2">Note au patient :</h6>
                        <p class="small text-muted mb-0">Merci de conserver cette facture pour vos remboursements mutuelle. En cas de question, contactez notre service comptabilité.</p>
                    </div>
                </div>

                <div class="card-footer bg-white border-top p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.factures.edit', $facture) }}" class="btn btn-warning text-white px-4">
                                <i class="bi bi-pencil-square me-2"></i> Modifier Statut
                            </a>
                            <button onclick="window.print()" class="btn btn-outline-dark px-4">
                                <i class="bi bi-printer me-2"></i> Imprimer
                            </button>
                        </div>
                        <a href="{{ route('admin.factures.index') }}" class="btn btn-link text-muted text-decoration-none">
                            <i class="bi bi-arrow-left"></i> Retour à la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .sidebar-wrapper, .topbar, .card-footer, .btn, .btn-link, footer { display: none !important; }
            .main-content { padding: 0 !important; margin: 0 !important; width: 100% !important; }
            .card { border: none !important; box-shadow: none !important; margin: 0 !important; }
            .card-header { background-color: #212529 !important; color: white !important; -webkit-print-color-adjust: exact; }
            body { background: white !important; }
        }
    </style>
@endsection