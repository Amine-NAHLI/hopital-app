@extends('layouts.app')
@section('title', 'Modifier RDV')
@section('page-title', 'Ajustement de l\'Agenda')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-4 px-4 border-bottom d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3" style="background: #fffbeb; color: #d97706;">
                        <i class="bi bi-calendar2-range fs-3"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold text-dark">Modification du Rendez-vous</h4>
                        <p class="text-muted small mb-0">Identifiant de planification : #RDV-{{ str_pad($rendezVous->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.rendez-vous.update', $rendezVous) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-people text-primary me-2"></i> Intervenants
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Patient <span class="text-danger">*</span></label>
                                <select name="patient_id" class="form-select bg-light @error('patient_id') is-invalid @enderror">
                                    @foreach($patients as $p)
                                        <option value="{{ $p->id }}" {{ old('patient_id', $rendezVous->patient_id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nom_complet }} ({{ $p->cin }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('patient_id') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Médecin Praticien <span class="text-danger">*</span></label>
                                <select name="medecin_id" class="form-select bg-light @error('medecin_id') is-invalid @enderror">
                                    @foreach($medecins as $m)
                                        <option value="{{ $m->id }}" {{ old('medecin_id', $rendezVous->medecin_id) == $m->id ? 'selected' : '' }}>
                                            Dr. {{ $m->nom_complet }} — {{ $m->specialite }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('medecin_id') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-clock-history text-primary me-2"></i> Temps & Statut
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Date & Heure <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-calendar3"></i></span>
                                    <input type="datetime-local" name="date_heure" class="form-control bg-light @error('date_heure') is-invalid @enderror"
                                        value="{{ old('date_heure', $rendezVous->date_heure->format('Y-m-d\TH:i')) }}">
                                </div>
                                @error('date_heure') <div class="text-danger x-small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Statut Actuel <span class="text-danger">*</span></label>
                                <select name="statut" class="form-select @error('statut') is-invalid @enderror" style="background-color: #f8fafc;">
                                    @foreach(['en_attente' => 'En attente', 'confirme' => 'Confirmé', 'annule' => 'Annulé', 'termine' => 'Terminé'] as $val => $lab)
                                        <option value="{{ $val }}" {{ old('statut', $rendezVous->statut) === $val ? 'selected' : '' }}>
                                            {{ $lab }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-4 mb-4">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-chat-left-text text-primary me-2"></i> Notes & Motif
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Motif de la visite</label>
                                <textarea name="motif" class="form-control" rows="4" 
                                          placeholder="Précisez la raison du rendez-vous ou des notes particulières...">{{ old('motif', $rendezVous->motif) }}</textarea>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.rendez-vous.index') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-warning px-5 shadow text-white fw-bold">
                                <i class="bi bi-check-circle me-2"></i> Mettre à jour le rendez-vous
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection