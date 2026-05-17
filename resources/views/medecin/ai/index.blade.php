@extends('layouts.app')
@section('title', 'Assistant IA Clinique — MediCore Nova')

@section('content')
<div class="page-header-nova mb-4">
    <div>
        <div class="d-flex align-items-center gap-3">
            <div class="stat-icon-nova mb-0" style="background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; width: 54px; height: 54px; box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);">
                <i class="bi bi-robot fs-3 animate-pulse"></i>
            </div>
            <div>
                <h1 class="mb-1">Assistant <span style="background: linear-gradient(135deg, #6366f1, #0ea5e9); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">IA Clinique</span></h1>
                <p class="text-muted mb-0">Deuxième avis diagnostique, e-prescription assistée et rédaction automatisée propulsés par Groq & Llama 3.3 70B.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Colonne Saisie & Options -->
    <div class="col-lg-6">
        <div class="card-nova d-flex flex-column gap-4">
            <div class="border-bottom pb-3 d-flex justify-content-between align-items-center">
                <h4 class="fw-800 mb-0" style="font-family: 'Sora', sans-serif;">
                    <i class="bi bi-clipboard-data text-primary me-2"></i> Données Cliniques
                </h4>
                <span class="badge-nova bg-primary-subtle text-primary">⚡ Groq Llama 3.3 70B</span>
            </div>

            <!-- Chargement rapide depuis consultation ou patient -->
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-secondary small">Importer d'une Consultation passée</label>
                    <select id="select-consultation" class="form-select bg-light">
                        <option value="">-- Sélectionner une consultation --</option>
                        @foreach($consultations as $c)
                            <option value="{{ $c->id }}">
                                {{ $c->patient->nom_complet }} ({{ \Carbon\Carbon::parse($c->date_consultation)->format('d/m') }}) - {{ substr($c->diagnostic ?? 'Examen', 0, 25) }}...
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-secondary small">Associer un Patient spécifique</label>
                    <select id="select-patient" class="form-select bg-light">
                        <option value="">-- Choisir un patient --</option>
                        @foreach($patients as $p)
                            <option value="{{ $p->id }}">{{ $p->nom_complet }} (CIN: {{ $p->cin }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Contexte Patient Affiché -->
            <div id="patient-context-box" class="p-3 rounded-4" style="background: #f8fafc; border: 1px solid rgba(226, 232, 240, 0.8); display: none;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold text-primary small"><i class="bi bi-person-badge me-1"></i> Contexte Patient Actif</span>
                    <button type="button" id="btn-clear-patient" class="btn btn-sm btn-link text-danger p-0 small text-decoration-none">Détacher</button>
                </div>
                <div id="patient-details" class="small text-muted"></div>
                <input type="hidden" id="patient_context_data" value="">
            </div>

            <!-- Sélection de l'action IA -->
            <div>
                <label class="form-label fw-bold text-dark mb-3">Que souhaitez-vous demander à l'IA ? <span class="text-danger">*</span></label>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="ai-action-card active" data-type="diagnostic">
                            <i class="bi bi-stethoscope fs-4 text-primary mb-2"></i>
                            <h6 class="fw-bold mb-1">Avis Diagnostique</h6>
                            <p class="x-small text-muted mb-0">Hypothèses, red flags & différentiels</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="ai-action-card" data-type="ordonnance">
                            <i class="bi bi-prescription2 fs-4 text-secondary mb-2"></i>
                            <h6 class="fw-bold mb-1">Prescription Assistée</h6>
                            <p class="x-small text-muted mb-0">Proposition de posologie & précautions</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="ai-action-card" data-type="compte_rendu">
                            <i class="bi bi-file-earmark-medical fs-4 text-success mb-2"></i>
                            <h6 class="fw-bold mb-1">Compte-rendu</h6>
                            <p class="x-small text-muted mb-0">Mise en forme clinique structurée</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="ai-action-card" data-type="vulgarisation">
                            <i class="bi bi-chat-heart fs-4 text-danger mb-2"></i>
                            <h6 class="fw-bold mb-1">Explication Patient</h6>
                            <p class="x-small text-muted mb-0">Vulgarisation simple & rassurante</p>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="selected-type" value="diagnostic">
            </div>

            <!-- Zone de texte pour les observations -->
            <div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label fw-bold text-dark mb-0">Observations cliniques & Symptômes <span class="text-danger">*</span></label>
                    <span class="x-small text-muted" id="char-count">0 caractère</span>
                </div>
                <textarea id="notes" class="form-control bg-light" rows="7" placeholder="Décrivez les symptômes observés, les constantes du patient ou collez vos notes brutes d'examen..."></textarea>
            </div>

            <!-- Bouton Analyser -->
            <div class="pt-2">
                <button type="button" id="btn-analyze" class="btn-nova btn-nova-primary w-100 py-3 justify-content-center fs-6 shadow-lg">
                    <i class="bi bi-stars fs-5"></i> Lancer l'analyse par l'IA
                </button>
            </div>
        </div>
    </div>

    <!-- Colonne Résultat IA -->
    <div class="col-lg-6">
        <div class="card-nova d-flex flex-column h-100" style="background: white; border: 2px solid rgba(99, 102, 241, 0.15);">
            <div class="border-bottom pb-3 mb-4 d-flex justify-content-between align-items-center">
                <h4 class="fw-800 mb-0 text-primary" style="font-family: 'Sora', sans-serif;">
                    <i class="bi bi-robot me-2"></i> Rapport d'Analyse IA
                </h4>
                <div class="d-flex gap-2">
                    <button id="btn-copy" class="btn btn-sm btn-outline-secondary d-none px-3" style="border-radius: 10px;">
                        <i class="bi bi-copy me-1"></i> Copier
                    </button>
                    <button id="btn-pdf" class="btn btn-sm btn-nova-primary d-none px-3 shadow-sm" style="border-radius: 10px; background-color: #6366f1; color: white; border: none;">
                        <i class="bi bi-file-earmark-pdf-fill me-1"></i> Télécharger PDF
                    </button>
                </div>
            </div>

            <!-- Formulaire masqué pour soumission PDF -->
            <form id="form-download-pdf" action="{{ route('medecin.ai.download_pdf') }}" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="type" id="pdf-type">
                <input type="hidden" name="result_content" id="pdf-result-content">
                <input type="hidden" name="patient_info" id="pdf-patient-info">
                <input type="hidden" name="notes" id="pdf-notes">
            </form>

            <!-- Zone de résultat vide par défaut -->
            <div id="ai-empty-state" class="my-auto text-center py-5 text-muted">
                <div class="stat-icon-nova mx-auto mb-3" style="width: 70px; height: 70px; background: #f1f5f9; color: #94a3b8; font-size: 2rem;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5 class="fw-bold mb-2">Prêt à assister votre diagnostic</h5>
                <p class="small max-w-sm mx-auto mb-0">Renseignez vos observations cliniques ou sélectionnez un patient sur la gauche puis lancez l'analyse.</p>
            </div>

            <!-- Loader IA en cours -->
            <div id="ai-loading-state" class="my-auto text-center py-5 d-none">
                <div class="ai-pulse-loader mx-auto mb-4">
                    <div class="glow-ring"></div>
                    <i class="bi bi-robot text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h5 class="fw-bold text-primary mb-2">Analyse clinique en cours...</h5>
                <p class="small text-muted mb-0">L'IA Groq examine les symptômes et le contexte médical à ultra-haute vitesse.</p>
            </div>

            <!-- Résultat formaté -->
            <div id="ai-result-content" class="markdown-body d-none overflow-auto pe-2" style="max-height: 650px; font-size: 0.95rem; line-height: 1.6;">
            </div>

            <!-- Message d'alerte de responsabilité -->
            <div id="ai-disclaimer" class="mt-auto pt-4 border-top d-none">
                <div class="p-3 rounded-4 bg-warning-subtle text-warning-emphasis small d-flex align-items-center gap-3">
                    <i class="bi bi-exclamation-triangle-fill fs-4 flex-shrink-0 text-warning"></i>
                    <div>
                        <strong>Avertissement clinique :</strong> L'IA est un outil d'aide à la décision clinique. Chaque proposition (diagnostic, ordonnance) doit impérativement faire l'objet de votre examen et validation médicale formelle.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles spécifiques pour l'assistant IA */
    .ai-action-card {
        padding: 18px;
        border-radius: 20px;
        border: 2px solid rgba(226, 232, 240, 0.8);
        background: white;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: center;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .ai-action-card:hover {
        border-color: var(--primary);
        background: var(--primary-glow);
        transform: translateY(-3px);
    }

    .ai-action-card.active {
        border-color: var(--primary);
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(14, 165, 233, 0.1));
        box-shadow: 0 10px 20px rgba(99, 102, 241, 0.15);
    }

    .ai-pulse-loader {
        position: relative;
        width: 90px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .glow-ring {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: var(--primary);
        opacity: 0.2;
        animation: pulse-ring 1.5s infinite ease-in-out;
    }

    @keyframes pulse-ring {
        0% { transform: scale(0.8); opacity: 0.5; }
        100% { transform: scale(1.6); opacity: 0; }
    }

    /* Markdown Styling */
    .markdown-body h1, .markdown-body h2, .markdown-body h3 { font-family: 'Sora', sans-serif; font-weight: 800; color: #0f172a; margin-top: 24px; margin-bottom: 12px; }
    .markdown-body h2 { font-size: 1.4rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 8px; color: var(--primary); }
    .markdown-body h3 { font-size: 1.15rem; }
    .markdown-body ul, .markdown-body ol { padding-left: 24px; margin-bottom: 16px; }
    .markdown-body li { margin-bottom: 6px; }
    .markdown-body strong { color: #0f172a; font-weight: 700; }
    .markdown-body p { margin-bottom: 16px; }
</style>

<!-- Inclusion de Marked.js pour le Markdown -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectConsultation = document.getElementById('select-consultation');
        const selectPatient = document.getElementById('select-patient');
        const patientContextBox = document.getElementById('patient-context-box');
        const patientDetails = document.getElementById('patient-details');
        const patientContextData = document.getElementById('patient_context_data');
        const btnClearPatient = document.getElementById('btn-clear-patient');
        const notes = document.getElementById('notes');
        const charCount = document.getElementById('char-count');
        const actionCards = document.querySelectorAll('.ai-action-card');
        const selectedTypeInput = document.getElementById('selected-type');
        const btnAnalyze = document.getElementById('btn-analyze');
        const btnCopy = document.getElementById('btn-copy');
        const btnPdf = document.getElementById('btn-pdf');
        const formPdf = document.getElementById('form-download-pdf');
        const pdfType = document.getElementById('pdf-type');
        const pdfResultContent = document.getElementById('pdf-result-content');
        const pdfPatientInfo = document.getElementById('pdf-patient-info');
        const pdfNotes = document.getElementById('pdf-notes');

        const emptyState = document.getElementById('ai-empty-state');
        const loadingState = document.getElementById('ai-loading-state');
        const resultContent = document.getElementById('ai-result-content');
        const disclaimer = document.getElementById('ai-disclaimer');

        let rawAIResult = '';
        let currentPatientDisplay = 'Non spécifié';

        // Compteur de caractères
        notes.addEventListener('input', () => {
            const len = notes.value.length;
            charCount.textContent = `${len} caractère${len > 1 ? 's' : ''}`;
        });

        // Choix de l'action IA
        actionCards.forEach(card => {
            card.addEventListener('click', () => {
                actionCards.forEach(c => c.classList.remove('active'));
                card.classList.add('active');
                selectedTypeInput.value = card.dataset.type;
            });
        });

        // Nettoyer patient
        btnClearPatient.addEventListener('click', () => {
            selectPatient.value = '';
            selectConsultation.value = '';
            patientContextBox.style.display = 'none';
            patientContextData.value = '';
            currentPatientDisplay = 'Non spécifié';
        });

        // Charger infos patient
        selectPatient.addEventListener('change', async function () {
            const id = this.value;
            if (!id) return;

            try {
                const res = await fetch(`{{ url('/medecin/ai-assistant/patient-data') }}/${id}`);
                const data = await res.json();
                
                currentPatientDisplay = `${data.nom_complet} (${data.sexe}, ${data.age} ans)`;
                patientDetails.innerHTML = `<strong>${data.nom_complet}</strong> (${data.sexe}, ${data.age} ans)<br><strong>Antécédents / Allergies :</strong> ${data.antecedents}`;
                patientContextData.value = `Patient: ${data.nom_complet}, Age: ${data.age} ans, Sexe: ${data.sexe}, Antécédents: ${data.antecedents}`;
                patientContextBox.style.display = 'block';
            } catch (err) {
                console.error("Erreur chargement patient", err);
            }
        });

        // Charger infos depuis consultation
        selectConsultation.addEventListener('change', async function () {
            const id = this.value;
            if (!id) return;

            try {
                const res = await fetch(`{{ url('/medecin/ai-assistant/consultation-data') }}/${id}`);
                const data = await res.json();
                
                currentPatientDisplay = `${data.patient_nom} (${data.patient_age} ans)`;
                patientDetails.innerHTML = `<strong>${data.patient_nom}</strong> (${data.patient_age} ans)<br><strong>Antécédents :</strong> ${data.patient_antecedents}<br><strong>Date :</strong> ${data.date_consultation}`;
                patientContextData.value = `Patient: ${data.patient_nom}, Age: ${data.patient_age} ans, Antécédents: ${data.patient_antecedents}`;
                patientContextBox.style.display = 'block';

                if (data.diagnostic || data.notes) {
                    notes.value = `[Consultation du ${data.date_consultation}] Diagnostic: ${data.diagnostic}\nNotes: ${data.notes}`;
                    notes.dispatchEvent(new Event('input'));
                }
            } catch (err) {
                console.error("Erreur chargement consultation", err);
            }
        });

        // Lancer l'analyse
        btnAnalyze.addEventListener('click', async function () {
            const text = notes.value.trim();
            if (!text) {
                alert('Veuillez saisir des observations cliniques ou importer une consultation.');
                notes.focus();
                return;
            }

            // Basculer l'affichage sur le chargement
            emptyState.classList.add('d-none');
            resultContent.classList.add('d-none');
            disclaimer.classList.add('d-none');
            btnCopy.classList.add('d-none');
            btnPdf.classList.add('d-none');
            loadingState.classList.remove('d-none');
            btnAnalyze.disabled = true;

            try {
                const response = await fetch('{{ route("medecin.ai.analyze") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        type: selectedTypeInput.value,
                        notes: text,
                        patient_context: patientContextData.value
                    })
                });

                const resData = await response.json();

                if (response.ok && resData.status === 'success') {
                    rawAIResult = resData.result;
                    resultContent.innerHTML = marked.parse(rawAIResult);
                    loadingState.classList.add('d-none');
                    resultContent.classList.remove('d-none');
                    disclaimer.classList.remove('d-none');
                    btnCopy.classList.remove('d-none');
                    btnPdf.classList.remove('d-none');
                } else {
                    alert(resData.message || "Une erreur est survenue lors de l'analyse.");
                    loadingState.classList.add('d-none');
                    emptyState.classList.remove('d-none');
                }
            } catch (err) {
                alert("Erreur réseau ou serveur inaccessible.");
                console.error(err);
                loadingState.classList.add('d-none');
                emptyState.classList.remove('d-none');
            } finally {
                btnAnalyze.disabled = false;
            }
        });

        // Copier le texte
        btnCopy.addEventListener('click', function () {
            if (!rawAIResult) return;
            navigator.clipboard.writeText(rawAIResult).then(() => {
                const originalHtml = btnCopy.innerHTML;
                btnCopy.innerHTML = '<i class="bi bi-check text-success"></i> Copié !';
                setTimeout(() => { btnCopy.innerHTML = originalHtml; }, 2000);
            });
        });

        // Télécharger PDF
        btnPdf.addEventListener('click', function () {
            if (!rawAIResult) return;
            pdfType.value = selectedTypeInput.value;
            pdfResultContent.value = rawAIResult;
            pdfPatientInfo.value = currentPatientDisplay;
            pdfNotes.value = notes.value;
            formPdf.submit();
        });
    });
</script>
@endpush
@endsection
