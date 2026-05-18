<?php

/**
 * Fichier : AIAssistantController.php
 * Description : Contrôleur pour l'assistant médical propulsé par l'IA (Gemini).
 * Rôle : Fournir des analyses cliniques, deuxièmes avis, propositions de prescriptions et comptes-rendus automatisés.
 */

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIAssistantController extends Controller
{
    /**
     * Affiche l'interface de l'assistant IA pour le médecin.
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->isMedecin() || !$user->medecin) {
            abort(403, 'Accès réservé aux médecins praticiens.');
        }

        $medecin = $user->medecin;
        $consultations = Consultation::with('patient')
            ->where('medecin_id', $medecin->id)
            ->latest()
            ->take(25)
            ->get();

        $patients = Patient::orderBy('nom')->get();

        return view('medecin.ai.index', compact('medecin', 'consultations', 'patients'));
    }

    /**
     * Récupère les données cliniques d'un patient au format JSON.
     */
    public function getPatientData($id)
    {
        $patient = Patient::findOrFail($id);
        $age = $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->age : 'Non spécifié';

        return response()->json([
            'id' => $patient->id,
            'nom_complet' => $patient->nom_complet,
            'age' => $age,
            'sexe' => $patient->sexe,
            'antecedents' => $patient->antecedents ?? 'Aucun antécédent particulier signalé.'
        ]);
    }

    /**
     * Récupère les données d'une consultation passée au format JSON.
     */
    public function getConsultationData($id)
    {
        $consultation = Consultation::with('patient')->findOrFail($id);
        $age = $consultation->patient->date_naissance ? \Carbon\Carbon::parse($consultation->patient->date_naissance)->age : 'Non spécifié';

        return response()->json([
            'id' => $consultation->id,
            'patient_nom' => $consultation->patient->nom_complet,
            'patient_age' => $age,
            'patient_antecedents' => $consultation->patient->antecedents ?? 'Aucun',
            'date_consultation' => \Carbon\Carbon::parse($consultation->date_consultation)->format('d/m/Y'),
            'diagnostic' => $consultation->diagnostic ?? '',
            'notes' => $consultation->notes ?? '',
            'traitement' => $consultation->traitement ?? ''
        ]);
    }

    /**
     * Effectue l'analyse IA via l'API Gemini.
     */
    public function analyze(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'notes' => 'required|string',
            'patient_context' => 'nullable|string'
        ]);

        $apiKey = config('services.groq.api_key');
        if (empty($apiKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'La clé API Groq n\'est pas configurée. Veuillez vérifier votre fichier .env (GROQ_API_KEY).'
            ], 400);
        }

        $type = $request->input('type');
        $notes = $request->input('notes');
        $patientContext = $request->input('patient_context', 'Aucune information patient spécifique.');

        // Construction du prompt selon le type choisi
        $prompt = "";
        switch ($type) {
            case 'diagnostic':
                $prompt = "Tu es un expert médical de haut niveau et un clinicien chevronné agissant comme assistant de deuxième avis clinique pour un médecin d'hôpital.\n"
                    . "Contexte du patient : {$patientContext}\n"
                    . "Observations et notes cliniques saisies par le médecin : \"{$notes}\"\n\n"
                    . "Fournis une analyse clinique rigoureuse et structurée en français comportant obligatoirement les sections suivantes :\n"
                    . "1. Hypothèses diagnostiques principales (avec justification clinique)\n"
                    . "2. Diagnostics différentiels à envisager ou écarter\n"
                    . "3. Signaux d'alerte (Red Flags) ou complications potentielles à surveiller\n"
                    . "4. Recommandations d'examens complémentaires (biologie, imagerie, etc.)\n"
                    . "Présente ta réponse de manière très professionnelle, claire et formatée en Markdown.";
                break;

            case 'ordonnance':
                $prompt = "Tu es un pharmacologue clinicien expert assistant un médecin d'hôpital.\n"
                    . "Contexte du patient : {$patientContext}\n"
                    . "Symptômes ou pathologie identifiée : \"{$notes}\"\n\n"
                    . "Génère une proposition de prescription médicale (ordonnance) complète et sécurisée en français avec :\n"
                    . "1. Liste des médicaments (DCI et nom commercial courant)\n"
                    . "2. Posologie précise, fréquence et moment de prise\n"
                    . "3. Durée exacte du traitement\n"
                    . "4. Précautions d'emploi, contre-indications majeures ou surveillance spécifique en lien avec le profil du patient.\n"
                    . "Ajoute un rappel clair en fin de message précisant que cette proposition doit être impérativement vérifiée et validée par le médecin prescripteur.";
                break;

            case 'compte_rendu':
                $prompt = "Tu es un assistant de rédaction médicale hospitalière.\n"
                    . "Contexte du patient : {$patientContext}\n"
                    . "Notes de consultation brutes du médecin : \"{$notes}\"\n\n"
                    . "Rédige un compte-rendu médical formel, exhaustif et élégant prêt à être intégré dans le dossier médical ou envoyé sous forme de lettre de liaison à des confrères.\n"
                    . "Structure le rapport avec les sections : Motif d'admission / consultation, Antécédents rappelés, Examen clinique & Observations, Synthèse diagnostique, et Plan de prise en charge / Traitement décidé.";
                break;

            case 'vulgarisation':
                $prompt = "Tu es un médecin empathique et un excellent vulgarisateur scientifique.\n"
                    . "Contexte du patient : {$patientContext}\n"
                    . "Diagnostic et notes cliniques : \"{$notes}\"\n\n"
                    . "Rédige une fiche d'explication simple, bienveillante et rassurante destinée directement au patient pour qu'il comprenne parfaitement sa pathologie, l'importance de son traitement et ce qu'il doit faire chez lui.\n"
                    . "Utilise un langage chaleureux, accessible, sans jargon complexe, et organise le texte avec des puces pour une lecture facile.";
                break;

            default:
                $prompt = "Analyse ces informations cliniques : {$notes}. Contexte patient : {$patientContext}";
                break;
        }

        try {
            $url = "https://api.groq.com/openai/v1/chat/completions";

            $response = Http::withToken($apiKey)->post($url, [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Tu es MediCore AI, un assistant clinique d\'hôpital de pointe. Réponds toujours avec rigueur scientifique, clarté et précision en français.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.2,
                'max_completion_tokens' => 2048,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $resultText = $data['choices'][0]['message']['content'] ?? 'Aucun texte généré par l\'IA.';
                return response()->json([
                    'status' => 'success',
                    'result' => $resultText
                ]);
            }

            Log::error('Erreur API Groq : ' . $response->body());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la communication avec l\'API Groq : ' . ($response->json('error.message') ?? $response->status())
            ], 500);

        } catch (\Exception $e) {
            Log::error('Exception API Groq : ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur interne du serveur lors de la requête IA : ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Génère un traitement médical automatique à partir du diagnostic en consultation.
     */
    public function generateTreatment(Request $request)
    {
        $request->validate([
            'diagnostic' => 'required|string',
            'patient_context' => 'nullable|string'
        ]);

        $apiKey = config('services.groq.api_key');
        if (empty($apiKey)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Clé API Groq non configurée.'
            ], 400);
        }

        $diagnostic = $request->input('diagnostic');
        $patientContext = $request->input('patient_context', 'Inconnu');

        $prompt = "Tu es un pharmacologue et médecin clinicien en milieu hospitalier.\n"
            . "Le praticien a établi ce diagnostic ou ces signes cliniques lors de la consultation : \"{$diagnostic}\".\n"
            . "Contexte du patient : {$patientContext}.\n\n"
            . "Rédige directement et de manière concise le plan de traitement médical recommandé (médicaments avec posologie précise, durée, et recommandations d'usage) pour remplir le champ 'Traitement & Prescriptions' de la fiche de consultation. Ne mets pas d'introduction ou de formules de politesse, fournis uniquement le texte clinique direct.";

        try {
            $response = Http::withToken($apiKey)->post("https://api.groq.com/openai/v1/chat/completions", [
                'model' => 'llama-3.3-70b-versatile',
                'messages' => [
                    ['role' => 'system', 'content' => 'Tu es un expert médical hospitalier. Sois rigoureux, direct et précis.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.2,
                'max_completion_tokens' => 1024,
            ]);

            if ($response->successful()) {
                $content = $response->json('choices.0.message.content') ?? 'Traitement non généré.';
                return response()->json(['status' => 'success', 'result' => trim($content)]);
            }

            return response()->json(['status' => 'error', 'message' => 'Erreur API Groq : ' . ($response->json('error.message') ?? $response->status())], 500);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Génère et télécharge le rapport IA en PDF stylisé.
     */
    public function downloadPdf(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'result_content' => 'required|string',
            'patient_info' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $user = auth()->user();
        $medecin = $user->medecin ?? (object) ['specialite' => 'Générale'];

        $type = $request->input('type');
        $rawMarkdown = $request->input('result_content');
        $patientInfo = $request->input('patient_info', 'Non spécifié');
        $notes = $request->input('notes', '');

        $htmlContent = \Illuminate\Support\Str::markdown($rawMarkdown);

        // Gestion du timestamp et simulation d'expiration pour démonstration
        $timestamp = time();
        if ($request->has('simulate_expired') || $request->input('simulate_expired') == '1') {
            $timestamp = time() - (8 * 3600); // Soustraire 8 heures pour simuler l'expiration
        }

        // Génération d'une URL sécurisée (utilise l'URL du tunnel statique) avec des paramètres dynamiques
        $uniqueId = strtoupper(substr(uniqid(), 0, 8));
        $dateGeneration = urlencode(date('d/m/Y à H:i', $timestamp));
        $qrCodeUrl = env('TUNNEL_URL') . "?ref=DOC-" . $uniqueId . "-AI&date=" . $dateGeneration . "&time=" . $timestamp;

        // Création du QR code en base64 SVG pour éviter l'erreur Imagick sous Windows
        $qrCodeSvg = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(100)->generate($qrCodeUrl);
        $qrCodeBase64 = base64_encode($qrCodeSvg);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('medecin.ai.pdf', compact('medecin', 'type', 'htmlContent', 'patientInfo', 'notes', 'qrCodeBase64'));

        $filename = "Rapport_IA_" . ucfirst($type) . "_" . date('Ymd_Hi') . ".pdf";

        return $pdf->download($filename);
    }
}
