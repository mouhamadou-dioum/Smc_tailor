<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mesure;
use App\Models\Client;
use App\Models\RendezVous;

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
        ]);

        Mesure::create([
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
        ]);

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
}