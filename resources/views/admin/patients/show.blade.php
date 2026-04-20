@extends('layouts.app')
@section('title', 'Fiche Patient')
@section('page-title', 'Fiche Patient')

@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    @if($patient->photo)
                        <img src="{{ asset('storage/' . $patient->photo) }}" class="rounded-circle mb-3" width="120" height="120"
                            style="object-fit:cover">
                    @else
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center
                                        justify-content-center mx-auto mb-3" style="width:120px;height:120px;font-size:40px">
                            {{ strtoupper(substr($patient->prenom, 0, 1)) }}
                        </div>
                    @endif
                    <h4>{{ $patient->nom_complet }}</h4>
                    <span class="badge bg-{{ $patient->sexe === 'homme' ? 'primary' : 'danger' }}">
                        {{ ucfirst($patient->sexe) }}
                    </span>
                    <hr>
                    <table class="table table-sm text-start">
                        <tr>
                            <th>CIN</th>
                            <td>{{ $patient->cin }}</td>
                        </tr>
                        <tr>
                            <th>Né(e) le</th>
                            <td>{{ \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Téléphone</th>
                            <td>{{ $patient->telephone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $patient->email ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Adresse</th>
                            <td>{{ $patient->adresse }}</td>
                        </tr>
                    </table>
                    @if($patient->antecedents)
                        <div class="alert alert-warning text-start mt-2">
                            <strong><i class="bi bi-exclamation-triangle"></i> Antécédents :</strong><br>
                            {{ $patient->antecedents }}
                        </div>
                    @endif
                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <i class="bi bi-calendar-check"></i> Rendez-vous
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Médecin</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patient->rendezVous as $rdv)
                                <tr>
                                    <td>{{ $rdv->date_heure->format('d/m/Y H:i') }}</td>
                                    <td>{{ $rdv->medecin->nom_complet }}</td>
                                    <td><span class="badge bg-success">{{ $rdv->statut }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Aucun rendez-vous</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <i class="bi bi-clipboard2-pulse"></i> Consultations
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Médecin</th>
                                <th>Diagnostic</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patient->consultations as $c)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m/Y') }}</td>
                                    <td>{{ $c->medecin->nom_complet }}</td>
                                    <td>{{ Str::limit($c->diagnostic, 40) }}</td>
                                    <td>{{ $c->prix }} DH</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucune consultation</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-warning">
                    <i class="bi bi-receipt"></i> Factures
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patient->factures as $f)
                                <tr>
                                    <td>{{ $f->numero_facture }}</td>
                                    <td>{{ \Carbon\Carbon::parse($f->date_facture)->format('d/m/Y') }}</td>
                                    <td>{{ $f->montant_total }} DH</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $f->statut === 'payee' ? 'success' : ($f->statut === 'annulee' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($f->statut) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Aucune facture</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection