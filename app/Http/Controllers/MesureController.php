<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Mesure;
use App\Models\Client;
use App\Models\RendezVous;
use Cloudinary\Cloudinary;

class MesureController extends Controller
{
    public function create($clientId)
    {
        $client = Client::findOrFail($clientId);
        $mesure = $client->mesures()->latest()->first();
        
        return view('admin.mesures.create', compact('client', 'mesure'));
    }

    public function store(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);

        $request->validate([
            'nom' => 'nullable|string|max:255',
            'cou' => 'nullable|numeric|min:0',
            'epaule' => 'nullable|numeric|min:0',
            'manche' => 'nullable|numeric|min:0',
            'hanche' => 'nullable|numeric|min:0',
            'tourbras' => 'nullable|numeric|min:0',
            'longueurChemise' => 'nullable|numeric|min:0',
            'longueurBoubou' => 'nullable|numeric|min:0',
            'longueurPantalon' => 'nullable|numeric|min:0',
            'cuisse' => 'nullable|numeric|min:0',
            'photo_tissu' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'modele' => 'nullable|string|max:255',
            'photo_modele' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = [
            'client_id' => $client->id,
            'nom' => $request->nom,
            'cou' => $request->cou,
            'epaule' => $request->epaule,
            'manche' => $request->manche,
            'hanche' => $request->hanche,
            'tourbras' => $request->tourbras,
            'longueurChemise' => $request->longueurChemise,
            'longueurBoubou' => $request->longueurBoubou,
            'longueurPantalon' => $request->longueurPantalon,
            'cuisse' => $request->cuisse,
            'modele' => $request->modele,
        ];

        if ($request->hasFile('photo_tissu')) {
            $data['photo_tissu'] = $this->uploadToCloudinary($request->file('photo_tissu'), 'mesures/tissus');
        }

        if ($request->hasFile('photo_modele')) {
            $data['photo_modele'] = $this->uploadToCloudinary($request->file('photo_modele'), 'mesures/modeles');
        }

        Mesure::create($data);

        return redirect()->route('admin.rendezvous.index')->with('success', 'Mesures enregistrées avec succès!');
    }

    public function show($clientId)
    {
        $client = Client::with('mesures')->findOrFail($clientId);
        $mesure = $client->mesures()->latest()->first();
        
        return view('admin.mesures.show', compact('client', 'mesure'));
    }

    public function historique($clientId)
    {
        $client = Client::with('mesures')->findOrFail($clientId);
        $mesures = $client->mesures()->orderBy('created_at', 'desc')->get();
        
        return view('admin.mesures.historique', compact('client', 'mesures'));
    }

    private function uploadToCloudinary(\Illuminate\Http\UploadedFile $file, string $folder): string
    {
        $cloudName = config('cloudinary.cloud_name');
        $apiKey    = config('cloudinary.api_key');
        $apiSecret = config('cloudinary.api_secret');

        if (empty($cloudName) || empty($apiKey) || empty($apiSecret)) {
            Log::error('Cloudinary: credentials manquants', [
                'cloud_name' => $cloudName,
                'api_key'    => $apiKey ? '***' : 'NULL',
                'api_secret' => $apiSecret ? '***' : 'NULL',
            ]);
            throw new \RuntimeException('Cloudinary non configuré — vérifiez les variables d\'environnement.');
        }

        $client = new Cloudinary(
            sprintf('cloudinary://%s:%s@%s', $apiKey, $apiSecret, $cloudName)
        );

        $result = $client->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
        ]);

        return $result['secure_url'];
    }
}