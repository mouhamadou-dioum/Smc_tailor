<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Models\Vetement;
use App\Models\RendezVous;
use App\Models\Notification;
use App\Models\Admin;

class RendezVousController extends Controller
{
    public function create()
    {
        $vetementPreselect = null;
        if (request()->filled('vetement')) {
            $vetementPreselect = Vetement::where('disponible', true)
                ->whereKey(request('vetement'))
                ->first();
        }

        return view('rendezvous.create', compact('vetementPreselect'));
    }

    public function store(Request $request)
    {
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
            'type' => $request->typeNotification ?? 'EMAIL',
            'contenu' => 'Votre demande de rendez-vous a été soumise. En attente de confirmation.',
            'dateEnvoi' => now(),
            'statut' => 'ENVOYE',
            'client_id' => $client->id,
            'rendez_vous_id' => $rendezVous->id,
        ]);

        $this->notifyAdminNewAppointment($client, $rendezVous, $vetement);

        return response()->json([
            'success' => true,
            'message' => 'Rendez-vous soumis avec succès!'
        ]);
    }

    public function myRendezVous()
    {
        $rendezVous = RendezVous::with('vetement')->where('client_id', Auth::guard('client')->id())
            ->orderBy('dateRendezVous', 'desc')
            ->get();
        return view('rendezvous.index', compact('rendezVous'));
    }

    public function confirmByClient(Request $request, $id)
    {
        $rendezVous = RendezVous::with('vetement')
            ->where('client_id', Auth::guard('client')->id())
            ->where('id', $id)
            ->where('statut', RendezVous::STATUT_EN_ATTENTE)
            ->firstOrFail();

        $request->session()->put('rendezvous_confirme_' . $id, true);

        return back()->with('success', 'Rendez-vous confirmé!');
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

    private function normalizeWhatsAppPhone(?string $raw): ?string
    {
        if ($raw === null || trim($raw) === '') {
            return null;
        }

        $digits = preg_replace('/\D+/', '', $raw);
        if ($digits === '') {
            return null;
        }

        $country = preg_replace('/\D+/', '', (string) config('services.whatsapp.default_country_code', '221'));
        if ($country === '') {
            $country = '221';
        }

        if (str_starts_with($digits, $country)) {
            return $digits;
        }

        if (str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
        }

        return $country . $digits;
    }
}