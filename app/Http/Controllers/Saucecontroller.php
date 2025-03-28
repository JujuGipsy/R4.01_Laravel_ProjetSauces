<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;

class SauceController extends Controller
{
    public function index()
    {
        $sauces = Sauce::all();
        return view('sauces.index', compact('sauces'));
    }

    public function create()
    {
        return view('sauces.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'description' => 'required|string',
            'mainPepper' => 'required|string',
            'heat' => 'required|integer|min:0|max:10',
            'imageUrl' => 'required|string',
        ]);
        $validatedData['userId'] = auth()->id();
        $validatedData['likes'] = 0;
        $validatedData['dislikes'] = 0;
        $validatedData['usersLiked'] = null;
        $validatedData['usersDisliked'] = null;
        Sauce::create($validatedData);
        return redirect()->route('sauces.index')->with('success', 'Sauce ajoutée avec succès');
    }

    


    public function show($id)
    {
        $sauce = Sauce::findOrFail($id);
        return view('sauces.show', compact('sauce'));
    }


    public function edit($id)
    {
        $sauce = Sauce::findOrFail($id);
        return view('sauces.edit', compact('sauce'));
    }

    public function update(Request $request, $id)
    {
        $sauce = Sauce::findOrFail($id);

        $request->validate([
            'name' => 'string',
            'manufacturer' => 'string',
            'description' => 'string',
            'main_pepper' => 'string',
            'imageUrl' => 'string|unique:sauces,imageUrl,' . $id,
            'heat' => 'integer',
        ]);

        if (Sauce::where('imageUrl', $request->input('imageUrl'))->where('id', '!=', $sauce->id)->exists()) {
            return redirect()->back()->withErrors(['imageUrl' => 'Cette URL d\'image est déjà utilisée.']);
        }

        $sauce->update($request->all());


        return redirect()->route('sauces.index')->with('success', 'Sauce mise à jour avec succès');
    }

    public function destroy($id)
    {
        $sauce = Sauce::findOrFail($id);
        $sauce->delete();

        return redirect()->route('sauces.index')->with('success', 'Sauce supprimée avec succès');
    }

    public function like($id)
{
    $sauce = Sauce::findOrFail($id);
    $user = auth()->user();

    $usersLiked = $sauce->usersLiked ?? [];
    $usersDisliked = $sauce->usersDisliked ?? [];

    if (in_array($user->id, $usersDisliked)) {
        $usersDisliked = array_filter($usersDisliked, fn($userId) => $userId !== $user->id);
        $sauce->dislikes -= 1; 

        $usersLiked[] = $user->id;
        $sauce->likes += 1;
    } elseif (!in_array($user->id, $usersLiked)) {
        $usersLiked[] = $user->id;
        $sauce->likes += 1;
    }

    $sauce->update([
        'usersLiked' => $usersLiked,
        'usersDisliked' => $usersDisliked,
        'likes' => $sauce->likes,
        'dislikes' => $sauce->dislikes,
    ]);

    return redirect()->route('sauces.show', $id)->with('success', 'Vous aimez cette sauce.');
}


public function dislike($id)
{
    $sauce = Sauce::findOrFail($id);
    $user = auth()->user();

    $usersLiked = $sauce->usersLiked ?? [];
    $usersDisliked = $sauce->usersDisliked ?? [];

    if (in_array($user->id, $usersLiked)) {
        $usersLiked = array_filter($usersLiked, fn($userId) => $userId !== $user->id);
        $sauce->likes -= 1;
        $usersDisliked[] = $user->id;
        $sauce->dislikes += 1;
    } elseif (!in_array($user->id, $usersDisliked)) {
        $usersDisliked[] = $user->id;
        $sauce->dislikes += 1;
    }

    $sauce->update([
        'usersLiked' => $usersLiked,
        'usersDisliked' => $usersDisliked,
        'likes' => $sauce->likes,
        'dislikes' => $sauce->dislikes,
    ]);

    return redirect()->route('sauces.show', $id)->with('success', 'Vous n\'aimez pas cette sauce.');
}

}
