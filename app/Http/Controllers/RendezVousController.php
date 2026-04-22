<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Vetement;
use App\Models\RendezVous;
use App\Models\Notification;

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

        $rendezVous = RendezVous::create([
            'dateRendezVous' => $request->dateRendezVous,
            'heure' => $request->heure,
            'statut' => RendezVous::STATUT_EN_ATTENTE,
            'commentaire' => $request->commentaire,
            'dateCreation' => now(),
            'client_id' => Auth::guard('client')->id(),
            'vetement_id' => $vetementId,
        ]);

        Notification::create([
            'type' => $request->typeNotification ?? 'EMAIL',
            'contenu' => 'Votre demande de rendez-vous a été soumise. En attente de confirmation.',
            'dateEnvoi' => now(),
            'statut' => 'ENVOYE',
            'client_id' => Auth::guard('client')->id(),
            'rendez_vous_id' => $rendezVous->id,
        ]);

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
}
