<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Concerns\UploadsToCloudinary;
use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Client;
use App\Models\Notification;
use App\Models\RendezVous;
use App\Models\Vetement;

class AdminController extends Controller
{
    use UploadsToCloudinary;
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'      => ['required', 'email'],
            'motDePasse' => ['required', 'string'],
        ]);

        $email = strtolower(trim($request->email));

        // Rate limiting : 5 tentatives / 60 s par IP
        $throttleKey = 'admin-login|' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        $admin = Admin::where('email', $email)->first();

        if ($admin && Hash::check($request->motDePasse, $admin->motDePasse)) {
            \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);
            $request->session()->regenerate();
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 60);

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function dashboard()
    {
        // CORRECTIF PERFORMANCE : take(5) au niveau SQL pour éviter de charger en mémoire la totalité des vêtements et RDV.
        $vetements = Vetement::orderBy('dateAjout', 'desc')->take(5)->get();
        $rendezVous = RendezVous::with(['client', 'vetement', 'notifications'])->orderBy('dateRendezVous', 'desc')->take(5)->get();
        
        // CORRECTIF PERFORMANCE : Utilisation de count() direct au niveau SQL au lieu de ->count() sur des collections PHP.
        $stats = [
            'vetements'  => Vetement::count(),
            'rendezVous' => RendezVous::count(),
            'enAttente'  => RendezVous::where('statut', 'EN_ATTENTE')->count(),
            'clients'    => Client::count(),
        ];

        return view('admin.dashboard', compact('vetements', 'rendezVous', 'stats'));
    }

    public function vetementsIndex()
    {
        $vetements = Vetement::with('categorie', 'images')->orderBy('dateAjout', 'desc')->get();
        return view('admin.vetements.index', compact('vetements'));
    }

    public function vetementsCreate()
    {
        $categories = Categorie::all();
        return view('admin.vetements.create', compact('categories'));
    }

    private function deleteImageFile($image): void
    {
        if (!$image || !$image->image_url) return;

        $path = $image->image_url;

        if (str_starts_with($path, 'http')) return;

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    // uploadToCloudinary() est fourni par le trait UploadsToCloudinary

    public function vetementsStore(Request $request)
    {
        $request->validate([
            'nom'             => 'required|string|max:255',
            'description'     => 'nullable|string',
            'prix'            => 'required|numeric|min:0',
            'image_principale' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image_detail_1'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image_detail_2'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image_detail_3'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'categorie_id'    => 'nullable|exists:categories,id',
        ]);

        $vetement = Vetement::create([
            'nom'          => $request->nom,
            'description'  => $request->description,
            'prix'         => $request->prix,
            'disponible'   => $request->has('disponible'),
            'dateAjout'    => now(),
            'admin_id'     => Auth::guard('admin')->id(),
            'categorie_id' => $request->categorie_id,
        ]);

        if ($request->hasFile('image_principale')) {
            $url = $this->uploadToCloudinary($request->file('image_principale'));
            $vetement->images()->create(['image_url' => $url, 'ordre' => 0]);
        }

        foreach (range(1, 3) as $i) {
            $field = "image_detail_{$i}";
            if ($request->hasFile($field)) {
                $url = $this->uploadToCloudinary($request->file($field));
                $vetement->images()->create(['image_url' => $url, 'ordre' => $i]);
            }
        }

        return redirect()->route('admin.vetements.index')->with('success', 'Vêtement ajouté avec succès!');
    }

    public function vetementsEdit($id)
    {
        $vetement = Vetement::with('images')->findOrFail($id);
        $categories = Categorie::all();
        return view('admin.vetements.edit', compact('vetement', 'categories'));
    }

    public function vetementsUpdate(Request $request, $id)
    {
        $vetement = Vetement::with('images')->findOrFail($id);

        $request->validate([
            'nom'             => 'required|string|max:255',
            'description'     => 'nullable|string',
            'prix'            => 'required|numeric|min:0',
            'image_principale' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image_detail_1'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image_detail_2'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image_detail_3'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'categorie_id'    => 'nullable|exists:categories,id',
        ]);

        $vetement->update([
            'nom'          => $request->nom,
            'description'  => $request->description,
            'prix'         => $request->prix,
            'disponible'   => $request->has('disponible'),
            'categorie_id' => $request->categorie_id,
        ]);

        if ($request->hasFile('image_principale')) {
            $this->deleteImageFile($vetement->images()->where('ordre', 0)->first());
            $vetement->images()->where('ordre', 0)->delete();
            $url = $this->uploadToCloudinary($request->file('image_principale'));
            $vetement->images()->create(['image_url' => $url, 'ordre' => 0]);
        }

        foreach (range(1, 3) as $i) {
            $field = "image_detail_{$i}";
            if ($request->hasFile($field)) {
                $this->deleteImageFile($vetement->images()->where('ordre', $i)->first());
                $vetement->images()->where('ordre', $i)->delete();
                $url = $this->uploadToCloudinary($request->file($field));
                $vetement->images()->create(['image_url' => $url, 'ordre' => $i]);
            }
        }

        return redirect()->route('admin.vetements.index')->with('success', 'Vêtement mis à jour!');
    }

    public function vetementsDestroy($id)
    {
        $vetement = Vetement::with('images')->findOrFail($id);

        foreach ($vetement->images as $image) {
            $this->deleteImageFile($image);
        }

        $vetement->delete();

        return redirect()->route('admin.vetements.index')->with('success', 'Vêtement supprimé!');
    }

    public function rendezvousIndex()
    {
        $rendezVous = RendezVous::with(['client', 'vetement', 'notifications'])->orderBy('dateRendezVous', 'desc')->get();
        return view('admin.rendezvous.index', compact('rendezVous'));
    }

    public function rendezvousShow($id)
    {
        $rendezVous = RendezVous::with(['client', 'vetement', 'notifications'])->findOrFail($id);
        return view('admin.rendezvous.show', compact('rendezVous'));
    }

    public function rendezvousConfirmer($id)
    {
        $rendezVous = RendezVous::with(['client', 'vetement', 'notifications'])->findOrFail($id);
        $rendezVous->update(['statut' => RendezVous::STATUT_CONFIRME]);

        $vetementNom = $rendezVous->vetement?->nom ?? null;
        $clientPrenom = $rendezVous->client?->prenom ?? 'Client';
        $dateRdv = $rendezVous->dateRendezVous->format('d/m/Y');
        $heureRdv = $rendezVous->heure;

        $message  = "✅ *Rendez-vous confirmé !*\n\n";
        $message .= "Bonjour {$clientPrenom},\n\n";
        $message .= "Votre rendez-vous a bien été *confirmé*.\n\n";
        $message .= "📅 Date : {$dateRdv}\n";
        $message .= "🕐 Heure : {$heureRdv}\n";
        if ($vetementNom) {
            $message .= "👗 Vêtement : {$vetementNom}\n";
        }
        $message .= "\nMerci de votre confiance. À très bientôt ! 🙏";

        $this->sendAppointmentNotifications($rendezVous, $message, 'confirm');

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Rendez-vous confirmé !',
                'wa_link' => session('wa_link')
            ]);
        }

        return back()->with('success', 'Rendez-vous confirmé!');
    }

    public function rendezvousRefuser($id)
    {
        $rendezVous = RendezVous::with(['client', 'vetement', 'notifications'])->findOrFail($id);
        $rendezVous->update(['statut' => RendezVous::STATUT_REFUSE]);

        $clientPrenom2 = $rendezVous->client?->prenom ?? 'Client';
        $dateRdv2 = $rendezVous->dateRendezVous->format('d/m/Y');

        $message  = "❌ *Rendez-vous non disponible*\n\n";
        $message .= "Bonjour {$clientPrenom2},\n\n";
        $message .= "Nous sommes désolés, votre rendez-vous du *{$dateRdv2}* n'a pas pu être confirmé.\n\n";
        $message .= "Vous pouvez prendre un nouveau rendez-vous directement sur l'application.\n";
        $message .= "N'hésitez pas à nous contacter pour toute question. 🙏";

        $this->sendAppointmentNotifications($rendezVous, $message, 'refuse');

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Rendez-vous refusé !',
                'wa_link' => session('wa_link')
            ]);
        }

        return back()->with('success', 'Rendez-vous refusé!');
    }

    public function clientsIndex()
    {
        $clients = Client::with('rendezVous')->orderBy('dateInscription', 'desc')->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * @param  'confirm'|'refuse'  $waEvent  choix du modèle WhatsApp (si configuré)
     */
    private function sendAppointmentNotifications(RendezVous $rendezVous, string $message, string $waEvent = 'confirm'): void
    {
        $client = $rendezVous->client;
        $waPhone = $this->normalizeWhatsAppPhone($client?->telephone);
        $waLink = $waPhone ? 'https://wa.me/'.$waPhone.'?text='.rawurlencode($message) : null;

        if ($waLink) {
            session()->flash('wa_link', $waLink);
        }

        // Envoi Email désactivé selon demande ("pas de mail")

        $whatsappStatus = 'A_ENVOYER';
        $token = config('services.whatsapp.token');
        $phoneNumberId = config('services.whatsapp.phone_number_id');

        if (!empty($token) && !empty($phoneNumberId) && !empty($waPhone)) {
            $whatsappStatus = $this->deliverWhatsAppCloud(
                $token,
                $phoneNumberId,
                $waPhone,
                $rendezVous,
                $message,
                $waEvent
            );
        } elseif (empty($waPhone)) {
            $whatsappStatus = 'ECHEC';
        }

        Notification::create([
            'type' => Notification::TYPE_WHATSAPP,
            'contenu' => $message,
            'dateEnvoi' => now(),
            'statut' => $whatsappStatus,
            'client_id' => $rendezVous->client_id,
            'rendez_vous_id' => $rendezVous->id,
        ]);
    }

    /**
     * @param  'confirm'|'refuse'  $waEvent
     */
    private function deliverWhatsAppCloud(
        string $token,
        string $phoneNumberId,
        string $waPhone,
        RendezVous $rendezVous,
        string $message,
        string $waEvent
    ): string {
        $url = "https://graph.facebook.com/v21.0/{$phoneNumberId}/messages";
        $http = Http::withToken($token)->timeout(25);

        $templateName = $this->resolveWhatsappTemplateName($waEvent);
        $fallbackText = (bool) config('services.whatsapp.template_fallback_text', false);

        if ($templateName !== null) {
            $lang = (string) config('services.whatsapp.template_lang', 'fr');
            $mode = strtolower((string) config('services.whatsapp.template_mode', 'message'));
            $bodyParams = $this->whatsappTemplateBodyParameters($mode, $rendezVous, $message, $waEvent);
            $payload = $this->buildWhatsappTemplatePayload($waPhone, $templateName, $lang, $bodyParams);

            try {
                $response = $http->post($url, $payload);
                if ($response->successful()) {
                    return 'ENVOYE';
                }

                Log::warning('Echec envoi WhatsApp (modèle Meta)', [
                    'rendez_vous_id' => $rendezVous->id,
                    'template' => $templateName,
                    'response' => $response->body(),
                ]);

                if ($fallbackText) {
                    return $this->postWhatsappTextMessage($http, $url, $waPhone, $message, $rendezVous->id);
                }

                return 'ECHEC';
            } catch (\Throwable $e) {
                Log::error('Erreur envoi WhatsApp (modèle Meta)', [
                    'rendez_vous_id' => $rendezVous->id,
                    'error' => $e->getMessage(),
                ]);

                if ($fallbackText) {
                    return $this->postWhatsappTextMessage($http, $url, $waPhone, $message, $rendezVous->id);
                }

                return 'ECHEC';
            }
        }

        try {
            return $this->postWhatsappTextMessage($http, $url, $waPhone, $message, $rendezVous->id);
        } catch (\Throwable $e) {
            Log::error('Erreur envoi WhatsApp rendez-vous', [
                'rendez_vous_id' => $rendezVous->id,
                'error' => $e->getMessage(),
            ]);

            return 'ECHEC';
        }
    }

    private function postWhatsappTextMessage(PendingRequest $http, string $url, string $waPhone, string $message, int $rendezVousId): string
    {
        $response = $http->post($url, [
            'messaging_product' => 'whatsapp',
            'to' => $waPhone,
            'type' => 'text',
            'text' => ['body' => $message],
        ]);

        if ($response->successful()) {
            return 'ENVOYE';
        }

        Log::warning('Echec envoi WhatsApp (texte libre)', [
            'rendez_vous_id' => $rendezVousId,
            'response' => $response->body(),
        ]);

        return 'ECHEC';
    }

    /**
     * @return 'confirm'|'refuse'
     */
    private function resolveWhatsappTemplateName(string $waEvent): ?string
    {
        if ($waEvent !== 'confirm' && $waEvent !== 'refuse') {
            return null;
        }

        $default = trim((string) config('services.whatsapp.template_name', ''));
        $confirm = trim((string) config('services.whatsapp.template_confirm_name', ''));
        $refuse = trim((string) config('services.whatsapp.template_refuse_name', ''));

        if ($waEvent === 'refuse') {
            $name = $refuse !== '' ? $refuse : $default;
        } else {
            $name = $confirm !== '' ? $confirm : $default;
        }

        return $name !== '' ? $name : null;
    }

    /**
     * @param  'confirm'|'refuse'  $waEvent
     * @return array<int, array{type: string, text: string}>
     */
    private function whatsappTemplateBodyParameters(string $mode, RendezVous $rendezVous, string $message, string $waEvent): array
    {
        if ($mode === 'fields') {
            $statut = $waEvent === 'confirm'
                ? 'Votre rendez-vous a été confirmé.'
                : 'Votre rendez-vous a été refusé. Vous pouvez en prendre un autre sur l’application.';

            return [
                ['type' => 'text', 'text' => $rendezVous->dateRendezVous->format('d/m/Y')],
                ['type' => 'text', 'text' => (string) $rendezVous->heure],
                ['type' => 'text', 'text' => $statut],
            ];
        }

        return [['type' => 'text', 'text' => $message]];
    }

    /**
     * @param  array<int, array{type: string, text: string}>  $bodyParameters
     */
    private function buildWhatsappTemplatePayload(string $to, string $templateName, string $lang, array $bodyParameters): array
    {
        $template = [
            'name' => $templateName,
            'language' => ['code' => $lang],
        ];

        if ($bodyParameters !== []) {
            $template['components'] = [
                [
                    'type' => 'body',
                    'parameters' => $bodyParameters,
                ],
            ];
        }

        return [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'template',
            'template' => $template,
        ];
    }

    // normalizeWhatsAppPhone() est fourni par le trait UploadsToCloudinary

    public function updateProductionStatus(Request $request, $id)
    {
        $request->validate([
            'statut_production' => 'required|in:EN_ATTENTE,MESURES,COUPE,COUTURE,FINITIONS,PRET,LIVRE',
        ]);

        $rendezVous = RendezVous::with(['client', 'vetement'])->findOrFail($id);
        $rendezVous->update([
            'statut_production' => $request->statut_production
        ]);

        $etapes = [
            'EN_ATTENTE' => 'En attente',
            'MESURES'    => 'Mesures enregistrées',
            'COUPE'      => 'Coupe du tissu',
            'COUTURE'    => 'Couture en cours',
            'FINITIONS'  => 'Finitions en cours',
            'PRET'       => 'Prêt pour retrait !',
            'LIVRE'      => 'Livré'
        ];
        
        $etapeNom = $etapes[$request->statut_production] ?? $request->statut_production;

        return back()->with('success', 'Statut de confection mis à jour : ' . $etapeNom);
    }
}