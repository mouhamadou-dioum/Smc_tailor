<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vetement;
use App\Models\Categorie;

class VetementController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categorie::all();
        $categorieId = $request->query('categorie');

        $vetements = Vetement::with('categorie')
            ->where('disponible', true)
            ->when($categorieId, function ($query) use ($categorieId) {
                $query->where('categorie_id', $categorieId);
            })
            ->orderBy('dateAjout', 'desc')
            ->get();

        return view('vetements.index', compact('vetements', 'categories', 'categorieId'));
    }

    public function show($id)
    {
        $vetement = Vetement::with('categorie')->findOrFail($id);
        return response()->json($vetement);
    }
}