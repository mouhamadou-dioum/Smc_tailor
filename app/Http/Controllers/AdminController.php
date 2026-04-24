<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Models\Vetement;
use App\Models\RendezVous;
use App\Models\Client;
use App\Models\Notification;
use App\Models\Categorie;

class AdminController extends Controller
{
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

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }

    public function dashboard()
    {
        $vetements = Vetement::orderBy('dateAjout', 'desc')->get();
        $rendezVous = RendezVous::with(['client', 'vetement'])->orderBy('dateRendezVous', 'desc')->get();
        $clients = Client::orderBy('dateInscription', 'desc')->get();
        
        $stats = [
            'vetements' => $vetements->count(),
            'rendezVous' => $rendezVous->count(),
            'enAttente' => $rendezVous->where('statut', 'EN_ATTENTE')->count(),
            'clients' => $clients->count(),
        ];

        return view('admin.dashboard', compact('vetements', 'rendezVous', 'stats'));
    }

    public function vetementsIndex()
    {
        $vetements = Vetement::with('categorie')->orderBy('dateAjout', 'desc')->get();
        return view('admin.vetements.index', compact('vetements'));
    }

    public function vetementsCreate()
    {
        $categories = Categorie::all();
        return view('admin.vetements.create', compact('categories'));
    }

    /**
     * Upload une image sur Cloudinary et retourne l'URL publique.
     * Utilise l'API REST directement (pas de package externe).
     */
    private function uploadToCloudinary($file): string
    {
        $cloudName = config('cloudinary.cloud_name');
        $apiKey    = config('cloudinary.api_key');
        $apiSecret = config('cloudinary.api_secret');

        $timestamp = time();
        $params    = ['timestamp' => $timestamp];
        ksort($params);
        $signString = http_build_query($params) . $apiSecret;
        $signature  = sha1($signString);

        $response = Http::attach(
            'file', file_get_contents($file->getRealPath()), $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload", [
            'api_key'   => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        if ($response->failed()) {
            throw new \Exception('Erreur upload Cloudinary : ' . $response->body());
        }

        return $response->json('secure_url');
    }

    public function vetementsStore(Request $request)
    {
        $request->validate([
            'nom'          => 'required|string|max:255',
            'description'  => 'nullable|string',
            'prix'         => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imageUrl'     => 'nullable|url',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        // Priorité : fichier uploadé > URL saisie > image par défaut
        $imageUrl = 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=600';

        if ($request->hasFile('image')) {
            $imageUrl = $this->uploadToCloudinary($request->file('image'));
        } elseif ($request->filled('imageUrl')) {
            $imageUrl = $request->imageUrl;
        }

        Vetement::create([
            'nom'          => $request->nom,
            'description'  => $request->description,
            'prix'         => $request->prix,
            'imageUrl'     => $imageUrl,
            'disponible'   => $request->has('disponible'),
            'dateAjout'    => now(),
            'admin_id'     => Auth::guard('admin')->id(),
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('admin.vetements.index')->with('success', 'Vêtement ajouté avec succès!');
    }

    public function vetementsEdit($id)
    {
        $vetement = Vetement::findOrFail($id);
        $categories = Categorie::all();
        return view('admin.vetements.edit', compact('vetement', 'categories'));
    }

    public function vetementsUpdate(Request $request, $id)
    {
        $vetement = Vetement::findOrFail($id);

        $request->validate([
            'nom'          => 'required|string|max:255',
            'description'  => 'nullable|string',
            'prix'         => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imageUrl'     => 'nullable|url',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        // Priorité : nouveau fichier > nouvelle URL > conserver l'ancienne image
        $imageUrl = $vetement->imageUrl;

        if ($request->hasFile('image')) {
            $imageUrl = $this->uploadToCloudinary($request->file('image'));
        } elseif ($request->filled('imageUrl')) {
            $imageUrl = $request->imageUrl;
        }

        $vetement->update([
            'nom'          => $request->nom,
            'description'  => $request->description,
            'prix'         => $request->prix,
            'imageUrl'     => $imageUrl,
            'disponible'   => $request->has('disponible'),
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('admin.vetements.index')->with('success', 'Vêtement mis à jour!');
    }

    public function vetementsDestroy($id)
    {
        $vetement = Vetement::findOrFail($id);
        $vetement->delete();

        return redirect()->route('admin.vetements.index')->with('success', 'Vêtement supprimé!');
    }

    public function rendezvousIndex()
    {
        $rendezVous = RendezVous::with(['client', 'vetement'])->orderBy('dateRendezVous', 'desc')->get();
        return view('admin.rendezvous.index', compact('rendezVous'));
    }

    public function rendezvousShow($id)
    {
        $rendezVous = RendezVous::with(['client', 'vetement'])->findOrFail($id);
        return view('admin.rendezvous.show', compact('rendezVous'));
    }

    public function rendezvousConfirmer($id)
    {
        $rendezVous = RendezVous::with(['client', 'vetement'])->findOrFail($id);
        $rendezVous->update(['statut' => RendezVous::STATUT_CONFIRME]);

        $message = "Votre rendez-vous du {$rendezVous->dateRendezVous->format('d/m/Y')} à {$rendezVous->heure} a été CONFIRME.";
        $this->sendAppointmentNotifications($rendezVous, $message, 'confirm');

        return back()->with('success', 'Rendez-vous confirmé!');
    }

    public function rendezvousRefuser($id)
    {
        $rendezVous = RendezVous::with(['client', 'vetement'])->findOrFail($id);
        $rendezVous->update(['statut' => RendezVous::STATUT_REFUSE]);

        $message = "Votre rendez-vous du {$rendezVous->dateRendezVous->format('d/m/Y')} a été REFUSE. Veuillez prendre un nouveau rendez-vous.";
        $this->sendAppointmentNotifications($rendezVous, $message, 'refuse');

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

        $emailStatus = 'ECHEC';
        if (!empty($client?->email)) {
            try {
                $html = view('emails.rendez-vous-update', [
                    'message' => $message,
                    'waLink' => $waLink,
                ])->render();

                Mail::html($html, function ($mail) use ($client) {
                    $mail->to($client->email)->subject('Mise à jour de votre rendez-vous — Couture');
                });
                $emailStatus = 'ENVOYE';
            } catch (\Throwable $e) {
                Log::error('Echec envoi email rendez-vous', [
                    'rendez_vous_id' => $rendezVous->id,
                    'client_id' => $client?->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        Notification::create([
            'type' => Notification::TYPE_EMAIL,
            'contenu' => $message,
            'dateEnvoi' => now(),
            'statut' => $emailStatus,
            'client_id' => $rendezVous->client_id,
            'rendez_vous_id' => $rendezVous->id,
        ]);

        $whatsappStatus = 'ECHEC';
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

    /**
     * Numéro international chiffres uniquement (ex. 221771234567) pour l’API WhatsApp Cloud.
     */
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

        return $country.$digits;
    }
}