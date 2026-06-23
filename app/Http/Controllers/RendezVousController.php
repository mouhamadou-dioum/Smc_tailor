<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Http\Concerns\UploadsToCloudinary;
use App\Models\Admin;
use App\Models\Notification;
use App\Models\RendezVous;
use App\Models\Vetement;

class RendezVousController extends Controller
{
    use UploadsToCloudinary;
    public function suivi(Request $request)
    {
        $telephone = $request->query('telephone');
        $rendezVous = collect();
        $error = null;

        if ($request->has('telephone')) {
            $request->validate([
                'telephone' => 'required|string|max:50',
            ]);

            $telephone = trim($telephone);

            // Recherche du client
            $client = \App\Models\Client::where('telephone', $telephone)
                ->orWhere('telephone', 'like', '%' . $telephone . '%')
                ->first();

            if ($client) {
                $rendezVous = RendezVous::with('vetement')
                    ->where('client_id', $client->id)
                    ->orderBy('dateRendezVous', 'desc')
                    ->get();

                if ($rendezVous->isEmpty()) {
                    $error = 'Aucun rendez-vous trouvé pour ce numéro de téléphone.';
                }
            } else {
                $error = 'Aucun rendez-vous ou compte associé à ce numéro de téléphone.';
            }
        }

        return view('rendezvous.suivi', compact('rendezVous', 'telephone', 'error'));
    }

    public function create()
    {
        $vetementPreselect = null;
        if (request()->filled('vetement')) {
            $vetementPreselect = Vetement::with('images')->where('disponible', true)
                ->whereKey(request('vetement'))
                ->first();
        }

        return view('rendezvous.create', compact('vetementPreselect'));
    }

