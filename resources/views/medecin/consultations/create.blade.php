@extends('layouts.app')
@section('title', 'Nouvelle Consultation')
@section('page-title', 'Examen Clinique')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-4 px-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="rounded-3 p-3 me-3" style="background: #f5f3ff; color: #7c3aed;">
                            <i class="bi bi-clipboard2-plus-fill fs-3"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold text-secondary">Rapport de Consultation</h4>
                            <p class="text-muted small mb-0">Renseignez les observations cliniques et le traitement pour le patient.</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('medecin.consultations.store') }}">
                        @csrf
                        <input type="hidden" name="medecin_id" value="{{ auth()->user()->medecin->id }}">
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-person-check text-primary me-2"></i> Informations Patient
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Sélectionner le Rendez-vous <span class="text-danger">*</span></label>
                                <select name="rendez_vous_id" id="select_rdv" class="form-select bg-light @error('rendez_vous_id') is-invalid @enderror">
                                    <option value="">-- Choisir le rendez-vous --</option>
                                    @foreach($rendezVous as $rdv)
                                        <option value="{{ $rdv->id }}" data-patient-id="{{ $rdv->patient_id }}" data-patient-nom="{{ $rdv->patient->nom_complet }}" data-patient-info="{{ $rdv->patient->sexe ?? 'Sexe NC' }}, {{ $rdv->patient->date_naissance ? \Carbon\Carbon::parse($rdv->patient->date_naissance)->age . ' ans' : 'Age NC' }} | Antécédents : {{ substr($rdv->patient->antecedents ?? 'Aucun', 0, 45) }}" {{ (old('rendez_vous_id') == $rdv->id || request('rendez_vous_id') == $rdv->id) ? 'selected' : '' }}>
                                            {{ $rdv->patient->nom_complet }} — {{ $rdv->date_heure->format('d/m/Y H:i') }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('rendez_vous_id')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Patient Associé</label>
                                <div id="patient_badge" class="p-2 px-3 rounded-3 bg-light border d-flex align-items-center overflow-hidden" style="height: 45px;">
                                    <i class="bi bi-person-badge text-primary me-2 fs-5"></i>
                                    <span id="patient_badge_text" class="fw-bold text-dark text-truncate small">Sélectionnez d'abord un rendez-vous</span>
                                </div>
                                <input type="hidden" name="patient_id" id="hidden_patient_id" value="{{ old('patient_id', request('patient_id')) }}">
                                @error('patient_id')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-secondary">Date de l'examen <span class="text-danger">*</span></label>
                                <input type="date" name="date_consultation" class="form-control bg-light"
                                       value="{{ old('date_consultation', date('Y-m-d')) }}">
                            </div>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                    <i class="bi bi-activity text-primary me-2"></i> Observations Cliniques
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold text-secondary">Diagnostic & Analyse <span class="text-danger">*</span></label>
                                <textarea name="diagnostic" id="diagnostic_field" class="form-control bg-light @error('diagnostic') is-invalid @enderror" 
                                          rows="5" placeholder="Symptômes décrits, signes cliniques, diagnostic suspecté ou confirmé...">{{ old('diagnostic') }}</textarea>
                                @error('diagnostic')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold text-secondary mb-0">Traitement & Prescriptions</label>
                                    <button type="button" id="btn_ai_treatment" class="btn btn-sm btn-nova btn-nova-primary py-2 px-3 fs-7 shadow-sm" style="border-radius: 10px;">
                                        <i class="bi bi-stars animate-pulse me-1"></i> Générer le traitement avec l'IA
                                    </button>
                                </div>
                                <textarea name="traitement" id="traitement_field" class="form-control" rows="5" placeholder="Détail du traitement, posologie, examens complémentaires à effectuer..."></textarea>
                            </div>
                        </div>

                        <div class="row g-4 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Honoraires (DH) <span class="text-danger">*</span></label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-white fw-bold">DH</span>
                                    <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror"
                                           value="{{ old('prix', 200) }}" min="0" step="0.01">
                                </div>
                                @error('prix')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-8">
                                <div class="p-3 rounded-3 bg-light border-start border-primary border-4">
                                    <p class="small mb-0 text-muted">
                                        <i class="bi bi-info-circle-fill text-primary me-1"></i>
                                        En validant ce rapport, le rendez-vous sera marqué comme <strong>terminé</strong> et une facture sera automatiquement générée par le système.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-5 d-flex justify-content-end gap-3">
                            <a href="{{ route('medecin.dashboard') }}" class="btn btn-outline-secondary px-4">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="bi bi-check2-all me-2"></i> Enregistrer la Consultation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectRdv = document.getElementById('select_rdv');
        const hiddenPatientId = document.getElementById('hidden_patient_id');
        const patientBadgeText = document.getElementById('patient_badge_text');
        const btnAiTreatment = document.getElementById('btn_ai_treatment');
        const diagnosticField = document.getElementById('diagnostic_field');
        const traitementField = document.getElementById('traitement_field');

        let patientContextStr = '';

        function updatePatientSelection() {
            const selectedOption = selectRdv.options[selectRdv.selectedIndex];
            if (!selectedOption || !selectedOption.value) {
                hiddenPatientId.value = '';
                patientBadgeText.innerHTML = '<span class="text-muted small">Sélectionnez d\'abord un rendez-vous</span>';
                patientContextStr = '';
                return;
            }

            const patientId = selectedOption.getAttribute('data-patient-id');
            const patientNom = selectedOption.getAttribute('data-patient-nom');
            const patientInfo = selectedOption.getAttribute('data-patient-info');

            hiddenPatientId.value = patientId;
            patientBadgeText.innerHTML = `${patientNom} <span class="text-muted fw-normal ms-2 small">(${patientInfo})</span>`;
            patientContextStr = `Patient: ${patientNom}, ${patientInfo}`;
        }

        selectRdv.addEventListener('change', updatePatientSelection);
        updatePatientSelection();

        btnAiTreatment.addEventListener('click', async function () {
            const diagnostic = diagnosticField.value.trim();
            if (!diagnostic) {
                alert('Veuillez d\'abord rédiger vos observations / diagnostic.');
                diagnosticField.focus();
                return;
            }

            const originalHtml = btnAiTreatment.innerHTML;
            btnAiTreatment.disabled = true;
            btnAiTreatment.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> IA Groq en cours...';

            try {
                const res = await fetch('{{ route("medecin.ai.generate_treatment") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        diagnostic: diagnostic,
                        patient_context: patientContextStr
                    })
                });

                const data = await res.json();
                if (res.ok && data.status === 'success') {
                    traitementField.value = data.result;
                    traitementField.style.transition = 'all 0.5s';
                    traitementField.style.borderColor = '#6366f1';
                    traitementField.style.backgroundColor = '#f1f5f9';
                    setTimeout(() => { 
                        traitementField.style.borderColor = ''; 
                        traitementField.style.backgroundColor = ''; 
                    }, 2000);
                } else {
                    alert('Erreur IA : ' + (data.message || 'Impossible de générer le traitement.'));
                }
            } catch (e) {
                alert('Erreur réseau ou serveur inaccessible.');
                console.error(e);
            } finally {
                btnAiTreatment.disabled = false;
                btnAiTreatment.innerHTML = originalHtml;
            }
        });
    });
</script>
@endpush
@endsection
