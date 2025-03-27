<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;

class SauceController extends Controller
{
    public function index()
    {
        // Récupérer toutes les sauces de la base de données
        $sauces = Sauce::all();

        // Retourner la vue avec les sauces
        return view('sauces.index', compact('sauces'));
    }

    public function create()
    {
        return view('sauces.create');
    }

    public function store(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'mainPepper' => 'required|string',
            'heat' => 'required|integer|min:0|max:10',
            'imageUrl' => 'nullable|url', // Si l'image est modifiable et optionnelle
        ]);

        // Ajouter l'ID de l'utilisateur connecté à la sauce
        $validatedData['userId'] = auth()->id();  // Récupère l'ID de l'utilisateur connecté

        $validatedData['likes'] = 0;
        $validatedData['dislikes'] = 0;

        // Initialiser 'userLiked' et 'userDisliked' avec des tableaux vides
        $validatedData['userLiked'] = null;  // Les likes peuvent être null
        $validatedData['userDisliked'] = null;  // Les dislikes peuvent être null

        // Créer une nouvelle sauce dans la base de données
        Sauce::create($validatedData);

        // Rediriger vers la page des sauces avec un message de succès
        return redirect()->route('sauces.index')->with('success', 'Sauce ajoutée avec succès');
    }

    


    public function show($id)
    {
        // Trouver la sauce par son ID, si elle n'existe pas, afficher une page 404
        $sauce = Sauce::findOrFail($id);
        // Retourner la vue avec les informations de la sauce
        return view('sauces.show', compact('sauce'));
    }


    public function edit($id)
    {
        $sauce = Sauce::findOrFail($id);
        return view('sauces.edit', compact('sauce'));
    }


    // Mettre à jour une sauce
    public function update(Request $request, $id)
    {
        $sauce = Sauce::findOrFail($id);

        $request->validate([
            'name' => 'string',
            'manufacturer' => 'string',
            'description' => 'string',
            'main_pepper' => 'string',
            'image_url' => 'string',
            'heat' => 'integer',
        ]);

        $sauce->update($request->all());

        return redirect()->route('sauces.index')->with('success', 'Sauce mise à jour avec succès');
    }

    // Supprimer une sauce
    public function destroy($id)
    {
        $sauce = Sauce::findOrFail($id);
        $sauce->delete();

        return response()->json(['message' => 'Sauce supprimée avec succès']);
    }

    // Aimer une sauce
    public function like($id)
    {
        $sauce = Sauce::findOrFail($id);
        $user = auth()->user();

        if (!in_array($user->id, $sauce->users_liked ?? [])) {
            $sauce->likes += 1;
            $sauce->users_liked = array_merge($sauce->users_liked ?? [], [$user->id]);
        }

        $sauce->save();

        return response()->json($sauce);
    }

    // Détester une sauce
    public function dislike($id)
    {
        $sauce = Sauce::findOrFail($id);
        $user = auth()->user();

        if (!in_array($user->id, $sauce->users_disliked ?? [])) {
            $sauce->dislikes += 1;
            $sauce->users_disliked = array_merge($sauce->users_disliked ?? [], [$user->id]);
        }

        $sauce->save();

        return response()->json($sauce);
    }
}