    public function store(Request $request)
    {
        $rules = [
            'vetement_id' => 'nullable|exists:vetements,id',
            'dateRendezVous' => 'required|date|after:today',
            'heure' => 'required',
            'commentaire' => [
                'nullable',
                'string',
                'max:5000',
                Rule::requiredIf(fn () => !$request->filled('vetement_id')),
            ],
        ];

        // S'il n'est pas connecté, on valide les champs d'identification du client invité
        if (!Auth::guard('client')->check()) {
            $rules['nom'] = 'required|string|max:255';
            $rules['prenom'] = 'required|string|max:255';
            $rules['telephone'] = 'required|string|max:50';
            $rules['email'] = 'nullable|email|max:255';
        }

        $request->validate($rules);

        $vetementId = $request->vetement_id;
        if ($vetementId) {
            $exists = Vetement::where('disponible', true)->whereKey($vetementId)->exists();
            if (!$exists) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Ce modèle n\'est plus disponible.'], 422);
                }
                return back()->withErrors(['vetement_id' => 'Ce modèle n\'est plus disponible.'])->withInput();
            }
        }

        // Identification ou création du client
        if (Auth::guard('client')->check()) {
            $client = Auth::guard('client')->user();
        } else {
            // Rechercher le client par téléphone
            $client = \App\Models\Client::where('telephone', $request->telephone)->first();
            
            if (!$client) {
                // Générer une adresse email unique s'il n'en a pas fourni
                $email = $request->email;
                if (!$email) {
                    $cleanedPhone = preg_replace('/\D+/', '', $request->telephone) ?: rand(100000, 999999);
                    $email = $cleanedPhone . '@smc-couture.com';
                }
                
                $originalEmail = $email;
                $i = 1;
                while (\App\Models\Client::where('email', $email)->exists()) {
                    $email = $i . '_' . $originalEmail;
                    $i++;
                }

                $client = \App\Models\Client::create([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'telephone' => $request->telephone,
                    'email' => $email,
                    'motDePasse' => \Illuminate\Support\Facades\Hash::make('password'),
                    'dateInscription' => now(),
                ]);
            }
        }

        // Vérification de rendez-vous actif en cours
        // Un rendez-vous est en cours s'il est EN_ATTENTE ou CONFIRME et sa production n'est pas LIVREE
        $activeRdv = RendezVous::where('client_id', $client->id)
            ->whereIn('statut', [RendezVous::STATUT_EN_ATTENTE, RendezVous::STATUT_CONFIRME])
            ->where('statut_production', '!=', RendezVous::PROD_LIVRE)
            ->exists();

        if ($activeRdv) {
            $errorMsg = 'Vous avez déjà un rendez-vous en cours. Vous ne pourrez pas en planifier un autre tant qu\'il ne sera pas terminé.';
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg
                ], 422);
            }
            return back()->withErrors(['error' => $errorMsg])->withInput();
        }

        $vetement = $vetementId ? Vetement::find($vetementId) : null;

        $rendezVous = RendezVous::create([
            'dateRendezVous' => $request->dateRendezVous,
            'heure' => $request->heure,
            'statut' => RendezVous::STATUT_EN_ATTENTE,
            'commentaire' => $request->commentaire,
            'dateCreation' => now(),
            'client_id' => $client->id,
            'vetement_id' => $vetementId,
        ]);

        Notification::create([
            'type' => $request->typeNotification ?? 'WHATSAPP',
            'contenu' => 'Votre demande de rendez-vous a été soumise. En attente de confirmation.',
            'dateEnvoi' => now(),
            'statut' => 'ENVOYE',
            'client_id' => $client->id,
            'rendez_vous_id' => $rendezVous->id,
        ]);

        $this->notifyAdminNewAppointment($client, $rendezVous, $vetement);

        // Si le client est connecté, on le redirige vers sa liste de RDV, sinon vers la page d'accueil
        $redirectUrl = Auth::guard('client')->check() ? route('rendezvous.index') : route('home');

        $msg = 'Votre demande de rendez-vous a été soumise avec succès ! Vous recevrez une confirmation par WhatsApp.';

        return response()->json([
            'success' => true,
            'message' => $msg,
            'redirect' => $redirectUrl
        ]);
    }

    public function myRendezVous()
    {
        $rendezVous = RendezVous::with('vetement')->where('client_id', Auth::guard('client')->id())
            ->orderBy('dateRendezVous', 'desc')
            ->get();
        return view('rendezvous.index', compact('rendezVous'));
    }

    public function edit($id)
    {
        $rendezVous = RendezVous::where('client_id', Auth::guard('client')->id())->findOrFail($id);
        $vetements = Vetement::where('disponible', true)->get();
        
        return view('rendezvous.edit', compact('rendezVous', 'vetements'));
    }

    public function update(Request $request, $id)
    {
        $rendezVous = RendezVous::where('client_id', Auth::guard('client')->id())->findOrFail($id);

        $request->validate([
            'vetement_id' => 'nullable|exists:vetements,id',
            'dateRendezVous' => 'required|date|after:today',
            'heure' => 'required',
            'commentaire' => [
                'nullable',
                'string',
                'max:5000',
                Rule::requiredIf(fn () => !$request->filled('vetement_id')),
            ],
        ]);

        $vetementId = $request->vetement_id;
        if ($vetementId) {
            $exists = Vetement::where('disponible', true)->whereKey($vetementId)->exists();
            if (!$exists) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'Ce modèle n\'est plus disponible.'], 422);
                }
                return back()->withErrors(['vetement_id' => 'Ce modèle n\'est plus disponible.'])->withInput();
            }
        }

        $client = Auth::guard('client')->user();
        $vetement = $vetementId ? Vetement::find($vetementId) : null;

        $rendezVous->update([
            'dateRendezVous' => $request->dateRendezVous,
            'heure' => $request->heure,
            'statut' => RendezVous::STATUT_EN_ATTENTE,
            'commentaire' => $request->commentaire,
            'vetement_id' => $vetementId,
        ]);

        Notification::create([
            'type' => $request->typeNotification ?? 'WHATSAPP',
            'contenu' => 'Votre demande de rendez-vous a été modifiée et est en attente de re-confirmation.',
            'dateEnvoi' => now(),
            'statut' => 'ENVOYE',
            'client_id' => $client->id,
            'rendez_vous_id' => $rendezVous->id,
        ]);

        $this->notifyAdminModifiedAppointment($client, $rendezVous);

        return response()->json([
            'success' => true,
            'message' => 'Rendez-vous modifié avec succès !'
        ]);
    }

    /**
     * Envoie un message WhatsApp détaillé à l'admin lors d'une nouvelle réservation.
     */
    private function notifyAdminNewAppointment($client, RendezVous $rendezVous, ?Vetement $vetement): void
    {
        $admin = Admin::first();
        if (!$admin || empty($admin->telephone)) {
            return;
        }

        $clientNom    = "{$client->prenom} {$client->nom}";
        $clientTel    = $client->telephone;
        $clientEmail  = $client->email ?? 'Non renseigné';
        $dateRdv      = $rendezVous->dateRendezVous->format('d/m/Y');
        $heureRdv     = $rendezVous->heure;
        $commentaire  = trim((string) $rendezVous->commentaire);

        // Bloc vêtement (optionnel)
        if ($vetement) {
            $vetementNom  = $vetement->nom;
            $vetementPrix = $vetement->prix
                ? number_format($vetement->prix, 0, ',', ' ') . ' CFA'
                : 'Prix non spécifié';
            $vetementLine = "👗 Vêtement : {$vetementNom} ({$vetementPrix})";
        } else {
            $vetementLine = "👗 Vêtement : *(à définir avec le client)*";
        }

        $message  = "🆕 *Nouvelle réservation*\n\n";
        $message .= "👤 Client : {$clientNom}\n";
        $message .= "📞 Tél : {$clientTel}\n";
        $message .= "📧 Email : {$clientEmail}\n";
        $message .= "📅 Date : {$dateRdv} à {$heureRdv}\n";
        $message .= "{$vetementLine}\n";

        if ($commentaire !== '') {
            $message .= "💬 Note : {$commentaire}\n";
        }

        $message .= "\n✅ Validez ou refusez ce RDV depuis votre tableau de bord.";

        $waPhone      = $this->normalizeWhatsAppPhone($admin->telephone);
        $token        = config('services.whatsapp.token');
        $phoneNumberId = config('services.whatsapp.phone_number_id');

        if (!empty($token) && !empty($phoneNumberId) && $waPhone) {
            $this->sendWhatsAppTextMessage($token, $phoneNumberId, $waPhone, $message);
        }
    }

    /**
     * Envoie un message WhatsApp détaillé à l'admin lors d'une modification de réservation.
     */
    private function notifyAdminModifiedAppointment($client, RendezVous $rendezVous): void
    {
        $admin = Admin::first();
        if (!$admin || empty($admin->telephone)) {
            return;
        }

        $clientNom    = "{$client->prenom} {$client->nom}";
        $clientTel    = $client->telephone;
        $dateRdv      = $rendezVous->dateRendezVous->format('d/m/Y');
        $heureRdv     = $rendezVous->heure;
        $commentaire  = trim((string) $rendezVous->commentaire);

        $vetement = $rendezVous->vetement;
        if ($vetement) {
            $vetementNom  = $vetement->nom;
            $vetementPrix = $vetement->prix
                ? number_format($vetement->prix, 0, ',', ' ') . ' CFA'
                : 'Prix non spécifié';
            $vetementLine = "👗 Vêtement : {$vetementNom} ({$vetementPrix})";
        } else {
            $vetementLine = "👗 Vêtement : *(à définir avec le client)*";
        }

        $message  = "🔄 *Modification de réservation*\n\n";
        $message .= "👤 Client : {$clientNom}\n";
        $message .= "📞 Tél : {$clientTel}\n";
        $message .= "📅 Nouveau créneau : {$dateRdv} à {$heureRdv}\n";
        $message .= "{$vetementLine}\n";

        if ($commentaire !== '') {
            $message .= "💬 Nouvelle Note : {$commentaire}\n";
        }

        $message .= "\n✅ Validez ou refusez ce RDV modifié depuis votre tableau de bord.";

        $waPhone      = $this->normalizeWhatsAppPhone($admin->telephone);
        $token        = config('services.whatsapp.token');
        $phoneNumberId = config('services.whatsapp.phone_number_id');

        if (!empty($token) && !empty($phoneNumberId) && $waPhone) {
            $this->sendWhatsAppTextMessage($token, $phoneNumberId, $waPhone, $message);
        }
    }

    private function sendWhatsAppTextMessage(string $token, string $phoneNumberId, string $waPhone, string $message): void
    {
        $url = "https://graph.facebook.com/v21.0/{$phoneNumberId}/messages";

        try {
            $response = Http::withToken($token)
                ->timeout(25)
                ->post($url, [
                    'messaging_product' => 'whatsapp',
                    'to'                => $waPhone,
                    'type'              => 'text',
                    'text'              => ['body' => $message],
                ]);

            if (!$response->successful()) {
                Log::warning('Echec envoi WhatsApp à admin', [
                    'response' => $response->body(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('Erreur envoi WhatsApp à admin', [
                'error' => $e->getMessage(),
            ]);
        }
    }

    // normalizeWhatsAppPhone() est fourni par le trait UploadsToCloudinary
}